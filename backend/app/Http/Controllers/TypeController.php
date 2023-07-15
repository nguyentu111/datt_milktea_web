<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Tables\TypeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(TypeTable $typeTable)
    {
        return view('bewama::pages/dashboard/type/index', compact('typeTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::query()->whereNot('name', 'Toppings')->whereNot('name', 'Materials')->get();
        return view('bewama::pages/dashboard/type/create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'max:50', 'unique:types,name'],
            'parent_id' => ['sometimes'],
        ]);

        $picture = null;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }
        Type::create([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'] ?? null,
            'picture' => $picture
        ]);
        return redirect('/dashboard/types')->with('message', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $types = Type::all();
        return view('bewama::pages/dashboard/type/show', compact('types', 'type'));
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
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'name' => ['required', 'max:50', 'unique:types,name,' . $type->id],
            'parent_id' => ['sometimes'],

        ]);

        $picture = $type->picture;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }
        $type->update([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'] ?? null,
            'picture' => $picture
        ]);
        return redirect('/dashboard/types')->with('message', 'Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        if ($type->products()->exists()) {
            return back()->with(['error' => 'Type has products cannot delete']);
        }
        if ($type->childrenType()->exists()) {
            return back()->with(['error' => 'Type has child type cannot delete']);
        }
        $type->delete();
        return redirect('/dashboard/types')->with('message', 'Type deleted successfully');
    }
}
