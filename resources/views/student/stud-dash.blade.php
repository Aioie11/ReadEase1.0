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
                        <img src="{{ asset('pic/profile.png') }}" alt="Student Profile" class="profile-image">
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

            <!-- Teacher Comments Section -->
            <div class="results-section">
                <div class="results-header">
                    <h2>Teacher Comments</h2>
                </div>
                <div class="comments-list" id="commentsList">
                    <div class="comment-item">
                        <div class="comment-header">
                            <div class="comment-type feedback">Reading Feedback</div>
                            <div class="comment-priority normal">Normal</div>
                            <div class="comment-time">2 hours ago</div>
                        </div>
                        <div class="comment-content">
                            <p>Great improvement in your reading comprehension! Keep practicing with the challenging
                                passages.</p>
                        </div>
                        <div class="comment-footer">
                            <span class="teacher-name">Ms. Johnson</span>
                        </div>
                    </div>

                    <div class="comment-item">
                        <div class="comment-header">
                            <div class="comment-type encouragement">Encouragement</div>
                            <div class="comment-priority important">Important</div>
                            <div class="comment-time">1 day ago</div>
                        </div>
                        <div class="comment-content">
                            <p>Excellent work on your recent English assessment! Your reading speed has improved
                                significantly.</p>
                        </div>
                        <div class="comment-footer">
                            <span class="teacher-name">Ms. Johnson</span>
                        </div>
                    </div>

                    <div class="comment-item">
                        <div class="comment-header">
                            <div class="comment-type improvement">Areas for Improvement</div>
                            <div class="comment-priority normal">Normal</div>
                            <div class="comment-time">3 days ago</div>
                        </div>
                        <div class="comment-content">
                            <p>Focus on understanding the main idea of each paragraph. Try to summarize what you read in
                                your own words.</p>
                        </div>
                        <div class="comment-footer">
                            <span class="teacher-name">Ms. Johnson</span>
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            height: 300px;
        }

        /* Comments Section Styles */
        .comments-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .comment-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid #3498db;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .comment-type {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .comment-type.feedback {
            background: #e3f2fd;
            color: #1976d2;
        }

        .comment-type.encouragement {
            background: #e8f5e8;
            color: #388e3c;
        }

        .comment-type.improvement {
            background: #fff3e0;
            color: #f57c00;
        }

        .comment-type.achievement {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .comment-type.general {
            background: #f5f5f5;
            color: #616161;
        }

        .comment-priority {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .comment-priority.normal {
            background: #e0e0e0;
            color: #757575;
        }

        .comment-priority.important {
            background: #fff3e0;
            color: #f57c00;
        }

        .comment-priority.urgent {
            background: #ffebee;
            color: #d32f2f;
        }

        .comment-time {
            font-size: 0.8em;
            color: #95a5a6;
        }

        .comment-content {
            margin: 15px 0;
        }

        .comment-content p {
            margin: 0;
            color: #2c3e50;
            line-height: 1.6;
        }

        .comment-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .teacher-name {
            font-size: 0.9em;
            color: #7f8c8d;
            font-style: italic;
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

        // Load teacher feedback from localStorage
        function loadTeacherFeedback() {
            const feedbackData = JSON.parse(localStorage.getItem('studentFeedback') || '[]');
            const commentsList = document.getElementById('commentsList');

            // Add new feedback to the existing comments
            feedbackData.forEach(feedback => {
                const commentItem = document.createElement('div');
                commentItem.className = 'comment-item';

                // Calculate time ago
                const sentDate = new Date(feedback.sentDate);
                const now = new Date();
                const diffTime = Math.abs(now - sentDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const timeAgo = diffDays === 1 ? '1 day ago' : `${diffDays} days ago`;

                commentItem.innerHTML = `
                        <div class="comment-header">
                            <div class="comment-type feedback">Reading Assessment</div>
                            <div class="comment-priority normal">Normal</div>
                            <div class="comment-time">${timeAgo}</div>
                        </div>
                        <div class="comment-content">
                            <div class="feedback-rating-display" style="margin-bottom: 10px;">
                                <strong>Rating: </strong>
                                ${Array(5).fill().map((_, i) =>
                    `<i class="fas fa-star${i < feedback.rating ? '' : ' far'}" style="color: #F9A602;"></i>`
                ).join('')}
                                <span>${feedback.rating}/5</span>
                            </div>
                            <p><strong>Strengths:</strong> ${feedback.strengths}</p>
                            <p><strong>Areas for Improvement:</strong> ${feedback.areasForImprovement}</p>
                            <p><strong>Recommendations:</strong> ${feedback.recommendations}</p>
                            <p><strong>Grade & Section:</strong> Grade ${feedback.grade} - Section ${feedback.section}</p>
                        </div>
                        <div class="comment-footer">
                            <span class="teacher-name">${feedback.teacherName}</span>
                        </div>
                    `;

                // Insert at the beginning of the comments list
                const firstComment = commentsList.querySelector('.comment-item');
                if (firstComment) {
                    commentsList.insertBefore(commentItem, firstComment);
                } else {
                    commentsList.appendChild(commentItem);
                }
            });

            // Show notification if there are new feedback items
            if (feedbackData.length > 0) {
                showFeedbackNotification(feedbackData.length);
            }
        }

        function showFeedbackNotification(count) {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: #6CC24A;
                    color: white;
                    padding: 15px 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 1000;
                    font-weight: 500;
                    animation: slideIn 0.3s ease-out;
                `;

            notification.innerHTML = `
                    <i class="fas fa-bell"></i>
                    You have ${count} new feedback message${count > 1 ? 's' : ''} from your teacher!
                `;

            // Add animation styles
            const style = document.createElement('style');
            style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                `;
            document.head.appendChild(style);

            document.body.appendChild(notification);

            // Remove notification after 5 seconds
            setTimeout(() => {
                notification.style.animation = 'slideIn 0.3s ease-out reverse';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 5000);
        }

        // Load feedback when page loads
        document.addEventListener('DOMContentLoaded', function () {
            loadTeacherFeedback();
        });
    </script>
@endsection