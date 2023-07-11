<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Drink;
use App\Http\Requests\StoreSize;
use App\Http\Requests\UpdateSize;
use App\Tables\SizeTable;
use Illuminate\Support\Facades\DB;


class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizeTable $sizeTable)
    {
        return view("bewama::pages/dashboard/size/index", compact('sizeTable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bewama::pages/dashboard/size/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['unique:sizes,name']]);
        Size::create($data);
        return redirect('/dashboard/sizes')->with('message', __('Size created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        if ($size->products()->exists()) return redirect('/dashboard/sizes')->with('error', __('Uom has product cannot delete'));
        $size->delete();
        return redirect('/dashboard/sizes')->with('message', __('Size deleted successfully'));
    }
}
