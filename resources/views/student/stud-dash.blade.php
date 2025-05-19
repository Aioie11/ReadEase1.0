@extends('student.head')

@section('title', 'Student Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <!-- Student Profile Section -->
            <div class="profile-section">
                <div class="profile-card">
                    <div class="profile-header">
                        <img src="{{ asset('pic/profile.png') }}" alt="Student Profile" class="profile-image">
                        <div class="profile-info">
                            <h2>Alibanga, Alexander Ven A.</h2>
                            <p>Grade 7: Section Narra</p>
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
                        <p class="stat-number">85%</p>
                        <p class="stat-label">Overall Completion</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Time Spent</h3>
                        <p class="stat-number">45 mins</p>
                        <p class="stat-label">Today's Activity</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Performance</h3>
                        <p class="stat-number">90%</p>
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
                    <div class="activity-item">
                        <div class="activity-icon completed">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="activity-details">
                            <h4>English Reading Exercise</h4>
                            <p>Completed with 85% score</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon in-progress">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="activity-details">
                            <h4>English Comprehension</h4>
                            <p>In progress - 60% complete</p>
                            <span class="activity-time">1 hour ago</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon completed">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="activity-details">
                            <h4>Filipino Reading Exercise</h4>
                            <p>Completed with 85% score</p>
                            <span class="activity-time">2 hours ago</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon in-progress">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="activity-details">
                            <h4>Filipino Comprehension</h4>
                            <p>In progress - 60% complete</p>
                            <span class="activity-time">1 hour ago</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Overview -->
            <div class="results-section">
                <div class="results-header">
                    <h2>Performance Overview</h2>
                </div>
                <div class="charts-container">
                    <div class="chart-card">
                        <canvas id="performanceChart"></canvas>
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            color: white;
        }

        .activity-icon.completed {
            background: #27ae60;
        }

        .activity-icon.in-progress {
            background: #f1c40f;
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

        .chart-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            height: 300px;
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

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Performance Overview Chart
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'English',
                    data: [75, 82, 78, 85],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Filipino',
                    data: [80, 85, 88, 90],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Weekly Performance',
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Score (%)'
                        }
                    }
                }
            }
        });
    </script>
@endsection