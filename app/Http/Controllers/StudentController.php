<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ReadingAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('readingAssessments')
            ->get()
            ->map(function ($student) {
                // Only consider assessments taken for the student's CURRENT grade and section
                $currentGrade = $student->grade_level;
                $currentSection = $student->section;

                // Helper to constrain to current grade/section, accounting for possible grade formats (e.g., '7' or 'grade7')
                $gradeConstraint = function ($query) use ($currentGrade) {
                    $query->where(function ($q) use ($currentGrade) {
                        $q->where('grade', $currentGrade)
                          ->orWhere('grade', 'grade' . $currentGrade);
                    });
                };

                // Check for complete English and Filipino assessments
                // A complete assessment must have reading data (reading_speed, correct_reading)
                // and comprehension data (comprehension > 0, correct_answers > 0)
                $completeEnglishAssessment = $student->readingAssessments()
                    ->where($gradeConstraint)
                    ->where('section', $currentSection)
                    ->where('language', 'english')
                    ->where('reading_speed', '>', 0)
                    ->where('correct_reading', '>', 0)
                    ->where('comprehension', '>', 0)
                    ->where('correct_answers', '>', 0)
                    ->exists();

                $completeFilipinoAssessment = $student->readingAssessments()
                    ->where($gradeConstraint)
                    ->where('section', $currentSection)
                    ->where('language', 'filipino')
                    ->where('reading_speed', '>', 0)
                    ->where('correct_reading', '>', 0)
                    ->where('comprehension', '>', 0)
                    ->where('correct_answers', '>', 0)
                    ->exists();

                // Check for incomplete assessments (has some data but not complete)
                $incompleteEnglishAssessment = $student->readingAssessments()
                    ->where($gradeConstraint)
                    ->where('section', $currentSection)
                    ->where('language', 'english')
                    ->where(function ($query) {
                        $query->where('reading_speed', '>', 0)
                            ->orWhere('correct_reading', '>', 0)
                            ->orWhere('comprehension', '>', 0)
                            ->orWhere('correct_answers', '>', 0);
                    })
                    ->exists();

                $incompleteFilipinoAssessment = $student->readingAssessments()
                    ->where($gradeConstraint)
                    ->where('section', $currentSection)
                    ->where('language', 'filipino')
                    ->where(function ($query) {
                        $query->where('reading_speed', '>', 0)
                            ->orWhere('correct_reading', '>', 0)
                            ->orWhere('comprehension', '>', 0)
                            ->orWhere('correct_answers', '>', 0);
                    })
                    ->exists();

                // Determine status based on assessment completion
                $status = 'No Assessment';
                if ($completeEnglishAssessment && $completeFilipinoAssessment) {
                    $status = 'Complete';
                } elseif (
                    $completeEnglishAssessment || $completeFilipinoAssessment ||
                    $incompleteEnglishAssessment || $incompleteFilipinoAssessment
                ) {
                    $status = 'Incomplete';
                }

                // Add the calculated test_status to the student object
                $student->test_status = $status;
                return $student;
            })
            ->groupBy('grade_level');

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

        $students = Student::where(function ($q) use ($query) {
            $q->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(CONCAT(last_name, ", ", first_name)) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(CONCAT(first_name, " ", last_name)) LIKE ?', ['%' . strtolower($query) . '%']);
        })
            ->when($section, function ($q) use ($section) {
                return $q->where('section', $section);
            })
            ->get()
            ->map(function ($student) {
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

    public function getStudentsBySection(Request $request)
    {
        $grade = $request->input('grade');
        $section = $request->input('section');

        \Log::info('Getting students by section', [
            'grade' => $grade,
            'section' => $section
        ]);

        // Extract grade number from grade parameter (e.g., 'grade7' -> 7)
        $gradeNumber = is_numeric($grade) ? $grade : (int) str_replace('grade', '', $grade);

        $students = Student::where('grade_level', $gradeNumber)
            ->where('section', ucfirst(strtolower($section)))
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'student_number' => $student->student_number,
                    'name' => $student->last_name . ', ' . $student->first_name . ' ' . ($student->middle_name ? $student->middle_name : ''),
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'middle_name' => $student->middle_name,
                    'grade_level' => $student->grade_level,
                    'section' => $student->section
                ];
            });

        \Log::info('Students found', [
            'count' => $students->count(),
            'students' => $students->toArray()
        ]);

        return response()->json([
            'success' => true,
            'students' => $students
        ]);
    }

    public function show(Student $student)
    {
        // Load student with reading assessments
        $student->load('readingAssessments');

        // Get latest assessments by language
        $latestAssessments = $student->readingAssessments()
            ->orderBy('assessment_date', 'desc')
            ->get()
            ->groupBy('language')
            ->map(function ($assessments) {
                return $assessments->first(); // Get the latest assessment for each language
            });

        // Calculate overall statistics
        $totalAssessments = $student->readingAssessments()->count();
        $avgReadingSpeed = $student->readingAssessments()->avg('reading_speed');
        $avgComprehension = $student->readingAssessments()->avg('comprehension');
        $avgCorrectReading = $student->readingAssessments()->avg('correct_reading');

        return response()->json([
            'success' => true,
            'student' => [
                'id' => $student->id,
                'student_number' => $student->student_number,
                'name' => $student->last_name . ', ' . $student->first_name . ' ' . ($student->middle_name ? $student->middle_name : ''),
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'middle_name' => $student->middle_name,
                'grade_level' => $student->grade_level,
                'section' => $student->section,
                'total_assessments' => $totalAssessments,
                'statistics' => [
                    'avg_reading_speed' => round($avgReadingSpeed, 1),
                    'avg_comprehension' => round($avgComprehension, 1),
                    'avg_correct_reading' => round($avgCorrectReading, 1)
                ],
                'latest_assessments' => $latestAssessments,
                'all_assessments' => $student->readingAssessments()->orderBy('assessment_date', 'desc')->get()
            ]
        ]);
    }
}
