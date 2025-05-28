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
                    <h1 class="text-2xl font-bold mb-4">Emma Brown</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-2">
                                <p class="text-sm text-gray-500">Student ID</p>
                                <p>001</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p>emma.b@example.com</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Grade & Section</p>
                                    <p>Grade 7 - Section A</p>
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
                    <span class="text-gray-500 text-sm">Reading Level</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-book-open-line"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Instructional</h3>
                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">Excellent</span>
            </div>

            <!-- Comprehension Score -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 text-sm">Comprehension Score</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-mental-health-line"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">84%</h3>
                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">Excellent</span>
            </div>

            <!-- Reading Speed -->
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500 text-sm">Reading Speed</span>
                    <div class="w-5 h-5 flex items-center justify-center text-blue-500">
                        <i class="ri-speed-line"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">121wpm</h3>
                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">Excellent</span>
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
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Book Title
                                </th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Reading
                                    Level</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Score</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 bg-gray-50">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                                            <i class="ri-book-2-line"></i>
                                        </div>
                                        <span>The Secret Garden</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Instructional
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 98%"></div>
                                        </div>
                                        <span>90/100</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Excellent
                                    </span>
                                </td>
                            </tr>


                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                                            <i class="ri-book-2-line"></i>
                                        </div>
                                        <span>Number the Stars</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Instructional
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 96%"></div>
                                        </div>
                                        <span>87/100</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Good
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                                            <i class="ri-book-2-line"></i>
                                        </div>
                                        <span>Island of the Blue Dolphins</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Instrutional
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 94%"></div>
                                        </div>
                                        <span>85/100</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Good
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                                            <i class="ri-book-2-line"></i>
                                        </div>
                                        <span>The Giver</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Instructional
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: 97%"></div>
                                        </div>
                                        <span>91/100</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Excellent
                                    </span>
                                </td>
                            </tr>
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

        <!-- Performance Trend -->
        <div class="bg-white rounded-lg shadow-sm p-6">
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
                            <p class="text-xl font-bold text-primary">121WPM</p>
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
                        <p class="text-gray-600 text-sm mt-1">6 out of 10 correct answers</p>
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

                // Reading Speed Chart
                const speedCtx = document.getElementById('reading-speed-chart');
                if (speedCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    speedCtx.appendChild(canvas);

                    new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Reading Time', 'Total Words'],
                            datasets: [{
                                data: [149, 250],
                                backgroundColor: [
                                    '#00B8A9',
                                    '#00B8A9'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Reading Comprehension Chart
                const comprehensionCtx = document.getElementById('reading-comprehension-chart');
                if (comprehensionCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    comprehensionCtx.appendChild(canvas);

                    new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Correct Answers', 'Total Questions'],
                            datasets: [{
                                data: [6, 10],
                                backgroundColor: [
                                    '#00B8A9',
                                    '#00B8A9'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
                    });
                }

                // Word Reading Chart
                const wordCtx = document.getElementById('word-reading-chart');
                if (wordCtx) {
                    // Create canvas element
                    const canvas = document.createElement('canvas');
                    canvas.style.height = '200px';
                    wordCtx.appendChild(canvas);

                    new Chart(canvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                            datasets: [{
                                data: [101, 149, 250],
                                backgroundColor: [
                                    '#00B8A9',
                                    '#00B8A9',
                                    '#00B8A9'
                                ],
                                borderWidth: 0,
                                borderRadius: 4
                            }]
                        },
                        options: chartOptions
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
        </script>
</body>

</html>