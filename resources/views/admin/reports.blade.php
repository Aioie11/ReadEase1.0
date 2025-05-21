@extends('layouts.head-ad')

@section('title', 'Admin Reports')

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

        /* Reports Content Styles */
        .reports-content {
            background: var(--neutral-light);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
        }

        .reports-header {
            margin-bottom: 2rem;
        }

        .reports-header h1 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .reports-header p {
            color: var(--text-light);
        }

        /* Reports Grid */
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .report-card {
            background: var(--neutral-light);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .report-card h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .report-card h3 i {
            color: var(--accent);
        }

        .report-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--neutral-dark);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .chart-container {
            background: var(--neutral-light);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-header h3 {
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Recent Reports Table */
        .recent-reports {
            background: var(--neutral-light);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .reports-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .reports-table th,
        .reports-table td {
            padding: 1rem;
            text-align: left;
        }

        .reports-table th {
            background: var(--neutral);
            color: var(--text);
            font-weight: 600;
        }

        .reports-table tr {
            transition: var(--transition);
        }

        .reports-table tr:hover {
            background: var(--neutral);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-pending {
            background: #fff3e0;
            color: #ef6c00;
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

            .charts-section {
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

        /* Chart containers */
        .pie-charts-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

        .chart-wrapper {
            background-color: var(--neutral-light);
            padding: 50px;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            height: 380px;
        }

        .chart-title {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .comparison-charts-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .month-title {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .pie-charts-container,
            .comparison-charts-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="reports-content">
            <div class="reports-header">
                <h1>Reports</h1>
                <p>View and analyze student performance data</p>
            </div>

            <!-- Recent Test Results Section -->
            <section class="report-section">
                <h2 class="section-title">RECENT TEST RESULTS</h2>
                <div class="month-title">FEBRUARY 2025</div>
                <div class="pie-charts-container">
                    <div class="chart-wrapper">
                        <div class="chart-title">GRADE 7</div>
                        <canvas id="grade7Chart"></canvas>
                    </div>
                    <div class="chart-wrapper">
                        <div class="chart-title">GRADE 8</div>
                        <canvas id="grade8Chart"></canvas>
                    </div>
                    <div class="chart-wrapper">
                        <div class="chart-title">GRADE 9</div>
                        <canvas id="grade9Chart"></canvas>
                    </div>
                    <div class="chart-wrapper">
                        <div class="chart-title">GRADE 10</div>
                        <canvas id="grade10Chart"></canvas>
                    </div>
                </div>
            </section>

            <!-- Comparison Chart Section -->
            <section class="report-section">
                <h2 class="section-title">COMPARISON CHART</h2>
                <div class="comparison-charts-container">
                    <div class="chart-wrapper">
                        <div class="month-title">AUGUST 2024</div>
                        <canvas id="augustChart"></canvas>
                    </div>
                    <div class="chart-wrapper">
                        <div class="month-title">SEPTEMBER 2024</div>
                        <canvas id="septemberChart"></canvas>
                    </div>
                    <div class="chart-wrapper">
                        <div class="month-title">OCTOBER 2024</div>
                        <canvas id="octoberChart"></canvas>
                    </div>
                    <div class="chart-wrapper">
                        <div class="month-title">NOVEMBER 2024</div>
                        <canvas id="novemberChart"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart Data
        const pieChartData = {
            labels: ['Beginner', 'Intermediate', 'Advance'],
            datasets: [{
                data: [30, 45, 25],
                backgroundColor: [
                    '#32CD32',
                    '#90EE90',
                    '#98FB98'
                ]
            }]
        };

        // Pie Chart Options
        const pieChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        };

        // Create Pie Charts
        const gradeIds = ['grade7', 'grade8', 'grade9', 'grade10'];
        gradeIds.forEach(id => {
            const ctx = document.getElementById(id + 'Chart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: pieChartData,
                options: pieChartOptions
            });
        });

        // Bar Chart Data
        const barChartData = {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                data: [35, 45, 55, 65, 80],
                backgroundColor: '#0066cc',
                barThickness: 30,
                borderRadius: 4
            }]
        };

        // Bar Chart Options
        const barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        display: true,
                        color: '#f0f0f0'
                    },
                    ticks: {
                        stepSize: 20
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        };

        // Create Bar Charts with different data for each month
        const months = ['august', 'september', 'october', 'november'];
        const monthlyData = {
            august: [10, 40, 30, 90, 70],
            september: [35, 45, 55, 65, 75],
            october: [40, 50, 60, 70, 80],
            november: [45, 55, 65, 75, 85]
        };

        months.forEach(month => {
            const ctx = document.getElementById(month + 'Chart').getContext('2d');
            const monthData = {
                ...barChartData,
                datasets: [{
                    ...barChartData.datasets[0],
                    data: monthlyData[month]
                }]
            };
            new Chart(ctx, {
                type: 'bar',
                data: monthData,
                options: barChartOptions
            });
        });

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
@endsection