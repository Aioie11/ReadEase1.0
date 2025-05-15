<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadEase - Teacher Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
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

        /* Header Styles */
        header {
            background: var(--primary);
            padding: 1rem 5%;
            position: fixed;
            width: 100%;
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

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--neutral-light);
            text-decoration: none;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
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
            gap: 0.8rem;
        }

        .sidebar-logo i {
            color: var(--accent);
            font-size: 1.8rem;
        }

        /* Navigation Styles */
        .nav-menu {
            list-style: none;
            margin-bottom: 2rem;
            padding: 0;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
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
            background: transparent;
        }

        .nav-link:hover {
            background: var(--secondary);
            color: var(--neutral-light);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: var(--secondary);
            color: var(--neutral-light);
            transform: translateX(5px);
            font-weight: 500;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-link span {
            flex: 1;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 6rem 5% 2rem;
            transition: var(--transition);
        }

        /* Report Container Styles */
        .report-container {
            background: var(--neutral-light);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .report-header {
            margin-bottom: 2rem;
        }

        .report-header h2 {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .report-header h3 {
            color: var(--text-light);
            font-size: 1.2rem;
        }

        /* Student Cards */
        .student-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .student-column {
            background: var(--neutral-light);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .student-column h4 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .section-box {
            background: var(--neutral);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            position: relative;
        }

        .label-box {
            position: absolute;
            bottom: -0.8rem;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent);
            color: var(--neutral-light);
            padding: 0.25rem 1rem;
            border-radius: 5px;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .bold-value {
            font-weight: 600;
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
            <a href="#" class="sidebar-logo">
                <i class="fas fa-book-reader"></i>
                ReadEase
            </a>
        </div>
        <nav>
            <ul class="nav-menu">
                <div class="nav-section">
                    <li class="nav-item">
                        <a href="{{ route('teacher.readinglanguage') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tasks"></i>
                            <span>Assessments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.viewreports') }}" class="nav-link active">
                            <i class="fas fa-chart-bar"></i>
                            <span>View Reports</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="teacher-profile">
                <div class="teacher-avatar">T</div>
                <div class="teacher-info">
                    <div class="teacher-name">Teacher Name</div>
                    <div class="teacher-role">English Teacher</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Header -->
    <header>
        <div class="header-container">
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info">
                <span>Welcome, Teacher</span>
                <div class="user-avatar">T</div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="report-container">
            <div class="report-header">
                <h2>STUDENT {{ strtoupper($language) }} REPORTS</h2>
                <h3>Grade 7 Students : <span class="underline">SECTION {{ strtoupper($section) }}</span></h3>
            </div>

            <!-- STUDENT CARD DISPLAY -->
            <div class="student-wrapper">
                @if($students->count() > 0)
                    @foreach($students as $i => $student)
                        <div class="student-column">
                            <h4>{{ $i + 1 }}. {{ $student['student_name'] }}</h4>

                            <!-- READING SPEED CHART -->
                            <div class="section-box">
                                <div class="chart-section">
                                    <canvas id="chart{{ $i }}_reading"></canvas>
                                    <div class="label-box">READING SPEED: <span class="bold-value">{{ $student['reading_speed'] }} WPM</span></div>
                                </div>
                            </div>

                            <!-- COMPREHENSION CHART -->
                            <div class="section-box">
                                <div class="chart-section">
                                    <canvas id="chart{{ $i }}_comp"></canvas>
                                    <div class="label-box">COMPREHENSION: <span class="bold-value">{{ $student['comprehension'] }}</span></div>
                                </div>
                            </div>

                            <!-- WORD RECOGNITION CHART -->
                            <div class="section-box">
                                <div class="chart-section">
                                    <canvas id="chart{{ $i }}_word"></canvas>
                                    <div class="label-box">WORD READING: <span class="bold-value">{{ $student['word_label'] }}</span></div>
                                </div>
                            </div>

                            <!-- Assessment Details -->
                            <div class="assessment-details">
                                <p><strong>Reading Time:</strong> {{ number_format($student['reading_time'], 2) }} seconds</p>
                                <p><strong>Miscues:</strong> {{ $student['miscues'] }}</p>
                                <p><strong>Total Words:</strong> {{ $student['total_words'] }}</p>
                                <p><strong>Assessment Date:</strong> {{ \Carbon\Carbon::parse($student['assessment_date'])->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info w-100 text-center">
                        No reading data available for {{ strtoupper($section) }} section in {{ strtoupper($language) }}.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Chart.js initialization code
        @if($students->count() > 0)
        @foreach($students as $i => $student)
            const ctxR{{ $i }} = document.getElementById('chart{{ $i }}_reading');
            const ctxC{{ $i }} = document.getElementById('chart{{ $i }}_comp');
            const ctxW{{ $i }} = document.getElementById('chart{{ $i }}_word');

            // Reading Speed Chart
            new Chart(ctxR{{ $i }}, {
                type: 'bar',
                data: {
                    labels: ['Reading Time', 'Total Words'],
                    datasets: [{
                        data: [{{ $student['reading_time'] }}, {{ $student['total_words'] }}],
                        backgroundColor: ['#247ba0', '#70c1b3']
                    }]
                },
                options: {
                    indexAxis: 'y',
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: {{ $student['total_words'] }}
                        }
                    }
                }
            });

            // Word Reading Chart
            new Chart(ctxW{{ $i }}, {
                type: 'bar',
                data: {
                    labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
                    datasets: [{
                        data: [
                            {{ $student['miscues'] }},
                            {{ $student['total_words'] - $student['miscues'] }},
                            {{ $student['total_words'] }}
                        ],
                        backgroundColor: ['#94d2bd', '#caf0f8', '#f0efeb']
                    }]
                },
                options: {
                    indexAxis: 'y',
                    plugins: {
                        legend: { display: false },
                        datalabels: {
                            display: function(context) {
                                return context.dataIndex === 1;
                            },
                            anchor: 'start',
                            align: 'left',
                            formatter: function() {
                                return 'Correct Reading';
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        @endforeach
        @endif

        // Sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Add active state to nav links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            });
        });
    </script>
</body>
</html>
