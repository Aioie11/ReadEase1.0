@extends('student.head')

@section('title', 'Student Results')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">

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
                            <p><strong>125 (WPM) Words Per Minute</strong></p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart1"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Instructional Level</strong></p>
                            <p>7 out of 10 correct answers</p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart2"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Independent Level</strong></p>
                            <p>235 out of 250 words read correctly</p>
                        </div>
                    </div>
                </div>
                <div class="feedback-section">
                    <div class="feedback-history">
                            <h4>Teacher's Feedbacks</h4>
                        <div class="feedback-item">
                            <div class="feedback-meta">
                                <span>Date: December 15, 2025</span>
                                <span>Reading Level: Grade 7</span>
                            </div>
                            <div class="feedback-content">
                                <p><strong>Strengths:</strong> Good comprehension of main ideas and vocabulary usage.</p>
                                <p><strong>Areas for Improvement:</strong> Needs to work on reading pace and pronunciation.</p>
                                <p><strong>Recommendations:</strong> Practice reading aloud daily and use phonics exercises.</p>
                            </div>
                            <div class="feedback-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>4/5</span>
                            </div>
                        </div>
                    </div>

                    <div class="feedback-history">
                        <div class="feedback-item">
                            <div class="feedback-meta">
                                <span>Date: March 30, 2024</span>
                                <span>Reading Level: Grade 7</span>
                            </div>
                            <div class="feedback-content">
                                <p><strong>Strengths:</strong> Good comprehension of main ideas and vocabulary usage.</p>
                                <p><strong>Areas for Improvement:</strong> Needs to work on reading pace and pronunciation.</p>
                                <p><strong>Recommendations:</strong> Practice reading aloud daily and use phonics exercises.</p>
                            </div>
                            <div class="feedback-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>4/5</span>
                            </div>
                        </div>
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
                            <p><strong>130 (WPM) Words Per Minute</strong></p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart4"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Independent Level</strong></p>
                            <p>8 out of 10 correct answers</p>
                        </div>
                    </div>

                    <div class="reading-passage">
                        <div class="chart-card">
                            <canvas id="myChart5"></canvas>
                        </div>
                        <div class="reading-metrics">
                            <p><strong>Independent Level</strong></p>
                            <p>238 out of 250 words read correctly</p>
                        </div>
                    </div>
                </div>
                <div class="feedback-section">
                    <div class="feedback-history">
                            <h4>Teacher's Feedbacks</h4>
                        <div class="feedback-item">
                            <div class="feedback-meta">
                                <span>Date: December 15, 2025</span>
                                <span>Reading Level: Grade 7</span>
                            </div>

                            <div class="feedback-content">
                                <p><strong>Strengths:</strong> Good comprehension of main ideas and vocabulary usage.</p>
                                <p><strong>Areas for Improvement:</strong> Needs to work on reading pace and pronunciation.</p>
                                <p><strong>Recommendations:</strong> Practice reading aloud daily and use phonics exercises.</p>
                            </div>

                            <div class="feedback-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>4/5</span>
                            </div>
                        </div>

                        <div class="feedback-item">
                            <div class="feedback-meta">
                                <span>Date: December 15, 2025</span>
                                <span>Reading Level: Grade 7</span>
                            </div>

                            <div class="feedback-content">
                                <p><strong>Strengths:</strong> Good comprehension of main ideas and vocabulary usage.</p>
                                <p><strong>Areas for Improvement:</strong> Needs to work on reading pace and pronunciation.</p>
                                <p><strong>Recommendations:</strong> Practice reading aloud daily and use phonics exercises.</p>
                            </div>

                            <div class="feedback-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>4/5</span>
                            </div>
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
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
            margin-top: 20px;
        }

        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #0E61BA;
        }

        .feedback-header h3 {
            color: #0E61BA;
            font-size: 1.2rem;
            margin: 0;
        }

        .feedback-form {
            display: grid;
            gap: 1.5rem;
        }

        .feedback-group {
            display: grid;
            gap: 0.5rem;
        }

        .feedback-group label {
            color: #2c3e50;
            font-weight: 500;
        }

        .feedback-input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            resize: vertical;
            min-height: 100px;
        }

        .feedback-input:focus {
            outline: none;
            border-color: #0E61BA;
            box-shadow: 0 0 0 2px rgba(14, 97, 186, 0.1);
        }

        .rating-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .rating-stars {
            display: flex;
            gap: 0.5rem;
        }

        .rating-stars i {
            color: #ddd;
            cursor: pointer;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .rating-stars i.active {
            color: #F9A602;
        }

        .rating-stars i:hover {
            transform: scale(1.1);
        }

        .feedback-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .btn-save {
            background: #0E61BA;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #3b82f6;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #f5f6fa;
            color: #2c3e50;
            border: 1px solid #ddd;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #ddd;
        }

        .feedback-history {
            margin-top: 2rem;
        }

        .feedback-history h4 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .feedback-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .feedback-meta {
            display: flex;
            justify-content: space-between;
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .feedback-content {
            color: #2c3e50;
            line-height: 1.5;
        }

        .feedback-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .feedback-rating i {
            color: #F9A602;
        }

        .results-table {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
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
            .overview-header, .results-header {
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

        // Reading Speed Chart
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Reading Time', 'Total Words'],
                datasets: [{
                    data: [120, 250],
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

        // Comprehension Chart
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Correct Answers', 'Total Questions'],
                datasets: [{
                    data: [7, 10],
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

        // Word Reading Chart
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                datasets: [{
                    data: [15, 235, 250],
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
                    data: [115, 250],
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
                    data: [8, 10],
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

        // Filipino Word Reading Chart
        const ctx5 = document.getElementById('myChart5').getContext('2d');
        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                datasets: [{
                    data: [12, 238, 250],
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

        // English Feedback Form Functionality
        const englishFeedbackForm = document.getElementById('englishFeedbackForm');
        const englishReadingRating = document.getElementById('englishReadingRating');
        const englishRatingValue = document.getElementById('englishRatingValue');
        let englishCurrentRating = 0;

        // Star Rating Functionality - English
        englishReadingRating.addEventListener('click', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const rating = parseInt(e.target.dataset.rating);
                englishCurrentRating = rating;
                updateEnglishStars(rating);
                englishRatingValue.textContent = `${rating}/5`;
            }
        });

        englishReadingRating.addEventListener('mouseover', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const rating = parseInt(e.target.dataset.rating);
                updateEnglishStars(rating);
            }
        });

        englishReadingRating.addEventListener('mouseout', () => {
            updateEnglishStars(englishCurrentRating);
        });

        function updateEnglishStars(rating) {
            const stars = englishReadingRating.querySelectorAll('i');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // Form Submission - English
        englishFeedbackForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const feedback = {
                rating: englishCurrentRating,
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

        function resetEnglishFeedback() {
            englishFeedbackForm.reset();
            englishCurrentRating = 0;
            updateEnglishStars(0);
            englishRatingValue.textContent = '0/5';
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
                <div class="feedback-rating">
                    ${Array(5).fill().map((_, i) => 
                        `<i class="${i < feedback.rating ? 'fas' : 'far'} fa-star"></i>`
                    ).join('')}
                    <span>${feedback.rating}/5</span>
                </div>
            `;
            
            feedbackHistory.insertBefore(feedbackItem, feedbackHistory.querySelector('.feedback-item'));
        }

        // Filipino Feedback Form Functionality
        const filipinoFeedbackForm = document.getElementById('filipinoFeedbackForm');
        const filipinoReadingRating = document.getElementById('filipinoReadingRating');
        const filipinoRatingValue = document.getElementById('filipinoRatingValue');
        let filipinoCurrentRating = 0;

        // Star Rating Functionality - Filipino
        filipinoReadingRating.addEventListener('click', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const rating = parseInt(e.target.dataset.rating);
                filipinoCurrentRating = rating;
                updateFilipinoStars(rating);
                filipinoRatingValue.textContent = `${rating}/5`;
            }
        });

        filipinoReadingRating.addEventListener('mouseover', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const rating = parseInt(e.target.dataset.rating);
                updateFilipinoStars(rating);
            }
        });

        filipinoReadingRating.addEventListener('mouseout', () => {
            updateFilipinoStars(filipinoCurrentRating);
        });

        function updateFilipinoStars(rating) {
            const stars = filipinoReadingRating.querySelectorAll('i');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // Form Submission - Filipino
        filipinoFeedbackForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const feedback = {
                rating: filipinoCurrentRating,
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

        function resetFilipinoFeedback() {
            filipinoFeedbackForm.reset();
            filipinoCurrentRating = 0;
            updateFilipinoStars(0);
            filipinoRatingValue.textContent = '0/5';
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
                <div class="feedback-rating">
                    ${Array(5).fill().map((_, i) => 
                        `<i class="${i < feedback.rating ? 'fas' : 'far'} fa-star"></i>`
                    ).join('')}
                    <span>${feedback.rating}/5</span>
                </div>
            `;
            
            feedbackHistory.insertBefore(feedbackItem, feedbackHistory.querySelector('.feedback-item'));
        }
    </script>
@endsection