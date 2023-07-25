<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;
use App\Traits\ApiResponses;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    use ApiResponses;

    public function addAddress(Request $request, $id)
    {
        $data = $request->validate([
            'address' => ['string', 'required'],
            'is_default' => ['sometimes', 'boolean']
        ]);
        if ($data['is_default']) {
            $customerAddresses = Address::query()->where('customer_id', $id)->get();
            $customerAddresses->each->update([
                'is_default' => false
            ]);
        }
        Address::create([
            'customer_id' => $id,
            'address' =>  $data['address'],
            'is_default' =>  $data['is_default'],
        ]);
        return $this->successEntityResponse(null);
    }
    public function getAddresses($id)
    {
        $customerAddresses = Address::query()->where('customer_id', $id)->get();
        return $this->successCollectionResponse($customerAddresses);
    }
    //web
    public function searchCustomer(Request $request)
    {
        $searchTerm = $request->query('search');
        if ($searchTerm) {
            $cus = Customer::query()
                ->orWhere(function ($query) use ($searchTerm) {
                    $query->where('phone', 'like', '%' . $searchTerm . '%')
                        ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
                })->whereNot('last_name', 'default')
                ->get();
            return $this->successCollectionResponse($cus);
        }
    }
    //web
    public function addCustomer(Request $request)
    {
        try {
            $cus = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ]);
            return $this->successEntityResponse($cus);
        } catch (Exception $e) {
            return $this->errorResponse($cus);
        }
    }
    public function addFavorite(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
        ]);
        try {

            $customer = Customer::find(Auth::user()->customer->id);
            $customer->likedDrinks()->attach($data['product_id']);
            return $this->successEntityResponse(['message' => 'Add to favorite successfully']);
        } catch (Exception $e) {
            throw $e;
            return $this->errorResponse(['message' => 'Failed']);
        }
    }
    public function removeFavorite(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
        ]);
        try {

            $customer = Customer::find(Auth::user()->customer->id);
            $customer->likedDrinks()->detach($data['product_id']);
            return $this->successEntityResponse(['message' => 'Remove favorite successfully']);
        } catch (Exception $e) {
            throw $e;
            return $this->errorResponse(['message' => 'Failed']);
        }
    }
    public function getFavorite(Request $request)
    {
        try {
            $customer = Customer::find(Auth::user()->customer->id);;
            $drinks =  $customer->likedDrinks()->with(['category', 'uom', 'tax', 'sizes', 'availableToppings', 'tax', 'recipes', 'promotions' => function ($query) {
                $query->where('from_time', '<=', date("Y-m-d H:i:s"))->where('to_time', '>', date("Y-m-d H:i:s"));
            }])->get();
            return $this->successEntityResponse(new ProductCollection($drinks));
        } catch (Exception $e) {
            return $this->errorResponse(['message' => 'Failed']);
        }
    }
}
