<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Emma Brown</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#0369a1', secondary: '#6b7280' }, borderRadius: { 'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px', 'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px' } } }</script>
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
                            {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                        @else
                            Brown, Emma
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
                                        <td class="py-4 px-4">
                                            <button
                                                onclick="showComprehensionDetails('{{ $student->student_number ?? '' }}', '{{ $assessment->language }}')"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                                title="View comprehension details">
                                                <i class="ri-eye-line mr-1"></i>
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="py-8 px-4 text-center text-gray-500">
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
        <div class="results-section">
            <div class="results-header">
                <h2>English Language Test Results</h2>
            </div>
            <div class="charts-container">
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="reading-metrics">
                        <p><strong>{{ session('english_reading_speed', 0) }} WPM</strong></p>
                        @php
                            $englishTime = session('english_reading_time', 0);
                            $englishTimeFormatted = $englishTime >= 60 ? floor($englishTime / 60) . ' min ' . ($englishTime % 60) . ' sec' : $englishTime . ' sec';
                        @endphp
                        <p>Reading Time: {{ $englishTimeFormatted }}</p>
                        <p>Total Words: {{ session('english_total_words', 0) }}</p>
                    </div>
                </div>

                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="myChart1"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @php
                            $englishScore = session('english_score', 0);
                            $englishTotal = session('english_total_questions', 0);
                            $englishPercentage = $englishTotal > 0 ? round(($englishScore / $englishTotal) * 100) : 0;

                            if ($englishPercentage >= 80) {
                                $englishLevel = 'Independent Level';
                                $englishLevelClass = 'text-success';
                            } elseif ($englishPercentage >= 59) {
                                $englishLevel = 'Instructional Level';
                                $englishLevelClass = 'text-warning';
                            } else {
                                $englishLevel = 'Frustrational Level';
                                $englishLevelClass = 'text-danger';
                            }
                        @endphp
                        <p><strong class="{{ $englishLevelClass }}">{{ $englishLevel }}</strong></p>
                        <p>{{ $englishPercentage }}% comprehension score</p>
                        <p>{{ $englishScore }} out of {{ $englishTotal }} correct answers </p>
                    </div>
                </div>

                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="myChart2"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @php
                            $englishWordAccuracy = session('english_correct_reading', 0);

                            if ($englishWordAccuracy >= 97) {
                                $englishWordLevel = 'Independent Level';
                                $englishWordLevelClass = 'text-success';
                            } elseif ($englishWordAccuracy >= 90) {
                                $englishWordLevel = 'Instructional Level';
                                $englishWordLevelClass = 'text-warning';
                            } else {
                                $englishWordLevel = 'Frustrational Level';
                                $englishWordLevelClass = 'text-danger';
                            }
                        @endphp
                        <p><strong class="{{ $englishWordLevelClass }}">{{ $englishWordLevel }}</strong></p>
                        <p>{{ $englishWordAccuracy }}% reading accuracy</p>
                        <p>{{ session('english_miscues', 0) }} miscues out of {{ session('english_total_words', 0) }} words</p>

                    </div>
                </div>
            </div>
        </div>

        <!-- Filipino Language Test Results -->
        <div class="results-section">
            <div class="results-header">
                <h2>Filipino Language Test Results</h2>
            </div>
            <div class="charts-container">
                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="myChart3"></canvas>
                    </div>
                    <div class="reading-metrics">
                        <p><strong>{{ session('filipino_reading_speed', 0) }} WPM</strong></p>
                        @php
                            $filipinoTime = session('filipino_reading_time', 0);
                            $filipinoTimeFormatted = $filipinoTime >= 60 ? floor($filipinoTime / 60) . ' min ' . ($filipinoTime % 60) . ' sec' : $filipinoTime . ' sec';
                        @endphp
                        <p>Reading Time: {{ $filipinoTimeFormatted }}</p>
                        <p>Total Words: {{ session('filipino_total_words', 0) }}</p>
                    </div>
                </div>

                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="myChart4"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @php
                            $filipinoScore = session('filipino_score', 0);
                            $filipinoTotal = session('filipino_total_questions', 0);
                            $filipinoPercentage = $filipinoTotal > 0 ? round(($filipinoScore / $filipinoTotal) * 100) : 0;

                            if ($filipinoPercentage >= 80) {
                                $filipinoLevel = 'Independent Level';
                                $filipinoLevelClass = 'text-success';
                            } elseif ($filipinoPercentage >= 59) {
                                $filipinoLevel = 'Instructional Level';
                                $filipinoLevelClass = 'text-warning';
                            } else {
                                $filipinoLevel = 'Frustrational Level';
                                $filipinoLevelClass = 'text-danger';
                            }
                        @endphp
                        <p><strong class="{{ $filipinoLevelClass }}">{{ $filipinoLevel }}</strong></p>
                        <p>{{ $filipinoPercentage }}% comprehension score</p>
                        <p>{{ $filipinoScore }} out of {{ $filipinoTotal }} correct answers </p>


                    </div>
                </div>

                <div class="reading-passage">
                    <div class="chart-card">
                        <canvas id="myChart5"></canvas>
                    </div>
                    <div class="reading-metrics">
                        @php
                            $filipinoWordAccuracy = session('filipino_correct_reading', 0);

                            if ($filipinoWordAccuracy >= 97) {
                                $filipinoWordLevel = 'Independent Level';
                                $filipinoWordLevelClass = 'text-success';
                            } elseif ($filipinoWordAccuracy >= 90) {
                                $filipinoWordLevel = 'Instructional Level';
                                $filipinoWordLevelClass = 'text-warning';
                            } else {
                                $filipinoWordLevel = 'Frustrational Level';
                                $filipinoWordLevelClass = 'text-danger';
                            }
                        @endphp
                        <p><strong class="{{ $filipinoWordLevelClass }}">{{ $filipinoWordLevel }}</strong></p>
                        <p>{{ $filipinoWordAccuracy }}% reading accuracy</p>
                        <p>{{ session('filipino_miscues', 0) }} miscues out of {{ session('filipino_total_words', 0) }} words</p>

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

            /* Student Reports Chart Styles */
            .results-section {
                background: white;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 30px;
            }

            .results-header h2 {
                color: #2c3e50;
                font-size: 1.8em;
                margin-bottom: 25px;
                padding-bottom: 15px;
                border-bottom: 2px solid #95a5a6;
            }

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
                background: linear-gradient(135deg, #1E3A8A, #3B82F6);
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

            .student-info-section {
                margin-bottom: 2rem;
            }

            .student-card {
                display: flex;
                align-items: center;
                background: linear-gradient(135deg, #F8FAFC, #E2E8F0);
                padding: 1.5rem;
                border-radius: 12px;
                border: 1px solid #E2E8F0;
            }

            .student-avatar-large {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: linear-gradient(135deg, #1E3A8A, #3B82F6);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2rem;
                margin-right: 1.5rem;
            }

            .student-details h3 {
                margin: 0 0 0.5rem 0;
                color: #1E3A8A;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .student-details p {
                margin: 0 0 1rem 0;
                color: #64748B;
                font-size: 1rem;
            }

            .assessment-summary {
                display: flex;
                gap: 1rem;
            }

            .score-badge,
            .percentage-badge,
            .date-badge {
                background: white;
                padding: 0.75rem 1rem;
                border-radius: 8px;
                text-align: center;
                border: 1px solid #E2E8F0;
                min-width: 80px;
            }

            .score-badge span,
            .percentage-badge span,
            .date-badge span {
                display: block;
                font-size: 1.25rem;
                font-weight: 600;
                color: #1E3A8A;
            }

            .score-badge small,
            .percentage-badge small,
            .date-badge small {
                color: #64748B;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
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
                border-left: 4px solid #10B981;
                background: #F0FDF4;
            }

            .question-item.incorrect {
                border-left: 4px solid #EF4444;
                background: #FEF2F2;
            }

            .question-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
            }

            .question-number {
                background: #1E3A8A;
                color: white;
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
                background: #D1FAE5;
                color: #065F46;
            }

            .answer-status.incorrect {
                background: #FEE2E2;
                color: #991B1B;
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
                background: #FEF2F2;
                border-left: 3px solid #EF4444;
            }

            .student-answer.correct-student {
                background: #F0FDF4;
                border-left: 3px solid #10B981;
            }

            .correct-answer {
                background: #F0FDF4;
                border-left: 3px solid #10B981;
            }

            .answer-label {
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.5rem;
            }

            .student-answer .answer-label {
                color: #991B1B;
            }

            .student-answer.correct-student .answer-label {
                color: #065F46;
            }

            .correct-answer .answer-label {
                color: #065F46;
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
                border-left: 4px solid #10B981;
            }

            .stat-card.incorrect {
                border-left: 4px solid #EF4444;
            }

            .stat-card.total {
                border-left: 4px solid #3B82F6;
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
                background: #1E3A8A;
                color: white;
            }

            .btn-primary:hover {
                background: #1E40AF;
            }

            @media (max-width: 768px) {
                .comprehension-modal {
                    width: 95%;
                    margin: 5% auto;
                }

                .student-card {
                    flex-direction: column;
                    text-align: center;
                }

                .student-avatar-large {
                    margin-right: 0;
                    margin-bottom: 1rem;
                }

                .assessment-summary {
                    justify-content: center;
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

                // Chart.js configuration for uniform styling (from student reports)
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

                // English Reading Speed Chart (Reading Time and Total Words)
                const ctx = document.getElementById('myChart');
                if (ctx) {
                    const englishReadingTime = {{ session('english_reading_time', 0) }};
                    const englishTotalWords = {{ session('english_total_words', 0) }};

                    new Chart(ctx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Time (sec)', 'Words'],
                            datasets: [{
                                data: [englishReadingTime, englishTotalWords],
                                backgroundColor: [
                                    '#3498db',
                                    '#e74c3c'
                                ],
                                borderWidth: 0,
                                borderRadius: 6,
                                barThickness: 60
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                title: {
                                    ...chartOptions.plugins.title,
                                    text: 'Reading Speed'
                                }
                            },
                            scales: {
                                ...chartOptions.scales,
                                y: {
                                    ...chartOptions.scales.y,
                                    title: {
                                        ...chartOptions.scales.y.title,
                                        text: 'Count'
                                    }
                                },
                                x: {
                                    ...chartOptions.scales.x,
                                    title: {
                                        ...chartOptions.scales.x.title,
                                        text: 'Reading Metrics'
                                    }
                                }
                            }
                        }
                    });
                }

                // English Comprehension Chart
                const ctx1 = document.getElementById('myChart1');
                if (ctx1) {
                    const englishCorrect = {{ session('english_score', 0) }};
                    const englishTotal = {{ session('english_total_questions', 0) }};

                    new Chart(ctx1.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Correct Answers', 'Total Questions'],
                            datasets: [{
                                data: [englishCorrect, englishTotal],
                                backgroundColor: [
                                    '#27ae60',
                                    '#3498db'
                                ],
                                borderWidth: 0,
                                borderRadius: 6,
                                barThickness: 60
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                title: {
                                    ...chartOptions.plugins.title,
                                    text: 'Reading Comprehension'
                                }
                            },
                            scales: {
                                ...chartOptions.scales,
                                y: {
                                    ...chartOptions.scales.y,
                                    title: {
                                        ...chartOptions.scales.y.title,
                                        text: 'Questions'
                                    },
                                    ticks: {
                                        ...chartOptions.scales.y.ticks,
                                        stepSize: 1,
                                        callback: function(value) {
                                            if (Number.isInteger(value)) {
                                                return value;
                                            }
                                        }
                                    }
                                },
                                x: {
                                    ...chartOptions.scales.x,
                                    title: {
                                        ...chartOptions.scales.x.title,
                                        text: 'Comprehension Results'
                                    }
                                }
                            }
                        }
                    });
                }

                // English Word Reading Chart (Teacher Assessment Data)
                const ctx2 = document.getElementById('myChart2');
                if (ctx2) {
                    const englishMiscues = {{ session('english_miscues', 0) }};
                    const englishWords = {{ session('english_total_words', 0) }};

                    new Chart(ctx2.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Miscues', 'Total Words'],
                            datasets: [{
                                data: [englishMiscues, englishWords],
                                backgroundColor: [
                                    '#e74c3c',
                                    '#3498db'
                                ],
                                borderWidth: 0,
                                borderRadius: 6,
                                barThickness: 60
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                title: {
                                    ...chartOptions.plugins.title,
                                    text: 'Word Reading'
                                }
                            },
                            scales: {
                                ...chartOptions.scales,
                                y: {
                                    ...chartOptions.scales.y,
                                    title: {
                                        ...chartOptions.scales.y.title,
                                        text: 'Count'
                                    }
                                },
                                x: {
                                    ...chartOptions.scales.x,
                                    title: {
                                        ...chartOptions.scales.x.title,
                                        text: 'Reading Analysis'
                                    }
                                }
                            }
                        }
                    });
                }

                // Filipino Reading Speed Chart (Reading Time and Total Words)
                const ctx3 = document.getElementById('myChart3');
                if (ctx3) {
                    const filipinoReadingTime = {{ session('filipino_reading_time', 0) }};
                    const filipinoTotalWords = {{ session('filipino_total_words', 0) }};

                    new Chart(ctx3.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Time (sec)', 'Words'],
                            datasets: [{
                                data: [filipinoReadingTime, filipinoTotalWords],
                                backgroundColor: [
                                    '#3498db',
                                    '#e74c3c'
                                ],
                                borderWidth: 0,
                                borderRadius: 6,
                                barThickness: 60
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                title: {
                                    ...chartOptions.plugins.title,
                                    text: 'Reading Speed'
                                }
                            },
                            scales: {
                                ...chartOptions.scales,
                                y: {
                                    ...chartOptions.scales.y,
                                    title: {
                                        ...chartOptions.scales.y.title,
                                        text: 'Count'
                                    }
                                },
                                x: {
                                    ...chartOptions.scales.x,
                                    title: {
                                        ...chartOptions.scales.x.title,
                                        text: 'Reading Metrics'
                                    }
                                }
                            }
                        }
                    });
                }

                // Filipino Comprehension Chart
                const ctx4 = document.getElementById('myChart4');
                if (ctx4) {
                    const filipinoCorrect = {{ session('filipino_score', 0) }};
                    const filipinoTotal = {{ session('filipino_total_questions', 0) }};

                    new Chart(ctx4.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Correct Answers', 'Total Questions'],
                            datasets: [{
                                data: [filipinoCorrect, filipinoTotal],
                                backgroundColor: [
                                    '#27ae60',
                                    '#3498db'
                                ],
                                borderWidth: 0,
                                borderRadius: 6,
                                barThickness: 60
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                title: {
                                    ...chartOptions.plugins.title,
                                    text: 'Reading Comprehension'
                                }
                            },
                            scales: {
                                ...chartOptions.scales,
                                y: {
                                    ...chartOptions.scales.y,
                                    title: {
                                        ...chartOptions.scales.y.title,
                                        text: 'Questions'
                                    },
                                    ticks: {
                                        ...chartOptions.scales.y.ticks,
                                        stepSize: 1,
                                        callback: function(value) {
                                            if (Number.isInteger(value)) {
                                                return value;
                                            }
                                        }
                                    }
                                },
                                x: {
                                    ...chartOptions.scales.x,
                                    title: {
                                        ...chartOptions.scales.x.title,
                                        text: 'Comprehension Results'
                                    }
                                }
                            }
                        }
                    });
                }

                // Filipino Word Reading Chart (Teacher Assessment Data)
                const ctx5 = document.getElementById('myChart5');
                if (ctx5) {
                    const filipinoMiscues = {{ session('filipino_miscues', 0) }};
                    const filipinoWords = {{ session('filipino_total_words', 0) }};

                    new Chart(ctx5.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Miscues', 'Total Words'],
                            datasets: [{
                                data: [filipinoMiscues, filipinoWords],
                                backgroundColor: [
                                    '#e74c3c',
                                    '#3498db'
                                ],
                                borderWidth: 0,
                                borderRadius: 6,
                                barThickness: 60
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                title: {
                                    ...chartOptions.plugins.title,
                                    text: 'Word Reading'
                                }
                            },
                            scales: {
                                ...chartOptions.scales,
                                y: {
                                    ...chartOptions.scales.y,
                                    title: {
                                        ...chartOptions.scales.y.title,
                                        text: 'Count'
                                    }
                                },
                                x: {
                                    ...chartOptions.scales.x,
                                    title: {
                                        ...chartOptions.scales.x.title,
                                        text: 'Reading Analysis'
                                    }
                                }
                            }
                        }
                    });
                }
            });


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
                document.getElementById('modalPercentage').textContent = data.assessment.percentage + '%';
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
                    <h2>📚 Comprehension Assessment Details</h2>
                    <span class="close" onclick="closeComprehensionModal()">&times;</span>
                </div>

                <div class="modal-body">
                    <!-- Student Info Section -->
                    <div class="student-info-section">
                        <div class="student-card">
                            <div class="student-avatar-large">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="student-details">
                                <h3 id="modalStudentName">Student Name</h3>
                                <p id="modalStudentInfo">Grade • Section</p>
                                <div class="assessment-summary">
                                    <div class="score-badge">
                                        <span id="modalScore">0</span>/<span id="modalTotalQuestions">0</span>
                                        <small>Score</small>
                                    </div>
                                    <div class="percentage-badge">
                                        <span id="modalPercentage">0%</span>
                                        <small>Accuracy</small>
                                    </div>
                                    <div class="date-badge">
                                        <span id="modalAssessmentDate">Date</span>
                                        <small>Assessment Date</small>
                                    </div>
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
</body>

</html>