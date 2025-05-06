<?php

namespace App\Http\Controllers;

use App\Models\ReadingData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReadingController extends Controller
{
    public function updateReading(Request $request)
    {
        try {
            // Log the incoming data for debugging
            Log::info('Received reading data:', $request->all());

            // Validate the request data
            $validated = $request->validate([
                'student_name' => 'required|string',
                'reading_time' => 'required|numeric',
                'total_words' => 'required|numeric',
                'reading_speed' => 'required|string',
                'correct_answers' => 'required|numeric',
                'total_questions' => 'required|numeric',
                'comprehension' => 'required|string',
                'word_recognition' => 'required|numeric',
                'word_label' => 'required|string',
                'miscues' => 'required|numeric',
                'section' => 'required|string',
                'language' => 'required|string'
            ]);

            // Check if the table exists
            if (!Schema::hasTable('reading_data')) {
                Log::error('reading_data table does not exist');
                return response()->json([
                    'success' => false,
                    'message' => 'Database table does not exist. Please run migrations.'
                ], 500);
            }

            // Create or update the reading data
            $readingData = ReadingData::updateOrCreate(
                [
                    'student_name' => $validated['student_name'],
                    'section' => $validated['section'],
                    'language' => $validated['language']
                ],
                $validated
            );

            Log::info('Successfully saved reading data:', ['data' => $readingData]);

            return response()->json([
                'success' => true,
                'message' => 'Reading data saved successfully',
                'data' => $readingData
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . json_encode($e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error saving reading data: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error saving reading data: ' . $e->getMessage()
            ], 500);
        }
    }
} 