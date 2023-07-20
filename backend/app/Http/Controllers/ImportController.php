<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchMaterial;
use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Product;
use App\Models\Supplier;
use App\Tables\ImportTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ImportTable $importTable)
    {
        return view('bewama::pages/dashboard/import/index', compact('importTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $branches = Branch::query()->where('active', true)->whereNot('id', Auth::user()->staff->branch->id)->get();
        $suppliers = Supplier::all();

        return view('bewama::pages/dashboard/import/create', compact('products', 'branches', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'branch_id' => ['sometimes'],
            'supplier_id' => ['sometimes'],
            'products' => 'string'
        ]);

        try {
            DB::beginTransaction();
            $import = Import::create([
                'supplier_id' => $data['supplier_id'] ?? null,
                'staff_id' => Auth::user()->staff->id,
                'branch_source_id' => $data['branch_id'] ?? null,
                'branch_des_id' => Auth::user()->staff->branch->id,
            ]);
            $products = [];
            foreach (json_decode($data['products']) as $product) {
                $products[] = [
                    'import_id' => $import->id,
                    'material_id' => $product->material_id,
                    'amount' => $product->amount
                ];
                if (isset($data['branch_id'])) {
                    $branchSourceMaterial = BranchMaterial::where([
                        'branch_id' =>  $data['branch_id'],
                        'material_id' =>  $product->material_id,
                    ])->first();
                    if ($branchSourceMaterial) {
                        $branchSourceMaterial->amount = floatval($branchSourceMaterial->amount) -  floatval($product->amount);
                        if ($branchSourceMaterial->amount < 0) return back()->withInput()->with('error', __('Branch not enought material '));
                        $branchSourceMaterial->save();
                    } else {
                        return back()->withInput()->with('error', __('Branch not enought material '));
                    }
                }
                $branchDesMaterial = BranchMaterial::where([
                    'branch_id' => Auth::user()->staff->branch->id,
                    'material_id' =>  $product->material_id,
                ])->first();

                if ($branchDesMaterial) {
                    $branchDesMaterial->amount = floatval($product->amount) + floatval($branchDesMaterial->amount);
                    $branchDesMaterial->save();
                } else {
                    $branch = Branch::query()->find(Auth::user()->staff->branch->id);
                    $branch->products()->attach([
                        [
                            'material_id' =>  $product->material_id,
                            'amount' => $product->amount
                        ]
                    ]);
                }
            }

            ImportDetail::insert($products);

            DB::commit();
            return redirect('dashboard/imports')->with('message', __('import created successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Import $import)
    {
        return view('bewama::pages/dashboard/import/show', compact('import'));
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
