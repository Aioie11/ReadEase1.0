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
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            padding: 10px;
        }

        .profile-info h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.8em;
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
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            color: #3498db;
        }

        .stat-info h3 {
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

        .stat-label {
            font-size: 0.8em;
            color: #95a5a6;
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
            border-radius: 8px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
        }

        .activity-icon.completed {
            background: #2ecc71;
            color: white;
        }

        .activity-icon.in-progress {
            background: #f1c40f;
            color: white;
        }

        .activity-details {
            flex: 1;
        }

        .activity-details h4 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.1em;
        }

        .activity-details p {
            margin: 5px 0;
            color: #7f8c8d;
        }

        .activity-time {
            font-size: 0.8em;
            color: #95a5a6;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .stats-overview {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
