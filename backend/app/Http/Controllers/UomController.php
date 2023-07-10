<?php

namespace App\Http\Controllers;

use App\Models\Uom;
use App\Tables\UomTable;
use Illuminate\Http\Request;

class UomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UomTable $uomTable)
    {
        return view('bewama::pages/dashboard/uom/index', compact('uomTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bewama::pages/dashboard/uom/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['unique:uoms,name']]);
        Uom::create($data);
        return redirect('/dashboard/uoms')->with('message', __('Uom created successfully'));
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
    public function destroy(Uom $uom)
    {
        if ($uom->products()->exists()) return redirect('/dashboard/uoms')->with('error', __('Uom has product cannot delete'));
        $uom->delete();
        return redirect('/dashboard/uoms')->with('message', __('Uom deleted successfully'));
    }
}
