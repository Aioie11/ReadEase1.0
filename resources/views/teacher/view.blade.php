<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - {{ isset($student) ? $student->first_name . ' ' . $student->last_name : 'Student' }}
    </title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#0369a1', secondary: '#6b7280' }, borderRadius: { 'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px', 'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px' } } }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Uniform Color Scheme - All #00B8A9 */
        :root {
            --primary-teal: #00B8A9;
            --primary-light: #00B8A9;
            --accent-orange: #00B8A9;
            --success-green: #00B8A9;
            --warning-yellow: #00B8A9;
            --danger-red: #00B8A9;
        }

        /* Enhanced Styling for Uniform Look */
        body {
            background: linear-gradient(135deg, #F7FAFC 0%, #EDF2F7 100%);
        }

        .container {
            background: transparent;
        }

        /* Back Navigation Enhancement */
        .mb-6 a {
            background: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
        }

        .mb-6 a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            color: var(--primary-teal) !important;
        }

        /* Student Profile Card Enhancement */
        .bg-white.rounded-lg.shadow-sm.p-6.mb-6 {
            background: linear-gradient(135deg, white 0%, #F7FAFC 100%);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #E2E8F0;
            transition: transform 0.3s ease;
        }

        .bg-white.rounded-lg.shadow-sm.p-6.mb-6:hover {
            transform: translateY(-2px);
        }

        /* Avatar Enhancement */
        .w-24.h-24.bg-blue-100 {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-light) 100%) !important;
            color: white !important;
            box-shadow: 0 4px 16px rgba(0, 184, 169, 0.3);
            transition: transform 0.3s ease;
        }

        .w-24.h-24.bg-blue-100:hover {
            transform: scale(1.05);
        }

        /* Student Name Enhancement */
        h1.text-2xl.font-bold.mb-4 {
            color: #000000 !important;
            font-size: 2rem;
            font-weight: 700;
        }

        /* Student Info Text */
        .text-sm.text-gray-500 {
            color: #000000 !important;
            font-weight: 600;
        }

        /* Student Info Values */
        p:not(.text-sm) {
            color: #000000 !important;
            font-weight: 500;
        }

        /* Performance Metrics Enhancement */
        .grid.grid-cols-1.sm\\:grid-cols-3.gap-4.mb-6>div {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #E2E8F0;
            transition: all 0.3s ease;
        }

        .grid.grid-cols-1.sm\\:grid-cols-3.gap-4.mb-6>div:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        /* Icons Enhancement */
        .w-5.h-5.flex.items-center.justify-center {
            color: var(--primary-teal) !important;
        }

        /* Values Enhancement */
        h3.text-2xl.font-bold.mb-2 {
            color: #000000 !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Status Badges Enhancement */
        .bg-green-100.text-green-700 {
            background: #10B981 !important;
            color: white !important;
            font-weight: 600;
        }

        .border-primary {
            border-color: var(--primary-teal) !important;
            color: var(--primary-teal) !important;
        }

        .text-primary {
            color: var(--primary-teal) !important;
        }

        /* Main Content Enhancement */
        .bg-white.rounded-lg.shadow-sm.p-6.mb-6:last-of-type {
            background: linear-gradient(135deg, white 0%, #F7FAFC 100%);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #E2E8F0;
        }

        /* Table Enhancement */
        .min-w-full.divide-y.divide-gray-200 {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .bg-gray-50 {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-light) 100%) !important;
            color: white !important;
        }

        .hover\\:bg-gray-50:hover {
            background: linear-gradient(135deg, #F7FAFC 0%, #EDF2F7 100%) !important;
        }

        /* Book Icons Enhancement */
        .w-8.h-8.bg-blue-100 {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-light) 100%) !important;
            color: white !important;
        }

        /* Progress Bars Enhancement */
        .bg-green-500 {
            background: linear-gradient(135deg, var(--success-green) 0%, #4FD1C7 100%) !important;
        }

        /* Level Badges Enhancement */
        .bg-blue-100.text-blue-800 {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-light) 100%) !important;
            color: white !important;
            font-weight: 600;
        }

        /* Chart Cards Enhancement */
        .hover-card {
            background: linear-gradient(135deg, white 0%, #F7FAFC 100%);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #E2E8F0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .hover-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-light) 100%);
        }

        .hover-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        /* Chart Icons Enhancement */
        .w-8.h-8.bg-blue-100.rounded-full,
        .w-8.h-8.bg-green-100.rounded-full,
        .w-8.h-8.bg-red-100.rounded-full,
        .w-8.h-8.bg-purple-100.rounded-full {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-light) 100%) !important;
            color: white !important;
            transition: transform 0.3s ease;
        }

        .w-8.h-8.bg-blue-100.rounded-full:hover,
        .w-8.h-8.bg-green-100.rounded-full:hover,
        .w-8.h-8.bg-red-100.rounded-full:hover,
        .w-8.h-8.bg-purple-100.rounded-full:hover {
            transform: scale(1.1);
        }

        /* Section Titles Enhancement */
        h2.text-3xl.font-bold.text-gray-800 {
            color: #000000 !important;
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Chart Values Enhancement */
        .text-primary {
            color: #000000 !important;
        }

        .text-xl.font-bold.text-primary {
            color: #000000 !important;
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Table Text Enhancement */
        .text-gray-600,
        .text-gray-700,
        .text-gray-800 {
            color: #000000 !important;
        }

        /* Chart Text Enhancement */
        .text-lg.font-medium.text-gray-700 {
            color: #000000 !important;
            font-weight: 600;
        }

        /* All Text Elements */
        span,
        p,
        td,
        th {
            color: #000000 !important;
        }

        /* Specific Text Classes */
        .text-sm {
            color: #000000 !important;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            h1.text-2xl.font-bold.mb-4 {
                font-size: 2rem;
            }

            h2.text-3xl.font-bold.text-gray-800 {
                font-size: 1.8rem;
            }

            .container {
                padding: 1rem;
            }
        }

        .back-btn {
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,184,169,0.08);
        }
        .back-btn:hover {
            background: var(--primary-teal);
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(0,184,169,0.15);
            transform: translateY(-2px) scale(1.03);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">
    <!-- Header with Logout -->
    
    <!-- Main Content with top margin for fixed header -->
    <div class="container mx-auto p-4 max-w-7xl" style="margin-top: 30px;">
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('teacher.student-management') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white shadow-md border border-gray-200 text-primary font-semibold text-base transition-all duration-200 hover:bg-primary hover:text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 back-btn">
                <i class="ri-arrow-left-line text-lg"></i>
                <span>Back</span>
            </a>
        </div>

        <!-- Student Profile Card -->
        <div class="bg-white rounded-xl shadow-sm p-10 mb-6">
            <div class="flex flex-wrap items-center">
               

                <!-- Student Info -->
                <div class="flex-grow">
                    <h1 class="text-2xl font-bold mb-4">
                        @if(isset($student))
                            {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                        @else
                            No Student Selected
                        @endif
                    </h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-2">
                                <p class="text-sm text-gray-500">Student ID</p>
                                <p>
                                    @if(isset($student))
                                        {{ $student->student_number }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Assessments</p>
                                    <p>
                                        @if(isset($student))
                                            {{ $student->readingAssessments->count() }}
                                        @else
                                            0
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Grade & Section</p>
                                    <p>
                                        @if(isset($student))
                                            Grade {{ $student->grade_level }} - {{ $student->section }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Metrics -->
        
       
        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <!-- Reading Records -->
            <div id="reading-assessments">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Reading Records</h2>
                    
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Assessment
                                    Date</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Language
                                </th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Reading
                                    Speed</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">
                                    Comprehension</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Correct
                                    Reading</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if(isset($student) && $student->readingAssessments->count() > 0)
                                @foreach($student->readingAssessments->sortByDesc('assessment_date') as $assessment)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <span>{{ $assessment->assessment_date->format('M d, Y') }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-medium
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        {{ $assessment->language == 'english' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($assessment->language) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    @php
                                                        $speedPercentage = min(100, ($assessment->reading_speed / 150) * 100);
                                                    @endphp
                                                    <div class="bg-red-500 h-2 rounded-full"
                                                        style="width: {{ $speedPercentage }}%"></div>
                                                </div>
                                                <span>{{ $assessment->reading_speed }} wpm</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    <div class="bg-green-400 h-2 rounded-full"
                                                        style="width: {{ $assessment->comprehension }}%"></div>
                                                </div>
                                                <span>{{ $assessment->comprehension }}%</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    <div class="bg-purple-500 h-2 rounded-full"
                                                        style="width: {{ $assessment->correct_reading }}%"></div>
                                                </div>
                                                <span>{{ $assessment->correct_reading }}%</span>
                                            </div>
                                        </td>

                                        <td class="py-4 px-4">
                                            <button
                                                onclick="showComprehensionDetails('{{ $student->student_number ?? '' }}', '{{ $assessment->language }}')"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                                title="View comprehension details">
                                                <i class="ri-eye-line mr-1"></i>
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="py-8 px-4 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="ri-book-open-line text-4xl mb-2"></i>
                                            <p>No reading assessments found for this student.</p>
                                            <p class="text-sm">Assessments will appear here after completing reading tests.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <!-- English Language Test Results -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">English Language Test Results</h2>
            </div>
            <div class="charts-container">
                <!-- Reading Speed Chart -->
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="reading-speed-chart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        <p><strong>
                                @if(isset($student) && $student->readingAssessments->where('language', 'english')->first())
                                    {{ $student->readingAssessments->where('language', 'english')->first()->reading_speed ?? 0 }}
                                    WPM
                                @else
                                    0 WPM
                                @endif
                            </strong></p>
                        @if(isset($student) && $student->readingAssessments->where('language', 'english')->first())
                            @php
                                $englishAssessment = $student->readingAssessments->where('language', 'english')->first();
                                $readingTime = $englishAssessment->reading_time ?? 0;
                                $timeFormatted = $readingTime >= 60 ? floor($readingTime / 60) . ' min ' . ($readingTime % 60) . ' sec' : $readingTime . ' sec';
                            @endphp
                            <p>Reading Time: {{ $timeFormatted }}</p>
                            <p>Total Words: {{ $englishAssessment->total_words ?? 0 }}</p>
                        @else
                            <p>Reading Time: 0 sec</p>
                            <p>Total Words: 0</p>
                        @endif
                    </div>
                </div>

                <!-- Reading Comprehension Chart -->
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="reading-comprehension-chart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @if(isset($student) && $student->readingAssessments->where('language', 'english')->first())
                            @php
                                $englishAssessment = $student->readingAssessments->where('language', 'english')->first();
                                $comprehensionScore = $englishAssessment->comprehension ?? 0;
                                $totalQuestions = $englishAssessment->total_questions ?? 0;
                                $correctAnswers = $englishAssessment->correct_answers ?? 0;

                                if ($comprehensionScore >= 80) {
                                    $level = 'Independent Level';
                                    $levelClass = 'text-success';
                                } elseif ($comprehensionScore >= 59) {
                                    $level = 'Instructional Level';
                                    $levelClass = 'text-warning';
                                } else {
                                    $level = 'Frustration Level';
                                    $levelClass = 'text-danger';
                                }
                            @endphp
                            <p><strong class="{{ $levelClass }}">{{ $level }}</strong></p>
                            <p>{{ $comprehensionScore }}% comprehension score</p>
                            <p>{{ $correctAnswers }} out of {{ $totalQuestions }} correct answers</p>
                        @else
                            <p><strong class="text-muted">No Assessment</strong></p>
                            <p>0% comprehension score</p>
                            <p>0 out of 0 correct answers</p>
                        @endif
                    </div>
                </div>

                <!-- Word Reading Chart -->
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="word-reading-chart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @if(isset($student) && $student->readingAssessments->where('language', 'english')->first())
                            @php
                                $englishAssessment = $student->readingAssessments->where('language', 'english')->first();
                                $wordAccuracy = $englishAssessment->correct_reading ?? 0;
                                $miscues = $englishAssessment->miscues ?? 0;
                                $totalWords = $englishAssessment->total_words ?? 0;

                                if ($wordAccuracy >= 97) {
                                    $wordLevel = 'Independent Level';
                                    $wordLevelClass = 'text-success';
                                } elseif ($wordAccuracy >= 90) {
                                    $wordLevel = 'Instructional Level';
                                    $wordLevelClass = 'text-warning';
                                } else {
                                    $wordLevel = 'Frustration Level';
                                    $wordLevelClass = 'text-danger';
                                }
                            @endphp
                            <p><strong class="{{ $wordLevelClass }}">{{ $wordLevel }}</strong></p>
                            <p>{{ $wordAccuracy }}% reading accuracy</p>
                            <p>{{ $miscues }} miscues out of {{ $totalWords }} words</p>
                        @else
                            <p><strong class="text-muted">No Assessment</strong></p>
                            <p>0% reading accuracy</p>
                            <p>0 miscues out of 0 words</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Filipino Language Test Results -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Filipino Language Test Results</h2>
            </div>
            <div class="charts-container">
                <!-- Filipino Reading Speed Chart -->
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="filipino-reading-speed-chart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        <p><strong>
                                @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->first())
                                    {{ $student->readingAssessments->where('language', 'filipino')->first()->reading_speed ?? 0 }}
                                    WPM
                                @else
                                    0 WPM
                                @endif
                            </strong></p>
                        @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->first())
                            @php
                                $filipinoAssessment = $student->readingAssessments->where('language', 'filipino')->first();
                                $readingTime = $filipinoAssessment->reading_time ?? 0;
                                $timeFormatted = $readingTime >= 60 ? floor($readingTime / 60) . ' min ' . ($readingTime % 60) . ' sec' : $readingTime . ' sec';
                            @endphp
                            <p>Reading Time: {{ $timeFormatted }}</p>
                            <p>Total Words: {{ $filipinoAssessment->total_words ?? 0 }}</p>
                        @else
                            <p>Reading Time: 0 sec</p>
                            <p>Total Words: 0</p>
                        @endif
                    </div>
                </div>

                <!-- Filipino Reading Comprehension Chart -->
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="filipino-reading-comprehension-chart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->first())
                            @php
                                $filipinoAssessment = $student->readingAssessments->where('language', 'filipino')->first();
                                $comprehensionScore = $filipinoAssessment->comprehension ?? 0;
                                $totalQuestions = $filipinoAssessment->total_questions ?? 0;
                                $correctAnswers = $filipinoAssessment->correct_answers ?? 0;

                                if ($comprehensionScore >= 80) {
                                    $level = 'Independent Level';
                                    $levelClass = 'text-success';
                                } elseif ($comprehensionScore >= 59) {
                                    $level = 'Instructional Level';
                                    $levelClass = 'text-warning';
                                } else {
                                    $level = 'Frustration Level';
                                    $levelClass = 'text-danger';
                                }
                            @endphp
                            <p><strong class="{{ $levelClass }}">{{ $level }}</strong></p>
                            <p>{{ $comprehensionScore }}% comprehension score</p>
                            <p>{{ $correctAnswers }} out of {{ $totalQuestions }} correct answers</p>
                        @else
                            <p><strong class="text-muted">No Assessment</strong></p>
                            <p>0% comprehension score</p>
                            <p>0 out of 0 correct answers</p>
                        @endif
                    </div>
                </div>

                <!-- Filipino Word Reading Chart -->
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="filipino-word-reading-chart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->first())
                            @php
                                $filipinoAssessment = $student->readingAssessments->where('language', 'filipino')->first();
                                $wordAccuracy = $filipinoAssessment->correct_reading ?? 0;
                                $miscues = $filipinoAssessment->miscues ?? 0;
                                $totalWords = $filipinoAssessment->total_words ?? 0;

                                if ($wordAccuracy >= 97) {
                                    $wordLevel = 'Independent Level';
                                    $wordLevelClass = 'text-success';
                                } elseif ($wordAccuracy >= 90) {
                                    $wordLevel = 'Instructional Level';
                                    $wordLevelClass = 'text-warning';
                                } else {
                                    $wordLevel = 'Frustration Level';
                                    $wordLevelClass = 'text-danger';
                                }
                            @endphp
                            <p><strong class="{{ $wordLevelClass }}">{{ $wordLevel }}</strong></p>
                            <p>{{ $wordAccuracy }}% reading accuracy</p>
                            <p>{{ $miscues }} miscues out of {{ $totalWords }} words</p>
                        @else
                            <p><strong class="text-muted">No Assessment</strong></p>
                            <p>0% reading accuracy</p>
                            <p>0 miscues out of 0 words</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Student-Style Chart Design */
            .charts-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 30px;
                padding: 20px 0;
                width: 100%;
                margin-bottom: 30px;
            }

            .reading-passage {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.3s ease;
                min-width: 0;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                border: 1px solid #e9ecef;
            }

            .reading-passage:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .chart-card {
                background: #fafbfc;
                padding: 25px;
                border-radius: 10px;
                margin: 0;
                height: 380px;
                position: relative;
                border-bottom: 1px solid #e9ecef;
            }

            .chart-card canvas {
                width: 100% !important;
                height: 100% !important;
            }

            .reading-metrics {
                background: white;
                padding: 25px;
                margin: 0;
                border-radius: 0 0 12px 12px;
                text-align: center;
                border-top: 1px solid #e9ecef;
            }

            .reading-metrics p {
                margin: 8px 0;
                color: #2c3e50;
                font-size: 1.1em;
            }

            .reading-metrics p:first-child {
                color: #3498db;
                font-size: 1.3em;
                font-weight: 600;
            }

            .reading-metrics p:not(:first-child) {
                color: #7f8c8d;
                font-size: 0.95em;
            }

            /* Reading Level Color Coding */
            .text-success {
                color: #27ae60 !important;
                font-weight: bold;
            }

            .text-warning {
                color: #f39c12 !important;
                font-weight: bold;
            }

            .text-danger {
                color: #e74c3c !important;
                font-weight: bold;
            }

            .text-muted {
                color: #6c757d !important;
                font-size: 0.85em;
            }

            .chart-container {
                height: 220px;
                width: 100%;
            }

            .hover-card {
                transition: all 0.3s ease;
            }

            .hover-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            @media (max-width: 1200px) {
                .charts-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 25px;
                }
            }

            @media (max-width: 768px) {
                .charts-container {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
            }

            /* Comprehension Modal Styles */
            .modal {
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
            }

            .comprehension-modal {
                background-color: #ffffff;
                margin: 2% auto;
                padding: 0;
                border-radius: 12px;
                width: 90%;
                max-width: 1000px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                animation: modalSlideIn 0.3s ease-out;
            }

            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-50px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .modal-header {
                background: linear-gradient(135deg, #00B8A9, #009688);
                color: white;
                padding: 1.5rem 2rem;
                border-radius: 12px 12px 0 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .modal-header h2 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .close {
                color: white;
                font-size: 2rem;
                font-weight: bold;
                cursor: pointer;
                transition: opacity 0.3s;
            }

            .close:hover {
                opacity: 0.7;
            }

            .modal-body {
                padding: 2rem;
            }

            /* Professional Student Information Card */
            .student-info-card {
                background: #ffffff;
                border: 1px solid #E5E7EB;
                border-radius: 12px;
                margin-bottom: 2rem;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .info-header {
                background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
                padding: 1.5rem;
                border-bottom: 1px solid #E5E7EB;
                display: flex;
                align-items: center;
                gap: 1rem;
            }

          
            .student-basic-info {
                flex: 1;
            }

            .student-name {
                margin: 0 0 0.25rem 0;
                font-size: 1.375rem;
                font-weight: 600;
                color: #111827;
                line-height: 1.2;
            }

            .student-meta {
                margin: 0;
            }

            .grade-section {
                color: #6B7280;
                font-size: 0.875rem;
                font-weight: 500;
            }

            /* Assessment Details Table */
            .assessment-details-table {
                padding: 0;
            }

            .detail-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #F3F4F6;
                transition: background-color 0.2s ease;
            }

            .detail-row:last-child {
                border-bottom: none;
            }

            .detail-row:hover {
                background-color: #F9FAFB;
            }

            .detail-label {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-weight: 500;
                color: #374151;
                font-size: 0.875rem;
            }

            .detail-label i {
                width: 16px;
                color: #6B7280;
                font-size: 0.875rem;
            }

            .detail-value {
                font-weight: 600;
                font-size: 0.875rem;
                text-align: right;
            }

            .score-value {
                color: #059669;
                font-size: 1rem;
            }

            .accuracy-value {
                font-size: 1rem;
                font-weight: 700;
            }

            .date-value {
                color: #374151;
            }

            .reading-material-section,
            .questions-section,
            .summary-section {
                margin-bottom: 2rem;
            }

            .reading-material-section h4,
            .questions-section h4 {
                color: #1E3A8A;
                font-size: 1.25rem;
                font-weight: 600;
                margin-bottom: 1rem;
                border-bottom: 2px solid #E2E8F0;
                padding-bottom: 0.5rem;
            }

            .reading-content {
                background: #F8FAFC;
                padding: 1.5rem;
                border-radius: 8px;
                border: 1px solid #E2E8F0;
            }

            .reading-content h5 {
                color: #1E3A8A;
                font-size: 1.1rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            .reading-text {
                color: #374151;
                line-height: 1.6;
                font-size: 1rem;
            }

            .questions-container {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .question-item {
                background: white;
                border: 1px solid #E2E8F0;
                border-radius: 8px;
                padding: 1.5rem;
                transition: all 0.3s ease;
            }

            .question-item.correct {
                border-left: 4px solid #00B8A9;
                background: #E6FFFA;
            }

            .question-item.incorrect {
                border-left: 4px solid #F6AD55;
                background: #FFFBEB;
            }

            .question-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
            }

            .question-number {
                background: #1E3A8A;
                color: white !important; 
                padding: 0.25rem 0.75rem;
                border-radius: 20px;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .answer-status {
                padding: 0.25rem 0.75rem;
                border-radius: 20px;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .answer-status.correct {
                background: #B2F5EA;
                color: #00695C;
            }

            .answer-status.incorrect {
                background: #FED7AA;
                color: #C05621;
            }

            .question-text {
                color: #374151;
                font-size: 1rem;
                margin-bottom: 1rem;
                font-weight: 500;
            }

            .answer-comparison {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .student-answer,
            .correct-answer {
                padding: 1rem;
                border-radius: 6px;
                border: 1px solid #E2E8F0;
            }

            .student-answer {
                background: #FFFBEB;
                border-left: 3px solid #F6AD55;
            }

            .student-answer.correct-student {
                background: #E6FFFA;
                border-left: 3px solid #00B8A9;
            }

            .correct-answer {
                background: #E6FFFA;
                border-left: 3px solid #00B8A9;
            }

            .answer-label {
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.5rem;
            }

            .student-answer .answer-label {
                color: #C05621;
            }

            .student-answer.correct-student .answer-label {
                color: #00695C;
            }

            .correct-answer .answer-label {
                color: #00695C;
            }

            .answer-text {
                color: #374151;
                font-size: 1rem;
                font-weight: 500;
            }

            .summary-stats {
                display: flex;
                gap: 1rem;
                justify-content: center;
            }

            .stat-card {
                background: white;
                border: 1px solid #E2E8F0;
                border-radius: 8px;
                padding: 1.5rem;
                text-align: center;
                min-width: 120px;
                transition: transform 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-2px);
            }

            .stat-card.correct {
                border-left: 4px solid #00B8A9;
            }

            .stat-card.incorrect {
                border-left: 4px solid #F6AD55;
            }

            .stat-card.total {
                border-left: 4px solid #009688;
            }

            .stat-icon {
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }

            .stat-number {
                display: block;
                font-size: 2rem;
                font-weight: 700;
                color: #1E3A8A;
            }

            .stat-label {
                color: #64748B;
                font-size: 0.875rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .modal-footer {
                background: #F8FAFC;
                padding: 1.5rem 2rem;
                border-radius: 0 0 12px 12px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-top: 1px solid #E2E8F0;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                border-radius: 6px;
                font-weight: 600;
                text-decoration: none;
                cursor: pointer;
                border: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-secondary {
                background: #6B7280;
                color: white;
            }

            .btn-secondary:hover {
                background: #4B5563;
            }

            .btn-primary {
                background: #00B8A9;
                color: white;
            }

            .btn-primary:hover {
                background: #009688;
            }

            @media (max-width: 768px) {
                .comprehension-modal {
                    width: 95%;
                    margin: 5% auto;
                }

                .info-header {
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }

                .student-avatar {
                    margin: 0 auto;
                }

                .detail-row {
                    padding: 0.75rem 1rem;
                }

                .detail-label {
                    font-size: 0.8rem;
                }

                .detail-value {
                    font-size: 0.8rem;
                }

                .answer-comparison {
                    grid-template-columns: 1fr;
                }

                .summary-stats {
                    flex-direction: column;
                }

                .modal-footer {
                    flex-direction: column;
                    gap: 1rem;
                }
            }
        </style>

        <script id="performance-chart-script">
            document.addEventListener('DOMContentLoaded', function () {
                // Get student assessment data from backend
                const studentData = @json(isset($student) ? $student->readingAssessments : []);

                // Process assessment data for charts
                const englishAssessments = studentData.filter(assessment => assessment.language === 'english');
                const filipinoAssessments = studentData.filter(assessment => assessment.language === 'filipino');

                // Get latest assessments for each language
                const latestEnglish = englishAssessments.length > 0 ? englishAssessments[0] : null;
                const latestFilipino = filipinoAssessments.length > 0 ? filipinoAssessments[0] : null;

                // Store chart instances globally for updates
                window.chartInstances = {};

                // Simple chart creation function
                function createSimpleChart(canvasId, data, labels, colors, title) {
                    const canvas = document.getElementById(canvasId);
                    if (!canvas) return null;

                    return new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: colors,
                                borderColor: colors,
                                borderWidth: 2,
                                borderRadius: 8,
                                barThickness: 50
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: title,
                                    font: { size: 16, weight: 'bold' },
                                    color: '#2c3e50'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { color: '#2c3e50', font: { size: 12 } }
                                },
                                x: {
                                    ticks: { color: '#2c3e50', font: { size: 12 } }
                                }
                            }
                        }
                    });
                }

                // Chart.js configuration matching student-side exactly
                const chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: '',
                            font: {
                                size: 16,
                                weight: '600',
                                family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                            },
                            color: '#2c3e50',
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f2f6',
                                lineWidth: 1
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                                },
                                color: '#7f8c8d',
                                padding: 8
                            },
                            title: {
                                display: true,
                                text: 'Value',
                                font: {
                                    size: 13,
                                    weight: '500',
                                    family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                                },
                                color: '#5a6c7d',
                                padding: {
                                    top: 10
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                                },
                                color: '#7f8c8d',
                                maxRotation: 0,
                                minRotation: 0,
                                padding: 10
                            },
                            title: {
                                display: true,
                                text: 'Metrics',
                                font: {
                                    size: 13,
                                    weight: '500',
                                    family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                                },
                                color: '#5a6c7d',
                                padding: {
                                    top: 15
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 15,
                            right: 15,
                            top: 15,
                            bottom: 15
                        }
                    }
                };

                // Special chart options for reading speed charts (ensures minimum 1 minute display)
                const readingSpeedChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label || '';
                                    const value = context.parsed.y;

                                    // For reading time, show actual time but ensure minimum 1 minute display
                                    if (context.label.includes('Time')) {
                                        const displayValue = Math.max(value, 1);
                                        return `${context.label}: ${displayValue} min`;
                                    }

                                    return `${context.label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: '#000000',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#000000',
                                font: {
                                    size: 12,
                                    weight: '600'
                                },
                                maxRotation: 45
                            }
                        }
                    }
                };

                // Create English Charts
                if (latestEnglish) {
                    // English Reading Speed Chart
                    const speedData = [latestEnglish.reading_time || 0, latestEnglish.total_words || 0];
                    const speedColors = ['#27ae60', '#3498db'];
                    window.chartInstances.speedChart = createSimpleChart(
                        'reading-speed-chart',
                        speedData,
                        ['Time (sec)', 'Words'],
                        speedColors,
                        'English Reading Speed'
                    );

                    // English Comprehension Chart
                    const compData = [latestEnglish.correct_answers || 0, latestEnglish.total_questions || 5];
                    const compColors = ['#27ae60', '#3498db'];
                    window.chartInstances.comprehensionChart = createSimpleChart(
                        'reading-comprehension-chart',
                        compData,
                        ['Correct', 'Total'],
                        compColors,
                        'English Comprehension'
                    );

                    // English Word Reading Chart
                    const wordData = [latestEnglish.miscues || 0, latestEnglish.total_words || 0];
                    const wordColors = ['#27ae60', '#3498db'];
                    window.chartInstances.wordChart = createSimpleChart(
                        'word-reading-chart',
                        wordData,
                        ['Miscues', 'Total Words'],
                        wordColors,
                        'English Word Reading'
                    );
                }

                // Create Filipino Charts
                if (latestFilipino) {
                    // Filipino Reading Speed Chart
                    const filipinoSpeedData = [latestFilipino.reading_time || 0, latestFilipino.total_words || 0];
                    const filipinoSpeedColors = ['#27ae60', '#3498db'];
                    window.chartInstances.filipinoSpeedChart = createSimpleChart(
                        'filipino-reading-speed-chart',
                        filipinoSpeedData,
                        ['Time (sec)', 'Words'],
                        filipinoSpeedColors,
                        'Filipino Reading Speed'
                    );

                    // Filipino Comprehension Chart
                    const filipinoCompData = [latestFilipino.correct_answers || 0, latestFilipino.total_questions || 5];
                    const filipinoCompColors = ['#27ae60', '#3498db'];
                    window.chartInstances.filipinoComprehensionChart = createSimpleChart(
                        'filipino-reading-comprehension-chart',
                        filipinoCompData,
                        ['Correct', 'Total'],
                        filipinoCompColors,
                        'Filipino Comprehension'
                    );

                    // Filipino Word Reading Chart
                    const filipinoWordData = [latestFilipino.miscues || 0, latestFilipino.total_words || 0];
                    const filipinoWordColors = ['#27ae60', '#3498db'];
                    window.chartInstances.filipinoWordChart = createSimpleChart(
                        'filipino-word-reading-chart',
                        filipinoWordData,
                        ['Miscues', 'Total Words'],
                        filipinoWordColors,
                        'Filipino Word Reading'
                    );
                }
            });











        </script>

        <script>

            // Comprehension Modal Functions
            function showComprehensionDetails(studentId, language = 'english') {
                if (!studentId) {
                    alert('Please select a student first');
                    return;
                }

                console.log('Fetching comprehension details for student:', studentId, 'language:', language);

                // Show loading state
                document.getElementById('modalStudentName').textContent = 'Loading...';
                document.getElementById('modalStudentInfo').textContent = 'Loading...';
                document.getElementById('questionsContainer').innerHTML = '<div style="text-align: center; padding: 2rem;">Loading comprehension details...</div>';

                // Show modal
                document.getElementById('comprehensionModal').style.display = 'block';

                // Fetch comprehension details
                fetch(`/teacher/get-student-comprehension/${studentId}/${language}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            populateComprehensionModal(data.data);
                        } else {
                            showModalError(data.message || 'Error loading comprehension details');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching comprehension details:', error);
                        showModalError('Error loading comprehension details. Please try again.');
                    });
            }

            function populateComprehensionModal(data) {
                // Populate student info
                document.getElementById('modalStudentName').textContent = data.student.name;
                document.getElementById('modalStudentInfo').textContent = `Grade ${data.student.grade_level} • ${data.student.section}`;

                // Populate assessment summary
                document.getElementById('modalScore').textContent = data.assessment.score;
                document.getElementById('modalTotalQuestions').textContent = data.assessment.total_questions;

                // Set percentage with dynamic color
                const percentageElement = document.getElementById('modalPercentage');
                percentageElement.textContent = data.assessment.percentage + '%';

                // Apply color based on percentage
                const percentage = data.assessment.percentage;
                if (percentage >= 80) {
                    percentageElement.style.color = '#059669'; // Green for excellent
                } else if (percentage >= 60) {
                    percentageElement.style.color = '#D97706'; // Orange for good
                } else {
                    percentageElement.style.color = '#DC2626'; // Red for needs improvement
                }

                document.getElementById('modalAssessmentDate').textContent = new Date(data.assessment.assessment_date).toLocaleDateString();

                // Populate reading material
                document.getElementById('modalReadingTitle').textContent = data.reading_material.title;
                document.getElementById('modalReadingContent').textContent = data.reading_material.content;

                // Populate questions and answers
                const questionsContainer = document.getElementById('questionsContainer');
                questionsContainer.innerHTML = '';

                let correctCount = 0;
                let incorrectCount = 0;

                data.answer_details.forEach(answer => {
                    if (answer.is_correct) {
                        correctCount++;
                    } else {
                        incorrectCount++;
                    }

                    const questionElement = createQuestionElement(answer);
                    questionsContainer.appendChild(questionElement);
                });

                // Update summary stats
                document.getElementById('correctCount').textContent = correctCount;
                document.getElementById('incorrectCount').textContent = incorrectCount;
                document.getElementById('totalQuestionsCount').textContent = data.assessment.total_questions;
            }

            function createQuestionElement(answer) {
                const questionDiv = document.createElement('div');
                questionDiv.className = `question-item ${answer.is_correct ? 'correct' : 'incorrect'}`;

                questionDiv.innerHTML = `
                    <div class="question-header">
                        <span class="question-number">Question ${answer.question_number}</span>
                        <span class="answer-status ${answer.is_correct ? 'correct' : 'incorrect'}">
                            ${answer.is_correct ? '✅ Correct' : '❌ Incorrect'}
                        </span>
                    </div>
                    <div class="question-text">${answer.question}</div>
                    <div class="answer-comparison">
                        <div class="student-answer ${answer.is_correct ? 'correct-student' : ''}">
                            <div class="answer-label">Student Answer</div>
                            <div class="answer-text">${answer.student_answer || 'No answer provided'}</div>
                        </div>
                        <div class="correct-answer">
                            <div class="answer-label">Correct Answer</div>
                            <div class="answer-text">${answer.correct_answer}</div>
                        </div>
                    </div>
                `;

                return questionDiv;
            }

            function showModalError(message) {
                document.getElementById('modalStudentName').textContent = 'Error';
                document.getElementById('modalStudentInfo').textContent = '';
                document.getElementById('questionsContainer').innerHTML = `
                    <div style="text-align: center; padding: 2rem; color: #EF4444;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p>${message}</p>
                    </div>
                `;
            }

            function closeComprehensionModal() {
                document.getElementById('comprehensionModal').style.display = 'none';
            }

            function printComprehensionDetails() {
                window.print();
            }

            // Close modal when clicking outside
            window.onclick = function (event) {
                const modal = document.getElementById('comprehensionModal');
                if (event.target === modal) {
                    closeComprehensionModal();
                }
            }

            // Make functions globally available
            window.showComprehensionDetails = showComprehensionDetails;
            window.closeComprehensionModal = closeComprehensionModal;
            window.printComprehensionDetails = printComprehensionDetails;
        </script>

        <!-- Comprehension Details Modal -->
        <div id="comprehensionModal" class="modal" style="display: none;">
            <div class="modal-content comprehension-modal">
                <div class="modal-header">
                    <h2><i class="fas fa-book-reader"></i> Comprehension Assessment Details</h2>
                    <span class="close" onclick="closeComprehensionModal()">&times;</span>
                </div>

                <div class="modal-body">
                    <!-- Professional Student Information Card -->
                    <div class="student-info-card">
                        <div class="info-header">
                            <div class="student-basic-info">
                                <h3 id="modalStudentName" class="student-name">Student Name</h3>
                                <div class="student-meta">
                                    <span class="grade-section" id="modalStudentInfo">Grade • Section</span>
                                </div>
                            </div>
                        </div>

                        <!-- Assessment Details Table -->
                        <div class="assessment-details-table">
                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="fas fa-trophy"></i>
                                    <span>Score</span>
                                </div>
                                <div class="detail-value score-value">
                                    <span id="modalScore">0</span>/<span id="modalTotalQuestions">0</span>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="fas fa-percentage"></i>
                                    <span>Accuracy</span>
                                </div>
                                <div class="detail-value accuracy-value">
                                    <span id="modalPercentage">0%</span>
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Assessment Date</span>
                                </div>
                                <div class="detail-value date-value">
                                    <span id="modalAssessmentDate">Date</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reading Material Section -->
                    <div class="reading-material-section">
                        <h4>📖 Reading Material</h4>
                        <div class="reading-content">
                            <h5 id="modalReadingTitle">Reading Title</h5>
                            <div id="modalReadingContent" class="reading-text">
                                Reading content will appear here...
                            </div>
                        </div>
                    </div>

                    <!-- Questions and Answers Section -->
                    <div class="questions-section">
                        <h4>❓ Questions & Answers</h4>
                        <div id="questionsContainer" class="questions-container">
                            <!-- Questions will be loaded dynamically -->
                        </div>
                    </div>

                    <!-- Summary Section -->
                    <div class="summary-section">
                        <div class="summary-stats">
                            <div class="stat-card correct">
                                <div class="stat-icon">✅</div>
                                <div class="stat-info">
                                    <span class="stat-number" id="correctCount">0</span>
                                    <span class="stat-label">Correct</span>
                                </div>
                            </div>
                            <div class="stat-card incorrect">
                                <div class="stat-icon">❌</div>
                                <div class="stat-info">
                                    <span class="stat-number" id="incorrectCount">0</span>
                                    <span class="stat-label">Incorrect</span>
                                </div>
                            </div>
                            <div class="stat-card total">
                                <div class="stat-icon">📊</div>
                                <div class="stat-info">
                                    <span class="stat-number" id="totalQuestionsCount">0</span>
                                    <span class="stat-label">Total</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeComprehensionModal()">Close</button>
                    <button class="btn btn-primary" onclick="printComprehensionDetails()">
                        <i class="fas fa-print"></i> Print Report
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- Close the main container div -->
</body>

</html>