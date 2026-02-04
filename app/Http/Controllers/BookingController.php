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
        // Хэрэглэгчийн захиалга
        if (auth()->check() && auth()->user()->role !== 'admin') {
            $validated = $request->validate([
                'car_id' => 'required|exists:cars,id',
                'phone' => 'required|string|size:8',
                'email' => 'required|email',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after:start_date',
                'notes' => 'nullable|string'
            ]);

            // Customer үүсгэх эсвэл олох
            $nameParts = explode(' ', auth()->user()->name, 2);
            $customer = Customer::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'firstname' => $nameParts[0],
                    'lastname' => $nameParts[1] ?? '',
                    'phone' => $validated['phone'],
                    'address' => 'Улаанбаатар'
                ]
            );

            Booking::create([
                'customer_id' => $customer->id,
                'car_id' => $validated['car_id'],
                'booking_date' => now(),
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null
            ]);

            return back()->with('success', 'Захиалга амжилттай илгээгдлээ! Админ тантай удахгүй холбогдох болно.');
        }

        // Админы захиалга
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

    public function confirm(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);
        return redirect()->route('admin.bookings.index')->with('success', 'Захиалга амжилттай баталгаажлаа!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Захиалга амжилттай устгагдлаа');
    }

    public function myBookings()
    {
        $bookings = Booking::with(['customer', 'car'])
            ->whereHas('customer', function($query) {
                $query->where('email', auth()->user()->email);
            })
            ->orWhere('user_id', auth()->id())
            ->orderBy('booking_date', 'desc')
            ->get();

        return view('user.bookings', compact('bookings'));
    }
}
