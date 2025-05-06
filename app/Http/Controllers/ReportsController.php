<?php

namespace App\Http\Controllers;

use App\Models\ReadingData;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $section = $request->query('section', 'narra');
        $language = $request->query('language', 'english');

        // Get reading data for the specified section and language
        $students = ReadingData::where('section', strtolower($section))
                             ->where('language', strtolower($language))
                             ->get();

        return view('teacher.viewreports', [
            'students' => $students,
            'section' => $section,
            'language' => $language
        ]);
    }
} 