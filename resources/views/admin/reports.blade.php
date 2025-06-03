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
            margin-top: 100px;
            margin-left: 280px;
            padding: 2rem 5% 2rem;
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

        .chart-section {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2.5rem;
        }

        .chart-section h2 {
            color: var(--text);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="chart-section">
            <h2>Reading Level Distribution By Grade</h2>
            <canvas id="readingLevelChart"></canvas>
            <div style="margin-top:1rem; font-size:0.95rem;">
                <strong>Legend:</strong>
                <span style="color:#4caf50; font-weight:bold;">■</span> Independent (Word Reading: 97-100, Comprehension: 80-100)
                <span style="color:#ffb300; font-weight:bold; margin-left:1.5rem;">■</span> Instructional (Word Reading: 90-96, Comprehension: 59-79)
                <span style="color:#e53935; font-weight:bold; margin-left:1.5rem;">■</span> Frustration (Word Reading: 89 BELOW, Comprehension: 58 BELOW)
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const distribution = @json($readingLevelDistribution ?? []);
        const grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];
        const independent = grades.map(g => distribution[g]?.['Independent'] || 0);
        const instructional = grades.map(g => distribution[g]?.['Instructional'] || 0);
        const frustration = grades.map(g => distribution[g]?.['Frustration'] || 0);
        const readingData = {
            labels: grades,
            datasets: [
                {
                    label: 'Independent',
                    data: independent,
                    backgroundColor: '#4caf50',
                    stack: 'Stack 0',
                },
                {
                    label: 'Instructional',
                    data: instructional,
                    backgroundColor: '#ffb300',
                    stack: 'Stack 0',
                },
                {
                    label: 'Frustration',
                    data: frustration,
                    backgroundColor: '#e53935',
                    stack: 'Stack 0',
                }
            ]
        };
        const readingConfig = {
            type: 'bar',
            data: readingData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Grade Level'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Students'
                        }
                    }
                }
            }
        };
        new Chart(document.getElementById('readingLevelChart'), readingConfig);
    </script>
</body>

</html>
@endsection