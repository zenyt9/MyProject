<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $hicheeluud = Subject::all();
        return view('hicheel.index', compact('hicheeluud'));
    }

    public function create()
    {
        return view('hicheel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($request->only('name'));

        return redirect()->route('hicheel.index')->with('success', 'Хичээл амжилттай нэмлээ');
    }

    public function edit(Subject $hicheel)
    {
        return view('hicheel.edit', compact('hicheel'));
    }

    public function update(Request $request, Subject $hicheel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hicheel->update($request->only('name'));

        return redirect()->route('hicheel.index')->with('success', 'Хичээл амжилттай засагдлаа');
    }

    public function destroy(Subject $hicheel)
    {
        $hicheel->delete();

        return redirect()->route('hicheel.index')->with('success', 'Хичээл устгагдлаа');
    }
}
