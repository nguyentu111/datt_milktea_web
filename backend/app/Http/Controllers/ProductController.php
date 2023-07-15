<?php

namespace App\Http\Controllers;

use App\Models\DrinkSize;
use App\Models\Product;
use App\Models\ProductImPrice;
use App\Models\ProductExPrice;
use App\Models\Recipe;
use App\Models\Size;
use App\Models\Tax;
use App\Models\Topping;
use App\Models\Type;
use App\Models\Uom;
use App\Tables\ProductTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

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
        })->where('active', '1')->get();
        // $toppings = Product::query()->whereHas('type', function ($query) {
        //     $query->where('name', 'Toppings');
        // })->where('active', '1')->get();
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
        $data = $request->validate([
            'name' => ['required', 'unique:' . Product::class . ',name', 'string', 'max:50'],
            'description' => ['sometimes', 'max:255'],
            'tax_id' => ['required'],
            'uom_id' => ['required'],
            'type_id' => ['required'],
            'active' => ['required'],
            'sizes' => ['string'],
            'toppings' => ['string'],
            'import_price' => ['string'],
            'export_price' => ['string']
        ]);
        $picture = null;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }

        try {
            DB::beginTransaction();
            $product = Product::create([
                ...$data,
                'picture' => $picture,
            ]);
            if (isset($data['import_price']))
                ProductImPrice::create([
                    'product_id' => $product->id,
                    'price' => $data['import_price'],
                    'apply_from' => date("Y-m-d H:i:s")
                ]);
            if (isset($data['export_price']))

                ProductExPrice::create([
                    'product_id' => $product->id,
                    'price' => $data['export_price'],
                    'apply_from' => date("Y-m-d H:i:s")
                ]);
            $toppings = [];
            foreach (json_decode($data['toppings']) as $topping) {
                $toppings[] = [
                    'material_id' => $topping->material_id,
                    'drink_id' => $product->id,
                    'active' => $topping->active,
                    'amount' => $topping->amount,
                ];
            }
            Topping::insertOrIgnore($toppings);
            $sizes = json_decode($data['sizes']);
            foreach ($sizes as $size) {
                $newDrinkSize = [
                    'drink_id' => $product->id,
                    'size_id' => $size->size_id,
                    'active' => $size->active,
                    'price_up_percent' => $size->price_up_percent,
                ];
                $insertedSize = DrinkSize::create($newDrinkSize);
                $recipes = [];
                foreach ($size->materials as $material) {
                    $recipes[] = [
                        'drink_size_id' => $insertedSize->id,
                        'material_id' => $material->material_id,
                        'amount' => $material->amount,
                    ];
                }
                Recipe::insertOrIgnore($recipes);
            }
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
    public function show(Product $product)
    {
        $materials = Product::query()->whereHas('type', function ($query) {
            $query->where('name', 'Materials');
        })->where('active', '1')->get();
        $toppings = Product::query()->whereHas('type', function ($query) {
            $query->where('name', 'Toppings');
        })->where('active', '1')->get();
        $taxs = Tax::all();
        $uoms = Uom::all();
        $types = Type::all();
        $sizes = Size::all();
        return view('bewama::pages/dashboard/product/show', compact('materials', 'taxs', 'types', 'uoms', 'sizes', 'product', 'toppings'));
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
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:' . Product::class . ',name,' . $product->id, 'string', 'max:50'],
            'description' => ['sometimes', 'max:255'],
            'tax_id' => ['required'],
            'uom_id' => ['required'],
            'type_id' => ['required'],
            'active' => ['required'],
            'sizes' => ['string'],
            'toppings' => ['string'],
            'import_price' => ['string'],
            'export_price' => ['string']
        ]);
        $picture = $product->picture;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }

        try {
            DB::beginTransaction();
            $product->update([
                ...$data,
                'picture' => $picture,
            ]);
            // if (isset($data['import_price']))
            //     ProductImPrice::create([
            //         'product_id' => $product->id,
            //         'price' => $data['import_price'],
            //         'apply_from' => date("Y-m-d H:i:s")
            //     ]);
            // if (isset($data['export_price']))

            //     ProductExPrice::create([
            //         'product_id' => $product->id,
            //         'price' => $data['export_price'],
            //         'apply_from' => date("Y-m-d H:i:s")
            //     ]);
            $product->recipes()->delete();
            $product->toppings()->delete();
            $product->drinkSizes()->delete();
            $toppings = [];
            foreach (json_decode($data['toppings']) as $topping) {
                $toppings[] = [
                    'material_id' => $topping->material_id,
                    'drink_id' => $product->id,
                    'active' => $topping->active,
                    'amount' => $topping->amount,
                ];
            }

            Topping::insertOrIgnore($toppings);
            $sizes = json_decode($data['sizes']);
            foreach ($sizes as $size) {
                $newDrinkSize = [
                    'drink_id' => $product->id,
                    'size_id' => $size->size_id,
                    'active' => $size->active,
                    'price_up_percent' => $size->price_up_percent,
                ];
                $insertedSize = DrinkSize::create($newDrinkSize);
                $recipes = [];
                foreach ($size->materials as $material) {
                    $recipes[] = [
                        'drink_size_id' => $insertedSize->id,
                        'material_id' => $material->material_id,
                        'amount' => $material->amount,
                    ];
                }
                Recipe::insertOrIgnore($recipes);
            }
            DB::commit();
            return redirect('dashboard/products')->with('message', __('Product update successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', __($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
