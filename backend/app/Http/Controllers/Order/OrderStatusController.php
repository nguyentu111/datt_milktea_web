<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use Exception;

class OrderStatusController extends Controller
{
    use ApiResponses;
    public function __invoke(Request $request)
    {
        $current = Order::find($request->id);
        if (!$current) return $this->errorResponse(['message' => 'order not found']);
        $current->status = $request->status;
        $current->cheff_id = $request->cheff_id;
        $current->save();
        return $this->successEntityResponse(['message' => 'update status success', 'status' => $request->status]);
    }
}
