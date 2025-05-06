<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container { 
            display: flex; 
            min-height: 100vh;
        }

        /* Sidebar Styles */
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

        .content {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: #2196F3;
            color: white;
            padding: 10px;
        }

        .header h1 {
            margin: 0;
        }

        .header .user-profile {
            display: flex;
            align-items: center;
        }

        .header .user-profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .dashboard-metrics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .metric-card {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .metric-card h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .metric-card p {
            margin: 10px 0 0;
            font-size: 1.2em;
        }

        .charts {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chart-card h2 {
            margin-top: 0;
        }

        .recent-tests {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }


    </style>
</head>

<body>

    <div class="container">
    <div class="sidebar">
        <div class="sidebar-logo">
        <img src="{{ asset('pic/logo .png') }}" alt="Logo" class="logo">
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.test-management') }}">Test Management</a></li>
            <li><a href="{{ route('admin.student-records') }}">Student Record</a></li>
            <li><a href="{{ route('admin.reports') }}">Reports</a></li>
            <li><a href="{{ route('admin.settings') }}">Settings</a></li>
        </ul>
    </div>
        <div class="content">
            <div class="header">
                <h1>DASHBOARD</h1>
                <div class="user-profile">
                    <span>User Name</span>
                    <img src="user-profile.jpg" alt="Lotchene Balcorza">
                </div>
            </div>

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
                <h2>RECENT TESTS</h2>
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
        </div>
    </div>

    <?php
$data = [
    "grade7" => [30, 40, 30],
    "grade8" => [20, 50, 30],
    "grade9" => [40, 30, 30],
    "grade10" => [30, 40, 30],
    "comparison" => [
        "august" => [80, 70, 90],
        "september" => [90, 80, 70],
        "october" => [70, 90, 80],
        "november" => [80, 70, 90]
    ]
];
    ?>

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
                data: [30, 20, 40, 30], // Example data, adjust according to your needs
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
    </script>
</body>

</html>