<?php

namespace App\Http\Controllers;

use App\Models\CourseSelection;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseSelectionController extends Controller
{
    public function index()
    {
        $selections = CourseSelection::with(['student', 'subject'])->get();
        return view('hicheel_songolt.index', compact('selections'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('hicheel_songolt.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        CourseSelection::create($request->only(['student_id','subject_id']));

        return redirect()->route('hicheel_songolt.index')->with('success', 'Хичээлийн сонголт амжилттай нэмэгдлээ!');
    }

    public function destroy(CourseSelection $hicheel_songolt)
    {
        $hicheel_songolt->delete();
        return redirect()->route('hicheel_songolt.index')->with('success', 'Сонголт устгагдлаа!');
    }
}


