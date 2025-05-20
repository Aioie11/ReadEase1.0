<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Primary - Main UI and Brand Elements */
            --primary: #0E61BA;
            --primary-light: #3b82f6;
            --primary-dark: #0d4b94;
            
            /* Secondary - Navigation and Secondary UI */
            --secondary: #6CC24A;
            --secondary-light: #7ed56f;
            
            /* Accent - Buttons and Highlights */
            --accent: #F9A602;
            --accent-light: #fbbf24;
            
            /* Neutral - Backgrounds */
            --neutral: #F4F4F4;
            --neutral-light: #ffffff;
            --neutral-dark: #e5e5e5;
            
            /* Text - Main Text and Headings */
            --text: #232323;
            --text-light: #4b5563;
            
            /* Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            line-height: 1.6;
            color: var(--text);
            background-color: var(--neutral);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: var(--primary);
            padding: 1.5rem;
            transition: var(--transition);
            z-index: 1001;
            box-shadow: var(--shadow-lg);
        }

        .sidebar-header {
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo {
            color: var(--neutral-light);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-logo img {
            height: 45px;
            width: 45px;
            object-fit: contain;
        }

        .nav-menu {
            list-style: none;
            margin-bottom: 2rem;
        }

        .nav-item {
            margin-bottom: 0.3rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            color: var(--neutral-light);
            text-decoration: none;
            border-radius: 8px;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--secondary);
            color: var(--neutral-light);
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Header Styles */
        header {
            background: var(--primary);
            padding: 1rem 5%;
            position: fixed;
            width: calc(100% - 280px);
            margin-left: 280px;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

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
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="{{ url('/') }}" class="sidebar-logo">
                <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo">
                <span>ReadEase</span>
            </a>
        </div>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.test-management') }}" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        Test Management
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.student-records') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        Student Record
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reports') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Header -->
    <header>
        <div class="header-container">
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info">
                <span>Welcome, Admin</span>
            </div>
        </div>
    </header>

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