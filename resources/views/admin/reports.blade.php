<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #e0f2f7 0%, #b2ebf2 100%);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar li {
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar li:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: block;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            display: block;
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            background-color: #f5f5f5;
            padding: 20px;
        }

        /* Header styles */
        .header {
            background-color: #003399;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-controls {
            display: flex;
            gap: 15px;
        }

        .user-controls span {
            cursor: pointer;
            font-size: 20px;
        }

        /* Report sections */
        .report-section {
            background-color: #E3F2FD;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        /* Chart containers */
        .pie-charts-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-wrapper {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 300px;
        }

        .chart-title {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .comparison-charts-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .month-title {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        /* Responsive design */
        @media (max-width: 1200px) {

            .pie-charts-container,
            .comparison-charts-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }

            .pie-charts-container,
            .comparison-charts-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('pic/logo .png') }}" alt="Logo" class="logo">
        </div>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.test-management') }}">Test Management</a></li>
            <li><a href="{{ route('admin.student-records') }}">Student Record</a></li>
            <li><a href="{{ route('admin.reports') }}">Reports</a></li>
            <li><a href="{{ route('admin.settings') }}">Settings</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <main class="main-content">
        <header class="header">
            <h1>REPORTS</h1>
            <div class="user-controls">
                <span>♪</span>
                <span>○</span>
            </div>
        </header>

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
    </main>

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
    </script>
</body>

</html>