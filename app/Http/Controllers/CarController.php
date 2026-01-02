<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('category')->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $categories = CarCategory::all();
        return view('cars.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:50|unique:cars',
            'color' => 'nullable|string|max:50',
            'seats' => 'nullable|integer|min:1',
            'features' => 'nullable|string',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'image' => 'nullable|string|max:255',
            'category_id' => 'required|exists:car_categories,id'
        ]);

        Car::create($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Машин амжилттай нэмэгдлээ');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $categories = CarCategory::all();
        return view('cars.edit', compact('car', 'categories'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|max:50|unique:cars,plate_number,' . $car->id,
            'color' => 'nullable|string|max:50',
            'seats' => 'nullable|integer|min:1',
            'features' => 'nullable|string',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'image' => 'nullable|string|max:255',
            'category_id' => 'required|exists:car_categories,id'
        ]);

        $car->update($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Машин амжилттай шинэчлэгдлээ');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Машин амжилттай устгагдлаа');
    }

    // User methods
    public function userIndex()
    {
        $cars = Car::with('category')->where('status', 'available')->get();
        $categories = CarCategory::all();
        return view('user.cars.index', compact('cars', 'categories'));
    }
}
