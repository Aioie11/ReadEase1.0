<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingAssessment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReadingController extends Controller
{
    public function updateReading(Request $request)
    {
        try {
            Log::info('Received reading assessment data:', $request->all());

            $validated = $request->validate([
                'student_name' => 'required|string',
                'reading_time' => 'required|numeric',
                'miscues' => 'required|integer',
                'total_words' => 'required|integer',
                'reading_speed' => 'required|integer',
                'section' => 'required|string',
                'language' => 'required|string|in:English,Filipino'
            ]);

            DB::beginTransaction();
            try {
                $assessment = ReadingAssessment::create([
                    'student_name' => $validated['student_name'],
                    'reading_time' => $validated['reading_time'],
                    'miscues' => $validated['miscues'],
                    'total_words' => $validated['total_words'],
                    'reading_speed' => $validated['reading_speed'],
                    'section' => $validated['section'],
                    'language' => $validated['language'],
                    'assessment_date' => now()
                ]);

                DB::commit();
                Log::info('Reading assessment saved successfully:', ['assessment_id' => $assessment->id]);

                return response()->json([
                    'success' => true,
                    'message' => 'Reading assessment saved successfully',
                    'assessment' => $assessment
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . json_encode($e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error saving reading assessment:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save reading assessment: ' . $e->getMessage()
            ], 500);
        }
    }
} 