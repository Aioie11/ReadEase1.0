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
        max-width: calc(100% - 280px);
    }


    .page-header {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .page-header h1 {
            color: #00B8A9;;
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


</style>

<!-- Main Content -->
<main class="main-content">
    <div class="page-header">
                <h1>Reading and Comprehension Assessment Distribution Reports</h1>
                <p>Analysis of student word reading and comprehension performance by grade and language</p>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <!-- Reading Level Distribution Charts -->
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
                    <i class="fas fa-chart-bar"></i>
                    Filipino Reading Level Distribution By Grade
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

        <!-- Comprehension Level Distribution Charts -->
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
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
                        callback: function(value) {
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
                        callback: function(value) {
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
                        callback: function(value) {
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
                        callback: function(value) {
                            return Math.round(value);
                        }
                    }
                }
            }
        }
    };

    new Chart(document.getElementById('comprehensionLevelChartFilipino'), comprehensionConfigFilipino);

    // Fetch initial data
    fetchEnglishReadingLevelDistribution();
    fetchFilipinoReadingLevelDistribution();
    fetchEnglishComprehensionLevelDistribution();
    fetchFilipinoComprehensionLevelDistribution();
</script>
@endsection