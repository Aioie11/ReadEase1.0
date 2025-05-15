<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all()->groupBy('grade_level');
        return view('admin.studentRecord', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'grade_level' => 'required|integer|between:7,10',
            'section' => 'required|string|max:255'
        ]);

        $student = Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'gender' => $request->gender,
            'grade_level' => $request->grade_level,
            'section' => $request->section
        ]);

        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $section = $request->input('section');
        
        \Log::info('Search request received', [
            'query' => $query,
            'section' => $section
        ]);

        $students = Student::where(function($q) use ($query) {
            $q->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(CONCAT(last_name, ", ", first_name)) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(CONCAT(first_name, " ", last_name)) LIKE ?', ['%' . strtolower($query) . '%']);
        })
        ->when($section, function($q) use ($section) {
            return $q->where('section', $section);
        })
        ->get()
        ->map(function($student) {
            $student->name = $student->last_name . ', ' . $student->first_name . ' ' . ($student->middle_name ? $student->middle_name : '');
            return $student;
        });

        \Log::info('Search results', [
            'count' => $students->count(),
            'students' => $students->toArray()
        ]);

        return response()->json($students);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'grade_level' => 'required|integer|between:7,10',
            'section' => 'required|string|max:255'
        ]);

        $student->update($request->all());

        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['success' => true]);
    }
}
