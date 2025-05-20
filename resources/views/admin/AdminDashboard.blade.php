@extends('layouts.head-ad')

@section('title', 'Admin Dashboard')

@section('content')
<style>

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 6rem 5% 2rem;
            transition: var(--transition);
        }

        /* Dashboard Metrics */
        .dashboard-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .metric-card h2 {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .metric-card p {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 600;
        }

        /* Charts Section */
        .charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .chart-card h2 {
            color: var(--text);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        /* Recent Tests Table */
        .recent-tests {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .recent-tests h2 {
            color: var(--text);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--neutral-dark);
        }

        th {
            color: var(--text-light);
            font-weight: 500;
        }

        tr:hover {
            background: var(--neutral);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            header {
                margin-left: 0;
                width: 100%;
            }

            .menu-toggle {
                display: block;
            }

            .charts {
                grid-template-columns: 1fr;
            }
        }

        /* Menu Toggle Button */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--neutral-light);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-metrics">
            <div class="metric-card">
                <h2>Total Tests</h2>
                <p>491</p>
            </div>
            <div class="metric-card">
                <h2>Number of Students</h2>
                <p>500</p>
            </div>
            <div class="metric-card">
                <h2>Top Listeners</h2>
                <p>100</p>
            </div>
        </div>

        <div class="charts">
            <div class="chart-card">
                <h2>Performance Trends</h2>
                <canvas id="performanceChart"></canvas>
            </div>
            <div class="chart-card">
                <h2>Reading Level Distribution</h2>
                <canvas id="readingLevelChart"></canvas>
            </div>
        </div>

        <div class="recent-tests">
            <h2>Recent Tests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Test Type</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Aliah Lyca Condino</td>
                        <td>Reading Test</td>
                        <td>87%</td>
                        <td>October 05, 2025</td>
                        <td>Complete</td>
                    </tr>
                    <tr>
                        <td>Aliah Lyca Condino</td>
                        <td>Comprehension Test</td>
                        <td>95%</td>
                        <td>September 04, 2025</td>
                        <td>Complete</td>
                    </tr>
                    <tr>
                        <td>Aliah Lyca Condino</td>
                        <td>Comprehension Test</td>
                        <td>92%</td>
                        <td>February 14, 2025</td>
                        <td>Complete</td>
                    </tr>
                    <tr>
                        <td>Aliah Lyca Condino</td>
                        <td>Comprehension Test</td>
                        <td>92%</td>
                        <td>February 14, 2025</td>
                        <td>Complete</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JavaScript for Charts -->
    <script>
        // Data for Performance Trends
        const performanceData = {
            labels: ['August', 'September', 'October', 'November'],
            datasets: [{
                label: 'Performance',
                data: [80, 90, 70, 80],
                backgroundColor: 'rgba(54,162,235,0.5)',
                borderColor: 'rgba(54,162,235,1)',
                borderWidth: 1
            }]
        };

        // Config for Performance Trends
        const performanceConfig = {
            type: 'line',
            data: performanceData,
            options: {
                responsive: true
            }
        };

        // Render Performance Chart
        new Chart(document.getElementById('performanceChart'), performanceConfig);

        // Data for Reading Level Distribution
        const readingData = {
            labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
            datasets: [{
                label: 'Reading Level',
                data: [30, 20, 40, 30],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Config for Reading Level Distribution
        const readingConfig = {
            type: 'bar',
            data: readingData,
            options: {
                responsive: true
            }
        };

        // Render Reading Level Chart
        new Chart(document.getElementById('readingLevelChart'), readingConfig);

        // Add sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>

</html>