<?php

namespace App\Http\Controllers;

use App\Models\ImportDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Traits\ApiResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    use ApiResponses;
    public function index()
    {

        $data = $this->getData(null, null);
        return view('bewama::pages/dashboard/statistic/index', compact('data'));
    }
    //api
    public function getStatistics(Request $request)
    {

        $data = $this->getData($request->from_time, $request->to_time);
        return $this->successEntityResponse($data);
    }
    //endapi

    protected function getData($from, $to)
    {

        if (!$from || !$to) {
            // where between get data inside, not include last and first  
            $from = Carbon::today()->subDays(7)->toDateString();
            $to = Carbon::today()->addDay()->toDateString();
        } else {
            $from = Carbon::parse($from)->subDay()->toDateString();
            $to = Carbon::parse($to)->addDay()->toDateString();
        }
        $revenue = Order::query()
            ->whereBetween('created_at', [$from, $to])
            ->sum('total_amount');
        $totalImport = ImportDetail::query()->whereHas('import', function ($query) use ($from, $to) {
            $query->whereBetween('created_at', [$from, $to]);
        })->sum('price');
        $successOrder = Order::query()
            ->where('status', 'success')
            ->whereBetween('created_at', [$from, $to])
            ->count();
        $canceledOrder = Order::query()
            ->where('status', 'canceled')
            ->whereBetween('created_at', [$from, $to])
            ->count();
        $topSelling = Product::select('products.id AS product_id', 'products.name AS product_name')
            ->selectRaw('SUM(order_details.amount) AS total_amount_sold')
            ->selectRaw('SUM(CASE WHEN order_details.promotion_amount IS NOT NULL THEN order_details.amount * order_details.promotion_amount ELSE order_details.amount * order_details.regular_amount END) AS total_sales_amount')
            ->join('drink_sizes', 'drink_sizes.drink_id', '=', 'products.id')
            ->join('order_details', 'order_details.drink_size_id', '=', 'drink_sizes.id')
            ->whereBetween('order_details.created_at', [$from, $to])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_amount_sold')
            ->limit(10)
            ->get();
        $toppingSelling = Product::select('products.id AS product_id', 'products.name AS product_name', 'uoms.name as uom')
            ->selectRaw('SUM(toppings.amount) AS total_amount')
            ->selectRaw('SUM(order_toppings.price) AS total_price ')
            ->join('toppings', 'toppings.material_id', '=', 'products.id')
            ->join('order_toppings', 'order_toppings.topping_id', '=', 'toppings.id')
            ->join('order_details', 'order_details.id', '=', 'order_toppings.order_detail_id')
            ->join('uoms', 'products.uom_id', '=', 'uoms.id')
            ->whereBetween('order_details.created_at', [$from, $to])
            ->groupBy('products.id', 'products.name', 'uoms.name')
            ->get();
        return  [
            'total_import' => $totalImport,
            'success_order' => $successOrder,
            'canceled_order' => $canceledOrder,
            'revenue' => $revenue,
            'top_product_sell' => $topSelling,
            'top_topping_sell' => $toppingSelling,
            'from_time' => Carbon::parse($from)->addDay()->toDateString(),
            'to_time' => Carbon::parse($to)->subDay()->toDateString(),
        ];
    }
}
