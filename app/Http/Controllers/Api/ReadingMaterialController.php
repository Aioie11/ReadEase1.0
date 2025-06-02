<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ReadingMaterial;
use Illuminate\Http\Request;

class ReadingMaterialController extends Controller
{
    public function getByGradeAndSubject($grade, $subject)
    {
        try {
            $material = ReadingMaterial::where('grade_level', $grade)
                ->where('subject', $subject)
                ->where('is_published', false)
                ->latest()
                ->first();

            if (!$material) {
                return response()->json([
                    'message' => 'No unpublished reading material found for this grade and subject'
                ], 404);
            }

            return response()->json([
                'material' => $material
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching reading material: ' . $e->getMessage()
            ], 500);
        }
    }

    public function publish($id)
    {
        try {
            $readingMaterial = ReadingMaterial::findOrFail($id);
            
            // Validate that the material has both grade level and subject
            if (!$readingMaterial->grade_level || !$readingMaterial->subject) {
                return response()->json([
                    'message' => 'Reading material must have both grade level and subject before publishing'
                ], 422);
            }

            $readingMaterial->is_published = true;
            $readingMaterial->published_at = now();
            $readingMaterial->save();

            return response()->json([
                'message' => 'Reading material published successfully',
                'material' => $readingMaterial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error publishing reading material: ' . $e->getMessage()
            ], 500);
        }
    }
} 