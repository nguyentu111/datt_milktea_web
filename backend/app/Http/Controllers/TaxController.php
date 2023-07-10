<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Tables\TaxTable;
use Exception;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaxTable $taxTable)
    {
        return view('bewama::pages/dashboard/tax/index', compact('taxTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bewama::pages/dashboard/tax/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:50', 'unique:' . Tax::class . ',name'],
            'percent' => ['decimal:0,2', 'max:0.99', 'min:0']
        ]);
        try {

            Tax::create($data);
            return redirect('/dashboard/taxes')->with('message', __('Tax created successfully'));
        } catch (Exception $e) {
            return redirect('/dashboard/taxes')->with('error', __($e->getMessage()));
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
    public function destroy(Tax $tax)
    {
        if ($tax->products()->exists())
            return redirect('/dashboard/taxes')->with('error', __('Tax has products cannot delete'));
        $tax->delete();
        return redirect('/dashboard/taxes')->with('message', __('Tax deleted successfully'));
    }
}
