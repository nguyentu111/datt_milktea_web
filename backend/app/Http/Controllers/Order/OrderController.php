<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Customer;
use App\Models\DrinkSize;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
    public function orderCheff()
    {
        $branchId = Auth::user()->staff->branch->id;

        $orders = Order::query()->with(['orderDetails.toppings.product.uom', 'orderDetails.drinkSize.recipes.material.uom', 'orderDetails.drinkSize.product', 'orderDetails.drinkSize.size'])
            ->orWhere(function (Builder $query) {
                $query->orWhere('status', 'pending')->orWhere('status', 'wait_for_shipping')->orWhere('status', 'processing');
            })->where('branch_id', $branchId)->orderbyDesc('created_at')->get();
        return view('bewama::pages/dashboard/order/order-cheff', compact('orders'));
    }
    public function orderCashier()
    {
        $branchId = Auth::user()->staff->branch->id;
        $defaultCus = $this->getDefaultCustomer();
        $orders = Order::query()->with([
            'orderDetails.toppings.product.uom', 'orderDetails.drinkSize.recipes.material.uom',
            'orderDetails.drinkSize.product', 'orderDetails.drinkSize.size', 'cheff'
        ])
            ->where('branch_id', $branchId)->orderbyDesc('created_at')->get();
        return view('bewama::pages/dashboard/order/order-cashier', compact('orders', 'defaultCus'));
    }
    public function addOrder()
    {
        $drinks = $this->getDrinks();
        $drinks = new ProductCollection($drinks);
        $defaultCus = $this->getDefaultCustomer();
        return view('bewama::pages/dashboard/order/add-order', compact('drinks', 'defaultCus'));
    }

    public function orderOnline(Request $request)
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
                    'amount' => $item['quantity']
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
    protected function getDefaultCustomer()
    {
        $branchName = Auth::user()->staff->branch->name;
        $defaultCus = Customer::query()->where('last_name', 'default')
            ->where('first_name', $branchName)->get();
        return $defaultCus;
    }


    public function getDrinks()
    {
        $products = Product::query()->whereHas('types', fn ($q) => $q->where('type', 'drink'))
            ->with(['category', 'uom', 'tax', 'sizes', 'availableToppings', 'tax', 'recipes', 'promotions' => function ($query) {
                $query->where('from_time', '<=', date("Y-m-d H:i:s"))->where('to_time', '>', date("Y-m-d H:i:s"));
            }])->where('active', true)->get();
        return $products;
    }
    //api :
    public function getOrderHistory()
    {
        $customer = Auth::user()->customer;
        $order = Order::with(['orderDetails.drinkSize.product', 'orderDetails.toppings.product', 'orderDetails.drinkSize.size'])
            ->where('customer_id', $customer->id)->orWhereHas('customer', function ($query) use ($customer) {
                $query->where('phone', $customer->phone);
            })->get();
        return $this->successCollectionResponse($order);
    }
}
