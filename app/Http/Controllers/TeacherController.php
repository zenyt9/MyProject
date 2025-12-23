<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ]);

        Teacher::create($request->only(['name', 'email', 'phone']));

        return redirect()->route('teacher.index')->with('success', 'Багш амжилттай нэмэгдлээ!');
    }

    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ]);

        $teacher->update($request->only(['name', 'email', 'phone']));

        return redirect()->route('teacher.index')->with('success', 'Багш амжилттай засагдлаа!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success', 'Багш устгагдлаа!');
    }
}
