<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:50|unique:drivers',
            'email' => 'required|email|unique:drivers',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255'
        ]);

        Driver::create($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Жолооч амжилттай нэмэгдлээ');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:50|unique:drivers,license_number,' . $driver->id,
            'email' => 'required|email|unique:drivers,email,' . $driver->id,
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255'
        ]);

        $driver->update($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Жолооч амжилттай шинэчлэгдлээ');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Жолооч амжилттай устгагдлаа');
    }
}
