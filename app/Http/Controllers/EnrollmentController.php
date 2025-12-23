<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Элсэлтийн жагсаалт.
     */
    public function index()
    {
        // Анги, хичээлтэй хамт
        $enrollments = Enrollment::with(['schoolClass', 'subject'])->get();
        return view('elselt.index', compact('enrollments'));
    }

    /**
     * Шинэ элсэлт нэмэх.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $subjects = Subject::all();

        return view('elselt.create', compact('classes', 'subjects'));
    }

    /**
     * Элсэлтийг хадгалах.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id'      => 'required|exists:subjects,id',
            'semester'        => 'required|string|max:10',
            'year'            => 'required|integer',
        ]);

        Enrollment::create($request->only([
            'firstname', 'lastname', 'email', 'phone',
            'school_class_id', 'subject_id', 'semester', 'year'
        ]));

        return redirect()->route('elselt.index')
                         ->with('success', 'Элсэлт амжилттай нэмэгдлээ!');
    }

    /**
     * Элсэлтийг устгах.
     */
    public function destroy(Enrollment $enrollment)
{
    $enrollment->delete();
    return redirect()->route('elselt.index')->with('success', 'Элсэлт амжилттай устгагдлаа!');
}

}
