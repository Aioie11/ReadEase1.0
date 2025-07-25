@extends('layouts.head-tech')

@section('title', content: 'Teacher Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <style>
            /* Main Content Layout - Exact Stud-Dash Styling */
            .main-content {
                padding: 100px 0px 0px 0px;
                background-color: #f8f9fa;
                min-height: 100vh;
            }

            /* Dashboard Header - Clean Stud-Dash Style */
            .dashboard-header {
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                border: 1px solid #e9ecef;
                margin-bottom: 30px;
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .dashboard-header:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .dashboard-header h1 {
                color: #2c3e50;
                font-size: 2.2rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
            }

            .dashboard-header p {
                color: #7f8c8d;
                font-size: 1.1rem;
                margin: 0;
            }

            /* Container - Clean Organization */
            .dashboard-container {
                max-width: 1200px;
                margin: 0 auto;
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
      max-width: auto;
    }
            /* Grade Levels Grid - Clean Stud-Dash Style */
            .grade-levels {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .grade-card {
                background: white;
                border-radius: 12px;
                padding: 25px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                border: 1px solid #e9ecef;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                cursor: pointer;
                position: relative;
                overflow: hidden;
            }

            .grade-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                background: white;
            }

            .grade-card h2 {
                color: #2c3e50;
                margin-bottom: 15px;
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 1.3em;
                font-weight: 700;
                padding-bottom: 10px;
                border-bottom: 1px solid #e9ecef;
            }

            .grade-card h2 i {
                color: #3498db;
                width: 20px;
            }

            .sections-list {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .section-item {
                padding: 15px;
                border-radius: 12px;
                margin-bottom: 10px;
                background: #f8f9fa;
                transition: all 0.2s ease;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: 1px solid #e9ecef;
                cursor: pointer;
            }

            .section-item:hover {
                transform: translateX(5px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                background: white;
            }

            .section-item:last-child {
                margin-bottom: 0;
            }

            .section-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .section-info i {
                color: #3498db;
                width: 16px;
            }

            .section-info span {
                color: #2c3e50;
                font-weight: 600;
            }

            .section-stats {
                display: flex;
                gap: 15px;
                font-size: 0.9rem;
            }

            .stat-item {
                display: flex;
                align-items: center;
                gap: 5px;
                color: #7f8c8d;
            }

            .stat-item i {
                color: #27ae60;
            }

            /* Dashboard Container - Clean Organization with proper top spacing */
            .dashboard-container {
                max-width: 1143px;
                margin: 0 auto;
                padding-top: 2rem;
                position: relative;
            }

            /* Responsive Design - Matching Student Dashboard */
            @media (max-width: 768px) {
                .main-content {
                    padding: 15px;
                }

                .dashboard-header {
                    margin-bottom: 2rem;
                    padding: 1.5rem;
                }

                .stats-overview {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                    margin-bottom: 2rem;
                }

                .grade-levels {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .grade-card {
                    padding: 1.5rem;
                }

                .welcome-message {
                    margin-bottom: 2rem;
                    padding: 2rem 1.5rem;
                }
            }
        </style>
        <!-- Dashboard Container - Clean Organization -->
        <div class="dashboard-container">
            <!-- Welcome Message -->
            <div class="welcome-message">
                <div class="welcome-content">
                    <h2>Teacher Dashboard</h2>
                    <p>Select a grade level below to view sections and manage your students' reading assessments. </p>
                </div>
            </div>

            <!-- Grade Levels -->
            <div class="grade-levels">
                <!-- Grade 7 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 7</h2>
                    <ul class="sections-list">
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'narra', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Narra</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 7)->where('section', 'Narra')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'lawaan', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Lawaan</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 7)->where('section', 'Lawaan')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'dao', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Dao</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 7)->where('section', 'Dao')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'mahugani', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Mahugani</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 7)->where('section', 'Mahugani')->count() }} Students
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Grade 8 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 8</h2>
                    <ul class="sections-list">
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'avocado', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Avocado</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 8)->where('section', 'Avocado')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'guava', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Guava</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 8)->where('section', 'Guava')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'duhat', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Duhat</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 8)->where('section', 'Duhat')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'mango', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Mango</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 8)->where('section', 'Mango')->count() }} Students
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Grade 9 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 9</h2>
                    <ul class="sections-list">
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'gold', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Gold</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 9)->where('section', 'Gold')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'silver', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Silver</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 9)->where('section', 'Silver')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'zinc', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Zinc</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 9)->where('section', 'Zinc')->count() }} Students
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Grade 10 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 10</h2>
                    <ul class="sections-list">
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'galileo', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Galileo</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 10)->where('section', 'Galileo')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'edison', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Edison</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 10)->where('section', 'Edison')->count() }} Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item"
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'newton', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Newton</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    {{ $students->where('grade_level', 10)->where('section', 'Newton')->count() }} Students
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> <!-- Close grade-levels -->
        </div> <!-- Close dashboard-container -->
    </div> <!-- Close main-content -->

    <script>
        // Add hover effect for grade cards
        document.querySelectorAll('.grade-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
                card.style.boxShadow = 'var(--shadow-lg)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'var(--shadow-md)';
            });
        });

        // Add click event for sections
        document.querySelectorAll('.section-item').forEach(section => {
            section.addEventListener('click', () => {
                // Add your section click handling logic here
                console.log('Section clicked:', section.querySelector('.section-info span').textContent);
            });
        });

        // Add sidebar toggle functionality
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

        // Enhanced hover effects - matching stud-dash style
        document.addEventListener('DOMContentLoaded', function () {
            // Enhanced hover effects for dashboard header and welcome message
            document.querySelectorAll('.dashboard-header, .welcome-message').forEach(element => {
                element.addEventListener('mouseenter', () => {
                    element.style.transform = 'translateY(-2px)';
                    element.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.12)';
                });

                element.addEventListener('mouseleave', () => {
                    element.style.transform = 'translateY(0)';
                    element.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.08)';
                });
            });

            // Enhanced section item interactions
            document.querySelectorAll('.section-item').forEach(section => {
                section.addEventListener('mouseenter', () => {
                    section.style.transform = 'translateX(5px)';
                    section.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.08)';
                    section.style.background = 'white';
                });

                section.addEventListener('mouseleave', () => {
                    section.style.transform = 'translateX(0)';
                    section.style.boxShadow = 'none';
                    section.style.background = '#f8f9fa';
                });
            });

            console.log('Teacher dashboard with clean stud-dash styling loaded successfully');
        });
    </script>
@endsection