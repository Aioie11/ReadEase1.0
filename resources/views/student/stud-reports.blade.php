@extends('layouts.head-stud')

@section('title', 'Student Results')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- English Language Results -->
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
                            <p><strong>{{ $latestEnglishReadingSpeed ?? 0 }} (WPM) Words Per Minute</strong></p>
                            <p><strong>Reading Time:</strong> {{ $latestEnglishReadingTime ?? 0 }} seconds</p>
                            <p><strong>Total Words:</strong> {{ $latestEnglishTotalWords ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart1"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Instructional Level</strong></p>
                            <p>{{ session('english_score', 0) }} out of {{ session('english_total_questions', 0) }} correct answers</p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart2"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Independent Level</strong></p>
                            <p>0 out of 0 words read correctly</p>
                        </div>
                    </div>
                </div>
                <div class="feedback-section">
                    <div class="feedback-header">
                        <h3>
                            <i class="fas fa-comments"></i>
                            Teacher Feedback - English
                        </h3>
                        <div class="feedback-count">
                            {{ $englishFeedback && $englishFeedback->count() > 0 ? $englishFeedback->count() : 0 }} feedback(s)
                        </div>
                    </div>

                    <div class="feedback-container">
                        @if($englishFeedback && $englishFeedback->count() > 0)
                            <div class="feedback-list">
                                @foreach($englishFeedback as $index => $feedback)
                                    <div class="feedback-card" data-feedback-id="{{ $index }}">
                                        <div class="feedback-card-header">
                                            <div class="feedback-info">
                                                <span class="feedback-date">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    {{ $feedback->sent_at->format('M d, Y') }}
                                                </span>
                                                <span class="feedback-teacher">
                                                    <i class="fas fa-user-tie"></i>
                                                    {{ $feedback->teacher_name }}
                                                </span>
                                            </div>
                                            <button class="feedback-toggle" onclick="toggleFeedback({{ $index }})">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>

                                        <div class="feedback-content" id="feedback-content-{{ $index }}">
                                            @if($feedback->strengths)
                                                <div class="feedback-section-item strengths">
                                                    <div class="feedback-label">
                                                        <i class="fas fa-star"></i>
                                                        <strong>Strengths</strong>
                                                    </div>
                                                    <p>{{ $feedback->strengths }}</p>
                                                </div>
                                            @endif

                                            @if($feedback->areas_for_improvement)
                                                <div class="feedback-section-item improvements">
                                                    <div class="feedback-label">
                                                        <i class="fas fa-arrow-up"></i>
                                                        <strong>Areas for Improvement</strong>
                                                    </div>
                                                    <p>{{ $feedback->areas_for_improvement }}</p>
                                                </div>
                                            @endif

                                            @if($feedback->recommendations)
                                                <div class="feedback-section-item recommendations">
                                                    <div class="feedback-label">
                                                        <i class="fas fa-lightbulb"></i>
                                                        <strong>Recommendations</strong>
                                                    </div>
                                                    <p>{{ $feedback->recommendations }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-feedback">
                                <div class="no-feedback-icon">
                                    <i class="fas fa-comment-slash"></i>
                                </div>
                                <p>No feedback yet</p>
                                <small>Your teacher hasn't provided feedback for English assessments yet.</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Filipino Language Results -->
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
                            <p><strong>{{ $latestFilipinoReadingSpeed ?? 0 }} (WPM) Words Per Minute</strong></p>
                            <p><strong>Reading Time:</strong> {{ $latestFilipinoReadingTime ?? 0 }} seconds</p>
                            <p><strong>Total Words:</strong> {{ $latestFilipinoTotalWords ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart4"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Instructional Level</strong></p>
                            <p>{{ session('filipino_score', 0) }} out of {{ session('filipino_total_questions', 0) }} correct answers</p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart5"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Independent Level</strong></p>
                            <p>0 out of 0 words read correctly</p>
                        </div>
                    </div>
                </div>
                <div class="feedback-section">
                    <div class="feedback-header">
                        <h3>
                            <i class="fas fa-comments"></i>
                            Teacher Feedback - Filipino
                        </h3>
                        <div class="feedback-count">
                            {{ $filipinoFeedback && $filipinoFeedback->count() > 0 ? $filipinoFeedback->count() : 0 }} feedback(s)
                        </div>
                    </div>

                    <div class="feedback-container">
                        @if($filipinoFeedback && $filipinoFeedback->count() > 0)
                            <div class="feedback-list">
                                @foreach($filipinoFeedback as $index => $feedback)
                                    <div class="feedback-card" data-feedback-id="filipino-{{ $index }}">
                                        <div class="feedback-card-header">
                                            <div class="feedback-info">
                                                <span class="feedback-date">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    {{ $feedback->sent_at->format('M d, Y') }}
                                                </span>
                                                <span class="feedback-teacher">
                                                    <i class="fas fa-user-tie"></i>
                                                    {{ $feedback->teacher_name }}
                                                </span>
                                            </div>
                                            <button class="feedback-toggle" onclick="toggleFeedback('filipino-{{ $index }}')">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>

                                        <div class="feedback-content" id="feedback-content-filipino-{{ $index }}">
                                            @if($feedback->strengths)
                                                <div class="feedback-section-item strengths">
                                                    <div class="feedback-label">
                                                        <i class="fas fa-star"></i>
                                                        <strong>Strengths</strong>
                                                    </div>
                                                    <p>{{ $feedback->strengths }}</p>
                                                </div>
                                            @endif

                                            @if($feedback->areas_for_improvement)
                                                <div class="feedback-section-item improvements">
                                                    <div class="feedback-label">
                                                        <i class="fas fa-arrow-up"></i>
                                                        <strong>Areas for Improvement</strong>
                                                    </div>
                                                    <p>{{ $feedback->areas_for_improvement }}</p>
                                                </div>
                                            @endif

                                            @if($feedback->recommendations)
                                                <div class="feedback-section-item recommendations">
                                                    <div class="feedback-label">
                                                        <i class="fas fa-lightbulb"></i>
                                                        <strong>Recommendations</strong>
                                                    </div>
                                                    <p>{{ $feedback->recommendations }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-feedback">
                                <div class="no-feedback-icon">
                                    <i class="fas fa-comment-slash"></i>
                                </div>
                                <p>No feedback yet</p>
                                <small>Your teacher hasn't provided feedback for Filipino assessments yet.</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detailed Results Table -->
            <div class="results-section">
                <div class="results-header">
                    <h2>Reading Results</h2>
                </div>

                <div class="results-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Reading Title</th>
                                <th>Date</th>
                                <th>Score</th>
                                <th>Time Spent</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pagbibilang ng mga Oras</td>
                                <td>2024-03-15</td>
                                <td>90%</td>
                                <td>25 mins</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Telling Time</td>
                                <td>2024-03-10</td>
                                <td>85%</td>
                                <td>20 mins</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="results-section">
                <div class="results-header">
                    <h2>Answer Results</h2>
                </div>

                <div class="results-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Question Category</th>
                                <th>Date</th>
                                <th>Score</th>
                                <th>Time Spent</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Filipino Question</td>
                                <td>2024-03-15</td>
                                <td>90%</td>
                                <td>25 mins</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>English Question</td>
                                <td>2024-03-10</td>
                                <td>85%</td>
                                <td>20 mins</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            padding: 20px;
            background-color: #f5f6fa;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .profile-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-image {
            width: 100px;
            height: 90px;
            border-radius: 10px;
        }

        .profile-info h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.5em;
        }

        .profile-info p {
            margin: 5px 0 0;
            color: #7f8c8d;
        }

        .performance-overview {
            margin-bottom: 30px;
        }

        .overview-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .overview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .overview-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stat-box {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .stat-box i {
            font-size: 2em;
            color: #3498db;
        }

        .stat-content h3 {
            margin: 0;
            font-size: 0.9em;
            color: #7f8c8d;
        }

        .stat-number {
            margin: 5px 0;
            font-size: 1.5em;
            font-weight: bold;
            color: #2c3e50;
        }

        .trend {
            font-size: 0.8em;
        }

        .trend.positive {
            color: #27ae60;
        }

        .trend.negative {
            color: #e74c3c;
        }

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

        .filter-options {
            display: flex;
            gap: 10px;
        }

        .form-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .charts-container {
            display: flex;
            flex-direction: row;
            gap: 10px;
            padding: 10px 0;
            width: 100%;
        }

        .reading-passage {
            flex: 1;
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s;
            min-width: 0;
        }

        .reading-passage:hover {
            transform: translateY(-5px);
        }

        .chart-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            height: 350px;
            position: relative;
        }

        .chart-card canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .reading-metrics {
            background: white;
            padding: 20px;
            margin: 0 15px 15px 15px;
            border-radius: 8px;
            text-align: center;
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

        .feedback-section {
            margin-top: 25px;
            background: #fafbfc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e1e5e9;
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e1e5e9;
        }

        .feedback-header h3 {
            color: #2c3e50;
            font-size: 1.3rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feedback-header h3 i {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .feedback-count {
            background: #e9ecef;
            color: #495057;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .feedback-container {
            min-height: 120px;
        }

        .feedback-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .feedback-card {
            background: white;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .feedback-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .feedback-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
        }

        .feedback-info {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .feedback-date,
        .feedback-teacher {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .feedback-date i,
        .feedback-teacher i {
            color: #adb5bd;
            font-size: 0.8rem;
        }

        .feedback-toggle {
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .feedback-toggle:hover {
            background: #e9ecef;
            color: #495057;
        }

        .feedback-toggle i {
            transition: transform 0.3s ease;
        }

        .feedback-toggle.active i {
            transform: rotate(180deg);
        }

        .feedback-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .feedback-content.active {
            padding: 20px;
            max-height: 500px;
        }

        .feedback-section-item {
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #dee2e6;
        }

        .feedback-section-item.strengths {
            background: #f8f9fa;
            border-left-color: #28a745;
        }

        .feedback-section-item.improvements {
            background: #fff3cd;
            border-left-color: #ffc107;
        }

        .feedback-section-item.recommendations {
            background: #d1ecf1;
            border-left-color: #17a2b8;
        }

        .feedback-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #495057;
        }

        .feedback-label i {
            font-size: 0.9rem;
        }

        .feedback-section-item.strengths .feedback-label i {
            color: #28a745;
        }

        .feedback-section-item.improvements .feedback-label i {
            color: #ffc107;
        }

        .feedback-section-item.recommendations .feedback-label i {
            color: #17a2b8;
        }

        .feedback-section-item p {
            margin: 0;
            color: #495057;
            line-height: 1.5;
        }

        .no-feedback {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .no-feedback-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .no-feedback p {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #495057;
        }

        .no-feedback small {
            color: #6c757d;
            font-size: 0.9rem;
        }





        .results-table {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
        }

        .status.completed {
            background: #e8f5e9;
            color: #27ae60;
        }

        .btn-view {
            background: #3498db;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-view:hover {
            background: #2980b9;
        }

        @media (max-width: 768px) {

            .overview-header,
            .results-header {
                flex-direction: column;
                gap: 15px;
            }

            .filter-options {
                width: 100%;
                flex-direction: column;
            }

            .form-select {
                width: 100%;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .charts-container {
                flex-direction: column;
            }

            .reading-passage {
                flex: 0 0 100%;
            }
        }
    </style>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    font: {
                        size: 14
                    },
                    padding: {
                        bottom: 10
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 11
                        },
                        maxRotation: 45,
                        minRotation: 45,
                        padding: 5
                    }
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            }
        };

        // English Reading Speed Chart
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Reading Time', 'Total Words'],
                datasets: [{
                    data: [{{ session('english_reading_time', 0) }}, {{ session('english_reading_speed', 0) }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    title: {
                        display: true,
                        text: 'Reading Speed',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });

        // English Comprehension Chart
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Correct Answers', 'Total Questions'],
                datasets: [{
                    data: [{{ session('english_score', 0) }}, {{ session('english_total_questions', 0) }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    title: {
                        display: true,
                        text: 'Reading Comprehension',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });

        // English Independent Level Chart
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    title: {
                        display: true,
                        text: 'Word Reading',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });

        // Filipino Reading Speed Chart
        const ctx3 = document.getElementById('myChart3').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Reading Time', 'Total Words'],
                datasets: [{
                    data: [{{ session('filipino_reading_time', 0) }}, {{ session('filipino_reading_speed', 0) }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    title: {
                        display: true,
                        text: 'Reading Speed',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });

        // Filipino Comprehension Chart
        const ctx4 = document.getElementById('myChart4').getContext('2d');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Correct Answers', 'Total Questions'],
                datasets: [{
                    data: [{{ session('filipino_score', 0) }}, {{ session('filipino_total_questions', 0) }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    title: {
                        display: true,
                        text: 'Reading Comprehension',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });

        // Filipino Independent Level Chart
        const ctx5 = document.getElementById('myChart5').getContext('2d');
        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    ...chartOptions.plugins,
                    title: {
                        display: true,
                        text: 'Word Reading',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        });

        // Feedback Toggle Functionality
        function toggleFeedback(feedbackId) {
            const content = document.getElementById('feedback-content-' + feedbackId);
            const toggle = document.querySelector(`[data-feedback-id="${feedbackId}"] .feedback-toggle`);

            if (content && toggle) {
                const isActive = content.classList.contains('active');

                if (isActive) {
                    content.classList.remove('active');
                    toggle.classList.remove('active');
                } else {
                    content.classList.add('active');
                    toggle.classList.add('active');
                }
            }
        }

        // Auto-expand first feedback item if available
        document.addEventListener('DOMContentLoaded', function() {
            const firstEnglishFeedback = document.querySelector('[data-feedback-id="0"]');
            const firstFilipinoFeedback = document.querySelector('[data-feedback-id="filipino-0"]');

            if (firstEnglishFeedback) {
                toggleFeedback('0');
            }

            if (firstFilipinoFeedback) {
                toggleFeedback('filipino-0');
            }
        });

        // English Feedback Form Functionality (Star rating removed)
        const englishFeedbackForm = document.getElementById('englishFeedbackForm');

        // Form Submission - English
        if (englishFeedbackForm) {
            englishFeedbackForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const feedback = {
                    strengths: document.getElementById('englishStrengths').value,
                    areasForImprovement: document.getElementById('englishAreasForImprovement').value,
                    recommendations: document.getElementById('englishRecommendations').value,
                    date: new Date().toLocaleDateString()
                };

                // Here you would typically send this to your backend
                console.log('English Feedback submitted:', feedback);

                // Add to feedback history (for demo purposes)
                addEnglishFeedbackToHistory(feedback);

                // Reset form
                resetEnglishFeedback();
            });
        }

        function resetEnglishFeedback() {
            if (englishFeedbackForm) {
                englishFeedbackForm.reset();
            }
        }

        function addEnglishFeedbackToHistory(feedback) {
            const feedbackHistory = document.querySelector('#englishFeedbackForm').nextElementSibling;
            const feedbackItem = document.createElement('div');
            feedbackItem.className = 'feedback-item';

            feedbackItem.innerHTML = `
                                                <div class="feedback-meta">
                                                    <span>Date: ${feedback.date}</span>
                                                    <span>Reading Level: Grade 7</span>
                                                </div>
                                                <div class="feedback-content">
                                                    <p><strong>Strengths:</strong> ${feedback.strengths}</p>
                                                    <p><strong>Areas for Improvement:</strong> ${feedback.areasForImprovement}</p>
                                                    <p><strong>Recommendations:</strong> ${feedback.recommendations}</p>
                                                </div>

                                            `;

            feedbackHistory.insertBefore(feedbackItem, feedbackHistory.querySelector('.feedback-item'));
        }

        // Filipino Feedback Form Functionality (Star rating removed)
        const filipinoFeedbackForm = document.getElementById('filipinoFeedbackForm');

        // Form Submission - Filipino
        if (filipinoFeedbackForm) {
            filipinoFeedbackForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const feedback = {
                    strengths: document.getElementById('filipinoStrengths').value,
                    areasForImprovement: document.getElementById('filipinoAreasForImprovement').value,
                    recommendations: document.getElementById('filipinoRecommendations').value,
                    date: new Date().toLocaleDateString()
                };

                // Here you would typically send this to your backend
                console.log('Filipino Feedback submitted:', feedback);

                // Add to feedback history (for demo purposes)
                addFilipinoFeedbackToHistory(feedback);

                // Reset form
                resetFilipinoFeedback();
            });
        }

        function resetFilipinoFeedback() {
            if (filipinoFeedbackForm) {
                filipinoFeedbackForm.reset();
            }
        }

        function addFilipinoFeedbackToHistory(feedback) {
            const feedbackHistory = document.querySelector('#filipinoFeedbackForm').nextElementSibling;
            const feedbackItem = document.createElement('div');
            feedbackItem.className = 'feedback-item';

            feedbackItem.innerHTML = `
                                                <div class="feedback-meta">
                                                    <span>Date: ${feedback.date}</span>
                                                    <span>Reading Level: Grade 7</span>
                                                </div>
                                                <div class="feedback-content">
                                                    <p><strong>Strengths:</strong> ${feedback.strengths}</p>
                                                    <p><strong>Areas for Improvement:</strong> ${feedback.areasForImprovement}</p>
                                                    <p><strong>Recommendations:</strong> ${feedback.recommendations}</p>
                                                </div>

                                            `;

            feedbackHistory.insertBefore(feedbackItem, feedbackHistory.querySelector('.feedback-item'));
        }
    </script>
@endsection