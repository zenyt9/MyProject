<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['customer', 'car'])->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $customers = Customer::all();
        $cars = Car::where('status', 'available')->get();
        return view('rentals.create', compact('customers', 'cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'days' => 'required|integer|min:1',
            'daily_rate' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        Rental::create($validated);

        // Update car status
        Car::find($validated['car_id'])->update(['status' => 'rented']);

        return redirect()->route('rentals.index')->with('success', 'Түрээс амжилттай нэмэгдлээ');
    }

    public function show(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('rentals.edit', compact('rental', 'customers', 'cars'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'days' => 'required|integer|min:1',
            'daily_rate' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $rental->update($validated);

        // Update car status if rental is completed
        if ($validated['status'] == 'completed') {
            Car::find($validated['car_id'])->update(['status' => 'available']);
        }

        return redirect()->route('rentals.index')->with('success', 'Түрээс амжилттай шинэчлэгдлээ');
    }

    public function destroy(Rental $rental)
    {
        // Make car available again
        Car::find($rental->car_id)->update(['status' => 'available']);

        $rental->delete();
        return redirect()->route('admin.rentals.index')->with('success', 'Түрээс амжилттай устгагдлаа');
    }
}
