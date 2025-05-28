@extends('layouts.head-tech')

@section('title', content: 'Teacher Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <style>

            /* Grade Levels Grid */
            .grade-levels {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }

            .grade-card {
                background: var(--neutral-light);
                border-radius: 15px;
                padding: 1.5rem;
                box-shadow: var(--shadow-md);
                transition: var(--transition);
                cursor: pointer;
                position: relative;
                overflow: hidden;
            }

            .grade-card:hover {
                transform: translateY(-5px);
                box-shadow: var(--shadow-lg);
            }

            .grade-card h2 {
                color: var(--primary);
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .grade-card h2 i {
                color: var(--accent);
            }

            .sections-list {
                list-style: none;
                margin-top: 1rem;
            }

            .section-item {
                padding: 0.8rem;
                border-radius: 8px;
                margin-bottom: 0.5rem;
                background: var(--neutral);
                transition: var(--transition);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .section-item:hover {
                background: var(--secondary);
                color: var(--neutral-light);
            }

            .section-info {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .section-stats {
                display: flex;
                gap: 1rem;
                font-size: 0.9rem;
            }

            .stat-item {
                display: flex;
                align-items: center;
                gap: 0.3rem;
            }
        </style>

        <!-- Dashboard Content -->
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Teacher Dashboard</h1>
                <p>Manage your classes and track student progress</p>
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
                                    25 Students
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
                                    28 Students
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
                                    30 Students
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
                                    27 Students
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
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'narra', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Narra</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    24 Students
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
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'narra', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Narra</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    22 Students
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
                            onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'narra', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Narra</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    20 Students
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
    </script>
@endsection