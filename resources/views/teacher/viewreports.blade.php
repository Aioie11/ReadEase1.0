@extends('layouts.head-tech')

@section('title', 'Reading Progress Dashboard')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <div class="dashboard-wrapper">
        <div class="dashboard-header">
            <div class="header-content">
                <h1>English Reports</h1>
                <p>Comprehensive insights into student reading performance and progress</p>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Left Column -->
            <div class="dashboard-column main-column">
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
                                <option value="7" {{ (string)($grade ?? '7') == '7' ? 'selected' : '' }}>Grade 7</option>
                                <option value="8" {{ (string)($grade ?? '7') == '8' ? 'selected' : '' }}>Grade 8</option>
                                <option value="9" {{ (string)($grade ?? '7') == '9' ? 'selected' : '' }}>Grade 9</option>
                                <option value="10" {{ (string)($grade ?? '7') == '10' ? 'selected' : '' }}>Grade 10</option>
                            </select>
                            <select class="custom-select" id="sectionFilter" onchange="updateEnglishGradeData()">
                                <option value="all" {{ (string)($section ?? 'all') == 'all' ? 'selected' : '' }}>All Sections</option>
                                <!-- Dynamic options will be populated by JavaScript -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="chart-panel">
                    <div class="chart-panel-header">
                        <h3 id="chartTitle">📊 Reading Performance Distribution - Grade {{ (string)($grade ?? '7') }}</h3>
                        <div class="time-selector">
                            <button class="time-btn active">Selected Grade</button>
                        </div>
                    </div>
                    <div class="chart-panel-body">
                        <canvas id="mainChart"></canvas>

                        <!-- Reading Level Legend -->
                        <div
                            style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #00B8A9;">
                            <h4 style="margin: 0 0 10px 0; color: #2D3748; font-size: 14px; font-weight: 600;">📖
                                Reading Performance Levels:</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 15px; font-size: 12px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 16px; height: 16px; background: #00B8A9; border-radius: 4px;">
                                    </div>
                                    <span><strong>Independent (90-100%):</strong> Students read fluently without
                                        assistance</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 16px; height: 16px; background: #F6AD55; border-radius: 4px;">
                                    </div>
                                    <span><strong>Instructional (70-89%):</strong> Students can read with teacher
                                        support</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 16px; height: 16px; background: #E53E3E; border-radius: 4px;">
                                    </div>
                                    <span><strong>Frustration (Below 70%):</strong> Students struggle with reading
                                        material</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- English Comprehension Performance Distribution -->
                <div class="chart-panel">
                    <div class="chart-panel-header">
                        <h3 id="englishComprehensionChartTitle">🧠 English Comprehension Performance Distribution - Grade {{ (string)($grade ?? '7') }}</h3>
                        <div class="time-selector">
                            <button class="time-btn active">Selected Grade</button>
                        </div>
                    </div>
                    <div class="chart-panel-body">
                        <canvas id="englishComprehensionChart"></canvas>

                        <!-- Comprehension Level Legend -->
                        <!-- <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #00B8A9;">
                            <h4 style="margin: 0 0 10px 0; color: #2D3748; font-size: 14px; font-weight: 600;">🧠
                                Comprehension Performance Levels:</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 15px; font-size: 12px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 16px; height: 16px; background: #00B8A9; border-radius: 4px;">
                                    </div>
                                    <span><strong>Independent (80-100%):</strong> Excellent comprehension skills</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 16px; height: 16px; background: #F6AD55; border-radius: 4px;">
                                    </div>
                                    <span><strong>Instructional (59-79%):</strong> Good comprehension with support</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 16px; height: 16px; background: #E53E3E; border-radius: 4px;">
                                    </div>
                                    <span><strong>Frustration (Below 59%):</strong> Needs comprehension improvement</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="student-table-panel">
                    <div class="panel-header">
                        <h3>Grade Level Performance Summary</h3>
                        <div class="summary-stats" id="summaryStats">
                            <div class="stat-item">
                                <span class="stat-label">Total Students:</span>
                                <span class="stat-value" id="totalStudents">{{ $total_students ?? 0 }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Avg Reading Speed:</span>
                                <span class="stat-value"
                                    id="avgReadingSpeed">{{ $statistics['avg_reading_speed'] ?? 0 }} WPM</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Avg Comprehension:</span>
                                <span class="stat-value"
                                    id="avgComprehension">{{ $statistics['avg_comprehension'] ?? 0 }}%</span>
                            </div>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="student-table">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Students</th>
                                    <th>Avg Reading Speed</th>
                                    <th>Avg Comprehension</th>
                                    <th>Avg Correct Reading</th>
                                    <th>Performance</th>
                                </tr>
                            </thead>
                            <tbody id="sectionTableBody">
                                @if(isset($section_data) && count($section_data) > 0)
                                    @foreach($section_data as $section)
                                        @php
                                            $sectionIcon = strtoupper(substr($section['section'], 0, 1));
                                            $performanceClass = 'green';
                                            if ($section['avg_comprehension'] < 80)
                                                $performanceClass = 'yellow';
                                            if ($section['avg_comprehension'] < 70)
                                                $performanceClass = 'red';
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">{{ $sectionIcon }}</div>
                                                    <div>{{ $section['section'] }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $section['student_count'] }} students</td>
                                            <td>{{ $section['avg_reading_speed'] }} WPM</td>
                                            <td>{{ $section['avg_comprehension'] }}%</td>
                                            <td>{{ $section['avg_correct_reading'] }}%</td>
                                            <td>
                                                <div class="progress-bar">
                                                    <div class="progress {{ $performanceClass }}"
                                                        style="width: {{ $section['avg_comprehension'] }}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6"
                                            style="text-align: center; padding: 2rem; color: var(--text-light);">
                                            No data available for the selected filters
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="dashboard-column side-column">
                <div class="metric-cards">
                    <div class="metric-card">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 3h18v18H3V3zm16 16V5H5v14h14zM7 7h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z" />
                            </svg>
                        </div>
                        <div class="metric-content">
                            <div class="metric-label">Reading Level</div>
                            <div class="metric-value">{{ $metric_cards['reading_level'] ?? 'No Data' }}</div>
                            <div class="metric-details"
                                style="font-size: 0.75rem; color: var(--text-light); margin-top: 0.25rem;">
                                Overall class performance level
                            </div>
                            <div class="metric-trend">
                                <svg viewBox="0 0 24 24" fill="currentColor" style="width: 12px; height: 12px;">
                                    <path d="M7 14l5-5 5 5z" />
                                </svg> {{ $total_students ?? 0 }} students
                            </div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div class="metric-content">
                            <div class="metric-label">Reading Speed</div>
                            <div class="metric-value">{{ $metric_cards['avg_reading_speed'] ?? 0 }} <span>WPM</span>
                            </div>
                            <div class="metric-trend">
                                <svg viewBox="0 0 24 24" fill="currentColor" style="width: 12px; height: 12px;">
                                    <path d="M7 14l5-5 5 5z" />
                                </svg> Average
                            </div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="metric-content">
                            <div class="metric-label">Comprehension</div>
                            <div class="metric-value">{{ $metric_cards['avg_comprehension'] ?? 0 }}<span>%</span></div>
                            <div class="metric-trend">
                                <svg viewBox="0 0 24 24" fill="currentColor" style="width: 12px; height: 12px;">
                                    <path d="M7 14l5-5 5 5z" />
                                </svg> Average
                            </div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" />
                            </svg>
                        </div>
                        <div class="metric-content">
                            <div class="metric-label">Total Students</div>
                            <div class="metric-value">{{ $total_students ?? 0 }} <span>Students</span></div>
                            <div class="metric-details"
                                style="font-size: 0.75rem; color: var(--text-light); margin-top: 0.25rem;">
                                Active students with assessments
                            </div>
                            <div class="metric-trend">
                                <svg viewBox="0 0 24 24" fill="currentColor" style="width: 12px; height: 12px;">
                                    <path d="M7 14l5-5 5 5z" />
                                </svg> Current grade
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reading Level Guide -->
                <div class="reading-level-guide">
                    <h3>Reading Level Guide</h3>
                    <div class="level-item">
                        <span class="badge independent">Independent</span>
                        <div class="level-details">
                            <div class="level-range">Word Reading: 97-100% | Comprehension: 80-100%</div>
                            <div class="level-description">Student reads fluently without assistance</div>
                        </div>
                    </div>
                    <div class="level-item">
                        <span class="badge instructional">Instructional</span>
                        <div class="level-details">
                            <div class="level-range">Word Reading: 90-96% | Comprehension: 59-79%</div>
                            <div class="level-description">Student can read with teacher support</div>
                        </div>
                    </div>
                    <div class="level-item">
                        <span class="badge frustration">Frustration</span>
                        <div class="level-details">
                            <div class="level-range">Word Reading: 89 Below | Comprehension: 58 Below</div>
                            <div class="level-description">Student struggles with reading material</div>
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

    .badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .independent {
        background-color: var(--success);
        color: white;
    }

    .instructional {
        background-color: var(--warning);
        color: var(--text-dark);
    }

    .frustration {
        background-color: var(--danger);
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

    /* Metric Cards Styling */
    .metric-cards {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .metric-card {
        background-color: var(--card-bg);
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .metric-card:hover {
        box-shadow: var(--shadow-md);
    }

    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background-color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .metric-icon svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }

    .metric-trend svg {
        display: inline-block;
        vertical-align: middle;
        margin-right: 4px;
    }

    .metric-content {
        flex: 1;
    }

    .metric-label {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .metric-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .metric-value span {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-light);
    }

    .metric-trend {
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .metric-trend.positive {
        color: var(--success);
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

    /* Reading Level Guide */
    .reading-level-guide {
        background-color: var(--card-bg);
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
        margin-bottom: 0.75rem;
        padding: 0.5rem;
        border-radius: 6px;
        transition: var(--transition);
    }

    .level-item:hover {
        background-color: rgba(0, 184, 169, 0.05);
    }

    .level-item:last-child {
        margin-bottom: 0;
    }

    .level-details {
        flex: 1;
    }

    .level-range {
        font-size: 0.75rem;
        color: var(--text);
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .level-description {
        font-size: 0.7rem;
        color: var(--text-light);
        line-height: 1.3;
    }

    /* Responsive adjustments */
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
        }

        .filter-group {
            justify-content: space-between;
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
        const currentGrade = '{{ (string)($grade ?? "7") }}';

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

        window.mainChart = new Chart(mainCtx, {
            type: 'pie',
            data: {
                labels: ['Independent Level (90-100%)', 'Instructional Level (70-89%)', 'Frustration Level (Below 70%)'],
                datasets: [{
                    data: [
                        initialChartData.independentData[0],
                        initialChartData.instructionalData[0],
                        initialChartData.frustrationData[0]
                    ],
                    backgroundColor: ['#00B8A9', '#F6AD55', '#E53E3E'],
                    borderColor: '#FFFFFF',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        align: 'center',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            color: '#2D3748',
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const value = data.datasets[0].data[i];
                                        const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        
                                        return {
                                            text: `${label}: ${value} students (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            strokeStyle: data.datasets[0].backgroundColor[i],
                                            lineWidth: 2,
                                            hidden: isNaN(data.datasets[0].data[i]),
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
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
                            title: function(context) {
                                const label = context[0].label;
                                const value = context[0].raw;
                                const total = context[0].dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}\n${value} students (${percentage}%)`;
                            },
                            label: function(context) {
                                const label = context.label;
                                const value = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                
                                let description = '';
                                if (label.includes('Independent')) {
                                    description = 'Students who read fluently without assistance';
                                } else if (label.includes('Instructional')) {
                                    description = 'Students who can read with teacher support';
                                } else if (label.includes('Frustration')) {
                                    description = 'Students who struggle with reading material';
                                }
                                
                                return [
                                    `Total Students: ${total}`,
                                    `Reading Level: ${label.split(' ')[0]}`,
                                    `Description: ${description}`
                                ];
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

        window.englishComprehensionChart = new Chart(englishComprehensionCtx, {
            type: 'pie',
            data: {
                labels: ['Independent Level (80-100%)', 'Instructional Level (59-79%)', 'Frustration Level (Below 59%)'],
                datasets: [{
                    data: [
                        initialEnglishComprehensionChartData.independentData[0],
                        initialEnglishComprehensionChartData.instructionalData[0],
                        initialEnglishComprehensionChartData.frustrationData[0]
                    ],
                    backgroundColor: ['#00B8A9', '#F6AD55', '#E53E3E'],
                    borderColor: '#FFFFFF',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        align: 'center',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            color: '#2D3748',
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        const value = data.datasets[0].data[i];
                                        const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';

                                        return {
                                            text: `${label}: ${value} students (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            strokeStyle: data.datasets[0].backgroundColor[i],
                                            lineWidth: 2,
                                            hidden: isNaN(data.datasets[0].data[i]),
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
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
                            title: function(context) {
                                const label = context[0].label;
                                const value = context[0].raw;
                                const total = context[0].dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';
                                return `${label}\n${value} students (${percentage}%)`;
                            },
                            label: function(context) {
                                const label = context.label;
                                const value = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';

                                let description = '';
                                if (label.includes('Independent')) {
                                    description = 'Students with excellent comprehension skills';
                                } else if (label.includes('Instructional')) {
                                    description = 'Students with good comprehension with support';
                                } else if (label.includes('Frustration')) {
                                    description = 'Students who need comprehension improvement';
                                }

                                return [
                                    `Total Students: ${total}`,
                                    `Comprehension Level: ${label.split(' ')[0]}`,
                                    `Description: ${description}`
                                ];
                            }
                        }
                    }
                }
            }
        });

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

        // Function to fetch grade data via AJAX
        function fetchGradeData(grade, section) {
            console.log('Fetching data for grade:', grade, 'section:', section);

            // Show loading state
            showLoadingState();

            // Make AJAX request to get updated data
            fetch(`{{ route('teacher.grade-level-data') }}?grade=${grade}&section=${section}&language=english`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateUIWithData(data.data, grade, section);
                    } else {
                        console.error('Error fetching data:', data.message);
                        hideLoadingState();
                    }
                })
                .catch(error => {
                    console.error('Error fetching grade data:', error);
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

        // Function to update UI with fetched data
        function updateUIWithData(data, grade, section) {
            console.log('Updating UI with data:', data);

            // Update summary statistics
            const totalStudentsEl = document.getElementById('totalStudents');
            const avgReadingSpeedEl = document.getElementById('avgReadingSpeed');
            const avgComprehensionEl = document.getElementById('avgComprehension');

            if (totalStudentsEl) totalStudentsEl.textContent = data.total_students || 0;
            if (avgReadingSpeedEl) avgReadingSpeedEl.textContent = `${data.statistics.avg_reading_speed || 0} WPM`;
            if (avgComprehensionEl) avgComprehensionEl.textContent = `${data.statistics.avg_comprehension || 0}%`;

            // Update chart title
            const chartTitle = section === 'all'
                ? `📊 Reading Performance Distribution - Grade ${grade} (All Sections)`
                : `📊 Reading Performance Distribution - Grade ${grade} - ${section.charAt(0).toUpperCase() + section.slice(1)}`;
            document.getElementById('chartTitle').textContent = chartTitle;

            // Update chart data
            const levelDistribution = data.reading_level_distribution;
            window.mainChart.data.datasets[0].data = [
                levelDistribution.Independent || 0,
                levelDistribution.Instructional || 0,
                levelDistribution.Frustration || 0
            ];
            window.mainChart.update('active');

            // Update comprehension chart data (fetch from API)
            fetchEnglishComprehensionData(grade, section);

            // Update section table
            updateSectionTable(data.section_data, section);
        }

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

        // Function to fetch English comprehension data
        function fetchEnglishComprehensionData(grade, section) {
            fetch(`{{ route('teacher.comprehension-level-data') }}?grade=${grade}&section=${section}&language=english`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateEnglishComprehensionChart(data.data, grade, section);
                    } else {
                        console.error('Error fetching English comprehension data:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching English comprehension data:', error);
                });
        }

        // Function to update English comprehension chart
        function updateEnglishComprehensionChart(data, grade, section) {
            const gradeKey = `Grade ${grade}`;
            const gradeData = data.distribution[gradeKey] || { Independent: 0, Instructional: 0, Frustration: 0 };

            // Update chart title
            const chartTitle = section === 'all'
                ? `🧠 English Comprehension Performance Distribution - Grade ${grade} (All Sections)`
                : `🧠 English Comprehension Performance Distribution - Grade ${grade} - ${section.charAt(0).toUpperCase() + section.slice(1)}`;
            document.getElementById('englishComprehensionChartTitle').textContent = chartTitle;

            // Update chart data
            window.englishComprehensionChart.data.datasets[0].data = [
                gradeData.Independent || 0,
                gradeData.Instructional || 0,
                gradeData.Frustration || 0
            ];
            window.englishComprehensionChart.update('active');
        }
    });

    // Initialize page with current data
    document.addEventListener('DOMContentLoaded', function () {
        console.log('English Reports page loaded');
        console.log('gradeSectionMapping:', gradeSectionMapping);

        // Initialize section options based on current grade
        const currentGrade = document.getElementById('gradeFilter').value;
        const currentSection = '{{ is_string($section ?? "all") ? ($section ?? "all") : "all" }}';

        console.log('Current grade:', currentGrade);
        console.log('Current section:', currentSection);

        // Update section options for the current grade
        const sectionSelect = document.getElementById('sectionFilter');
        console.log('Section select element:', sectionSelect);

        sectionSelect.innerHTML = '<option value="all">All Sections</option>';

        if (gradeSectionMapping[currentGrade]) {
            console.log('Adding sections for grade:', currentGrade, gradeSectionMapping[currentGrade]);
            gradeSectionMapping[currentGrade].forEach(section => {
                const option = document.createElement('option');
                option.value = section.toLowerCase();
                option.textContent = section.charAt(0).toUpperCase() + section.slice(1);
                if (section.toLowerCase() === currentSection.toLowerCase()) {
                    option.selected = true;
                }
                sectionSelect.appendChild(option);
            });
        } else {
            console.log('No sections found for grade:', currentGrade);
        }

        // Set the current section if it exists
        if (currentSection !== 'all') {
            sectionSelect.value = currentSection.toLowerCase();
        }

        console.log('Final section select HTML:', sectionSelect.innerHTML);

        // Update chart title based on current selection
        const chartTitle = currentSection === 'all'
            ? `📊 Reading Performance Distribution - Grade ${currentGrade} (All Sections)`
            : `📊 Reading Performance Distribution - Grade ${currentGrade} - ${currentSection.charAt(0).toUpperCase() + currentSection.slice(1)}`;
        document.getElementById('chartTitle').textContent = chartTitle;

        // Load initial comprehension data
        fetchEnglishComprehensionData(currentGrade, currentSection);
    });
</script>
@endsection