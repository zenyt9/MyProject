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
            'category_id' => 'required|exists:car_categories,id'
        ]);

        // Зураг хадгалах
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/cars'), $imageName);
            $validated['image'] = 'cars/' . $imageName;
        }

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
            'category_id' => 'required|exists:car_categories,id'
        ]);

        // Зураг шинэчлэх
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Хуучин зургийг устгах
            if ($car->image && file_exists(public_path('storage/' . $car->image))) {
                unlink(public_path('storage/' . $car->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/cars'), $imageName);
            $validated['image'] = 'cars/' . $imageName;
        }

        $car->update($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Машин амжилттай шинэчлэгдлээ');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Машин амжилттай устгагдлаа');
    }

    /**
     * Display available cars for users
     */
    public function userIndex(Request $request)
    {
        $query = Car::with('category')->where('status', 'available');

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Optional: Add search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        $cars = $query->orderBy('daily_rate', 'asc')->get();

        return view('user.cars.index', compact('cars'));
    }
}
