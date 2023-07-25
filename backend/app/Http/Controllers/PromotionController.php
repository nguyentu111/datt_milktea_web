<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use App\Tables\PromotionTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PromotionTable $promotionTable)
    {
        return view('bewama::pages/dashboard/promotion/index', compact('promotionTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::query()->where(['active' => true])->whereHas('types', function ($query) {
            $query->where('type', 'drink');
        })->get();
        return view('bewama::pages/dashboard/promotion/create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $picture = null;
            if ($request->has('picture')) {
                $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
            }
            $promotion = Promotion::create([
                'name' => $request->name,
                'picture' => $picture,
                'from_time' =>  $request->from_day . ' ' . $request->from_time . ':00',
                'to_time' =>  $request->to_day . ' ' . $request->to_time . ':00',
            ]);
            $drinks = [];
            foreach (json_decode($request->drinks) as $drink) {
                $drinks[] = [
                    'promotion_id' => $promotion->id,
                    'drink_id' => $drink->drink_id,
                    'promotion_amount' => $drink->promotion_amount ? $drink->promotion_amount : null,
                    'discount' => $request->discount,
                ];
            }
            $promotion->products()->attach($drinks);
            DB::commit();
            return redirect('dashboard/promotions')->with('message', __('Promotion created successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', __($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        $products = Product::query()->where(['active' => true])->whereHas('types', function ($query) {
            $query->where('type', 'drink');
        })->get();
        return view('bewama::pages/dashboard/promotion/show', compact('promotion', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        try {
            DB::beginTransaction();
            $picture = $promotion->picture;
            if ($request->has('picture')) {
                $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
            }
            $promotion->update([
                'name' => $request->name,
                'picture' => $picture,
                'from_time' =>  $request->from_day . ' ' . $request->from_time . ':00',
                'to_time' =>  $request->to_day . ' ' . $request->to_time . ':00',
            ]);
            $drinks = [];
            foreach (json_decode($request->drinks) as $drink) {
                $drinks[] = [
                    'promotion_id' => $promotion->id,
                    'drink_id' => $drink->drink_id,
                    'promotion_amount' => $drink->promotion_amount ? $drink->promotion_amount : null,
                    'discount' => $request->discount,
                ];
            }
            $promotion->promotionDrink()->delete();
            $promotion->products()->attach($drinks);
            DB::commit();
            return redirect('dashboard/promotions')->with('message', __('Promotion updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', __($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        try {
            $promotion->promotionDrink()->delete();
            $promotion->delete();
            return back()->with('message', __('Promotion deleted successfully'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', __($e->getMessage()));
        }
    }
}
