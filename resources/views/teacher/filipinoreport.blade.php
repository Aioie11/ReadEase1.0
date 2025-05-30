@extends('layouts.head-tech')

@section('title', 'Filipino Reading Progress Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-wrapper">
            <div class="dashboard-header">
                <div class="header-content">
                    <h1>Filipino Reports</h1>
                    <p>Comprehensive insights into student Filipino reading performance and progress</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <!-- Left Column -->
                <div class="dashboard-column main-column">
                    <div class="filter-controls">
                        <div class="filter-group">
                            <div class="filter-label">Subject</div>
                            <div class="filter-options">
                                <button class="filter-btn"
                                    onclick="window.location.href='{{ route('teacher.viewreports') }}'">English</button>
                                <button class="filter-btn active">Filipino</button>
                            </div>
                        </div>
                        <div class="filter-group">
                            <div class="filter-label">View by</div>
                            <div class="filter-options">
                                <select class="custom-select">
                                    <option>All Sections</option>
                                    <option>Narra</option>
                                    <option>Lawaan</option>
                                    <option>Dao</option>
                                    <option>Mahugani</option>
                                </select>
                                <select class="custom-select">
                                    <option>All Grades</option>
                                    <option>Grade 7</option>
                                    <option>Grade 8</option>
                                    <option>Grade 9</option>
                                    <option>Grade 10</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Filipino Reading Sessions Progress -->
                    <div class="chart-panel">
                        <div class="chart-panel-header">
                            <h3>Filipino Reading Sessions Progress (By Grade Level)</h3>
                            <div class="time-selector">
                                <button class="time-btn active">6 Weeks</button>
                            </div>
                        </div>
                        <div class="chart-panel-body">
                            <canvas id="filipinoProgressChart"></canvas>
                        </div>
                    </div>

                    <!-- Filipino Language Test Results -->
                    <div class="chart-panel">
                        <div class="chart-panel-header">
                            <h3>Filipino Language Test Results</h3>
                        </div>
                        <div class="chart-panel-body">
                            <div class="charts-grid">
                                <div class="chart-container">
                                    <h4>Reading Speed</h4>
                                    <canvas id="filipinoChart1"></canvas>
                                    <div class="chart-summary">
                                        <div class="summary-item">
                                            <div class="summary-value">120 (WPM) Words Per Minute</div>
                                            <div class="summary-label">Bilis ng Pagbasa</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-container">
                                    <h4>Reading Comprehension</h4>
                                    <canvas id="filipinoChart2"></canvas>
                                    <div class="chart-summary">
                                        <div class="summary-item">
                                            <div class="summary-value">Instructional Level</div>
                                            <div class="summary-label">7 out of 10 correct answers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-container">
                                    <h4>Word Reading</h4>
                                    <canvas id="filipinoChart3"></canvas>
                                    <div class="chart-summary">
                                        <div class="summary-item">
                                            <div class="summary-value">Independent Level</div>
                                            <div class="summary-label">235 out of 250 words read correctly</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Filipino Reading Level Guide -->
                <div class="reading-level-guide">
                    <h3>Gabay sa Antas ng Pagbasa</h3>
                    <div class="level-item">
                        <span class="badge independent">Independiyente</span>
                        <div class="level-details">
                            <div class="level-range">Pagbasa ng Salita: 97-100% | Pag-unawa: 80-100%</div>
                            <div class="level-description">Ang mag-aaral ay makakabasa nang maayos nang walang tulong
                            </div>
                        </div>
                    </div>
                    <div class="level-item">
                        <span class="badge instructional">Pagtuturo</span>
                        <div class="level-details">
                            <div class="level-range">Pagbasa ng Salita: 90-96% | Pag-unawa: 59-79%</div>
                            <div class="level-description">Ang mag-aaral ay makakabasa sa tulong ng guro</div>
                        </div>
                    </div>
                    <div class="level-item">
                        <span class="badge frustration">Pagkabalisa</span>
                        <div class="level-details">
                            <div class="level-range">Pagbasa ng Salita: 89 Pababa | Pag-unawa: 58 Pababa</div>
                            <div class="level-description">Ang mag-aaral ay nahihirapan sa materyal na binabasa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        :root {
            --primary: #00B8A9;
            --primary-dark: #00B8A9;
            --primary-light: #00B8A9;
            --accent: #00B8A9;
            --neutral-dark: #2D3748;
            --neutral: #4A5568;
            --neutral-light: #E2E8F0;
            --background: #F7FAFC;
            --card-bg: #FFFFFF;
            --success: #00B8A9;
            --warning: #00B8A9;
            --danger: #00B8A9;
            --text-dark: #1A202C;
            --text: #4A5568;
            --text-light: #718096;
            --secondary-gradient: linear-gradient(135deg, #00B8A9 0%, #00B8A9 100%);
            --accent-gradient: linear-gradient(135deg, #00B8A9 0%, #00B8A9 100%);
            --danger-gradient: linear-gradient(135deg, #00B8A9 0%, #00B8A9 100%);
            --shadow-sm: 0 1px 3px rgba(0, 184, 169, 0.12), 0 1px 2px rgba(0, 184, 169, 0.08);
            --shadow-md: 0 4px 6px rgba(0, 184, 169, 0.1), 0 2px 4px rgba(0, 184, 169, 0.06);
            --transition: all 0.3s ease
        }

        .dashboard-wrapper {
            padding: 1.5rem;
            background-color: var(--background);
            min-height: calc(100vh - 60px)
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem
        }

        .header-content h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
            position: relative;
            display: inline-block
        }

        .header-content h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--accent);
            border-radius: 3px
        }

        .header-content p {
            color: var(--text-light);
            font-size: 0.95rem
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem
        }

        .dashboard-column {
            display: flex;
            flex-direction: column;
            gap: 1.5rem
        }

        .filter-controls {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            box-shadow: var(--shadow-sm)
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 1rem
        }

        .filter-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text)
        }

        .filter-options {
            display: flex;
            gap: 0.5rem
        }

        .filter-btn {
            background-color: var(--neutral-light);
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            color: var(--text);
            cursor: pointer;
            transition: var(--transition)
        }

        .filter-btn.active {
            background-color: var(--primary);
            color: white
        }

        .filter-btn:hover:not(.active) {
            background-color: #D1D9E6
        }

        .custom-select {
            background-color: var(--neutral-light);
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            color: var(--text);
            cursor: pointer;
            transition: var(--transition);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%234A5568' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2rem
        }

        .custom-select:focus {
            outline: none
        }

        .chart-panel {
            background-color: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm)
        }

        .chart-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid var(--neutral-light)
        }

        .chart-panel-header h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0
        }

        .time-selector {
            display: flex;
            gap: 0.5rem
        }

        .time-btn {
            background-color: var(--neutral-light);
            border: none;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            font-size: 0.8rem;
            color: var(--text);
            cursor: pointer;
            transition: var(--transition)
        }

        .time-btn.active {
            background-color: var(--primary);
            color: white
        }

        .chart-panel-body {
            padding: 1rem;
        }

        /* Progress Chart Specific Styling */
        #filipinoProgressChart {
            height: 300px !important;
        }

        /* Charts Grid Layout */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .chart-container {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .chart-container h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            text-align: center;
        }

        .chart-container canvas {
            height: 200px !important;
        }

        .chart-summary {
            margin-top: 1rem;
            text-align: center;
        }

        .summary-item {
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .summary-label {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        /* Student Table Panel */
        .student-table-panel {
            background-color: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid var(--neutral-light);
        }

        .panel-header h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }

        .search-wrapper {
            position: relative;
        }

        .search-wrapper i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-wrapper input {
            padding: 0.5rem 0.5rem 0.5rem 2rem;
            border: 1px solid var(--neutral-light);
            border-radius: 20px;
            font-size: 0.85rem;
            width: 200px;
            transition: var(--transition);
        }

        .search-wrapper input:focus {
            outline: none;
            border-color: var(--primary);
            width: 220px;
        }

        .table-wrapper {
            overflow-x: auto;
            padding: 0 1rem 1rem;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table th {
            text-align: left;
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-light);
            border-bottom: 1px solid var(--neutral-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .student-table td {
            padding: 0.75rem 0.5rem;
            border-bottom: 1px solid var(--neutral-light);
            font-size: 0.85rem;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .student-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.independent {
            background: #E8F5E8;
            color: #2E7D32;
        }

        .badge.instructional {
            background: #FFF3E0;
            color: #F57C00;
        }

        .badge.frustration {
            background: #FFEBEE;
            color: #D32F2F;
        }

        .progress-bar {
            width: 60px;
            height: 6px;
            background: var(--neutral-light);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .progress.green {
            background: var(--success);
        }

        .progress.yellow {
            background: var(--warning);
        }

        .progress.red {
            background: var(--danger);
        }

        /* Metric Cards */
        .metric-cards {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .metric-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .metric-content {
            flex: 1;
        }

        .metric-label {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .metric-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .metric-value span {
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--text-light);
        }

        .metric-trend {
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .metric-trend.positive {
            color: var(--success);
        }

        .metric-trend.negative {
            color: var(--danger);
        }

        /* Reading Level Guide */
        .reading-level-guide {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .reading-level-guide h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .level-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .level-item:last-child {
            margin-bottom: 0;
        }

        .level-details {
            flex: 1;
        }

        .level-range {
            font-size: 0.75rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .level-description {
            font-size: 0.8rem;
            color: var(--text);
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .filter-controls {
                flex-direction: column;
                gap: 1rem;
            }

            .search-wrapper input {
                width: 100%;
            }

            .search-wrapper input:focus {
                width: 100%;
            }
        }
    </style>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Filipino Reading Sessions Progress Chart (By Grade Level)
        const progressCtx = document.getElementById('filipinoProgressChart').getContext('2d');

        // Reading level data for Filipino
        const readingLevels = {
            1: { name: 'Pagkabalisa', wordReading: '89% pababa', comprehension: '58% pababa', description: 'Nahihirapan sa materyal na binabasa' },
            2: { name: 'Pagtuturo', wordReading: '90-96%', comprehension: '59-79%', description: 'Makakabasa sa tulong ng guro' },
            3: { name: 'Independiyente', wordReading: '97-100%', comprehension: '80-100%', description: 'Makakabasa nang maayos nang walang tulong' }
        };

        new Chart(progressCtx, {
            type: 'line',
            data: {
                labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [{
                    label: '🟢 Independiyente',
                    data: [2.8, 2.6, 2.9, 3.1],
                    borderColor: '#2E7D32',
                    backgroundColor: 'rgba(46, 125, 50, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2E7D32',
                    pointBorderWidth: 3,
                    pointRadius: 8,
                    pointHoverRadius: 12
                }, {
                    label: '🟡 Pagtuturo',
                    data: [2.2, 2.4, 2.3, 2.5],
                    borderColor: '#F57C00',
                    backgroundColor: 'rgba(245, 124, 0, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#F57C00',
                    pointBorderWidth: 3,
                    pointRadius: 8,
                    pointHoverRadius: 12
                }, {
                    label: '🔴 Pagkabigo',
                    data: [1.5, 1.3, 1.2, 1.1],
                    borderColor: '#D32F2F',
                    backgroundColor: 'rgba(211, 47, 47, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#D32F2F',
                    pointBorderWidth: 3,
                    pointRadius: 8,
                    pointHoverRadius: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: '📊 Pag-unlad sa Pagbasa ng Filipino (Ayon sa Baitang)',
                        font: { size: 16, weight: 'bold' },
                        color: '#00B8A9',
                        padding: 20
                    },
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20,
                            font: { size: 12, weight: '600' },
                            color: '#2D3748',
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#1A202C',
                        bodyColor: '#2D3748',
                        borderColor: '#00B8A9',
                        borderWidth: 2,
                        cornerRadius: 12,
                        padding: 20,
                        callbacks: {
                            title: function (context) {
                                const gradeData = {
                                    'Grade 7': { students: 28, avgAge: '12-13 taon' },
                                    'Grade 8': { students: 32, avgAge: '13-14 taon' },
                                    'Grade 9': { students: 30, avgAge: '14-15 taon' },
                                    'Grade 10': { students: 25, avgAge: '15-16 taon' }
                                };
                                const grade = context[0].label;
                                const data = gradeData[grade];
                                return `${grade} - ${data.students} Mag-aaral (${data.avgAge})`;
                            },
                            label: function (context) {
                                const value = context.parsed.y;
                                let level = readingLevels[Math.round(value)];
                                if (!level) {
                                    if (value < 1.5) level = readingLevels[1];
                                    else if (value < 2.5) level = readingLevels[2];
                                    else level = readingLevels[3];
                                }
                                return [
                                    `Antas ng Pagbasa: ${level.name}`,
                                    `Pagbasa ng Salita: ${level.wordReading}`,
                                    `Pag-unawa: ${level.comprehension}`,
                                    `${level.description}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        position: 'left',
                        beginAtZero: false,
                        min: 0.5,
                        max: 3.5,
                        grid: {
                            color: 'rgba(0, 184, 169, 0.1)',
                            drawBorder: false,
                            lineWidth: 2
                        },
                        ticks: {
                            stepSize: 1,
                            padding: 20,
                            font: { size: 12, weight: '600' },
                            color: '#2D3748',
                            callback: function (value) {
                                if (value === 1) return '🔴 Pagkabalisa';
                                if (value === 2) return '🟡 Pagtuturo';
                                if (value === 3) return '🟢 Independiyente';
                                return '';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Antas ng Pagganap sa Pagbasa',
                            font: { size: 14, weight: 'bold' },
                            color: '#00B8A9',
                            padding: 20
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            padding: 15,
                            font: { size: 12, weight: '500' },
                            color: '#4A5568'
                        },
                        title: {
                            display: true,
                            text: '🎓 Mga Baitang',
                            font: { size: 14, weight: 'bold' },
                            color: '#2D3748',
                            padding: 15
                        }
                    }
                }
            }
        });

        // Define clean chart options for Filipino charts
        const cleanChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        };

        // Filipino Reading Speed Chart
        const ctx1 = document.getElementById('filipinoChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Reading Time', 'Total Words'],
                datasets: [{
                    data: [120, 250],
                    backgroundColor: [
                        '#4fc3f7',
                        '#f56565'
                    ],
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: cleanChartOptions
        });

        // Filipino Reading Comprehension Chart
        const ctx2 = document.getElementById('filipinoChart2').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Correct Answers', 'Total Questions'],
                datasets: [{
                    data: [7, 10],
                    backgroundColor: [
                        '#38b2ac',
                        '#ed8936'
                    ],
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: cleanChartOptions
        });

        // Filipino Word Reading Chart
        const ctx3 = document.getElementById('filipinoChart3').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                datasets: [{
                    data: [15, 235, 250],
                    backgroundColor: [
                        '#f56565',
                        '#38b2ac',
                        '#ed8936'
                    ],
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: cleanChartOptions
        });
    </script>
@endsection