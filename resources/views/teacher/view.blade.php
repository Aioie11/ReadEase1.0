<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - {{ isset($student) ? $student->first_name . ' ' . $student->last_name : 'Student' }}
    </title>
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
                        @if(isset($student))
                            {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                        @else
                            ST
                        @endif
                    </div>
                </div>

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
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <!-- Average Correct Reading (Combined) -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-3">
                    <span class="text-gray-500 text-sm">Average Correct Reading</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-book-open-line"></i>
                    </div>
                </div>

                <!-- English Data -->
                <div class="mb-3">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">English:</span>
                        <span class="text-lg font-bold text-blue-600">
                            @if(isset($student) && $student->readingAssessments->where('language', 'english')->count() > 0)
                                {{ round($student->readingAssessments->where('language', 'english')->avg('correct_reading'), 1) }}%
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs">
                        @if(isset($student) && $student->readingAssessments->where('language', 'english')->count() > 0)
                            @php
                                $avgEnglishCorrect = $student->readingAssessments->where('language', 'english')->avg('correct_reading');
                            @endphp
                            @if($avgEnglishCorrect >= 90)
                                Excellent
                            @elseif($avgEnglishCorrect >= 80)
                                Good
                            @elseif($avgEnglishCorrect >= 70)
                                Fair
                            @else
                                Needs Improvement
                            @endif
                        @else
                            No Data
                        @endif
                    </span>
                </div>

                <!-- Filipino Data -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Filipino:</span>
                        <span class="text-lg font-bold text-green-600">
                            @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->count() > 0)
                                {{ round($student->readingAssessments->where('language', 'filipino')->avg('correct_reading'), 1) }}%
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                        @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->count() > 0)
                            @php
                                $avgFilipinoCorrect = $student->readingAssessments->where('language', 'filipino')->avg('correct_reading');
                            @endphp
                            @if($avgFilipinoCorrect >= 90)
                                Excellent
                            @elseif($avgFilipinoCorrect >= 80)
                                Good
                            @elseif($avgFilipinoCorrect >= 70)
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

            <!-- Average Comprehension (Combined) -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-3">
                    <span class="text-gray-500 text-sm">Average Comprehension</span>
                    <div class="w-5 h-5 flex items-center justify-center text-purple-500">
                        <i class="ri-mental-health-line"></i>
                    </div>
                </div>

                <!-- English Comprehension -->
                <div class="mb-3">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">English:</span>
                        <span class="text-lg font-bold text-blue-600">
                            @if(isset($student) && $student->readingAssessments->where('language', 'english')->count() > 0)
                                {{ round($student->readingAssessments->where('language', 'english')->avg('comprehension'), 1) }}%
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs">
                        @if(isset($student) && $student->readingAssessments->where('language', 'english')->count() > 0)
                            @php
                                $avgEnglishComp = $student->readingAssessments->where('language', 'english')->avg('comprehension');
                            @endphp
                            @if($avgEnglishComp >= 90)
                                Excellent
                            @elseif($avgEnglishComp >= 80)
                                Good
                            @elseif($avgEnglishComp >= 70)
                                Fair
                            @else
                                Needs Improvement
                            @endif
                        @else
                            No Data
                        @endif
                    </span>
                </div>

                <!-- Filipino Comprehension -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Filipino:</span>
                        <span class="text-lg font-bold text-green-600">
                            @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->count() > 0)
                                {{ round($student->readingAssessments->where('language', 'filipino')->avg('comprehension'), 1) }}%
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                        @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->count() > 0)
                            @php
                                $avgFilipinoComp = $student->readingAssessments->where('language', 'filipino')->avg('comprehension');
                            @endphp
                            @if($avgFilipinoComp >= 90)
                                Excellent
                            @elseif($avgFilipinoComp >= 80)
                                Good
                            @elseif($avgFilipinoComp >= 70)
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

            <!-- Average Reading Speed (Combined) -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-3">
                    <span class="text-gray-500 text-sm">Average Reading Speed</span>
                    <div class="w-5 h-5 flex items-center justify-center text-orange-500">
                        <i class="ri-speed-line"></i>
                    </div>
                </div>

                <!-- English Reading Speed -->
                <div class="mb-3">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">English:</span>
                        <span class="text-lg font-bold text-blue-600">
                            @if(isset($student) && $student->readingAssessments->where('language', 'english')->count() > 0)
                                {{ round($student->readingAssessments->where('language', 'english')->avg('reading_speed'), 1) }}
                                wpm
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs">
                        @if(isset($student) && $student->readingAssessments->where('language', 'english')->count() > 0)
                            @php
                                $avgEnglishSpeed = $student->readingAssessments->where('language', 'english')->avg('reading_speed');
                            @endphp
                            @if($avgEnglishSpeed >= 120)
                                Excellent
                            @elseif($avgEnglishSpeed >= 100)
                                Good
                            @elseif($avgEnglishSpeed >= 80)
                                Fair
                            @else
                                Needs Improvement
                            @endif
                        @else
                            No Data
                        @endif
                    </span>
                </div>

                <!-- Filipino Reading Speed -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-gray-600">Filipino:</span>
                        <span class="text-lg font-bold text-green-600">
                            @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->count() > 0)
                                {{ round($student->readingAssessments->where('language', 'filipino')->avg('reading_speed'), 1) }}
                                wpm
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                        @if(isset($student) && $student->readingAssessments->where('language', 'filipino')->count() > 0)
                            @php
                                $avgFilipinoSpeed = $student->readingAssessments->where('language', 'filipino')->avg('reading_speed');
                            @endphp
                            @if($avgFilipinoSpeed >= 120)
                                Excellent
                            @elseif($avgFilipinoSpeed >= 100)
                                Good
                            @elseif($avgFilipinoSpeed >= 80)
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
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">English Language Test Results</h2>
                <div class="flex items-center space-x-4">
                    <button onclick="window.forceChartRefresh()"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="ri-refresh-line mr-1"></i>
                        Refresh Charts
                    </button>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">View:</span>
                        <select class="text-sm border-gray-200 rounded-md focus:ring-primary focus:border-primary">
                            <option>Detailed View</option>
                            <option>Summary View</option>
                        </select>
                    </div>
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
                            <p class="text-xl font-bold text-primary"></p>
                            <span class="text-sm text-green-600"></span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"></p>
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
                            <p class="text-xl font-bold text-primary"></p>
                            <span class="text-sm text-green-600"></span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"></p>
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
                            <p class="text-xl font-bold text-primary"></p>
                            <span class="text-sm text-green-600"></span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"></p>
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
                            <p class="text-xl font-bold text-primary"></p>
                            <span class="text-sm text-green-600"></span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"></p>
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
                            <p class="text-xl font-bold text-primary"></p>
                            <span class="text-sm text-green-600"></span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"></p>
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
                            <p class="text-xl font-bold text-primary"></p>
                            <span class="text-sm text-green-600"></span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"></p>
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
                color: #00B8A9;
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

                // Reading Speed Chart (English)
                const speedCtx = document.getElementById('reading-speed-chart');
                if (speedCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    speedCtx.appendChild(canvas);

                    // Use real data if available, otherwise show empty chart
                    let actualReadingTime = 0; // Default 0 minutes when no data

                    if (latestEnglish && latestEnglish.reading_time) {
                        // Convert reading_time from seconds to minutes and ensure reasonable range
                        const rawTime = latestEnglish.reading_time;
                        console.log('Raw reading time from database:', rawTime, 'seconds');

                        // If time is in seconds, convert to minutes
                        if (rawTime > 60) {
                            actualReadingTime = rawTime / 60; // Convert seconds to minutes
                        } else {
                            actualReadingTime = rawTime; // Already in minutes
                        }

                        // Cap maximum time to 10 minutes for realistic display
                        actualReadingTime = Math.min(actualReadingTime, 10);
                    }

                    const readingTimeMinutes = Math.max(Math.round(actualReadingTime), 0); // Allow minimum 0 minutes, maximum 10
                    const totalWords = latestEnglish ? latestEnglish.total_words : 0;
                    const readingSpeed = latestEnglish ? latestEnglish.reading_speed : 0;

                    console.log('English Chart - Raw time:', latestEnglish?.reading_time, 'Processed time:', actualReadingTime.toFixed(2), 'Display time:', readingTimeMinutes);

                    // Add visual indicator for very short times
                    if (actualReadingTime < 0.5 && latestEnglish) {
                        console.log('ℹ️ SHORT READING TIME: Reading time was', actualReadingTime.toFixed(2), 'minutes, displayed as', readingTimeMinutes, 'minutes');
                    }

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
                        options: readingSpeedChartOptions
                    });
                }

                // Reading Comprehension Chart (English)
                const comprehensionCtx = document.getElementById('reading-comprehension-chart');
                if (comprehensionCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    comprehensionCtx.appendChild(canvas);

                    // Use real data if available, otherwise show empty chart
                    const correctAnswers = latestEnglish ? latestEnglish.correct_answers : 0;
                    const totalQuestions = latestEnglish ? latestEnglish.total_questions : 0;
                    const comprehensionScore = latestEnglish ? latestEnglish.comprehension : 0;

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

                    // Use real data if available, otherwise show empty chart
                    const miscues = latestEnglish ? latestEnglish.miscues : 0;
                    const totalWords = latestEnglish ? latestEnglish.total_words : 0;
                    const correctWords = totalWords - miscues;
                    const correctReadingPercent = latestEnglish ? latestEnglish.correct_reading : 0;

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

                    // Use real data if available, otherwise show empty chart
                    let actualFilipinoReadingTime = 0; // Default 0 minutes when no data

                    if (latestFilipino && latestFilipino.reading_time) {
                        // Convert reading_time from seconds to minutes and ensure reasonable range
                        const rawTime = latestFilipino.reading_time;
                        console.log('Raw Filipino reading time from database:', rawTime, 'seconds');

                        // If time is in seconds, convert to minutes
                        if (rawTime > 60) {
                            actualFilipinoReadingTime = rawTime / 60; // Convert seconds to minutes
                        } else {
                            actualFilipinoReadingTime = rawTime; // Already in minutes
                        }

                        // Cap maximum time to 10 minutes for realistic display
                        actualFilipinoReadingTime = Math.min(actualFilipinoReadingTime, 10);
                    }

                    const filipinoReadingTimeMinutes = Math.max(Math.round(actualFilipinoReadingTime), 0); // Allow minimum 0 minutes, maximum 10
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 0;
                    const filipinoReadingSpeed = latestFilipino ? latestFilipino.reading_speed : 0;

                    console.log('Filipino Chart - Raw time:', latestFilipino?.reading_time, 'Processed time:', actualFilipinoReadingTime.toFixed(2), 'Display time:', filipinoReadingTimeMinutes);

                    // Add visual indicator for very short times
                    if (actualFilipinoReadingTime < 0.5 && latestFilipino) {
                        console.log('ℹ️ SHORT FILIPINO READING TIME: Reading time was', actualFilipinoReadingTime.toFixed(2), 'minutes, displayed as', filipinoReadingTimeMinutes, 'minutes');
                    }

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
                        options: readingSpeedChartOptions
                    });
                }

                // Filipino Reading Comprehension Chart
                const filipinoComprehensionCtx = document.getElementById('filipino-reading-comprehension-chart');
                if (filipinoComprehensionCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    filipinoComprehensionCtx.appendChild(canvas);

                    // Use real data if available, otherwise show empty chart
                    const filipinoCorrectAnswers = latestFilipino ? latestFilipino.correct_answers : 0;
                    const filipinoTotalQuestions = latestFilipino ? latestFilipino.total_questions : 0;
                    const filipinoComprehensionScore = latestFilipino ? latestFilipino.comprehension : 0;

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

                    // Use real data if available, otherwise show empty chart
                    const filipinoMiscues = latestFilipino ? latestFilipino.miscues : 0;
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 0;
                    const filipinoCorrectWords = filipinoTotalWords - filipinoMiscues;
                    const filipinoCorrectReadingPercent = latestFilipino ? latestFilipino.correct_reading : 0;

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
                    let actualReadingTime = 3; // Default 3 minutes

                    if (latestEnglish && latestEnglish.reading_time) {
                        // Convert reading_time from seconds to minutes and ensure reasonable range
                        const rawTime = latestEnglish.reading_time;
                        console.log('Update - Raw English reading time from database:', rawTime, 'seconds');

                        // If time is in seconds, convert to minutes
                        if (rawTime > 60) {
                            actualReadingTime = rawTime / 60; // Convert seconds to minutes
                        } else {
                            actualReadingTime = rawTime; // Already in minutes
                        }

                        // Cap maximum time to 10 minutes for realistic display
                        actualReadingTime = Math.min(actualReadingTime, 10);
                    }

                    const readingTimeMinutes = Math.max(Math.round(actualReadingTime), 0); // Allow minimum 0 minutes, maximum 10
                    const totalWords = latestEnglish ? latestEnglish.total_words : 0;
                    const readingSpeed = latestEnglish ? latestEnglish.reading_speed : 0;

                    console.log('Update English Chart - Raw time:', latestEnglish?.reading_time, 'Processed time:', actualReadingTime.toFixed(2), 'Display time:', readingTimeMinutes);

                    window.chartInstances.speedChart.data.datasets[0].data = [readingTimeMinutes, totalWords, readingSpeed];
                    window.chartInstances.speedChart.update();
                }

                // Update Comprehension Chart
                if (window.chartInstances.comprehensionChart) {
                    const correctAnswers = latestEnglish ? latestEnglish.correct_answers : 0;
                    const totalQuestions = latestEnglish ? latestEnglish.total_questions : 0;
                    const comprehensionScore = latestEnglish ? latestEnglish.comprehension : 0;

                    window.chartInstances.comprehensionChart.data.datasets[0].data = [correctAnswers, totalQuestions, comprehensionScore];
                    window.chartInstances.comprehensionChart.update();
                }

                // Update Word Reading Chart
                if (window.chartInstances.wordChart) {
                    const miscues = latestEnglish ? latestEnglish.miscues : 0;
                    const totalWords = latestEnglish ? latestEnglish.total_words : 0;
                    const correctWords = totalWords - miscues;
                    const correctReadingPercent = latestEnglish ? latestEnglish.correct_reading : 0;

                    window.chartInstances.wordChart.data.datasets[0].data = [miscues, correctWords, correctReadingPercent];
                    window.chartInstances.wordChart.update();
                }
            }

            // Function to update Filipino charts
            function updateFilipinoCharts(latestFilipino) {
                // Update Filipino Reading Speed Chart
                if (window.chartInstances.filipinoSpeedChart) {
                    let actualFilipinoReadingTime = 3; // Default 3 minutes

                    if (latestFilipino && latestFilipino.reading_time) {
                        // Convert reading_time from seconds to minutes and ensure reasonable range
                        const rawTime = latestFilipino.reading_time;
                        console.log('Update - Raw Filipino reading time from database:', rawTime, 'seconds');

                        // If time is in seconds, convert to minutes
                        if (rawTime > 60) {
                            actualFilipinoReadingTime = rawTime / 60; // Convert seconds to minutes
                        } else {
                            actualFilipinoReadingTime = rawTime; // Already in minutes
                        }

                        // Cap maximum time to 10 minutes for realistic display
                        actualFilipinoReadingTime = Math.min(actualFilipinoReadingTime, 10);
                    }

                    const filipinoReadingTimeMinutes = Math.max(Math.round(actualFilipinoReadingTime), 0); // Allow minimum 0 minutes, maximum 10
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 0;
                    const filipinoReadingSpeed = latestFilipino ? latestFilipino.reading_speed : 0;

                    console.log('Update Filipino Chart - Raw time:', latestFilipino?.reading_time, 'Processed time:', actualFilipinoReadingTime.toFixed(2), 'Display time:', filipinoReadingTimeMinutes);

                    window.chartInstances.filipinoSpeedChart.data.datasets[0].data = [filipinoReadingTimeMinutes, filipinoTotalWords, filipinoReadingSpeed];
                    window.chartInstances.filipinoSpeedChart.update();
                }

                // Update Filipino Comprehension Chart
                if (window.chartInstances.filipinoComprehensionChart) {
                    const filipinoCorrectAnswers = latestFilipino ? latestFilipino.correct_answers : 0;
                    const filipinoTotalQuestions = latestFilipino ? latestFilipino.total_questions : 0;
                    const filipinoComprehensionScore = latestFilipino ? latestFilipino.comprehension : 0;

                    window.chartInstances.filipinoComprehensionChart.data.datasets[0].data = [filipinoCorrectAnswers, filipinoTotalQuestions, filipinoComprehensionScore];
                    window.chartInstances.filipinoComprehensionChart.update();
                }

                // Update Filipino Word Reading Chart
                if (window.chartInstances.filipinoWordChart) {
                    const filipinoMiscues = latestFilipino ? latestFilipino.miscues : 0;
                    const filipinoTotalWords = latestFilipino ? latestFilipino.total_words : 0;
                    const filipinoCorrectWords = filipinoTotalWords - filipinoMiscues;
                    const filipinoCorrectReadingPercent = latestFilipino ? latestFilipino.correct_reading : 0;

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

            // Force chart refresh function to ensure minimum time display
            window.forceChartRefresh = function () {
                console.log('Forcing chart refresh with minimum time constraints...');

                // Get current student data
                const studentData = @json(isset($student) ? $student->readingAssessments : []);
                const englishAssessments = studentData.filter(assessment => assessment.language === 'english');
                const filipinoAssessments = studentData.filter(assessment => assessment.language === 'filipino');
                const latestEnglish = englishAssessments.length > 0 ? englishAssessments[0] : null;
                const latestFilipino = filipinoAssessments.length > 0 ? filipinoAssessments[0] : null;

                // Force update English charts
                if (latestEnglish) {
                    updateEnglishCharts(latestEnglish);
                }

                // Force update Filipino charts
                if (latestFilipino) {
                    updateFilipinoCharts(latestFilipino);
                }

                console.log('Chart refresh completed');
            };

            // Auto-refresh charts after page load to ensure minimum constraints
            setTimeout(function () {
                if (typeof window.forceChartRefresh === 'function') {
                    window.forceChartRefresh();
                }
            }, 2000);

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