<?php

namespace App\Http\Controllers;

use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CarCategory::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'daily_rate' => 'required|numeric|min:0'
        ]);

        CarCategory::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Ангилал амжилттай нэмэгдлээ');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarCategory $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'daily_rate' => 'required|numeric|min:0'
        ]);

        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Ангилал амжилттай шинэчлэгдлээ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Ангилал амжилттай устгагдлаа');
    }
}
