<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Бүх ангиудыг харуулах.
     */
    public function index()
    {
        $classes = SchoolClass::all();
        return view('angi.index', compact('classes'));
    }

    /**
     * Шинэ анги нэмэх form.
     */
    public function create()
    {
        return view('angi.create');
    }

    /**
     * Шинэ анги нэмэх.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SchoolClass::create($request->only(['name', 'tailbar']));

        return redirect()->route('angi.index')->with('success', 'Анги амжилттай нэмэгдлээ!');
    }

    /**
     * Анги засах form харуулах.
     */
    public function edit(SchoolClass $angi)
    {
        return view('angi.edit', compact('angi'));
    }

    /**
     * Анги update хийх.
     */
    public function update(Request $request, SchoolClass $angi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $angi->update($request->only(['name', 'tailbar']));

        return redirect()->route('angi.index')->with('success', 'Анги амжилттай засагдлаа!');
    }

    /**
     * Анги устгах.
     */
    public function destroy(SchoolClass $angi)
    {
        $angi->delete();
        return redirect()->route('angi.index')->with('success', 'Анги устгагдлаа!');
    }
}
