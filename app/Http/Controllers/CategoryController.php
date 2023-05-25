<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function apiCategory() {

        $categories = Category::all();


        return response()->json([
            'success' => true,
            'message' => 'List Data category',
            'data' => $categories
        ], 200);

    }
    public function index()
    {
        $categories = Category::all();

        return view('pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
        ->with('success', 'Category created successfully.');
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

        $category = Category::find($id);

        return view('pages.category.edit', compact('category'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);

        $category->update($request->all());

        return redirect()->route('categories.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $category = Category::find($id);

        $category->delete();

        return redirect()->route('categories.index');

    }
}
