<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use App\Models\Tax;
use App\Models\Type;
use App\Models\Uom;
use App\Tables\ProductTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductTable $productTable)
    {
        return view("bewama::pages/dashboard/product/index", compact('productTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Product::query()->whereHas('type', function ($query) {
            $query->where('name', 'Materials');
        })->get();
        $taxs = Tax::all();
        $uoms = Uom::all();
        $types = Type::all();
        $sizes = Size::all();
        return view("bewama::pages/dashboard/product/create", compact('materials', 'taxs', 'types', 'uoms', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $data = $request->validate([
            'name' => ['required', 'unique:' . Product::class . ',name', 'string', 'max:50'],
            'description' => ['sometimes', 'max:255'],
            'tax_id' => ['required'],
            'uom_id' => ['required'],
            'type_id' => ['required'],
            'picture' => ['image', 'required'],
            'recipes' => ['array', 'sometimes'],
            'active' => ['required'],
        ]);
        $picture = null;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }

        try {
            DB::beginTransaction();
            Product::create([
                ...$data,
                'picture' => $picture,
            ]);

            DB::commit();
            return redirect('dashboard/products')->with('message', __('Product created successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', __($e->getMessage()));
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
