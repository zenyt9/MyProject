<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:50|unique:customers',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255'
        ]);

        Customer::create($validated);
        return redirect()->route('admin.customers.index')->with('success', 'Үйлчлүүлэгч амжилттай нэмэгдлээ');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:50|unique:customers,license_number,' . $customer->id,
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255'
        ]);

        $customer->update($validated);
        return redirect()->route('admin.customers.index')->with('success', 'Үйлчлүүлэгч амжилттай шинэчлэгдлээ');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Үйлчлүүлэгч амжилттай устгагдлаа');
    }
}
