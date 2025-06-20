@extends('layouts.head-stud')

@section('title', 'Student Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <!-- Student Profile Section -->
            <div class="profile-section">
                <div class="profile-card">
                    <div class="profile-header">
                        <img src="{{ asset('pic/profile.png') }}" alt="Student Profile" class="profile-image" >
                        <div class="profile-info">
                            <h2>{{ $user->name }}</h2>
                            <p>Grade {{ $user->grade }}: Section {{ $user->section }}</p>
                        </div>
                        <div class="notification-indicator" id="feedbackNotification" style="display: none;">
                            <i class="fas fa-bell"></i>
                            <span class="notification-count" id="notificationCount">0</span>
                            <div class="notification-message">
                                You have new feedback from your teacher!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick Stats Overview -->
            <div class="stats-overview">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Test Progress</h3>
                        <p class="stat-number">{{ $completionPercentage }}%</p>
                        <p class="stat-label">Overall Completion</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Performance</h3>
                        <p class="stat-number">{{ $averageScore }}%</p>
                        <p class="stat-label">
                            Average Score
                            
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="results-section">
                <div class="results-header">
                    <h2>Recent Activities</h2>
                </div>
                <div class="activity-list">
                    <!-- English Answering -->
                    <div class="activity-item">
                        <div class="activity-icon {{ $latestEnglishActivity ? 'completed' : 'in-progress' }}">
                            <i class="fas {{ $latestEnglishActivity ? 'fa-check' : 'fa-spinner' }}"></i>
                        </div>
                        <div class="activity-details">
                            <h4>English Answering</h4>
                            @if($latestEnglishActivity)
                                @php
                                    $englishPercent = ($totalEnglishQuestions > 0) ? round(($latestEnglishScore / $totalEnglishQuestions) * 100) : 0;
                                @endphp
                                <p>Completed with {{ $englishPercent }}% score</p>
                                <span class="activity-time">{{ $latestEnglishActivity->created_at->diffForHumans() }}</span>
                            @else
                                <p>0% - Not yet completed</p>
                                <span class="activity-time">Pending</span>
                            @endif
                        </div>
                    </div>
                    <!-- English Reading Assessment -->
                    <div class="activity-item">
                        <div class="activity-icon {{ $latestEnglishReading ? 'completed' : 'in-progress' }}">
                            <i class="fas {{ $latestEnglishReading ? 'fa-check' : 'fa-spinner' }}"></i>
                        </div>
                        <div class="activity-details">
                            <h4>English Reading</h4>
                            @if($latestEnglishReading)
                                @php
                                    // Use teacher's submitted reading percentage for this student
                                    $englishReadingPercent = $latestEnglishReading->correct_reading ?? 0;
                                @endphp
                                <p>Completed with {{ $englishReadingPercent }}% reading accuracy</p>
                                
                                <span class="activity-time">{{ $latestEnglishReading->assessment_date->diffForHumans() }}</span>
                            @else
                                <p>0% - Not yet completed</p>
                                <span class="activity-time">Pending</span>
                            @endif
                        </div>
                    </div>
                    <!-- Filipino Answering -->
                    <div class="activity-item">
                        <div class="activity-icon {{ $latestFilipinoActivity ? 'completed' : 'in-progress' }}">
                            <i class="fas {{ $latestFilipinoActivity ? 'fa-check' : 'fa-spinner' }}"></i>
                        </div>
                        <div class="activity-details">
                            <h4>Filipino Answering</h4>
                            @if($latestFilipinoActivity)
                                @php
                                    $filipinoPercent = ($totalFilipinoQuestions > 0) ? round(($latestFilipinoScore / $totalFilipinoQuestions) * 100) : 0;
                                @endphp
                                <p>Completed with {{ $filipinoPercent }}% score</p>
                                <span class="activity-time">{{ $latestFilipinoActivity->created_at->diffForHumans() }}</span>
                            @else
                                <p>0% - Not yet completed</p>
                                <span class="activity-time">Pending</span>
                            @endif
                        </div>
                    </div>
                    <!-- Filipino Reading Assessment -->
                    <div class="activity-item">
                        <div class="activity-icon {{ $latestFilipinoReading ? 'completed' : 'in-progress' }}">
                            <i class="fas {{ $latestFilipinoReading ? 'fa-check' : 'fa-spinner' }}"></i>
                        </div>
                        <div class="activity-details">
                            <h4>Filipino Reading</h4>
                            @if($latestFilipinoReading)
                                @php
                                    // Use teacher's submitted reading percentage for this student
                                    $filipinoReadingPercent = $latestFilipinoReading->correct_reading ?? 0;
                                @endphp
                                <p>Completed with {{ $filipinoReadingPercent }}% reading accuracy</p>
                                <span class="activity-time">{{ $latestFilipinoReading->assessment_date->diffForHumans() }}</span>
                            @else
                                <p>0% - Not yet completed</p>
                                <span class="activity-time">Pending</span>
                            @endif
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-section {
            margin-bottom: 40px;
        }

        .profile-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-bottom: 30px;
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
            width: 90px;
            height: 90px;
            padding: 10px;

        }

        .profile-info h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.8em;
            font-weight: 700;
        }

        .profile-info p {
            margin: 5px 0 0;
            color: #7f8c8d;
        }

        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.2s ease;
            border: 1px solid #e9ecef;
            border-left: 4px solid #3498db;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            border-left-color: #2980b9;
        }

        .stat-card:nth-child(1) {
            border-left-color: #3498db;
        }

        .stat-card:nth-child(2) {
            border-left-color: #27ae60;
        }

        .stat-card:nth-child(3) {
            border-left-color: #e67e22;
        }

        .stat-card:nth-child(4) {
            border-left-color: #9b59b6;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #3498db;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            color: white;
        }

        .stat-card:nth-child(1) .stat-icon {
            background: #3498db;
        }

        .stat-card:nth-child(2) .stat-icon {
            background: #27ae60;
        }

        .stat-card:nth-child(3) .stat-icon {
            background: #e67e22;
        }

        .stat-card:nth-child(4) .stat-icon {
            background: #9b59b6;
        }

        .stat-info h3 {
            margin: 0;
            font-size: 0.9em;
            color: #7f8c8d;
            font-weight: 600;
        }

        .stat-number {
            margin: 5px 0;
            font-size: 1.5em;
            font-weight: bold;
            color: #2c3e50;
        }

        .stat-label {
            font-size: 0.8em;
            color: #7f8c8d;
        }

        .results-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .results-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .results-header h2 {
            color: #2c3e50;
            font-size: 1.8em;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #3498db;
            font-weight: 700;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.2s ease;
            border-left: 4px solid #3498db;
        }

        .activity-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .activity-icon.completed {
            background: #2ecc71;
            animation: completedPulse 2s ease-in-out infinite;
        }

        .activity-icon.in-progress {
            background: #f1c40f;
            animation: inProgressSpin 2s linear infinite;
        }

        .activity-icon.pending {
            background: #95a5a6;
        }

        @keyframes completedPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes inProgressSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Reading accuracy styling */
        .activity-details {
            flex: 1;
        }

        .activity-details h4 {
            margin: 0 0 8px 0;
            color: #2c3e50;
            font-size: 1.2em;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .activity-details p {
            margin: 4px 0;
            color: #5a6c7d;
            font-weight: 500;
            font-size: 0.95em;
        }

        .activity-time {
            font-size: 0.85em;
            color: #95a5a6;
            font-weight: 400;
            margin-top: 8px;
        }

        /* Notification Indicator Styles */
        .notification-indicator {
            position: relative;
            background: #e74c3c;
            color: white;
            padding: 10px 15px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9em;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(231, 76, 60, 0.3);
            animation: pulse 2s infinite;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-indicator:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        .notification-count {
            background: white;
            color: #e74c3c;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            font-weight: bold;
        }

        .notification-message {
            font-size: 0.85em;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 2px 10px rgba(231, 76, 60, 0.3);
            }
            50% {
                box-shadow: 0 2px 20px rgba(231, 76, 60, 0.6);
            }
            100% {
                box-shadow: 0 2px 10px rgba(231, 76, 60, 0.3);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-card {
                padding: 20px;
            }

            .stats-overview {
                grid-template-columns: 1fr;
            }

            .results-section {
                padding: 20px;
            }

            .notification-indicator {
                margin-top: 15px;
                align-self: center;
            }
        }
    </style>

    <script>
        // Check for unread feedback notifications
        function checkUnreadFeedback() {
            fetch('/student/unread-feedback-count')
                .then(response => response.json())
                .then(data => {
                    const notificationIndicator = document.getElementById('feedbackNotification');
                    const notificationCount = document.getElementById('notificationCount');

                    if (data.count > 0) {
                        notificationIndicator.style.display = 'flex';
                        notificationCount.textContent = data.count;
                    } else {
                        notificationIndicator.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error checking feedback notifications:', error);
                });
        }

        // Add click handler to notification
        document.addEventListener('DOMContentLoaded', function() {
            const notificationIndicator = document.getElementById('feedbackNotification');

            if (notificationIndicator) {
                notificationIndicator.addEventListener('click', function() {
                    // Redirect to reports page where feedback is displayed
                    window.location.href = '/stud-reports';
                });
            }

            // Check for unread feedback on page load
            checkUnreadFeedback();

            // Check for unread feedback every 30 seconds
            setInterval(checkUnreadFeedback, 30000);

            // Auto-refresh dashboard when reading assessments are completed
            checkForReadingAssessmentUpdates();
            setInterval(checkForReadingAssessmentUpdates, 30000);
        });

        // Function to check for reading assessment updates
        function checkForReadingAssessmentUpdates() {
            const studentId = '{{ $user->userId }}';

            fetch(`/student/check-reading-updates/${studentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.hasUpdates) {
                        console.log('📚 New reading assessment detected, refreshing dashboard...');
                        // Refresh the page to show updated data
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error checking for reading updates:', error);
                });
        }
    </script>
@endsection