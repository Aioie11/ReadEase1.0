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
                        <p class="stat-label">Average Score</p>
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
                    <!-- English Reading (not yet connected, always show 0%) -->
                    <div class="activity-item">
                        <div class="activity-icon in-progress">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="activity-details">
                            <h4>English Reading</h4>
                            <p>0% - Not yet completed</p>
                            <span class="activity-time">Pending</span>
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
                    <!-- Filipino Reading (not yet connected, always show 0%) -->
                    <div class="activity-item">
                        <div class="activity-icon in-progress">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="activity-details">
                            <h4>Filipino Reading</h4>
                            <p>0% - Not yet completed</p>
                            <span class="activity-time">Pending</span>
                        </div>
                    </div>
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
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .results-header h2 {
            color: #2c3e50;
            font-size: 1.8em;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #95a5a6;
            font-weight: 700;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .activity-item:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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
        }

        .activity-icon.in-progress {
            background: #f1c40f;
        }

        .activity-details h4 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.1em;
            font-weight: 600;
        }

        .activity-details p {
            margin: 5px 0;
            color: #7f8c8d;
        }

        .activity-time {
            font-size: 0.8em;
            color: #7f8c8d;
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
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .stats-overview {
                grid-template-columns: 1fr;
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
        });
    </script>
@endsection