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

                    <!-- Filipino Language Test Results by Grade Level -->
                    <div class="chart-panel">
                        <div class="chart-panel-header">
                            <h3>📊 Filipino Language Test Results by Grade Level</h3>
                            <div class="grade-selector">
                                <select id="gradeSelector" class="custom-select" onchange="updateGradeAnalysis()">
                                    <option value="all">All Grades</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-panel-body">
                            <!-- Grade Level Summary Cards -->
                            <div class="grade-summary-grid">
                                <div class="summary-card grade-7">
                                    <div class="card-header">
                                        <h4>Grade 7</h4>
                                        <span class="student-count">28 mag-aaral</span>
                                    </div>
                                    <div class="performance-metrics">
                                        <div class="metric">
                                            <span class="metric-label">Avg Reading Speed</span>
                                            <span class="metric-value">95 WPM</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Comprehension</span>
                                            <span class="metric-value">78%</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Accuracy</span>
                                            <span class="metric-value">85%</span>
                                        </div>
                                    </div>
                                    <div class="performance-distribution">
                                        <div class="dist-item independent">
                                            <span class="dist-label">Independiyente</span>
                                            <span class="dist-value">18 (64%)</span>
                                        </div>
                                        <div class="dist-item instructional">
                                            <span class="dist-label">Pagtuturo</span>
                                            <span class="dist-value">7 (25%)</span>
                                        </div>
                                        <div class="dist-item frustration">
                                            <span class="dist-label">Pagkabalisa</span>
                                            <span class="dist-value">3 (11%)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-card grade-8">
                                    <div class="card-header">
                                        <h4>Grade 8</h4>
                                        <span class="student-count">32 mag-aaral</span>
                                    </div>
                                    <div class="performance-metrics">
                                        <div class="metric">
                                            <span class="metric-label">Avg Reading Speed</span>
                                            <span class="metric-value">108 WPM</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Comprehension</span>
                                            <span class="metric-value">82%</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Accuracy</span>
                                            <span class="metric-value">89%</span>
                                        </div>
                                    </div>
                                    <div class="performance-distribution">
                                        <div class="dist-item independent">
                                            <span class="dist-label">Independiyente</span>
                                            <span class="dist-value">20 (63%)</span>
                                        </div>
                                        <div class="dist-item instructional">
                                            <span class="dist-label">Pagtuturo</span>
                                            <span class="dist-value">9 (28%)</span>
                                        </div>
                                        <div class="dist-item frustration">
                                            <span class="dist-label">Pagkabalisa</span>
                                            <span class="dist-value">3 (9%)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-card grade-9">
                                    <div class="card-header">
                                        <h4>Grade 9</h4>
                                        <span class="student-count">30 mag-aaral</span>
                                    </div>
                                    <div class="performance-metrics">
                                        <div class="metric">
                                            <span class="metric-label">Avg Reading Speed</span>
                                            <span class="metric-value">118 WPM</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Comprehension</span>
                                            <span class="metric-value">86%</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Accuracy</span>
                                            <span class="metric-value">92%</span>
                                        </div>
                                    </div>
                                    <div class="performance-distribution">
                                        <div class="dist-item independent">
                                            <span class="dist-label">Independiyente</span>
                                            <span class="dist-value">24 (80%)</span>
                                        </div>
                                        <div class="dist-item instructional">
                                            <span class="dist-label">Pagtuturo</span>
                                            <span class="dist-value">5 (17%)</span>
                                        </div>
                                        <div class="dist-item frustration">
                                            <span class="dist-label">Pagkabalisa</span>
                                            <span class="dist-value">1 (3%)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-card grade-10">
                                    <div class="card-header">
                                        <h4>Grade 10</h4>
                                        <span class="student-count">25 mag-aaral</span>
                                    </div>
                                    <div class="performance-metrics">
                                        <div class="metric">
                                            <span class="metric-label">Avg Reading Speed</span>
                                            <span class="metric-value">125 WPM</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Comprehension</span>
                                            <span class="metric-value">89%</span>
                                        </div>
                                        <div class="metric">
                                            <span class="metric-label">Avg Accuracy</span>
                                            <span class="metric-value">94%</span>
                                        </div>
                                    </div>
                                    <div class="performance-distribution">
                                        <div class="dist-item independent">
                                            <span class="dist-label">Independiyente</span>
                                            <span class="dist-value">22 (88%)</span>
                                        </div>
                                        <div class="dist-item instructional">
                                            <span class="dist-label">Pagtuturo</span>
                                            <span class="dist-value">3 (12%)</span>
                                        </div>
                                        <div class="dist-item frustration">
                                            <span class="dist-label">Pagkabalisa</span>
                                            <span class="dist-value">0 (0%)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Analysis Charts -->
                            <div class="detailed-analysis">
                                <div class="analysis-header">
                                    <h4>📈 Detailed Performance Analysis</h4>
                                    <p>Comprehensive breakdown of Filipino reading performance across all grade levels</p>
                                </div>

                                <div class="charts-grid">
                                    <div class="chart-container">
                                        <h4>📚 Reading Speed Progression</h4>
                                        <canvas id="filipinoSpeedChart"></canvas>
                                        <div class="chart-summary">
                                            <div class="summary-item">
                                                <div class="summary-value">112 WPM Average</div>
                                                <div class="summary-label">Across all grade levels</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart-container">
                                        <h4>🧠 Comprehension Levels</h4>
                                        <canvas id="filipinoComprehensionChart"></canvas>
                                        <div class="chart-summary">
                                            <div class="summary-item">
                                                <div class="summary-value">84% Average</div>
                                                <div class="summary-label">Overall comprehension rate</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart-container">
                                        <h4>✅ Reading Accuracy</h4>
                                        <canvas id="filipinoAccuracyChart"></canvas>
                                        <div class="chart-summary">
                                            <div class="summary-item">
                                                <div class="summary-value">90% Average</div>
                                                <div class="summary-label">Word reading accuracy</div>
                                            </div>
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

        /* Grade Level Analysis Styles */
        .grade-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .grade-summary-grid {
            display: grid;grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;margin-bottom: 2rem;
        }

        .summary-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            border-left: 4px solid var(--primary);
            transition: var(--transition);
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 184, 169, 0.15);
        }

        .summary-card.grade-7 {
            border-left-color: #00B8A9;
        }

        .summary-card.grade-8 {
            border-left-color: #F6AD55;
        }

        .summary-card.grade-9 {
            border-left-color: #4FC3F7;
        }

        .summary-card.grade-10 {
            border-left-color: #E53E3E;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--neutral-light);
        }

        .card-header h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .student-count {
            font-size: 0.85rem;
            color: var(--text-light);
            background: var(--neutral-light);
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
        }

        .performance-metrics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .metric {
            text-align: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .metric-label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .metric-value {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .performance-distribution {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .dist-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .dist-item.independent {
            background: #E8F5E8;
            color: #2E7D32;
        }

        .dist-item.instructional {
            background: #FFF3E0;
            color: #F57C00;
        }

        .dist-item.frustration {
            background: #FFEBEE;
            color: #D32F2F;
        }

        .dist-label {
            font-weight: 600;
        }

        .dist-value {
            font-weight: 700;
        }

        .detailed-analysis {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid var(--neutral-light);
        }

        .analysis-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .analysis-header h4 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .analysis-header p {
            color: var(--text-light);
            font-size: 1rem;
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

            .grade-summary-grid {
                grid-template-columns: 1fr;
            }

            .performance-metrics {
                grid-template-columns: 1fr;
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
            type: 'bar',
            data: {
                labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [
                    {
                        label: 'Independiyente (90-100%)',
                        data: [18, 20, 24, 22], // Number of students at Independent level
                        backgroundColor: '#00B8A9',
                        borderColor: '#00B8A9',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: 'Pagtuturo (70-89%)',
                        data: [7, 9, 5, 3], // Number of students at Instructional level
                        backgroundColor: '#F6AD55',
                        borderColor: '#F6AD55',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: 'Pagkabalisa (Below 70%)',
                        data: [3, 3, 1, 0], // Number of students at Frustration level
                        backgroundColor: '#E53E3E',
                        borderColor: '#E53E3E',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    title: {
                        display: true,
                        text: '📊 Pag-unlad sa Pagbasa ng Filipino (Ayon sa Baitang)',
                        font: { size: 16, weight: 'bold' },
                        color: '#00B8A9',
                        padding: 20
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'center',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rect',
                            padding: 20,
                            font: { size: 12, weight: '600' },
                            color: '#2D3748'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#1A202C',
                        bodyColor: '#2D3748',
                        borderColor: '#00B8A9',
                        borderWidth: 2,
                        cornerRadius: 12,
                        displayColors: true,
                        padding: 16,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        callbacks: {
                            title: function (context) {
                                return `${context[0].label} Pagganap sa Filipino`;
                            },
                            label: function (context) {
                                const datasetLabel = context.dataset.label;
                                const value = context.parsed.y;
                                const total = context.chart.data.datasets.reduce((sum, dataset) => {
                                    return sum + dataset.data[context.dataIndex];
                                }, 0);
                                const percentage = ((value / total) * 100).toFixed(1);

                                return `${datasetLabel}: ${value} mag-aaral (${percentage}%)`;
                            },
                            afterBody: function (context) {
                                const dataIndex = context[0].dataIndex;
                                const total = context[0].chart.data.datasets.reduce((sum, dataset) => {
                                    return sum + dataset.data[dataIndex];
                                }, 0);
                                return `Kabuuang Mag-aaral: ${total}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: false,
                        grid: {
                            color: 'rgba(0, 184, 169, 0.1)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            padding: 15,
                            font: { size: 12, weight: '500' },
                            color: '#4A5568',
                            callback: function (value) {
                                return value + ' mag-aaral';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Bilang ng Mag-aaral',
                            font: { size: 14, weight: 'bold' },
                            color: '#2D3748',
                            padding: 20
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            padding: 15,
                            font: { size: 13, weight: '600' },
                            color: '#2D3748'
                        },
                        title: {
                            display: true,
                            text: 'Mga Baitang',
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

        // Filipino Reading Speed Progression Chart
        const speedCtx = document.getElementById('filipinoSpeedChart').getContext('2d');
        new Chart(speedCtx, {
            type: 'line',
            data: {
                labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [{
                    label: 'Average Reading Speed (WPM)',
                    data: [95, 108, 118, 125],
                    borderColor: '#00B8A9',
                    backgroundColor: 'rgba(0, 184, 169, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#00B8A9',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                ...cleanChartOptions,
                plugins: {
                    ...cleanChartOptions.plugins,
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#1A202C',
                        bodyColor: '#2D3748',
                        borderColor: '#00B8A9',
                        borderWidth: 2,
                        cornerRadius: 8,
                        displayColors: true,
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 12 },
                        callbacks: {
                            label: function (context) {
                                return `Reading Speed: ${context.parsed.y} WPM`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 184, 169, 0.1)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            padding: 10,
                            font: { size: 11, weight: '500' },
                            color: '#4A5568',
                            callback: function (value) {
                                return value + ' WPM';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            font: { size: 11, weight: '500' },
                            color: '#2D3748'
                        }
                    }
                }
            }
        });

        // Filipino Comprehension Levels Chart
        const comprehensionCtx = document.getElementById('filipinoComprehensionChart').getContext('2d');
        new Chart(comprehensionCtx, {
            type: 'bar',
            data: {
                labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [{
                    label: 'Average Comprehension (%)',
                    data: [78, 82, 86, 89],
                    backgroundColor: '#F6AD55',
                    borderColor: '#F6AD55',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                ...cleanChartOptions,
                plugins: {
                    ...cleanChartOptions.plugins,
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#1A202C',
                        bodyColor: '#2D3748',
                        borderColor: '#00B8A9',
                        borderWidth: 2,
                        cornerRadius: 8,
                        displayColors: true,
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 12 },
                        callbacks: {
                            label: function (context) {
                                return `Comprehension: ${context.parsed.y}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: 'rgba(0, 184, 169, 0.1)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            padding: 10,
                            font: { size: 11, weight: '500' },
                            color: '#4A5568',
                            callback: function (value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            font: { size: 11, weight: '500' },
                            color: '#2D3748'
                        }
                    }
                }
            }
        });

        // Filipino Reading Accuracy Chart
        const accuracyCtx = document.getElementById('filipinoAccuracyChart').getContext('2d');
        new Chart(accuracyCtx, {
            type: 'bar',
            data: {
                labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [{
                    label: 'Average Reading Accuracy (%)',
                    data: [85, 89, 92, 94],
                    backgroundColor: '#4FC3F7',
                    borderColor: '#4FC3F7',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                ...cleanChartOptions,
                plugins: {
                    ...cleanChartOptions.plugins,
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#1A202C',
                        bodyColor: '#2D3748',
                        borderColor: '#00B8A9',
                        borderWidth: 2,
                        cornerRadius: 8,
                        displayColors: true,
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 12 },
                        callbacks: {
                            label: function (context) {
                                return `Reading Accuracy: ${context.parsed.y}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: 'rgba(0, 184, 169, 0.1)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            padding: 10,
                            font: { size: 11, weight: '500' },
                            color: '#4A5568',
                            callback: function (value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            font: { size: 11, weight: '500' },
                            color: '#2D3748'
                        }
                    }
                }
            }
        });

        // Grade Analysis Update Function
        function updateGradeAnalysis() {
            const selectedGrade = document.getElementById('gradeSelector').value;
            // This function can be expanded to filter data based on selected grade
            console.log('Selected grade:', selectedGrade);
            // Future implementation: Update charts and summary cards based on selected grade
        }
    </script>
@endsection