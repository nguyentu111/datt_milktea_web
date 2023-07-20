<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\DrinkSize;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::query()->with(['orderDetails.toppings.product.uom', 'orderDetails.drinkSize.recipes.material.uom', 'orderDetails.drinkSize.product', 'orderDetails.drinkSize.size'])
            ->where('status', 'pending')->orWhere('status', 'wait_for_shipping')->orWhere('status', 'processing')->orderbyDesc('created_at')->get();
        // dd($order);
        return view('bewama::pages/dashboard/order/index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        $data = $request->all();

        $result = DB::transaction(function () use ($data) {

            $data['status'] = 1;
            // $data['created']
            $new_order = Order::create($data);

            foreach ($data['order_detail'] as $key => $order_detail) {
                $topping_list = [];

                $drink_detail = DrinkDetail::find($order_detail['drink_detail_id']);
                $drink_info = Drink::find($drink_detail['drink_id']);
                $drink_info['sales_on_day'] =  $order_detail['quantity'] + $drink_info['sales_on_day'];
                $drink_info->save();

                foreach ($order_detail['topping_list'] as $key1 => $toppings) {
                    $topping_list[$key1]['quan'] = $toppings['quan'];
                    $topping_list[$key1]['price'] = [];
                    foreach ($toppings['topping'] as $key2 => $topping) {
                        $topping_list[$key1]['price'][$key2] = Topping::select('price')->where('id', $topping['topping_id'])->first()->price + 0;
                        $topping_list[$key1]['topping'][$key2] = $topping['topping_id'];
                    }
                }

                $new_order->drinkDetails()->attach(
                    $order_detail['drink_detail_id'],
                    [
                        'quantity' => $order_detail['quantity'],
                        'price' => $order_detail['price'],
                        'topping_list' => json_encode($topping_list)
                    ]
                );
            }
            return $new_order;
        });

        if ($result == null) {
            return response()->json([
                'status'   => 'error',
                'msg' => "Them that bai"
            ], 422);
        } else {
            return response()->json([
                'status'   => 'success',
                'msg' => "Them thanh cong",
                'newOrder' => new OrderResource(Order::find($result['id'])),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $data = $order->drinkDetails()->get();
        $order_details = [];
        $toppingList = [];
        $i = 0;

        foreach ($data as $order_detail) {
            $order_details[$i]['drinkDetail'] = DrinkDetail::find($order_detail['id']);
            $order_details[$i]['drink_detail_id'] = $order_detail['id'];
            $order_details[$i]['drinkName'] = Drink::select('name')->where('id', $order_details[$i]['drinkDetail']['drink_id'])->first()['name'];
            $order_details[$i]['drinkSize'] = Size::select('name')->where('id', $order_details[$i]['drinkDetail']['size_id'])->first()['name'];
            $order_details[$i]['quantity'] = $order_detail['pivot']['quantity'];
            $order_details[$i]['price'] = $order_detail['pivot']['price'];


            if ($order_detail['pivot']['topping_list'] != null) {
                $order_details[$i]['topping_list']  = json_decode($order_detail['pivot']['topping_list'], true);
                foreach ($order_details[$i]['topping_list'] as $key => $toppings) {
                    foreach ($toppings['topping'] as $key_topping => $topping_id) {
                        $topping_info = Topping::select('id', 'name')->where('id', $topping_id)->first();
                        $topping_info['price'] = $toppings['price'][$key_topping];
                        $order_details[$i]['topping_list'][$key]['toppingInfo'][$key_topping] = $topping_info;
                    }
                    unset($order_details[$i]['topping_list'][$key]['price']);
                    unset($order_details[$i]['topping_list'][$key]['topping']);
                }
            } else {
                $order_details[$i]['topping_list'] == 'null';
            }
            unset($order_details[$i]['drinkDetail']);
            $i += 1;
        }

        return response()->json([
            'status' => 'success',
            'order' => new OrderResource($order),
            'orderDetail' => $order_details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderOnWeb(Request $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();
            $customer_id = Auth::user()->customer->id;
            $order = Order::create([
                'customer_id' => $customer_id,
                'status' => 'pending',
                ...$data
            ]);
            $sizes = [];
            foreach ($data['items'] as $item) {
                $drinkSizeId = DrinkSize::query()->where([
                    'drink_id' => $item['drink']['id'],
                    'size_id' => $item['size']['id']
                ])->first()->id;
                $oderDetail =  OrderDetail::create([
                    'drink_size_id' => $drinkSizeId,
                    'order_id' =>  $order->id,
                    'regular_amount' => $item['drink']['regular_amount'],
                    'promotion_amount' => $item['drink']['promotion_amount'],
                ]);

                $toppings = [];

                foreach ($item['toppings'] as $topping) {
                    $toppings[] = [
                        'order_detail_id' =>   $oderDetail->id,
                        'topping_id' => $topping['id'],
                        'price' => $topping['price'],
                    ];
                }
                $oderDetail->toppings()->attach($toppings);
            }
            DB::commit();
            return $this->successEntityResponse(null);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
            return  $this->errorResponse(['message' => $e->getMessage()], 422);
        }
    }
}
