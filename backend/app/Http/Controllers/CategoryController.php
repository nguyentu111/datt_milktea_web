<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use App\Tables\CategoryTable;
use App\Tables\TypeTable;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryTable $categoryTable)
    {
        return view('bewama::pages/dashboard/category/index', compact('categoryTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $types = Type::query()->whereNot('name', 'Toppings')->whereNot('name', 'Materials')->get();
        $categories = Category::all();
        return view('bewama::pages/dashboard/category/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'max:50', 'unique:categories,name'],
            'parent_id' => ['sometimes'],
        ]);

        $picture = null;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }
        Category::create([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'] ?? null,
            'picture' => $picture
        ]);
        return redirect('/dashboard/categories')->with('message', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $categories = Category::all();
        return view('bewama::pages/dashboard/category/show', compact('categories', 'category'));
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
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'max:50', 'unique:categories,name,' . $category->id],
            'parent_id' => ['sometimes'],

        ]);

        $picture = $category->picture;
        if ($request->has('picture')) {
            $picture = cloudinary()->upload($request->file('picture')->getRealPath())->getSecurePath();
        }
        $category->update([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'] ?? null,
            'picture' => $picture
        ]);
        return redirect('/dashboard/categories')->with('message', 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return back()->with(['error' => 'category has products cannot delete']);
        }
        if ($category->childrenCategory()->exists()) {
            return back()->with(['error' => 'category has child cannot delete']);
        }
        $category->delete();
        return redirect('/dashboard/categories')->with('message', 'category deleted successfully');
    }
    //api:
    public function getCategories()
    {
        return $this->successCollectionResponse(Category::with('descendants')->whereNull('parent_id')->get());
    }

    //end api
}
