<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass; // Ангиудын model
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('angi')->get(); // ангигийн мэдээлэлтэй хамт
        return view('student.index', compact('students'));
    }

    public function create()
    {
        $classes = SchoolClass::all(); // бүх анги авна
        return view('student.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'angi_id' => 'required|exists:school_classes,id',
        ]);

        Student::create($request->only([
            'firstname',
            'lastname',
            'birthday',
            'gender',
            'angi_id',
            'phone',
            'image'
        ]));

        return redirect()->route('student.index')
                         ->with('success', 'Оюутан амжилттай нэмэгдлээ!');
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::all();
        return view('student.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'angi_id' => 'required|exists:school_classes,id',
        ]);

        $student->update($request->only([
            'firstname',
            'lastname',
            'birthday',
            'gender',
            'angi_id',
            'phone',
            'image'
        ]));

        return redirect()->route('student.index')
                         ->with('success', 'Оюутан амжилттай засагдлаа!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')
                         ->with('success', 'Оюутан устгагдлаа!');
    }
}
