<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductExPrice;
use App\Models\ProductImPrice;
use App\Tables\PriceTable;
use Exception;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PriceTable $priceTable)
    {
        // dd(Product::all()->map())
        return view('bewama::pages/dashboard/price/index', compact('priceTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with(['importPrices' => function ($query) {
            $query->orderByDesc('apply_from');
        }, 'exportPrices' => function ($query) {
            $query->orderByDesc('apply_from');
        }])->get();
        return view('bewama::pages/dashboard/price/create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'price' => 'required',
            'product_id' => 'required',
            'apply_from' => ['date', 'required'],
            'is_import' => 'required',
        ]);
        $product = Product::find($data['product_id']);
        $data['price'] = str_replace('.', '', $data['price']);
        // dd(strtotime($product->lastestExportApplyFrom) >= strtotime($data['apply_from']), $product->lastestExportApplyFrom,  $data['apply_from']);
        try {
            if ($data['is_import']) {
                if ($product->lastestImportApplyFrom >=   $data['apply_from']) {
                    return back()->withInput()->with('error', __('Apply time must be after latest apply time '));
                }
                ProductImPrice::create($data);
            } else {
                if ($product->lastestExportApplyFrom >=  $data['apply_from']) {
                    return back()->withInput()->with('error', __('Apply time must be after latest apply time '));
                }
                ProductExPrice::create($data);
            }
            return  back()->withInput()->with('message', __('Price created successfully'));
        } catch (Exception $e) {
            return back()->withInput()->with('error', __($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
