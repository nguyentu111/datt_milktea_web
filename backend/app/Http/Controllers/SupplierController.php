<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Tables\SupplierTable;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierTable $supplierTable)
    {
        return view('bewama::pages/dashboard/supplier/index', compact('supplierTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bewama::pages/dashboard/supplier/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'max:50'],
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|digits:10',
            'address' => 'required',
        ]);
        Supplier::create($validation);
        return redirect('/dashboard/suppliers')->with('message', __('Create supplier successfully'));
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
    public function destroy(Supplier $sup)
    {
        if ($sup->imports()->exists()) {
            return back()->withInput()->with('error', __('Supplier has import cannot delete'));
        }
        $sup->delete();
        return  redirect('/dashboard/suppliers')->with('message', __('Delete supplier successfully'));
    }
}
