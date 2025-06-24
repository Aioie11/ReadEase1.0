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
                            @php
                                // Get only the most recent English and Filipino reading assessments
                                $latestEnglishAssessment = $allReadingAssessments->where('language', 'english')->first();
                                $latestFilipinoAssessment = $allReadingAssessments->where('language', 'filipino')->first();

                                $recentAssessments = collect();
                                if ($latestEnglishAssessment) {
                                    $recentAssessments->push($latestEnglishAssessment);
                                }
                                if ($latestFilipinoAssessment) {
                                    $recentAssessments->push($latestFilipinoAssessment);
                                }

                                // Sort by assessment date (most recent first)
                                $recentAssessments = $recentAssessments->sortByDesc('assessment_date');
                            @endphp

                            @if($recentAssessments->count() > 0)
                                @foreach($recentAssessments as $assessment)
                                    @php
                                        // Find matching reading material by grade and language
                                        $matchingMaterial = $readingMaterials->where('grade_level', $assessment->grade)
                                            ->where('subject', $assessment->language)
                                            ->first();

                                        $readingTitle = $matchingMaterial ? $matchingMaterial->title : 'Reading Assessment (' . ucfirst($assessment->language) . ')';

                                        // Calculate reading score using formula: (total words - miscues) / total words
                                        $totalWords = $assessment->total_words;
                                        $miscues = $assessment->miscues;
                                        $correctWords = $totalWords - $miscues;
                                        $readingScore = $correctWords . '/' . $totalWords;

                                        // Format time spent (no WPM info)
                                        $timeSpent = $assessment->reading_time;
                                        if ($timeSpent >= 60) {
                                            $minutes = floor($timeSpent / 60);
                                            $seconds = $timeSpent % 60;
                                            $timeFormatted = $minutes . ' min' . ($seconds > 0 ? ' ' . $seconds . ' sec' : '');
                                        } else {
                                            $timeFormatted = $timeSpent . ' sec';
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <strong>{{ $readingTitle }}</strong>
                                        </td>
                                        <td>{{ $assessment->assessment_date->format('M j, Y') }}</td>
                                        <td>
                                            {{ $readingScore }}
                                        </td>
                                        <td>
                                            {{ $timeFormatted }}
                                        </td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" style="text-align:center;">No reading assessments completed yet.</td>
                                </tr>
                            @endif
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $hasAnswers = ($englishAnswers->count() > 0) || ($filipinoAnswers->count() > 0);
                            @endphp
                            @if($hasAnswers)
                                @if($filipinoAnswers->count() > 0)
                                    @php
                                        $latestFilipino = $filipinoAnswers->first();
                                    @endphp
                                    <tr>
                                        <td><strong>Filipino Question</strong></td>
                                        <td>{{ $latestFilipino->created_at->format('Y-m-d') }}</td>
                                        <td>{{ session('filipino_score', 0) }}/{{ session('filipino_total_questions', 0) }}</td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
                                @endif
                                @if($englishAnswers->count() > 0)
                                    @php
                                        $latestEnglish = $englishAnswers->first();
                                    @endphp
                                    <tr>
                                        <td><strong>English Question</strong></td>
                                        <td>{{ $latestEnglish->created_at->format('Y-m-d') }}</td>
                                        <td>{{ session('english_score', 0) }}/{{ session('english_total_questions', 0) }}</td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td colspan="4" style="text-align:center;">No answers yet.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
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
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
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
            color: #00B8A9;
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

        /* Results Table Styling */
        .results-table {
            overflow-x: auto;
            margin-top: 20px;
        }

        .results-table table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .results-table th {
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .results-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            color: #495057;
        }

        .results-table tr:hover {
            background: #f8f9fa;
        }

        .status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 500;
        }

        .status.completed {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .feedback-section {
            margin-top: 25px;
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .feedback-header h3 {
            color: #2c3e50;
            font-size: 1.3rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
        }

        .feedback-header h3 i {
            color: #00B8A9;
            font-size: 1.1rem;
        }

        .feedback-count {
            background: #00B8A9;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 16px;
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
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .feedback-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .feedback-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.25rem;
            background: #f8f9fa;
            cursor: pointer;
        }

        .feedback-card-header:hover {
            background: #e9ecef;
        }

        .feedback-info {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .feedback-date,
        .feedback-teacher {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #495057;
            font-size: 0.9rem;
        }

        .feedback-date i,
        .feedback-teacher i {
            color: #00B8A9;
            font-size: 0.8rem;
        }

        .feedback-toggle {
            background: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .feedback-toggle:hover {
            background: #e9ecef;
            color: #495057;
        }

        .feedback-toggle i {
            transition: transform 0.3s ease;
            font-size: 0.9rem;
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
            margin-bottom: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .feedback-section-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .feedback-section-item.strengths {
            background: #E6FFFA;
        }

        .feedback-section-item.improvements {
            background: #FFFBEB;
        }

        .feedback-section-item.recommendations {
            background: #E6F3FF;
        }

        .feedback-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem 0.5rem;
            margin: 0;
            font-weight: 600;
            font-size: 1rem;
        }

        .feedback-label i {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }

        .feedback-section-item.strengths .feedback-label {
            color: #00695C;
        }

        .feedback-section-item.strengths .feedback-label i {
            background: #00B8A9;
        }

        .feedback-section-item.improvements .feedback-label {
            color: #C05621;
        }

        .feedback-section-item.improvements .feedback-label i {
            background: #F6AD55;
        }

        .feedback-section-item.recommendations .feedback-label {
            color: #0277BD;
        }

        .feedback-section-item.recommendations .feedback-label i {
            background: #4FC3F7;
        }

        .feedback-section-item p {
            margin: 0;
            padding: 0 1.25rem 1.25rem;
            color: #2c3e50;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .no-feedback {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .no-feedback-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #6c757d;
            opacity: 0.6;
        }

        .no-feedback p {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #495057;
            font-weight: 500;
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

        @media (max-width: 1200px) {
            .charts-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
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
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 15px 0;
            }

            .reading-passage {
                margin-bottom: 20px;
            }

            .chart-card {
                height: 320px;
                padding: 20px;
            }

            .reading-metrics {
                padding: 20px;
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

        // English Reading Speed Chart (Reading Time and Total Words)
        const ctx = document.getElementById('myChart').getContext('2d');
        const englishReadingTime = {{ session('english_reading_time', 0) }};
        const englishTotalWords = {{ session('english_total_words', 0) }};

        new Chart(ctx, {
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

        // English Comprehension Chart
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const englishCorrect = {{ session('english_score', 0) }};
        const englishTotal = {{ session('english_total_questions', 0) }};

        new Chart(ctx1, {
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

        // English Word Reading Chart (Teacher Assessment Data)
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const englishMiscues = {{ session('english_miscues', 0) }};
        const englishWords = {{ session('english_total_words', 0) }};

        new Chart(ctx2, {
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

        // Filipino Reading Speed Chart (Reading Time and Total Words)
        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const filipinoReadingTime = {{ session('filipino_reading_time', 0) }};
        const filipinoTotalWords = {{ session('filipino_total_words', 0) }};

        new Chart(ctx3, {
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

        // Filipino Comprehension Chart
        const ctx4 = document.getElementById('myChart4').getContext('2d');
        const filipinoCorrect = {{ session('filipino_score', 0) }};
        const filipinoTotal = {{ session('filipino_total_questions', 0) }};

        new Chart(ctx4, {
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

        // Filipino Word Reading Chart (Teacher Assessment Data)
        const ctx5 = document.getElementById('myChart5').getContext('2d');
        const filipinoMiscues = {{ session('filipino_miscues', 0) }};
        const filipinoWords = {{ session('filipino_total_words', 0) }};

        new Chart(ctx5, {
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