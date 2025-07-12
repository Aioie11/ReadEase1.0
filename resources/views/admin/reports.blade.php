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
            margin-top: 60px;
            padding: 70px 30px 50px 50px;
            transition: var(--transition);
            max-width: calc(100% - 280px);
        }


        .page-header {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 1rem;
        }

        .page-header h1 {
            color: #00B8A9;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-header p {
            color: #7f8c8d;
            margin: 0.5rem 0 0 0;
            font-size: 1rem;
            line-height: 0.9;
        }



        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .chart-header h3 {
            color: #2c3e50;
            font-size: 1.1rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-header h3 i {
            color: #6c757d;
            font-size: 1rem;
        }



        .chart-content {
            position: relative;
        }

        .chart-legend {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
            font-size: 0.85rem;
            color: #495057;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .legend-color.independent {
            background-color: #4caf50;
        }

        .legend-color.instructional {
            background-color: #ffb300;
        }

        .legend-color.frustration {
            background-color: #e53935;
        }

        /* View Control Buttons */
        .view-controls {
            background: white;
            padding: 1.5rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .view-btn {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            color: #495057;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .view-btn:hover {
            background: #e9ecef;
            border-color: #00B8A9;
            color: #00B8A9;
        }

        .view-btn.active {
            background: #00B8A9;
            border-color: #00B8A9;
            color: white;
        }

        .view-container {
            display: none;
        }

        .view-container.active {
            display: block;
        }

        /* Grade Section Styling */
        .grade-section {
            margin-bottom: 3rem;
        }

        .grade-title {
            color: #00B8A9;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding: 1rem 0;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .grade-title::before {
            content: "📊";
            font-size: 1.2rem;
        }





        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .reports-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .filter-controls {
                grid-template-columns: 1fr;
            }

            .charts-section {
                grid-template-columns: 1fr;
            }

            .view-controls {
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
            }

            .view-btn {
                width: 100%;
                text-align: center;
            }

            .trends-content {
                grid-template-columns: 1fr;
            }

            .analysis-grid {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
            }

            .table-actions {
                width: 100%;
                justify-content: space-between;
            }

            .search-box input {
                width: 200px;
            }

            .table-pagination {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Add new row layout for overall charts */
        .charts-row {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .charts-row .chart-container {
            flex: 1 1 0;
            min-width: 350px;
            max-width: 100%;
        }

        @media (max-width: 1100px) {
            .charts-row {
                flex-direction: column;
                gap: 2rem;
            }
        }
    </style>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <h1>Reading and Comprehension Assessment Distribution Reports</h1>
            <p>Analysis of student word reading and comprehension performance by grade and language</p>
        </div>

        <!-- View Control Buttons -->
        <div class="view-controls">
            <button class="view-btn active" onclick="switchView('overall')">Overall Grade</button>
            <button class="view-btn" onclick="switchView('section')">All Section Grade Level</button>
        </div>

        <!-- Overall Grade View -->
        <div id="overall-view" class="view-container active">
            <!-- English Charts Row -->
            <div class="charts-row">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>
                            <i class="fas fa-chart-bar"></i>
                            English Word Reading Level Distribution By Grade
                        </h3>
                    </div>
                    <div class="chart-content">
                        <canvas id="readingLevelChartEnglish"></canvas>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color independent"></span>
                                <span>Independent (Word Reading: 97-100%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color instructional"></span>
                                <span>Instructional (Word Reading: 90-96%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color frustration"></span>
                                <span>Frustration (Word Reading: Below 90%)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>
                            <i class="fas fa-brain"></i>
                            English Comprehension Level Distribution By Grade
                        </h3>
                    </div>
                    <div class="chart-content">
                        <canvas id="comprehensionLevelChartEnglish"></canvas>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color independent"></span>
                                <span>Independent (Comprehension: 80-100%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color instructional"></span>
                                <span>Instructional (Comprehension: 59-79%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color frustration"></span>
                                <span>Frustration (Comprehension: Below 59%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filipino Charts Row -->
            <div class="charts-row">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>
                            <i class="fas fa-chart-bar"></i>
                            Filipino Word Reading Level Distribution By Grade
                        </h3>
                    </div>
                    <div class="chart-content">
                        <canvas id="readingLevelChartFilipino"></canvas>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color independent"></span>
                                <span>Independent (Word Reading: 97-100%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color instructional"></span>
                                <span>Instructional (Word Reading: 90-96%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color frustration"></span>
                                <span>Frustration (Word Reading: Below 90%)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>
                            <i class="fas fa-brain"></i>
                            Filipino Comprehension Level Distribution By Grade
                        </h3>
                    </div>
                    <div class="chart-content">
                        <canvas id="comprehensionLevelChartFilipino"></canvas>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color independent"></span>
                                <span>Independent (Comprehension: 80-100%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color instructional"></span>
                                <span>Instructional (Comprehension: 59-79%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color frustration"></span>
                                <span>Frustration (Comprehension: Below 59%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Grade Level View -->
        <div id="section-view" class="view-container">
            <!-- Grade 7 Section -->
            <div class="grade-section">
                <h2 class="grade-title">Grade 7</h2>
                <!-- English Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> English Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartEnglishSection7"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> English Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartEnglishSection7"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filipino Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> Filipino Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartFilipinoSection7"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> Filipino Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartFilipinoSection7"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grade 8 Section -->
            <div class="grade-section">
                <h2 class="grade-title">Grade 8</h2>
                <!-- English Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> English Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartEnglishSection8"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> English Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartEnglishSection8"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filipino Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> Filipino Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartFilipinoSection8"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> Filipino Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartFilipinoSection8"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grade 9 Section -->
            <div class="grade-section">
                <h2 class="grade-title">Grade 9</h2>
                <!-- English Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> English Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartEnglishSection9"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> English Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartEnglishSection9"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filipino Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> Filipino Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartFilipinoSection9"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> Filipino Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartFilipinoSection9"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grade 10 Section -->
            <div class="grade-section">
                <h2 class="grade-title">Grade 10</h2>
                <!-- English Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> English Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartEnglishSection10"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> English Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartEnglishSection10"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filipino Charts Row -->
                <div class="charts-row">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-chart-bar"></i> Filipino Word Reading Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="readingLevelChartFilipinoSection10"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Word Reading: 97-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Word Reading: 90-96%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Word Reading: Below 90%)</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3><i class="fas fa-brain"></i> Filipino Comprehension Level Distribution By Section</h3>
                        </div>
                        <div class="chart-content">
                            <canvas id="comprehensionLevelChartFilipinoSection10"></canvas>
                            <div class="chart-legend">
                                <div class="legend-item"><span class="legend-color independent"></span><span>Independent
                                        (Comprehension: 80-100%)</span></div>
                                <div class="legend-item"><span class="legend-color instructional"></span><span>Instructional
                                        (Comprehension: 59-79%)</span></div>
                                <div class="legend-item"><span class="legend-color frustration"></span><span>Frustration
                                        (Comprehension: Below 59%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // View switching functionality
        function switchView(viewType) {
            // Update button states
            document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Hide all views
            document.querySelectorAll('.view-container').forEach(container => {
                container.classList.remove('active');
            });

            // Show selected view
            if (viewType === 'overall') {
                document.getElementById('overall-view').classList.add('active');
            } else if (viewType === 'section') {
                document.getElementById('section-view').classList.add('active');
                // Initialize section charts if not already done
                if (!window.sectionChartsInitialized) {
                    initializeSectionCharts();
                    window.sectionChartsInitialized = true;
                }
            }
        }

        // Fetch English reading level distribution
        async function fetchEnglishReadingLevelDistribution() {
            try {
                const response = await fetch('/api/reading-level-distribution/english');
                const data = await response.json();

                if (data.success) {
                    const distribution = data.data.distribution;
                    const grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];

                    // Update English Chart
                    const englishChart = Chart.getChart('readingLevelChartEnglish');
                    if (englishChart) {
                        englishChart.data.datasets[0].data = grades.map(g => distribution[g]?.['Independent'] || 0);
                        englishChart.data.datasets[1].data = grades.map(g => distribution[g]?.['Instructional'] || 0);
                        englishChart.data.datasets[2].data = grades.map(g => distribution[g]?.['Frustration'] || 0);
                        englishChart.update();
                    }
                }
            } catch (error) {
                console.error('Error fetching English reading level distribution:', error);
            }
        }

        // Fetch Filipino reading level distribution
        async function fetchFilipinoReadingLevelDistribution() {
            try {
                const response = await fetch('/api/reading-level-distribution/filipino');
                const data = await response.json();

                if (data.success) {
                    const distribution = data.data.distribution;
                    const grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];

                    // Update Filipino Chart
                    const filipinoChart = Chart.getChart('readingLevelChartFilipino');
                    if (filipinoChart) {
                        filipinoChart.data.datasets[0].data = grades.map(g => distribution[g]?.['Independent'] || 0);
                        filipinoChart.data.datasets[1].data = grades.map(g => distribution[g]?.['Instructional'] || 0);
                        filipinoChart.data.datasets[2].data = grades.map(g => distribution[g]?.['Frustration'] || 0);
                        filipinoChart.update();
                    }
                }
            } catch (error) {
                console.error('Error fetching Filipino reading level distribution:', error);
            }
        }

        // Fetch English comprehension level distribution
        async function fetchEnglishComprehensionLevelDistribution() {
            try {
                const response = await fetch('/api/comprehension-level-distribution/english');
                const data = await response.json();

                if (data.success) {
                    const distribution = data.data.distribution;
                    const grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];

                    // Update English Comprehension Chart
                    const englishCompChart = Chart.getChart('comprehensionLevelChartEnglish');
                    if (englishCompChart) {
                        englishCompChart.data.datasets[0].data = grades.map(g => distribution[g]?.['Independent'] || 0);
                        englishCompChart.data.datasets[1].data = grades.map(g => distribution[g]?.['Instructional'] || 0);
                        englishCompChart.data.datasets[2].data = grades.map(g => distribution[g]?.['Frustration'] || 0);
                        englishCompChart.update();
                    }
                }
            } catch (error) {
                console.error('Error fetching English comprehension level distribution:', error);
            }
        }

        // Fetch Filipino comprehension level distribution
        async function fetchFilipinoComprehensionLevelDistribution() {
            try {
                const response = await fetch('/api/comprehension-level-distribution/filipino');
                const data = await response.json();

                if (data.success) {
                    const distribution = data.data.distribution;
                    const grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];

                    // Update Filipino Comprehension Chart
                    const filipinoCompChart = Chart.getChart('comprehensionLevelChartFilipino');
                    if (filipinoCompChart) {
                        filipinoCompChart.data.datasets[0].data = grades.map(g => distribution[g]?.['Independent'] || 0);
                        filipinoCompChart.data.datasets[1].data = grades.map(g => distribution[g]?.['Instructional'] || 0);
                        filipinoCompChart.data.datasets[2].data = grades.map(g => distribution[g]?.['Frustration'] || 0);
                        filipinoCompChart.update();
                    }
                }
            } catch (error) {
                console.error('Error fetching Filipino comprehension level distribution:', error);
            }
        }



        // Initialize charts
        const grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];

        // English Chart
        const readingDataEnglish = {
            labels: grades,
            datasets: [
                {
                    label: 'Independent',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#4caf50',
                    stack: 'Stack 0',
                },
                {
                    label: 'Instructional',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#ffb300',
                    stack: 'Stack 0',
                },
                {
                    label: 'Frustration',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#e53935',
                    stack: 'Stack 0',
                }
            ]
        };

        const readingConfigEnglish = {
            type: 'bar',
            data: readingDataEnglish,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: { display: false }
                },
                scales: {
                    x: { stacked: true, title: { display: true, text: 'Grade Level' } },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Number of Students' },
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                return Math.round(value);
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('readingLevelChartEnglish'), readingConfigEnglish);

        // Filipino Chart
        const readingDataFilipino = {
            labels: grades,
            datasets: [
                {
                    label: 'Independent',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#4caf50',
                    stack: 'Stack 0',
                },
                {
                    label: 'Instructional',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#ffb300',
                    stack: 'Stack 0',
                },
                {
                    label: 'Frustration',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#e53935',
                    stack: 'Stack 0',
                }
            ]
        };

        const readingConfigFilipino = {
            type: 'bar',
            data: readingDataFilipino,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: { display: false }
                },
                scales: {
                    x: { stacked: true, title: { display: true, text: 'Grade Level' } },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Number of Students' },
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                return Math.round(value);
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('readingLevelChartFilipino'), readingConfigFilipino);

        // English Comprehension Chart
        const comprehensionDataEnglish = {
            labels: grades,
            datasets: [
                {
                    label: 'Independent',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#4caf50',
                    stack: 'Stack 0',
                },
                {
                    label: 'Instructional',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#ffb300',
                    stack: 'Stack 0',
                },
                {
                    label: 'Frustration',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#e53935',
                    stack: 'Stack 0',
                }
            ]
        };

        const comprehensionConfigEnglish = {
            type: 'bar',
            data: comprehensionDataEnglish,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: { display: false }
                },
                scales: {
                    x: { stacked: true, title: { display: true, text: 'Grade Level' } },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Number of Students' },
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                return Math.round(value);
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('comprehensionLevelChartEnglish'), comprehensionConfigEnglish);

        // Filipino Comprehension Chart
        const comprehensionDataFilipino = {
            labels: grades,
            datasets: [
                {
                    label: 'Independent',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#4caf50',
                    stack: 'Stack 0',
                },
                {
                    label: 'Instructional',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#ffb300',
                    stack: 'Stack 0',
                },
                {
                    label: 'Frustration',
                    data: [0, 0, 0, 0],
                    backgroundColor: '#e53935',
                    stack: 'Stack 0',
                }
            ]
        };

        const comprehensionConfigFilipino = {
            type: 'bar',
            data: comprehensionDataFilipino,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: { display: false }
                },
                scales: {
                    x: { stacked: true, title: { display: true, text: 'Grade Level' } },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: { display: true, text: 'Number of Students' },
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                return Math.round(value);
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('comprehensionLevelChartFilipino'), comprehensionConfigFilipino);

        // Initialize section charts
        function initializeSectionCharts() {
            // Initialize charts for each grade (7-10)
            const grades = [7, 8, 9, 10];

            grades.forEach(grade => {
                // Initialize section labels (will be updated dynamically)
                const sectionLabels = [];

                // Chart configuration template
                const chartConfig = {
                    type: 'bar',
                    data: {
                        labels: sectionLabels,
                        datasets: [
                            {
                                label: 'Independent',
                                data: [],
                                backgroundColor: '#4caf50',
                                stack: 'Stack 0',
                            },
                            {
                                label: 'Instructional',
                                data: [],
                                backgroundColor: '#ffb300',
                                stack: 'Stack 0',
                            },
                            {
                                label: 'Frustration',
                                data: [],
                                backgroundColor: '#e53935',
                                stack: 'Stack 0',
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true, position: 'top' },
                            title: { display: false }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                title: { display: true, text: 'Section' },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                title: { display: true, text: 'Number of Students' },
                                ticks: {
                                    stepSize: 1,
                                    callback: function (value) {
                                        return Math.round(value);
                                    }
                                }
                            }
                        }
                    }
                };

                // Create charts for each grade
                new Chart(document.getElementById(`readingLevelChartEnglishSection${grade}`), JSON.parse(JSON.stringify(chartConfig)));
                new Chart(document.getElementById(`readingLevelChartFilipinoSection${grade}`), JSON.parse(JSON.stringify(chartConfig)));
                new Chart(document.getElementById(`comprehensionLevelChartEnglishSection${grade}`), JSON.parse(JSON.stringify(chartConfig)));
                new Chart(document.getElementById(`comprehensionLevelChartFilipinoSection${grade}`), JSON.parse(JSON.stringify(chartConfig)));
            });

            // Fetch section data for all grades
            fetchSectionDataForAllGrades();
        }

        // Fetch section data for all grades
        async function fetchSectionDataForAllGrades() {
            try {
                // Fetch all section data
                const [englishReading, filipinoReading, englishComp, filipinoComp] = await Promise.all([
                    fetch('/api/reading-level-distribution/english/by-section').then(r => r.json()),
                    fetch('/api/reading-level-distribution/filipino/by-section').then(r => r.json()),
                    fetch('/api/comprehension-level-distribution/english/by-section').then(r => r.json()),
                    fetch('/api/comprehension-level-distribution/filipino/by-section').then(r => r.json())
                ]);

                // Process and update charts for each grade
                const grades = [7, 8, 9, 10];

                grades.forEach(grade => {
                    // Filter data for this grade
                    const gradePrefix = `Grade ${grade} - `;

                    // English Reading
                    if (englishReading.success) {
                        const gradeData = Object.keys(englishReading.data.distribution)
                            .filter(key => key.startsWith(gradePrefix))
                            .reduce((obj, key) => {
                                obj[key.replace(gradePrefix, '')] = englishReading.data.distribution[key];
                                return obj;
                            }, {});

                        updateGradeChart(`readingLevelChartEnglishSection${grade}`, gradeData);
                    }

                    // Filipino Reading
                    if (filipinoReading.success) {
                        const gradeData = Object.keys(filipinoReading.data.distribution)
                            .filter(key => key.startsWith(gradePrefix))
                            .reduce((obj, key) => {
                                obj[key.replace(gradePrefix, '')] = filipinoReading.data.distribution[key];
                                return obj;
                            }, {});

                        updateGradeChart(`readingLevelChartFilipinoSection${grade}`, gradeData);
                    }

                    // English Comprehension
                    if (englishComp.success) {
                        const gradeData = Object.keys(englishComp.data.distribution)
                            .filter(key => key.startsWith(gradePrefix))
                            .reduce((obj, key) => {
                                obj[key.replace(gradePrefix, '')] = englishComp.data.distribution[key];
                                return obj;
                            }, {});

                        updateGradeChart(`comprehensionLevelChartEnglishSection${grade}`, gradeData);
                    }

                    // Filipino Comprehension
                    if (filipinoComp.success) {
                        const gradeData = Object.keys(filipinoComp.data.distribution)
                            .filter(key => key.startsWith(gradePrefix))
                            .reduce((obj, key) => {
                                obj[key.replace(gradePrefix, '')] = filipinoComp.data.distribution[key];
                                return obj;
                            }, {});

                        updateGradeChart(`comprehensionLevelChartFilipinoSection${grade}`, gradeData);
                    }
                });

            } catch (error) {
                console.error('Error fetching section data for all grades:', error);
            }
        }

        // Helper function to update individual grade charts
        function updateGradeChart(chartId, gradeData) {
            const chart = Chart.getChart(chartId);
            if (chart) {
                // Always update the chart, even if there's no data
                const sectionLabels = Object.keys(gradeData);
                chart.data.labels = sectionLabels;
                chart.data.datasets[0].data = sectionLabels.map(s => gradeData[s]?.['Independent'] || 0);
                chart.data.datasets[1].data = sectionLabels.map(s => gradeData[s]?.['Instructional'] || 0);
                chart.data.datasets[2].data = sectionLabels.map(s => gradeData[s]?.['Frustration'] || 0);
                chart.update();
            }
        }

        // Fetch initial data
        fetchEnglishReadingLevelDistribution();
        fetchFilipinoReadingLevelDistribution();
        fetchEnglishComprehensionLevelDistribution();
        fetchFilipinoComprehensionLevelDistribution();
    </script>
@endsection