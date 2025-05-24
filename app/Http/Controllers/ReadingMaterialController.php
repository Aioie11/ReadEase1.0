<?php

namespace App\Http\Controllers;

use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadingMaterialController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'grade_level' => 'required|string|in:7,8,9,10',
                'subject' => 'required|string|in:english,filipino',
                'questions' => 'required|array|min:1',
                'questions.*.question' => 'required|string',
                'questions.*.type' => 'required|in:multiple,text',
                'questions.*.options' => 'required_if:questions.*.type,multiple|array',
                'questions.*.correct_answer' => 'required|string'
            ]);

            DB::beginTransaction();

            $readingMaterial = ReadingMaterial::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'grade_level' => $validated['grade_level'],
                'subject' => $validated['subject']
            ]);

            foreach ($validated['questions'] as $question) {
                ReadingQuestion::create([
                    'reading_material_id' => $readingMaterial->id,
                    'question' => $question['question'],
                    'type' => $question['type'],
                    'options' => $question['type'] === 'multiple' ? $question['options'] : null,
                    'correct_answer' => $question['correct_answer']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reading material created successfully',
                'data' => $readingMaterial->load('questions')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to create reading material: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create reading material: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getByGradeAndSubject($grade, $subject)
    {
        try {
            $materials = ReadingMaterial::with('questions')
                ->where('grade_level', $grade)
                ->where('subject', $subject)
                ->where('is_published', true)
                ->get();

            return response()->json($materials);
        } catch (\Exception $e) {
            \Log::error('Failed to fetch reading materials: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch reading materials: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getByGradeAndSubjectForAdmin($grade, $subject)
    {
        try {
            $materials = ReadingMaterial::where('grade_level', $grade)
                ->where('subject', $subject)
                ->with('questions')
                ->get();

            return response()->json($materials);
        } catch (\Exception $e) {
            \Log::error('Error fetching reading materials for admin: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch reading materials'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'grade_level' => 'required|string',
            'subject' => 'required|string',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.type' => 'required|in:multiple,text',
            'questions.*.options' => 'required_if:questions.*.type,multiple|array',
            'questions.*.correct_answer' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $readingMaterial = ReadingMaterial::findOrFail($id);
            $readingMaterial->update([
                'title' => $request->title,
                'content' => $request->content,
                'grade_level' => $request->grade_level,
                'subject' => $request->subject
            ]);

            // Delete existing questions
            $readingMaterial->questions()->delete();

            // Create new questions
            foreach ($request->questions as $question) {
                ReadingQuestion::create([
                    'reading_material_id' => $readingMaterial->id,
                    'question' => $question['question'],
                    'type' => $question['type'],
                    'options' => $question['type'] === 'multiple' ? $question['options'] : null,
                    'correct_answer' => $question['correct_answer']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reading material updated successfully',
                'data' => $readingMaterial->load('questions')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update reading material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $readingMaterial = ReadingMaterial::findOrFail($id);
            $readingMaterial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Reading material deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete reading material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function publish($id)
    {
        try {
            $readingMaterial = ReadingMaterial::findOrFail($id);
            
            // Update the published status and published_at timestamp
            $readingMaterial->update([
                'is_published' => true,
                'published_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reading material published successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to publish reading material: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to publish reading material: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPublishedMaterial($grade = null, $subject = 'english')
    {
        try {
            // Get the current route name to determine which view to use
            $routeName = request()->route()->getName();
            
            // Set the subject based on the route
            if ($routeName === 'student.students-fil') {
                $subject = 'filipino';
            } else {
                $subject = 'english';
            }

            // Get the authenticated user's grade level
            $user = auth()->user();
            if (!$user) {
                return redirect()->route('login');
            }

            // Use the user's grade level instead of the passed parameter
            $grade = $user->grade;

            $readingMaterial = ReadingMaterial::with('questions')
                ->where('grade_level', $grade)
                ->where('subject', $subject)
                ->where('is_published', true)
                ->latest('published_at')
                ->first();

            if (!$readingMaterial) {
                return view($subject === 'english' ? 'student.stud-eng' : 'student.stud-fil', [
                    'readingMaterial' => null,
                    'error' => 'No published reading material found for your grade level.',
                    'user' => $user
                ]);
            }

            return view($subject === 'english' ? 'student.stud-eng' : 'student.stud-fil', [
                'readingMaterial' => $readingMaterial,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching published material: ' . $e->getMessage());
            return view($subject === 'english' ? 'student.stud-eng' : 'student.stud-fil', [
                'readingMaterial' => null,
                'error' => 'Error fetching reading material: ' . $e->getMessage()
            ]);
        }
    }
}
