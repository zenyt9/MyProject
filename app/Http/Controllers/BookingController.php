<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Car;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'car'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::all();
        $cars = Car::where('status', 'available')->get();
        return view('bookings.create', compact('customers', 'cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'booking_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string'
        ]);

        Booking::create($validated);
        return redirect()->route('admin.bookings.index')->with('success', 'Захиалга амжилттай нэмэгдлээ');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('bookings.edit', compact('booking', 'customers', 'cars'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'booking_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $booking->update($validated);
        return redirect()->route('admin.bookings.index')->with('success', 'Захиалга амжилттай шинэчлэгдлээ');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Захиалга амжилттай устгагдлаа');
    }
}
