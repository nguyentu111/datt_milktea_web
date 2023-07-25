<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\BranchMaterial;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderStatusController extends Controller
{
    use ApiResponses;
    public function __invoke(Request $request)
    {

        $current = Order::find($request->id);
        if (!$current) return $this->errorResponse(['message' => 'order not found']);
        if ($request->has('cheff_id')) {
            $current->cheff_id = $request->cheff_id;
        }
        if ($request->has('status') && $request->status) {
            $current->status = $request->status;
        } else {
            switch ($current->status) {
                case 'pending':
                    $current->status = 'processing';
                    break;
                case 'processing':
                    $current->status = 'wait_for_shipping';
                    break;
                case 'wait_for_shipping':
                    if ($current->ship_to)
                        $current->status = 'shipping';
                    else   $current->status = 'success';
                    break;
                case 'shipping':
                    $current->status = 'success';
                    $current->is_paid = 1;
                    break;
            }
        }

        $current->save();
        $recipes = [];
        $currentBranch = Auth::user()->staff->branch->id;
        if ($current->status == 'wait_for_shipping') {
            //TODO : auto reduce metarial left in branch
            // $recipes = DB::select(`SELECT products.id, products.name, sum(recipes.amount) as amount FROM products 
            // join recipes on products.id = recipes.material_id join drink_sizes on recipes.drink_size_id =
            // drink_sizes.id join order_details on order_details.drink_size_id = drink_sizes.id 
            // join orders WHERE orders.id = order_details.order_id and orders.id =
            // GROUP by products.id, products.name`);
            $recipes = Product::select('products.id', 'products.name')
                ->selectRaw('sum(recipes.amount) as amount')
                ->join('recipes', 'products.id', '=', 'recipes.material_id')
                ->join('drink_sizes', 'recipes.drink_size_id', '=', 'drink_sizes.id')
                ->join('order_details', 'order_details.drink_size_id', '=', 'drink_sizes.id')
                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                ->where('orders.id', $current->id)
                ->groupBy('products.id', 'products.name')
                ->get();

            foreach ($recipes as $recipe) {
                $currentBranchMat = BranchMaterial::query()->where('material_id', $recipe->id)->where('branch_id', $currentBranch)->first();
                if ($currentBranchMat) {
                    $currentBranchMat->amount = floatval($currentBranchMat->amount) - floatval($recipe->amount);
                    $currentBranchMat->save();
                }
            }
        }
        return $this->successEntityResponse(['message' => 'update status success', 'status' => $current->status, 'a' => $recipes]);
    }
}
