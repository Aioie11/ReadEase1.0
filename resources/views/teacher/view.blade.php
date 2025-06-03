<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Emma Brown</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#0369a1', secondary: '#6b7280' }, borderRadius: { 'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px', 'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px' } } } }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
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

        /* Tab Navigation Enhancement */
        .border-b.border-gray-200.mb-6 {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #E2E8F0;
            padding: 0.5rem;
            margin-bottom: 2rem;
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">
    <div class="container mx-auto p-4 max-w-7xl">
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('teacher.student-management') }}"
                class="flex items-center text-gray-600 hover:text-primary transition-colors">
                <div class="w-5 h-5 flex items-center justify-center mr-1">
                    <i class="ri-arrow-left-line"></i>
                </div>
                <span>Back</span>
            </a>
        </div>

        <!-- Student Profile Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-wrap items-center">
                <!-- Avatar -->
                <div class="mr-6">
                    <div
                        class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl font-bold">
                        EB
                    </div>
                </div>

                <!-- Student Info -->
                <div class="flex-grow">
                    <h1 class="text-2xl font-bold mb-4">
                        @if(isset($student))
                            {{ $student->first_name }} {{ $student->last_name }}
                        @else
                            Emma Brown
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
                                        001
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
                                            Grade 7 - Narra
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
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <!-- Reading Level -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 text-sm">Average Correct Reading</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-book-open-line"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">
                    @if(isset($student) && $student->readingAssessments->count() > 0)
                        {{ round($student->readingAssessments->avg('correct_reading'), 1) }}%
                    @else
                        N/A
                    @endif
                </h3>
                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                    @if(isset($student) && $student->readingAssessments->count() > 0)
                        @php
                            $avgCorrect = $student->readingAssessments->avg('correct_reading');
                        @endphp
                        @if($avgCorrect >= 90)
                            Excellent
                        @elseif($avgCorrect >= 80)
                            Good
                        @elseif($avgCorrect >= 70)
                            Fair
                        @else
                            Needs Improvement
                        @endif
                    @else
                        No Data
                    @endif
                </span>
            </div>

            <!-- Comprehension Score -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 text-sm">Average Comprehension</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-mental-health-line"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">
                    @if(isset($student) && $student->readingAssessments->count() > 0)
                        {{ round($student->readingAssessments->avg('comprehension'), 1) }}%
                    @else
                        N/A
                    @endif
                </h3>
                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                    @if(isset($student) && $student->readingAssessments->count() > 0)
                        @php
                            $avgComp = $student->readingAssessments->avg('comprehension');
                        @endphp
                        @if($avgComp >= 90)
                            Excellent
                        @elseif($avgComp >= 80)
                            Good
                        @elseif($avgComp >= 70)
                            Fair
                        @else
                            Needs Improvement
                        @endif
                    @else
                        No Data
                    @endif
                </span>
            </div>

            <!-- Reading Speed -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 text-sm">Average Reading Speed</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-speed-line"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">
                    @if(isset($student) && $student->readingAssessments->count() > 0)
                        {{ round($student->readingAssessments->avg('reading_speed'), 1) }} wpm
                    @else
                        N/A
                    @endif
                </h3>
                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                    @if(isset($student) && $student->readingAssessments->count() > 0)
                        @php
                            $avgSpeed = $student->readingAssessments->avg('reading_speed');
                        @endphp
                        @if($avgSpeed >= 120)
                            Excellent
                        @elseif($avgSpeed >= 100)
                            Good
                        @elseif($avgSpeed >= 80)
                            Fair
                        @else
                            Needs Improvement
                        @endif
                    @else
                        No Data
                    @endif
                </span>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex flex-wrap -mb-px">
                <button
                    class="inline-block py-4 px-6 border-b-2 border-primary text-primary font-medium hover:bg-blue-50 transition-colors">
                    <i class="ri-book-open-line mr-2"></i>Reading Records
                </button>
                <button
                    class="inline-block py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                    <i class="ri-mental-health-line mr-2"></i>Comprehension Analysis
                </button>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <!-- Reading Records -->
            <div id="reading-assessments">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Reading Records</h2>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Filter by:</span>
                        <select class="text-sm border-gray-200 rounded-md focus:ring-primary focus:border-primary">
                            <option>All Levels</option>
                            <option>Instructional</option>
                            <option>Frustration</option>
                            <option>Independent</option>
                        </select>
                    </div>
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
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Status</th>
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
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
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
                                                    <div class="bg-blue-500 h-2 rounded-full"
                                                        style="width: {{ $speedPercentage }}%"></div>
                                                </div>
                                                <span>{{ $assessment->reading_speed }} wpm</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                    <div class="bg-green-500 h-2 rounded-full"
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
                                            @php
                                                $overallScore = ($assessment->comprehension + $assessment->correct_reading) / 2;
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                                                                                                                                                        @if($overallScore >= 90) bg-green-100 text-green-800
                                                                                                                                                                                                        @elseif($overallScore >= 80) bg-blue-100 text-blue-800
                                                                                                                                                                                                        @elseif($overallScore >= 70) bg-yellow-100 text-yellow-800
                                                                                                                                                                                                        @else bg-red-100 text-red-800 @endif">
                                                @if($overallScore >= 90) Excellent
                                                @elseif($overallScore >= 80) Good
                                                @elseif($overallScore >= 70) Fair
                                                @else Needs Improvement @endif
                                            </span>
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

            <!-- Comprehension Analysis -->
            <div class="hidden" id="comprehension-analysis">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Comprehension Analysis</h2>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Time Period:</span>
                        <select class="text-sm border-gray-200 rounded-md focus:ring-primary focus:border-primary">
                            <option>Last 30 Days</option>
                            <option>Last 3 Months</option>
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-700">Instructional Level</h3>
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                <i class="ri-book-open-line"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-blue-600 mb-2">50%</div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 50%"></div>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-700">Independent Level</h3>
                            <div
                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <i class="ri-check-line"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-green-600 mb-2">30%</div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-700">Frustration Level</h3>
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                                <i class="ri-error-warning-line"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-red-600 mb-2">20%</div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                </div>
                <div id="reading-level-chart"
                    class="w-full h-96 bg-white p-5 rounded-lg shadow-sm border border-gray-100"></div>
            </div>
        </div>

        <!-- English Language Test Results -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">English Language Test Results</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">View:</span>
                    <select class="text-sm border-gray-200 rounded-md focus:ring-primary focus:border-primary">
                        <option>Detailed View</option>
                        <option>Summary View</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Reading Speed Chart -->
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-700">Reading Speed</h2>
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i class="ri-speed-line"></i>
                        </div>
                    </div>
                    <div id="reading-speed-chart" class="chart-container"></div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-primary">121 WPM</p>
                            <span class="text-sm text-green-600">+5% from last test</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Words Per Minute</p>
                    </div>
                </div>

                <!-- Reading Comprehension Chart -->
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-700">Reading Comprehension</h2>
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                            <i class="ri-mental-health-line"></i>
                        </div>
                    </div>
                    <div id="reading-comprehension-chart" class="chart-container"></div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-primary">Instructional Level</p>
                            <span class="text-sm text-green-600">+2% from last test</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">7 out of 10 correct answers</p>
                    </div>
                </div>

                <!-- Word Reading Chart -->
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-700">Word Reading</h2>
                        <div
                            class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                            <i class="ri-book-read-line"></i>
                        </div>
                    </div>
                    <div id="word-reading-chart" class="chart-container"></div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-primary">Independent Level</p>
                            <span class="text-sm text-green-600">+3% from last test</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">149 out of 250 words read correctly</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filipino Language Test Results -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Filipino Language Test Results</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">View:</span>
                    <select class="text-sm border-gray-200 rounded-md focus:ring-primary focus:border-primary">
                        <option>Detailed View</option>
                        <option>Summary View</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Reading Speed Chart -->
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-700">Bilis ng Pagbasa</h2>
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i class="ri-speed-line"></i>
                        </div>
                    </div>
                    <div id="filipino-reading-speed-chart" class="chart-container"></div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-primary">120 WPM</p>
                            <span class="text-sm text-green-600">+3% mula sa huling pagsusulit</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Mga Salita Bawat Minuto</p>
                    </div>
                </div>

                <!-- Reading Comprehension Chart -->
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-700">Pag-unawa sa Binasa</h2>
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                            <i class="ri-mental-health-line"></i>
                        </div>
                    </div>
                    <div id="filipino-reading-comprehension-chart" class="chart-container"></div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-primary">Antas ng Pagtuturo</p>
                            <span class="text-sm text-green-600">+1% mula sa huling pagsusulit</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">7 sa 10 tamang sagot</p>
                    </div>
                </div>

                <!-- Word Reading Chart -->
                <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100 hover-card">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-gray-700">Pagbasa ng Salita</h2>
                        <div
                            class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                            <i class="ri-book-read-line"></i>
                        </div>
                    </div>
                    <div id="filipino-word-reading-chart" class="chart-container"></div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-primary">Antas ng Independiyente</p>
                            <span class="text-sm text-green-600">+2% mula sa huling pagsusulit</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">235 sa 250 salitang nabasa nang tama</p>
                    </div>
                </div>
            </div>
        </div>

        <style>
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

                // Chart.js configuration for uniform styling
                const chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
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

                // Reading Speed Chart (English)
                const speedCtx = document.getElementById('reading-speed-chart');
                if (speedCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    speedCtx.appendChild(canvas);

                    // Use real data if available, otherwise use default values
                    const readingTimeMinutes = latestEnglish ? Math.round(latestEnglish.reading_time / 60) : 3;
                    const totalWords = latestEnglish ? latestEnglish.total_words : 250;
                    const readingSpeed = latestEnglish ? latestEnglish.reading_speed : 83;

                    window.chartInstances.speedChart = new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Reading Time (min)', 'Total Words', 'Speed (WPM)'],
                            datasets: [{
                                data: [readingTimeMinutes, totalWords, readingSpeed],
                                backgroundColor: [
                                    '#1E3A8A',
                                    '#EA580C',
                                    '#0F766E'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Reading Comprehension Chart (English)
                const comprehensionCtx = document.getElementById('reading-comprehension-chart');
                if (comprehensionCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    comprehensionCtx.appendChild(canvas);

                    // Use real data if available, otherwise use default values
                    const correctAnswers = latestEnglish ? latestEnglish.correct_answers : 7;
                    const totalQuestions = latestEnglish ? latestEnglish.total_questions : 10;
                    const comprehensionScore = latestEnglish ? latestEnglish.comprehension : 70;

                    window.chartInstances.comprehensionChart = new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Correct Answers', 'Total Questions', 'Comprehension %'],
                            datasets: [{
                                data: [correctAnswers, totalQuestions, comprehensionScore],
                                backgroundColor: [
                                    '#0F766E',
                                    '#EA580C',
                                    '#1E3A8A'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Word Reading Chart (English)
                const wordCtx = document.getElementById('word-reading-chart');
                if (wordCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    wordCtx.appendChild(canvas);

                    // Use real data if available, otherwise use default values
                    const miscues = latestEnglish ? latestEnglish.miscues : 101;
                    const totalWords = latestEnglish ? latestEnglish.total_words : 250;
                    const correctWords = totalWords - miscues;
                    const correctReadingPercent = latestEnglish ? latestEnglish.correct_reading : 60;

                    window.chartInstances.wordChart = new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Reading Miscues', 'Correct Words', 'Accuracy %'],
                            datasets: [{
                                data: [miscues, correctWords, correctReadingPercent],
                                backgroundColor: [
                                    '#DC2626',
                                    '#0F766E',
                                    '#1E3A8A'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Filipino Reading Speed Chart
                const filipinoSpeedCtx = document.getElementById('filipino-reading-speed-chart');
                if (filipinoSpeedCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    filipinoSpeedCtx.appendChild(canvas);

                    // Use real data if available, otherwise use default values
                    const filipinoReadingTimeMinutes = latestFilipino ? Math.round(latestFilipino.reading_time / 60) : 3;
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 250;
                    const filipinoReadingSpeed = latestFilipino ? latestFilipino.reading_speed : 83;

                    window.chartInstances.filipinoSpeedChart = new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Oras ng Pagbasa (min)', 'Kabuuang Salita', 'Bilis (WPM)'],
                            datasets: [{
                                data: [filipinoReadingTimeMinutes, filipinoTotalWords, filipinoReadingSpeed],
                                backgroundColor: [
                                    '#1E3A8A',
                                    '#EA580C',
                                    '#0F766E'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Filipino Reading Comprehension Chart
                const filipinoComprehensionCtx = document.getElementById('filipino-reading-comprehension-chart');
                if (filipinoComprehensionCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    filipinoComprehensionCtx.appendChild(canvas);

                    // Use real data if available, otherwise use default values
                    const filipinoCorrectAnswers = latestFilipino ? latestFilipino.correct_answers : 7;
                    const filipinoTotalQuestions = latestFilipino ? latestFilipino.total_questions : 10;
                    const filipinoComprehensionScore = latestFilipino ? latestFilipino.comprehension : 70;

                    window.chartInstances.filipinoComprehensionChart = new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Tamang Sagot', 'Kabuuang Tanong', 'Pag-unawa %'],
                            datasets: [{
                                data: [filipinoCorrectAnswers, filipinoTotalQuestions, filipinoComprehensionScore],
                                backgroundColor: [
                                    '#0F766E',
                                    '#EA580C',
                                    '#1E3A8A'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Filipino Word Reading Chart
                const filipinoWordCtx = document.getElementById('filipino-word-reading-chart');
                if (filipinoWordCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    filipinoWordCtx.appendChild(canvas);

                    // Use real data if available, otherwise use default values
                    const filipinoMiscues = latestFilipino ? latestFilipino.miscues : 15;
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 250;
                    const filipinoCorrectWords = filipinoTotalWords - filipinoMiscues;
                    const filipinoCorrectReadingPercent = latestFilipino ? latestFilipino.correct_reading : 94;

                    window.chartInstances.filipinoWordChart = new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Mali sa Pagbasa', 'Tamang Salita', 'Tumpak %'],
                            datasets: [{
                                data: [filipinoMiscues, filipinoCorrectWords, filipinoCorrectReadingPercent],
                                backgroundColor: [
                                    '#DC2626',
                                    '#0F766E',
                                    '#1E3A8A'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }
            });

            // Function to refresh charts with new data
            window.refreshChartsWithNewData = function (studentId) {
                if (!studentId) {
                    console.log('No student ID provided for chart refresh');
                    return;
                }

                console.log('Refreshing charts for student ID:', studentId);

                // Fetch updated student assessment data
                fetch(`/teacher/get-student-assessments/${studentId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Updated assessment data:', data.data);

                            const assessments = data.data.assessments;
                            const latestEnglish = assessments.english;
                            const latestFilipino = assessments.filipino;

                            // Update English charts
                            updateEnglishCharts(latestEnglish);

                            // Update Filipino charts
                            updateFilipinoCharts(latestFilipino);

                            console.log('Charts updated successfully with new data');

                        } else {
                            console.error('Error fetching updated data:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error refreshing charts:', error);
                    });
            };

            // Function to update English charts
            function updateEnglishCharts(latestEnglish) {
                // Update Reading Speed Chart
                if (window.chartInstances.speedChart) {
                    const readingTimeMinutes = latestEnglish ? Math.round(latestEnglish.reading_time / 60) : 3;
                    const totalWords = latestEnglish ? latestEnglish.total_words : 250;
                    const readingSpeed = latestEnglish ? latestEnglish.reading_speed : 83;

                    window.chartInstances.speedChart.data.datasets[0].data = [readingTimeMinutes, totalWords, readingSpeed];
                    window.chartInstances.speedChart.update();
                }

                // Update Comprehension Chart
                if (window.chartInstances.comprehensionChart) {
                    const correctAnswers = latestEnglish ? latestEnglish.correct_answers : 7;
                    const totalQuestions = latestEnglish ? latestEnglish.total_questions : 10;
                    const comprehensionScore = latestEnglish ? latestEnglish.comprehension : 70;

                    window.chartInstances.comprehensionChart.data.datasets[0].data = [correctAnswers, totalQuestions, comprehensionScore];
                    window.chartInstances.comprehensionChart.update();
                }

                // Update Word Reading Chart
                if (window.chartInstances.wordChart) {
                    const miscues = latestEnglish ? latestEnglish.miscues : 101;
                    const totalWords = latestEnglish ? latestEnglish.total_words : 250;
                    const correctWords = totalWords - miscues;
                    const correctReadingPercent = latestEnglish ? latestEnglish.correct_reading : 60;

                    window.chartInstances.wordChart.data.datasets[0].data = [miscues, correctWords, correctReadingPercent];
                    window.chartInstances.wordChart.update();
                }
            }

            // Function to update Filipino charts
            function updateFilipinoCharts(latestFilipino) {
                // Update Filipino Reading Speed Chart
                if (window.chartInstances.filipinoSpeedChart) {
                    const filipinoReadingTimeMinutes = latestFilipino ? Math.round(latestFilipino.reading_time / 60) : 3;
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 250;
                    const filipinoReadingSpeed = latestFilipino ? latestFilipino.reading_speed : 83;

                    window.chartInstances.filipinoSpeedChart.data.datasets[0].data = [filipinoReadingTimeMinutes, filipinoTotalWords, filipinoReadingSpeed];
                    window.chartInstances.filipinoSpeedChart.update();
                }

                // Update Filipino Comprehension Chart
                if (window.chartInstances.filipinoComprehensionChart) {
                    const filipinoCorrectAnswers = latestFilipino ? latestFilipino.correct_answers : 7;
                    const filipinoTotalQuestions = latestFilipino ? latestFilipino.total_questions : 10;
                    const filipinoComprehensionScore = latestFilipino ? latestFilipino.comprehension : 70;

                    window.chartInstances.filipinoComprehensionChart.data.datasets[0].data = [filipinoCorrectAnswers, filipinoTotalQuestions, filipinoComprehensionScore];
                    window.chartInstances.filipinoComprehensionChart.update();
                }

                // Update Filipino Word Reading Chart
                if (window.chartInstances.filipinoWordChart) {
                    const filipinoMiscues = latestFilipino ? latestFilipino.miscues : 15;
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 250;
                    const filipinoCorrectWords = filipinoTotalWords - filipinoMiscues;
                    const filipinoCorrectReadingPercent = latestFilipino ? latestFilipino.correct_reading : 94;

                    window.chartInstances.filipinoWordChart.data.datasets[0].data = [filipinoMiscues, filipinoCorrectWords, filipinoCorrectReadingPercent];
                    window.chartInstances.filipinoWordChart.update();
                }
            }
        </script>

        <script>
            // Tab switching functionality
            document.addEventListener('DOMContentLoaded', function () {
                const tabs = document.querySelectorAll('nav button');
                const readingAssessments = document.getElementById('reading-assessments');
                const comprehensionAnalysis = document.getElementById('comprehension-analysis');

                tabs.forEach((tab, index) => {
                    tab.addEventListener('click', () => {
                        // Update active tab styling
                        tabs.forEach(t => {
                            t.classList.remove('border-primary', 'text-primary');
                            t.classList.add('border-transparent', 'text-gray-500');
                        });
                        tab.classList.remove('border-transparent', 'text-gray-500');
                        tab.classList.add('border-primary', 'text-primary');

                        // Show/hide content based on tab
                        if (index === 1) { // Comprehension Analysis tab
                            readingAssessments.classList.add('hidden');
                            comprehensionAnalysis.classList.remove('hidden');

                            // Initialize comprehension chart with Chart.js
                            const chartDom = document.getElementById('reading-level-chart');
                            if (chartDom && !chartDom.querySelector('canvas')) {
                                // Create canvas element
                                const canvas = document.createElement('canvas');
                                canvas.style.height = '300px';
                                chartDom.appendChild(canvas);

                                new Chart(canvas.getContext('2d'), {
                                    type: 'pie',
                                    data: {
                                        labels: ['Instructional', 'Independent', 'Frustration'],
                                        datasets: [{
                                            data: [50, 30, 20],
                                            backgroundColor: [
                                                '#3B82F6',
                                                '#10B981',
                                                '#EF4444'
                                            ],
                                            borderWidth: 2,
                                            borderColor: '#ffffff'
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                position: 'bottom',
                                                labels: {
                                                    color: '#000000',
                                                    font: {
                                                        size: 14,
                                                        weight: '600'
                                                    },
                                                    padding: 20
                                                }
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (context) {
                                                        return context.label + ': ' + context.parsed + '%';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            }
                        } else {
                            readingAssessments.classList.remove('hidden');
                            comprehensionAnalysis.classList.add('hidden');
                        }
                    });
                });
            });
        </script>
</body>

</html>