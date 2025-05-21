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
                ->get();

            return response()->json($materials);
        } catch (\Exception $e) {
            \Log::error('Failed to fetch reading materials: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch reading materials: ' . $e->getMessage()
            ], 500);
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
}
