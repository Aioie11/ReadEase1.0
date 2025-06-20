@extends('layouts.head-tech')

@section('title', content: 'Teacher Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <style>
            /* Dashboard Header */
            .dashboard-header {
                text-align: center;
                margin-bottom: 3rem;
                padding: 2rem;
                background: linear-gradient(135deg, #00B8A9 0%, #009688 100%);
                color: white;
                border-radius: 15px;
                box-shadow: 0 8px 32px rgba(0, 184, 169, 0.3);
            }

            .dashboard-header h1 {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
            }

            .dashboard-header p {
                font-size: 1.2rem;
                opacity: 0.9;
                margin: 0;
            }

            /* Performance Overview */
            .stats-overview {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
                margin-bottom: 3rem;
                max-width: 900px;
                margin-left: auto;
                margin-right: auto;
            }

            .stat-card {
                background: white;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                display: flex;
                align-items: center;
                gap: 1.5rem;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border-left: 4px solid var(--primary);
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            }

            .stat-icon {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #00B8A9 0%, #009688 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.5rem;
            }

            .stat-content h3 {
                font-size: 2rem;
                font-weight: 700;
                color: var(--primary);
                margin: 0 0 0.5rem 0;
            }

            .stat-content p {
                color: #6b7280;
                margin: 0;
                font-weight: 500;
            }



            /* Welcome Message */
            .welcome-message {
                margin-bottom: 3rem;
                text-align: center;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                padding: 3rem 2rem;
                border-radius: 20px;
                border: 1px solid #e2e8f0;
            }

            .welcome-content h2 {
                color: var(--primary);
                margin-bottom: 1rem;
                font-size: 2rem;
                font-weight: 700;
            }

            .welcome-content p {
                color: #64748b;
                font-size: 1.1rem;
                margin: 0;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

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