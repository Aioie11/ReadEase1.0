<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
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
            gap: 0.5rem;
        }

        .sidebar-logo img {
            height: 45px;
            width: 45px;
            object-fit: contain;
        }

        .sidebar-logo span {
            font-size: 1.8rem;
            background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .nav-menu {
            list-style: none;
            margin-bottom: 2rem;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            color: var(--neutral-light);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 1rem;
            margin-bottom: 0.5rem;
            opacity: 0.7;
        }

        .nav-item {
            margin-bottom: 0.3rem;
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
        }

        .nav-link:hover, .nav-link.active {
            background: var(--secondary);
            color: var(--neutral-light);
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-link .badge {
            margin-left: auto;
            background: var(--accent);
            color: var(--neutral-light);
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .student-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .student-info {
            flex: 1;
        }

        .student-name {
            font-weight: 600;
            margin-bottom: 0.2rem;
            font-size: 1rem;
            letter-spacing: 0.3px;
            background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .student-role {
            font-size: 0.85rem;
            opacity: 0.9;
            color: #e0e0e0;
            letter-spacing: 0.2px;
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
            <a href="{{ url('/') }}" class="sidebar-logo">
                <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo">
                <span>ReadEase</span>
            </a>
        </div>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.test-management') }}" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        Test Management
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.student-records') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        Student Record
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user-management') }}" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        User Management
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reports') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Reports
                    </a>
                </li>
                
            </ul>
        </nav>
    </aside>

    <!-- Header -->
    <header>
        <div class="header-container">
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info">
                <span>Welcome, Admin</span>
            </div>
        </div>
    </header>


    @yield ('content')
    
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