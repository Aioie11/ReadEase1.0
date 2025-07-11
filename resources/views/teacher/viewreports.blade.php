@extends('layouts.head-tech')

@section('title', 'Reading Progress Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-wrapper">
            <!-- Dashboard Header -->

            <div class="welcome-message">
                <div class="welcome-content">
                    <h2>English Reports</h2>
                    <p>Comprehensive insights into student reading performance and progress</p>
                </div>
            </div>

            <!-- Full Width Filter Controls -->
            <div class="filter-controls">
                <div class="filter-group">
                    <div class="filter-label">Subject</div>
                    <div class="filter-options">
                        <button class="filter-btn active">English</button>
                        <button class="filter-btn"
                            onclick="window.location.href='{{ route('teacher.filipinoreport') }}'">Filipino</button>
                    </div>
                </div>
                <div class="filter-group">
                    <div class="filter-label">View by</div>
                    <div class="filter-options">
                        <select class="custom-select" id="gradeFilter" onchange="updateSectionOptions()">
                            <option value="7" {{ (string) ($grade ?? '7') == '7' ? 'selected' : '' }}>Grade 7</option>
                            <option value="8" {{ (string) ($grade ?? '7') == '8' ? 'selected' : '' }}>Grade 8</option>
                            <option value="9" {{ (string) ($grade ?? '7') == '9' ? 'selected' : '' }}>Grade 9</option>
                            <option value="10" {{ (string) ($grade ?? '7') == '10' ? 'selected' : '' }}>Grade 10</option>
                        </select>
                        <select class="custom-select" id="sectionFilter" onchange="updateEnglishGradeData()">
                            <option value="all" {{ (string) ($section ?? 'all') == 'all' ? 'selected' : '' }}>All Sections
                            </option>
                            <!-- Dynamic options will be populated by JavaScript -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <!-- Left Column - Charts -->
                <div class="dashboard-column main-column">
                    <!-- Word Reading Chart -->
                    <div class="chart-panel">
                        <div class="chart-panel-header">
                            <h3 id="chartTitle">📊 Word Reading Level Distribution - Grade {{ (string) ($grade ?? '7') }}
                                (All Sections)</h3>
                            <div class="time-selector">
                                <button class="time-btn active">Selected Grade</button>
                            </div>
                        </div>
                        <div class="chart-panel-body">
                            <canvas id="mainChart"></canvas>
                        </div>
                    </div>

                    <!-- Comprehension Chart -->
                    <div class="chart-panel">
                        <div class="chart-panel-header">
                            <h3 id="englishComprehensionChartTitle">🧠 Comprehension Level Distribution - Grade
                                {{ (string) ($grade ?? '7') }} (All Sections)
                            </h3>
                            <div class="time-selector">
                                <button class="time-btn active">Selected Grade</button>
                            </div>
                        </div>
                        <div class="chart-panel-body">
                            <canvas id="englishComprehensionChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Data and Information -->
                <div class="dashboard-column side-column">
                    <!-- Performance Metrics -->
                    <div class="performance-metrics">
                        <!-- Overall Reading Performance Card -->
                        <div class="performance-card">
                            <div class="performance-icon reading-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                                </svg>
                            </div>
                            <div class="performance-content">
                                <div class="performance-label">Overall Reading Level</div>
                                <div class="performance-value" id="overallReadingLevel">No Data</div>
                                <div class="performance-description">
                                    Majority level based on student distribution
                                </div>
                                <div class="performance-stats">
                                    <span class="student-count" id="readingStudentCount">{{ $total_students ?? 0 }}
                                        students</span>
                                </div>
                            </div>
                        </div>

                        <div class="performance-card">
                            <div class="performance-icon reading-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                                </svg>
                            </div>
                            <div class="performance-content">
                                <div class="performance-label">Overall Comprehension Level</div>
                                <div class="performance-value" id="overallComprehensionLevel">No Data</div>
                                <div class="performance-description">
                                    Majority level based on student distribution
                                </div>
                                <div class="performance-stats">
                                    <span class="student-count" id="comprehensionStudentCount">{{ $total_students ?? 0 }}
                                        students</span>
                                </div>
                            </div>
                        </div>

                        <!-- Reading Performance Guide -->
                        <div class="reading-performance-guide">
                            <h3>Reading Performance Levels</h3>
                            <div class="performance-level-item">
                                <span class="performance-badge independent-level">Independent</span>
                                <div class="performance-level-details">
                                    <div class="performance-level-range">Word Reading: 97-100% | Comprehension: 80-100%
                                    </div>
                                    <div class="performance-level-description">Students read fluently without assistance
                                    </div>
                                </div>
                            </div>

                            <div class="performance-level-item">
                                <span class="performance-badge instructional-level">Instructional</span>
                                <div class="performance-level-details">
                                    <div class="performance-level-range">Word Reading: 90-96% | Comprehension: 59-79%</div>
                                    <div class="performance-level-description">Students can read with teacher support</div>
                                </div>
                            </div>

                            <div class="performance-level-item">
                                <span class="performance-badge frustration-level">Frustration</span>
                                <div class="performance-level-details">
                                    <div class="performance-level-range">Word Reading: 89% Below | Comprehension: 58% Below
                                    </div>
                                    <div class="performance-level-description">Students struggle with reading material</div>
                                </div>
                            </div>
                        </div>

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

        .welcome-message {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .welcome-message:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .welcome-content h2 {
            text-align: left;
            color: #00B8A9;
            font-size: 1.8em;
            font-weight: 700;
        }

        .welcome-content p {
            text-align: left;
            color: #7f8c8d;
            font-size: 1rem;
            margin: 0;
            max-width: 600px;


        }


        .dashboard-wrapper {
            padding: 60px;
            background-color: var(--background);
            min-height: calc(100vh - 60px)
        }

        .dashboard-header {
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            margin-bottom: 30px;
        }

        .header-content h1 {
            color: #00B8A9;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .header-content p {
            color: #718096;
            margin: 0;
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
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
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

        .chart-info {
            display: flex;
            align-items: center;
        }

        .info-text {
            font-size: 0.8rem;
            color: var(--text-light);
            font-style: italic;
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
            height: 300px
        }



        /* Unique Student Table Panel */
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

        .summary-stats {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .stat-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
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
            font-size: 0.9rem;
            color: var(--text);
            border-bottom: 1px solid var(--neutral-light);
        }

        .student-table tr:last-child td {
            border-bottom: none;
        }

        .student-table tr:hover td {
            background-color: rgba(0, 184, 169, 0.05);
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .student-avatar {
            width: 32px;
            height: 32px;
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Legacy Badge Support - Updated for Clean Styling */
        .badge {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .independent {
            background-color: #00B8A9;
            color: white;
        }

        .instructional {
            background-color: #F6AD55;
            color: #2c3e50;
        }

        .frustration {
            background-color: #E53E3E;
            color: white;
        }

        .progress-bar {
            width: 100px;
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 50px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            border-radius: 50px;
        }

        .green {
            background: var(--secondary-gradient);
        }

        .yellow {
            background: var(--accent-gradient);
        }

        .red {
            background: var(--danger-gradient);
        }

        /* Performance Metrics Styling - Clean Stud-Dash Style */
        .performance-metrics {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .performance-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }

        .performance-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .performance-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .performance-icon.reading-icon {
            background: #3498db;
        }

        .performance-icon.speed-icon {
            background: #27ae60;
        }

        .performance-icon.comprehension-icon {
            background: #e67e22;
        }

        .performance-icon.assessment-icon {
            background: #9b59b6;
        }

        .performance-icon svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .performance-content {
            flex: 1;
        }

        .performance-label {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .performance-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
            background: none !important;
            background-color: transparent !important;
            display: inline-block;
            width: auto;
            height: auto;
            padding: 0;
            border: none;
            border-radius: 0;
        }

        /* Performance Level Colors - Override any background colors */
        .performance-value.independent {
            color: #00B8A9 !important;
            background: none !important;
            background-color: transparent !important;
        }

        .performance-value.instructional {
            color: #F6AD55 !important;
            background: none !important;
            background-color: transparent !important;
        }

        .performance-value.frustration {
            color: #E53E3E !important;
            background: none !important;
            background-color: transparent !important;
        }

        .performance-value.no-data {
            color: #718096 !important;
            font-style: italic;
            background: none !important;
            background-color: transparent !important;
        }

        .performance-value .unit {
            font-size: 0.9rem;
            font-weight: 500;
            color: #7f8c8d;
        }

        .performance-description {
            font-size: 0.75rem;
            color: #7f8c8d;
            margin-bottom: 0.5rem;
        }

        .performance-stats {
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .performance-stats .student-count {
            color: var(--primary);
        }

        .performance-stats .trend-indicator {
            color: var(--success);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .performance-stats .trend-indicator svg {
            width: 12px;
            height: 12px;
        }

        .performance-stats .comprehension-level {
            color: var(--primary);
            font-weight: 600;
        }

        .performance-stats .grade-info {
            color: var(--text);
        }

        /* Recent Activity */
        .recent-activity {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .recent-activity h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.5rem 0;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            font-size: 0.85rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
            line-height: 1.4;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        /* Reading Performance Guide - Clean Stud-Dash Style */
        .reading-performance-guide {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }

        .reading-performance-guide:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .reading-performance-guide h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .performance-level-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .performance-level-item:hover {
            background-color: rgba(0, 184, 169, 0.05);
            border-color: rgba(0, 184, 169, 0.1);
        }

        .performance-level-item:last-child {
            margin-bottom: 0;
        }

        .performance-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 90px;
            text-align: center;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }

        .performance-badge.independent-level {
            background-color: #00B8A9;
            color: white;
        }

        .performance-badge.instructional-level {
            background-color: #F6AD55;
            color: #2c3e50;
        }

        .performance-badge.frustration-level {
            background-color: #E53E3E;
            color: white;
        }

        .performance-level-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 0.1rem;
        }

        .performance-level-range {
            font-size: 0.8rem;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .performance-level-description {
            font-size: 0.75rem;
            color: #7f8c8d;
            line-height: 1.4;
        }

        /* Reading Level Legend */
        .reading-level-legend {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            margin-bottom: 1.5rem;
        }

        .reading-level-legend h4 {
            margin: 0 0 1rem 0;
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
        }

        .legend-items {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .legend-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }

        .legend-color.independent-color {
            background: #00B8A9;
        }

        .legend-color.instructional-color {
            background: #F6AD55;
        }

        .legend-color.frustration-color {
            background: #E53E3E;
        }

        /* Responsive Design - Clean Stud-Dash Style */
        @media (max-width: 768px) {
            .dashboard-wrapper {
                padding: 1rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .filter-controls {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .filter-group {
                justify-content: space-between;
            }

            .performance-metrics {
                gap: 1rem;
            }

            .performance-card {
                padding: 1rem;
            }

            .performance-icon {
                width: 45px;
                height: 45px;
            }

            .performance-value {
                font-size: 1.3rem;
            }

            .reading-performance-guide {
                padding: 1rem;
            }

            .reading-level-legend {
                padding: 1rem;
            }

            .performance-level-item {
                padding: 0.5rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .performance-badge {
                align-self: flex-start;
                margin-top: 0;
                min-width: auto;
            }

            .legend-item {
                align-items: flex-start;
                gap: 0.5rem;
            }

            .legend-color {
                margin-top: 0.2rem;
            }

            .search-wrapper input {
                width: 180px;
            }

            .search-wrapper input:focus {
                width: 200px;
            }
        }
    </style>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Grade to Section mapping - Define globally so both DOMContentLoaded listeners can access it
        const gradeSectionMapping = {
            '7': ['narra', 'lawaan', 'dao', 'mahugani'],
            '8': ['avocado', 'duhat', 'mango', 'guava'],
            '9': ['gold', 'zinc', 'silver'],
            '10': ['galileo', 'newton', 'edison']
        };

        document.addEventListener('DOMContentLoaded', function () {
            // Main Chart - Reading Progress Overview
            const mainCtx = document.getElementById('mainChart').getContext('2d');

            // Reading level data with detailed information
            const readingLevels = {
                1: {
                    name: 'Frustration',
                    wordReading: '89 Below',
                    comprehension: '58 Below',
                    description: 'Student struggles with reading material',
                    color: '#E53E3E'
                },
                2: {
                    name: 'Instructional',
                    wordReading: '90-96',
                    comprehension: '59-79',
                    description: 'Student can read with teacher support',
                    color: '#F6AD55'
                },
                3: {
                    name: 'Independent',
                    wordReading: '97-100',
                    comprehension: '80-100',
                    description: 'Student reads fluently without assistance',
                    color: '#00B8A9'
                }
            };

            // Create gradient for the chart
            const gradient = mainCtx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(0, 184, 169, 0.4)');
            gradient.addColorStop(0.5, 'rgba(0, 184, 169, 0.2)');
            gradient.addColorStop(1, 'rgba(0, 184, 169, 0.05)');

            // Get chart data from backend
            const gradeDistribution = @json($grade_distribution ?? []);
            const readingLevelDistribution = @json($reading_level_distribution ?? []);
            const currentGrade = '{{ (string) ($grade ?? "7") }}';
            const currentSection = '{{ (string) ($section ?? "all") }}';

            console.log('Initial data from backend:', {
                gradeDistribution,
                readingLevelDistribution,
                currentGrade,
                currentSection
            });

            // Function to get chart data for specific grade
            function getChartDataForGrade(selectedGrade) {
                const gradeKey = `Grade ${selectedGrade}`;
                const gradeData = gradeDistribution[gradeKey] || { Independent: 0, Instructional: 0, Frustration: 0 };

                return {
                    labels: [gradeKey],
                    independentData: [gradeData.Independent || 0],
                    instructionalData: [gradeData.Instructional || 0],
                    frustrationData: [gradeData.Frustration || 0]
                };
            }

            // Get initial chart data for current grade
            const initialChartData = getChartDataForGrade(currentGrade);

            console.log('Initial chart data:', initialChartData);

            // Function to calculate majority level from data
            function calculateMajorityLevel(independentCount, instructionalCount, frustrationCount) {
                const total = independentCount + instructionalCount + frustrationCount;

                if (total === 0) {
                    return { level: 'No Data', class: 'no-data', total: 0 };
                }

                // Find the highest count
                const maxCount = Math.max(independentCount, instructionalCount, frustrationCount);

                if (independentCount === maxCount) {
                    return { level: 'Independent', class: 'independent', total: total };
                } else if (instructionalCount === maxCount) {
                    return { level: 'Instructional', class: 'instructional', total: total };
                } else {
                    return { level: 'Frustration', class: 'frustration', total: total };
                }
            }

            // Function to update performance cards
            function updatePerformanceCards(readingData, comprehensionData) {
                // Update Reading Level Card
                const readingMajority = calculateMajorityLevel(
                    readingData.Independent || 0,
                    readingData.Instructional || 0,
                    readingData.Frustration || 0
                );

                const readingElement = document.getElementById('overallReadingLevel');
                const readingCountElement = document.getElementById('readingStudentCount');

                if (readingElement) {
                    readingElement.textContent = readingMajority.level;
                    readingElement.className = `performance-value ${readingMajority.class}`;
                }

                if (readingCountElement) {
                    readingCountElement.textContent = `${readingMajority.total} students`;
                }

                // Update Comprehension Level Card
                const comprehensionMajority = calculateMajorityLevel(
                    comprehensionData.Independent || 0,
                    comprehensionData.Instructional || 0,
                    comprehensionData.Frustration || 0
                );

                const comprehensionElement = document.getElementById('overallComprehensionLevel');
                const comprehensionCountElement = document.getElementById('comprehensionStudentCount');

                if (comprehensionElement) {
                    comprehensionElement.textContent = comprehensionMajority.level;
                    comprehensionElement.className = `performance-value ${comprehensionMajority.class}`;
                }

                if (comprehensionCountElement) {
                    comprehensionCountElement.textContent = `${comprehensionMajority.total} students`;
                }

                console.log('Updated performance cards:', {
                    reading: readingMajority,
                    comprehension: comprehensionMajority
                });
            }

            // Initialize performance cards with initial data
            const initialReadingData = gradeDistribution[`Grade ${currentGrade}`] || { Independent: 0, Instructional: 0, Frustration: 0 };
            const initialComprehensionData = readingLevelDistribution[`Grade ${currentGrade}`] || { Independent: 0, Instructional: 0, Frustration: 0 };
            updatePerformanceCards(initialReadingData, initialComprehensionData);

            // Initialize with placeholder data if no data available
            const chartData = [
                initialChartData.independentData[0] || 0,
                initialChartData.instructionalData[0] || 0,
                initialChartData.frustrationData[0] || 0
            ];

            // Always show colorful charts - data will be loaded via AJAX
            const displayData = chartData.some(value => value > 0) ? chartData : [1, 1, 1]; // Show equal segments if no data

            window.mainChart = new Chart(mainCtx, {
                type: 'bar',
                data: {
                    labels: [], // Will be populated with section names
                    datasets: [
                        {
                            label: 'Independent Level (97-100%)',
                            data: [],
                            backgroundColor: '#00B8A9',
                            borderColor: '#00B8A9',
                            borderWidth: 1
                        },
                        {
                            label: 'Instructional Level (90-96%)',
                            data: [],
                            backgroundColor: '#F6AD55',
                            borderColor: '#F6AD55',
                            borderWidth: 1
                        },
                        {
                            label: 'Frustration Level (Below 90%)',
                            data: [],
                            backgroundColor: '#E53E3E',
                            borderColor: '#E53E3E',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Sections',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                color: '#2D3748'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                color: '#2D3748'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'center',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'rect',
                                padding: 20,
                                font: {
                                    size: 12,
                                    weight: '600'
                                },
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
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label;
                                    const value = context.raw;
                                    return `${label}: ${value} students`;
                                },
                                footer: function(tooltipItems) {
                                    let total = 0;
                                    tooltipItems.forEach(function(tooltipItem) {
                                        total += tooltipItem.parsed.y;
                                    });
                                    return 'Total: ' + total + ' students';
                                }
                            }
                        }
                    }
                }
            });

            // English Comprehension Performance Chart
            const englishComprehensionCtx = document.getElementById('englishComprehensionChart').getContext('2d');

            // Function to get English comprehension chart data for specific grade
            function getEnglishComprehensionChartDataForGrade(selectedGrade) {
                const gradeKey = `Grade ${selectedGrade}`;
                // We'll calculate comprehension levels based on comprehension scores only
                const gradeData = gradeDistribution[gradeKey] || { Independent: 0, Instructional: 0, Frustration: 0 };

                return {
                    labels: [gradeKey],
                    independentData: [gradeData.Independent || 0],
                    instructionalData: [gradeData.Instructional || 0],
                    frustrationData: [gradeData.Frustration || 0]
                };
            }

            // Get initial comprehension chart data for current grade
            const initialEnglishComprehensionChartData = getEnglishComprehensionChartDataForGrade(currentGrade);

            // Initialize comprehension chart with placeholder data if no data available
            const comprehensionChartData = [
                initialEnglishComprehensionChartData.independentData[0] || 0,
                initialEnglishComprehensionChartData.instructionalData[0] || 0,
                initialEnglishComprehensionChartData.frustrationData[0] || 0
            ];

            // Always show colorful charts - data will be loaded via AJAX
            const displayComprehensionData = comprehensionChartData.some(value => value > 0) ? comprehensionChartData : [1, 1, 1]; // Show equal segments if no data

            window.englishComprehensionChart = new Chart(englishComprehensionCtx, {
                type: 'bar',
                data: {
                    labels: [], // Will be populated with section names
                    datasets: [
                        {
                            label: 'Independent Level (80-100%)',
                            data: [],
                            backgroundColor: '#00B8A9',
                            borderColor: '#00B8A9',
                            borderWidth: 1
                        },
                        {
                            label: 'Instructional Level (59-79%)',
                            data: [],
                            backgroundColor: '#F6AD55',
                            borderColor: '#F6AD55',
                            borderWidth: 1
                        },
                        {
                            label: 'Frustration Level (Below 59%)',
                            data: [],
                            backgroundColor: '#E53E3E',
                            borderColor: '#E53E3E',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Sections',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                color: '#2D3748'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                color: '#2D3748'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'center',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'rect',
                                padding: 20,
                                font: {
                                    size: 12,
                                    weight: '600'
                                },
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
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label;
                                    const value = context.raw;
                                    return `${label}: ${value} students`;
                                },
                                footer: function(tooltipItems) {
                                    let total = 0;
                                    tooltipItems.forEach(function(tooltipItem) {
                                        total += tooltipItem.parsed.y;
                                    });
                                    return 'Total: ' + total + ' students';
                                }
                            }
                        }
                    }
                }
            });

            // Load initial data immediately after chart creation
            console.log('=== ENGLISH REPORTS INITIALIZATION ===');
            console.log('Loading initial data for current grade on page load:', currentGrade);
            console.log('Current section:', currentSection);
            console.log('Grade distribution from backend:', gradeDistribution);
            console.log('Reading level distribution from backend:', readingLevelDistribution);

            setTimeout(() => {
                console.log('=== INITIALIZING SECTION OPTIONS AND FETCHING DATA ===');

                // Ensure section options are initialized first
                const sectionSelect = document.getElementById('sectionFilter');
                console.log('Section select element found:', !!sectionSelect);

                if (sectionSelect) {
                    sectionSelect.innerHTML = '<option value="all">All Sections</option>';
                    if (gradeSectionMapping[currentGrade]) {
                        console.log('Adding sections for grade:', currentGrade, gradeSectionMapping[currentGrade]);
                        gradeSectionMapping[currentGrade].forEach(section => {
                            const option = document.createElement('option');
                            option.value = section.toLowerCase();
                            option.textContent = section.charAt(0).toUpperCase() + section.slice(1);
                            sectionSelect.appendChild(option);
                        });
                    }
                    sectionSelect.value = currentSection;
                    console.log('Section select final value:', sectionSelect.value);
                }

                // Update chart titles based on current selection
                const chartTitle = currentSection === 'all'
                    ? `📊 Reading Performance Distribution - Grade ${currentGrade} (All Sections)`
                    : `📊 Reading Performance Distribution - Grade ${currentGrade} - ${currentSection.charAt(0).toUpperCase() + currentSection.slice(1)}`;
                const comprehensionChartTitle = currentSection === 'all'
                    ? `🧠 Comprehension Level Distribution - Grade ${currentGrade} (All Sections)`
                    : `🧠 Comprehension Level Distribution - Grade ${currentGrade} - ${currentSection.charAt(0).toUpperCase() + currentSection.slice(1)}`;

                console.log('Setting chart titles:', { chartTitle, comprehensionChartTitle });
                document.getElementById('chartTitle').textContent = chartTitle;
                document.getElementById('englishComprehensionChartTitle').textContent = comprehensionChartTitle;

                // Now fetch the data
                console.log('About to fetch grade data for:', currentGrade, currentSection);
                fetchGradeData(currentGrade, currentSection);
            }, 300);

            // Function to update chart for selected grade (this will be updated by AJAX call)
            function updateChartForGrade(selectedGrade) {
                // This function is now mainly used for immediate visual feedback
                // The actual data update will be handled by the AJAX response in updateUIWithData
                console.log('Chart update requested for grade:', selectedGrade);
            }

            // Make functions globally accessible
            window.updateSectionOptions = updateSectionOptions;
            window.updateEnglishGradeData = updateEnglishGradeData;

            // Function to update section options based on selected grade
            function updateSectionOptions() {
                const gradeSelect = document.getElementById('gradeFilter');
                const sectionSelect = document.getElementById('sectionFilter');
                const selectedGrade = gradeSelect.value;

                console.log('Grade changed to:', selectedGrade);

                // Clear current section options except "All Sections"
                sectionSelect.innerHTML = '<option value="all">All Sections</option>';

                // Add sections for the selected grade
                if (gradeSectionMapping[selectedGrade]) {
                    gradeSectionMapping[selectedGrade].forEach(section => {
                        const option = document.createElement('option');
                        option.value = section.toLowerCase();
                        option.textContent = section.charAt(0).toUpperCase() + section.slice(1);
                        sectionSelect.appendChild(option);
                    });
                }

                // Reset section to "All Sections" when grade changes
                sectionSelect.value = 'all';

                // Update the chart immediately for the selected grade (showing ALL sections data)
                updateChartForGrade(selectedGrade);

                // Fetch and update data dynamically for the selected grade (all sections)
                fetchGradeData(selectedGrade, 'all');
            }

            // Function to update English grade level data (called when section changes)
            function updateEnglishGradeData() {
                const selectedGrade = document.getElementById('gradeFilter') ? document.getElementById('gradeFilter').value : '7';
                const selectedSection = document.getElementById('sectionFilter') ? document.getElementById('sectionFilter').value : 'all';

                console.log('Section changed - Selected grade:', selectedGrade);
                console.log('Section changed - Selected section:', selectedSection);

                // Update the chart for the selected section
                updateChartForGrade(selectedGrade);

                // Fetch and update data dynamically for the selected grade and section
                fetchGradeData(selectedGrade, selectedSection);
            }

            // Function to fetch section-wise data via AJAX
            function fetchGradeData(grade, section) {
                console.log('=== ENGLISH FETCH GRADE DATA ===');
                console.log('Fetching section-wise data for grade:', grade, 'section:', section);

                // Show loading state
                showLoadingState();

                const readingUrl = `{{ route('teacher.section-wise-reading-data') }}?grade=${grade}&section=${section}&language=english`;
                const comprehensionUrl = `{{ route('teacher.section-wise-comprehension-data') }}?grade=${grade}&section=${section}&language=english`;

                console.log('Reading URL:', readingUrl);
                console.log('Comprehension URL:', comprehensionUrl);

                // Fetch reading data
                Promise.all([
                    fetch(readingUrl),
                    fetch(comprehensionUrl)
                ])
                    .then(responses => {
                        console.log('Fetch responses received:', responses.map(r => r.status));
                        return Promise.all(responses.map(r => r.json()));
                    })
                    .then(([readingData, comprehensionData]) => {
                        console.log('=== ENGLISH FETCH RESPONSE DATA ===');
                        console.log('Reading data response:', readingData);
                        console.log('Comprehension data response:', comprehensionData);
                        console.log('Reading success:', readingData.success);
                        console.log('Comprehension success:', comprehensionData.success);

                        if (readingData.success && comprehensionData.success) {
                            console.log('Both requests successful, calling updateSectionWiseCharts');
                            updateSectionWiseCharts(readingData.data, comprehensionData.data, grade);
                        } else {
                            console.error('Error fetching data:', readingData.message || comprehensionData.message);
                            console.error('Reading data:', readingData);
                            console.error('Comprehension data:', comprehensionData);
                            hideLoadingState();
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching section-wise data:', error);
                        hideLoadingState();
                    });
            }

            // Function to show loading state
            function showLoadingState() {
                const totalStudentsEl = document.getElementById('totalStudents');
                const avgReadingSpeedEl = document.getElementById('avgReadingSpeed');
                const avgComprehensionEl = document.getElementById('avgComprehension');

                if (totalStudentsEl) totalStudentsEl.textContent = 'Loading...';
                if (avgReadingSpeedEl) avgReadingSpeedEl.textContent = 'Loading...';
                if (avgComprehensionEl) avgComprehensionEl.textContent = 'Loading...';
            }

            // Function to hide loading state
            function hideLoadingState() {
                // This will be called after data is updated or on error
            }

            // Function to update section-wise charts
            function updateSectionWiseCharts(readingData, comprehensionData, grade) {
                console.log('=== ENGLISH UPDATE SECTION-WISE CHARTS ===');
                console.log('Updating section-wise charts for grade:', grade);
                console.log('Reading data:', readingData);
                console.log('Comprehension data:', comprehensionData);

                // Get current section selection
                const selectedSection = document.getElementById('sectionFilter') ? document.getElementById('sectionFilter').value : 'all';
                console.log('Selected section for chart update:', selectedSection);
                console.log('Reading data sections:', readingData.sections);
                console.log('Reading data section_data:', readingData.section_data);

                // Update reading chart
                if (window.mainChart && readingData.sections) {
                    let sections = readingData.sections;
                    let independentData = [];
                    let instructionalData = [];
                    let frustrationData = [];

                    // Filter sections based on selection
                    if (selectedSection !== 'all') {
                        // Show only the selected section
                        const sectionName = selectedSection.charAt(0).toUpperCase() + selectedSection.slice(1);
                        sections = [sectionName];
                        console.log('Filtering to show only section:', sectionName);
                    }

                    sections.forEach(section => {
                        const sectionData = readingData.section_data[section] || {};
                        independentData.push(sectionData.Independent || 0);
                        instructionalData.push(sectionData.Instructional || 0);
                        frustrationData.push(sectionData.Frustration || 0);
                    });

                    console.log('Chart sections:', sections);
                    console.log('Chart data - Independent:', independentData);
                    console.log('Chart data - Instructional:', instructionalData);
                    console.log('Chart data - Frustration:', frustrationData);

                    window.mainChart.data.labels = sections;
                    window.mainChart.data.datasets[0].data = independentData;
                    window.mainChart.data.datasets[1].data = instructionalData;
                    window.mainChart.data.datasets[2].data = frustrationData;
                    window.mainChart.update();
                }

                // Update comprehension chart
                if (window.englishComprehensionChart && comprehensionData.sections) {
                    let sections = comprehensionData.sections;
                    let independentData = [];
                    let instructionalData = [];
                    let frustrationData = [];

                    // Filter sections based on selection (same as reading chart)
                    if (selectedSection !== 'all') {
                        // Show only the selected section
                        const sectionName = selectedSection.charAt(0).toUpperCase() + selectedSection.slice(1);
                        sections = [sectionName];
                        console.log('Filtering comprehension chart to show only section:', sectionName);
                    }

                    sections.forEach(section => {
                        const sectionData = comprehensionData.section_data[section] || {};
                        independentData.push(sectionData.Independent || 0);
                        instructionalData.push(sectionData.Instructional || 0);
                        frustrationData.push(sectionData.Frustration || 0);
                    });

                    console.log('Comprehension chart sections:', sections);
                    console.log('Comprehension chart data - Independent:', independentData);
                    console.log('Comprehension chart data - Instructional:', instructionalData);
                    console.log('Comprehension chart data - Frustration:', frustrationData);

                    window.englishComprehensionChart.data.labels = sections;
                    window.englishComprehensionChart.data.datasets[0].data = independentData;
                    window.englishComprehensionChart.data.datasets[1].data = instructionalData;
                    window.englishComprehensionChart.data.datasets[2].data = frustrationData;
                    window.englishComprehensionChart.update();
                }

                // Update summary statistics
                const totalStudents = readingData.sections.reduce((total, section) => {
                    const sectionData = readingData.section_data[section] || {};
                    return total + (sectionData.total_students || 0);
                }, 0);

                const totalStudentsEl = document.getElementById('totalStudents');
                if (totalStudentsEl) totalStudentsEl.textContent = totalStudents;

                // Update chart titles based on selection
                let readingChartTitle, comprehensionChartTitle;

                if (selectedSection === 'all') {
                    readingChartTitle = `📊 Reading Performance Distribution - Grade ${grade} (All Sections)`;
                    comprehensionChartTitle = `📊 Comprehension Performance Distribution - Grade ${grade} (All Sections)`;
                } else {
                    const sectionName = selectedSection.charAt(0).toUpperCase() + selectedSection.slice(1);
                    readingChartTitle = `📊 Reading Performance Distribution - Grade ${grade} - Section ${sectionName}`;
                    comprehensionChartTitle = `📊 Comprehension Performance Distribution - Grade ${grade} - Section ${sectionName}`;
                }

                const readingTitleEl = document.querySelector('.chart-container h3');
                const comprehensionTitleEl = document.getElementById('englishComprehensionChartTitle');

                if (readingTitleEl) readingTitleEl.textContent = readingChartTitle;
                if (comprehensionTitleEl) comprehensionTitleEl.textContent = comprehensionChartTitle;

                hideLoadingState();
            }

            // Legacy function - replaced by updateSectionWiseCharts
            // Keeping for compatibility but will be removed in future updates

            // Function to update section table
            function updateSectionTable(sectionData, selectedSection) {
                const tableBody = document.getElementById('sectionTableBody');
                if (!tableBody) return;

                if (!sectionData || sectionData.length === 0) {
                    tableBody.innerHTML = `
                                                            <tr>
                                                                <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-light);">
                                                                    No data available for the selected filters
                                                                </td>
                                                            </tr>
                                                        `;
                    return;
                }

                let tableHTML = '';
                sectionData.forEach(section => {
                    const sectionIcon = section.section.charAt(0).toUpperCase();
                    let performanceClass = 'green';
                    if (section.avg_comprehension < 80) performanceClass = 'yellow';
                    if (section.avg_comprehension < 70) performanceClass = 'red';

                    tableHTML += `
                                                            <tr>
                                                                <td>
                                                                    <div class="student-info">
                                                                        <div class="student-avatar">${sectionIcon}</div>
                                                                        <div>${section.section}</div>
                                                                    </div>
                                                                </td>
                                                                <td>${section.student_count} students</td>
                                                                <td>${section.avg_reading_speed} WPM</td>
                                                                <td>${section.avg_comprehension}%</td>
                                                                <td>${section.avg_correct_reading}%</td>
                                                                <td>
                                                                    <div class="progress-bar">
                                                                        <div class="progress ${performanceClass}" style="width: ${section.avg_comprehension}%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        `;
                });

                tableBody.innerHTML = tableHTML;
            }

            // Legacy comprehension functions - replaced by updateSectionWiseCharts
            // Keeping for compatibility but will be removed in future updates
        });

        // Initialize page with current data
        document.addEventListener('DOMContentLoaded', function () {
            console.log('English Reports page loaded - charts and data initialization handled in main DOMContentLoaded');
        });
    </script>
@endsection