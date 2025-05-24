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
            $materials = ReadingMaterial::where('grade_level', $grade)
                ->where('subject', $subject)
                ->with('questions')
                ->get();

            if ($materials->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($materials);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch reading materials: ' . $e->getMessage()
            ], 500);
        }
    }

    public function publish(Request $request, $id)
    {
        try {
            $material = ReadingMaterial::findOrFail($id);
            
            // Update the published status
            $material->update([
                'is_published' => true,
                'published_at' => now()
            ]);

            // Determine the redirect URL based on the subject
            $redirectUrl = $material->subject === 'english' 
                ? '/student/students-eng' 
                : '/student/students-tag';

            return response()->json([
                'success' => true,
                'message' => 'Reading material published successfully',
                'redirect_url' => $redirectUrl
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to publish reading material: ' . $e->getMessage()
            ], 500);
        }
    }
} 