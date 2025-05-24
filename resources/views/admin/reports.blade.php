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
                <div class="month-title">{{ now()->format('F Y') }}</div>
                <div class="pie-charts-container">
                    @foreach([7, 8, 9, 10] as $grade)
                    <div class="chart-wrapper">
                        <div class="chart-title">GRADE {{ $grade }}</div>
                        <canvas id="grade{{ $grade }}Chart"></canvas>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Comparison Chart Section -->
            <section class="report-section">
                <h2 class="section-title">COMPARISON CHART</h2>
                <div class="comparison-charts-container">
                    @foreach(['august', 'september', 'october', 'november'] as $month)
                    <div class="chart-wrapper">
                        <div class="month-title">{{ strtoupper($month) }} {{ now()->year }}</div>
                        <canvas id="{{ $month }}Chart"></canvas>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Function to fetch reading level data
        async function fetchReadingLevelData() {
            try {
                const response = await fetch('/api/reading-levels/stats');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching reading level data:', error);
                return null;
            }
        }

        // Function to create pie charts
        function createPieCharts(data) {
            const gradeIds = ['grade7', 'grade8', 'grade9', 'grade10'];
            const colors = {
                beginner: '#32CD32',
                intermediate: '#90EE90',
                advanced: '#98FB98'
            };

            gradeIds.forEach((id, index) => {
                const grade = index + 7;
                const ctx = document.getElementById(id + 'Chart').getContext('2d');
                
                // Get data for both English and Filipino subjects
                const englishData = data[grade]?.english || { beginner: 0, intermediate: 0, advanced: 0 };
                const filipinoData = data[grade]?.filipino || { beginner: 0, intermediate: 0, advanced: 0 };

                // Combine the data
                const combinedData = {
                    beginner: englishData.beginner + filipinoData.beginner,
                    intermediate: englishData.intermediate + filipinoData.intermediate,
                    advanced: englishData.advanced + filipinoData.advanced
                };

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Beginner', 'Intermediate', 'Advanced'],
                        datasets: [{
                            data: [
                                combinedData.beginner,
                                combinedData.intermediate,
                                combinedData.advanced
                            ],
                            backgroundColor: [
                                colors.beginner,
                                colors.intermediate,
                                colors.advanced
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        }

        // Initialize charts with real data
        async function initializeCharts() {
            const readingLevelData = await fetchReadingLevelData();
            if (readingLevelData) {
                createPieCharts(readingLevelData);
            }
        }

        // Call initialization function when page loads
        document.addEventListener('DOMContentLoaded', initializeCharts);
    </script>
</body>

</html>
@endsection