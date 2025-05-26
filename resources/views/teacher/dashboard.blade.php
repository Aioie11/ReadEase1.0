<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadEase - Reading Language</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .logo span {
            font-size: 1.5rem;
            font-weight: 700;
            margin-left: 0.8rem;
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

        /* Dashboard Content */
        .dashboard {
            padding: 6rem 5% 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-header h1 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .dashboard-header p {
            color: var(--text-light);
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

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .action-card {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
            text-align: center;
        }

        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            background: var(--primary);
            color: var(--neutral-light);
        }

        .action-card i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--accent);
        }

        .action-card:hover i {
            color: var(--neutral-light);
        }

        /* Recent Activity */
        .recent-activity {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .activity-header h2 {
            color: var(--primary);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            padding: 1rem;
            border-bottom: 1px solid var(--neutral-dark);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--neutral);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .activity-details {
            flex: 1;
        }

        .activity-time {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background: var(--primary);
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 1001;
            box-shadow: 2px 0 8px #0001;
        }

        .sidebar-header {
            padding: 2rem 1.5rem 1rem 1.5rem;
            border-bottom: 1px solid #ffffff22;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            margin-left: 0.5rem;
        }

        .sidebar-logo img {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        .sidebar-logo span {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 0.5px;
        }

        /* Navigation Styles */
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0 0;
            flex: 1;
        }

        .nav-item {
            margin-bottom: 0.7rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.9rem 1.5rem;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.08rem;
            font-weight: 500;
            transition: var(--transition);
            background: transparent;
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 22px;
            text-align: center;
        }

        .nav-link.active, .nav-link:focus, .nav-link.selected {
            background: #388ee7;
            color: #fff;
            font-weight: 700;
            box-shadow: 0 2px 8px #0002;
        }

        .nav-link:hover {
            background: #2196f3;
            color: #fff;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid #ffffff22;
            color: #e3e3e3;
        }

        .teacher-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .teacher-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #fff;
        }

        .teacher-info {
            flex: 1;
        }

        .teacher-name {
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .teacher-role {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Adjust main content for sidebar */
        .main-content {
            margin-left: 250px;
            transition: var(--transition);
        }

        /* Adjust header for sidebar */
        header {
            margin-left: 250px;
            width: calc(100% - 250px);
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
            <a href="{{ route('teacher.dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo">
                <span>ReadEase</span>
            </a>
        </div>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        Assessments
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        Students
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.viewreports') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>View Reports</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="teacher-profile">
                <div class="teacher-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="teacher-info">
                    <div class="teacher-name">{{ auth()->user()->name }}</div>
                    <div class="teacher-role">Grade {{ auth()->user()->grade }} Teacher</div>
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
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Teacher Dashboard</h1>
                <p>Manage your classes and track student progress</p>
            </div>

            <!-- Quick Actions -->

            <!-- Grade Levels -->
            <div class="grade-levels">
                <!-- Grade 7 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 7</h2>
                    <ul class="sections-list">
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'narra', 'language' => 'english']) }}'">
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
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'lawaan', 'language' => 'english']) }}'">
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
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'dao', 'language' => 'english']) }}'">
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
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade7', 'section' => 'mahugani', 'language' => 'english']) }}'">
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
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'guava', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Guava</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    32 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'duhat', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Duhat</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    29 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'avocado', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Avocado</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    27 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade8', 'section' => 'mango', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Mango</span>
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

                <!-- Grade 9 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 9</h2>
                    <ul class="sections-list">
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'zinc', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Zinc</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    32 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'gold', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Gold</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    29 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade9', 'section' => 'silver', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Silver</span>
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

                <!-- Grade 10 -->
                <div class="grade-card">
                    <h2><i class="fas fa-graduation-cap"></i> Grade 10</h2>
                    <ul class="sections-list">
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'newton', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Newton</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    32 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'galileo', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Galileo</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    29 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'edison', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                                <span>Section Edison</span>
                            </div>
                            <div class="section-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user"></i>
                                    27 Students
                                </span>
                            </div>
                        </li>
                        <li class="section-item" onclick="window.location.href='{{ route('teacher.passage', ['grade' => 'grade10', 'section' => 'edison', 'language' => 'english']) }}'">
                            <div class="section-info">
                                <i class="fas fa-book"></i>
                            <span>Section Einstien</span>
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

        // Add click event for quick action cards
        document.querySelectorAll('.action-card').forEach(card => {
            card.addEventListener('click', () => {
                // Add your action card click handling logic here
                console.log('Action clicked:', card.querySelector('h3').textContent);
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
</body>
</html>