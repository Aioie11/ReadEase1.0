<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/readease-colors.css') }}">
    <style>
        :root {
            /* ReadEase Teal Theme - Consistent with Filipino Report */
            --primary: #00B8A9;
            --primary-light: #4DD0E1;
            --primary-dark: #009688;
            --primary-slight: rgb(3, 204, 187);

            /* Secondary - Navigation and Secondary UI */
            --secondary: #F6AD55;
            --secondary-light: #FFB74D;

            /* Accent - Buttons and Highlights */
            --accent: #00B8A9;
            --accent-light: #4DD0E1;

            /* Neutral - Backgrounds */
            --neutral: #F7FAFC;
            --neutral-light: #E2E8F0;
            --neutral-dark: #2D3748;

            /* Text - Main Text and Headings */
            --text: #1A202C;
            --text-light: #718096;
            --text-white: #FFFFFF;

            /* Status Colors */
            --success: #00B8A9;
            --warning: #F6AD55;
            --danger: #E53E3E;
            --info: #4FC3F7;

            /* Gradients */
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);

            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);

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
            left: 0;
            z-index: 1002;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            margin-left: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Ensure header shadow is always visible */
        header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent);
            pointer-events: none;
            z-index: -1;
        }



        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .readease-logo {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--neutral-light);
            text-decoration: none;
        }

        .header-left-section {
            display: flex;
            align-items: center;
        }

        .header-right-section {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .teacher-user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
            position: relative;
            margin-left: auto;
        }



        /* Teacher User Dropdown Styles */
        .teacher-user-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .teacher-user-dropdown:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .teacher-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-slight);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            color: var(--neutral-light);
        }

        .teacher-user-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.3rem;
        }

        .teacher-user-name {
            font-weight: 600;
            font-size: 0.95rem;
            line-height: 1.2;
            margin-bottom: 0.1rem;
        }

        .teacher-user-role {
            font-size: 0.8rem;
            opacity: 0.8;
            line-height: 1;
        }

        .teacher-dropdown-arrow {
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .teacher-user-dropdown.active .teacher-dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Teacher Dropdown Menu */
        .teacher-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--neutral-light);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            margin-top: 0.5rem;
            border: 1px solid #e0e0e0;
        }

        .teacher-dropdown-menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            display: block !important;
            background: white !important;
            border: 2px solid #0E61BA !important;
            z-index: 9999 !important;
            position: absolute !important;
        }

        /* Alternative hover-based dropdown for testing */
        .teacher-user-dropdown:hover .teacher-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            display: block;
        }

        .teacher-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            border-bottom: 1px solid var(--neutral-dark);
        }

        .teacher-dropdown-item:last-child {
            border-bottom: none;
        }

        .teacher-dropdown-item:hover {
            background: var(--neutral);
            color: var(--primary);
        }

        .teacher-dropdown-item i {
            width: 16px;
            text-align: center;
            font-size: 0.9rem;
        }

        .teacher-logout-item {
            color: var(--text);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .teacher-logout-item:hover {
            background: #dc3545 !important;
            color: white !important;
            transform: translateX(5px);
        }

        .teacher-logout-item:active {
            transform: scale(0.95);
        }

        /* Dashboard Content */
        .dashboard {
            padding: 7rem 5% 2rem;
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
            top: 70px;
            /* Push below header */
            height: calc(100vh - 70px);
            /* Full height minus header */
            width: 260px;
            background: var(--primary);
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Mobile sidebar - hidden by default */
        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
                /* Hidden by default on mobile */
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .sidebar.active {
                left: 0;
                /* Show sidebar when burger menu is clicked */
            }
        }

        /* Desktop sidebar always visible */
        @media (min-width: 769px) {
            .sidebar {
                left: 0;
            }
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
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
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

        .nav-link:hover,
        .nav-link.active {
            background: var(--primary-slight);
            color: var(--neutral-light);
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(246, 173, 85, 0.3);
        }

        /* Ensure header shadow persists on all pages including reports */
        body {
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 70px;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent);
            z-index: 1001;
            pointer-events: none;
        }

        .nav-link.active {
            background: var(--primary-slight);
            position: relative;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 100%;
            background: var(--neutral-light);
            border-radius: 2px;
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

        .teacher-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        .teacher-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-slight);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .teacher-info {
            flex: 1;
        }

        .teacher-name {
            font-weight: 600;
            margin-bottom: 0.2rem;
            font-size: 1rem;
            letter-spacing: 0.3px;
            background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .teacher-assignment {
            font-size: 0.85rem;
            opacity: 0.9;
            color: #e0e0e0;
            letter-spacing: 0.2px;
        }

        /* Adjust main content for sidebar */
        .main-content {
            margin-left: 260px;
            /* Same as sidebar width */
            padding-top: 70px;
            /* Same as header height */
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: calc(100vh - 70px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
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

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none;
            }
        }

        /* Sidebar Menu Toggle Button - Hidden by default, only shows on mobile */
        .sidebar-menu-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 0.6rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .sidebar-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .sidebar-menu-toggle {
                display: flex;
                /* Show burger menu only on mobile */
                align-items: center;
                justify-content: center;
                margin-left: 1rem;
                order: 2;
                /* Place burger menu after user dropdown */
            }

            .teacher-user-details {
                display: none;
                /* Hide user details on mobile */
            }

            .teacher-user-dropdown {
                padding: 0.5rem;
                gap: 0.5rem;
            }

            .teacher-user-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }

            /* Sidebar overlay for mobile */
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }

        @media (max-width: 480px) {
            .sidebar-menu-toggle {
                padding: 0.5rem;
                margin-left: 0.5rem;
            }

            .teacher-user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            .teacher-user-info {
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <!-- Removed sidebar logo and title -->
        </div>
        <nav>
            <ul class="nav-menu">
                <div class="nav-section">
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}"
                            class="nav-link {{ Route::currentRouteName() == 'teacher.dashboard' ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.student-management') }}"
                            class="nav-link {{ Route::currentRouteName() == 'teacher.student-management' ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            Student Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.grade-management') }}"
                            class="nav-link {{ Route::currentRouteName() == 'teacher.grade-management' ? 'active' : '' }}">
                            <i class="fas fa-graduation-cap"></i>
                            Grade Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.viewreports') }}"
                            class="nav-link {{ Route::currentRouteName() == 'teacher.viewreports' ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            Reports
                        </a>
                    </li>
                </div>
            </ul>
        </nav>


        <div class="sidebar-footer">
            <div class="teacher-profile">
                <div class="teacher-avatar">{{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '' }}</div>
                <div class="teacher-info">
                    <div class="teacher-name">{{ Auth::user() ? Auth::user()->name : '' }}</div>
                    <div class="teacher-assignment">
                        @if(Auth::user() && Auth::user()->teacherGrade)
                            Grade {{ Auth::user()->teacherGrade }} Teacher
                        @else
                            Teacher
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <header>
        <div class="header-container">
            <div class="header-left-section">
                <a class="readease-logo" style="display: flex; align-items: center; gap: 0.7rem;">
                    <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo"
                        style="height: 75px; width: 75px; object-fit: contain;">
                    <span>ReadEase</span>
                </a>
            </div>
            <div class="header-right-section">
                <div class="teacher-user-info">
                    <div class="teacher-user-dropdown" id="teacherUserDropdownToggle">
                        <div class="teacher-user-avatar">
                            {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '' }}
                        </div>
                        <div class="teacher-user-details">
                            <div class="teacher-user-name">{{ Auth::user() ? Auth::user()->name : '' }}</div>
                            <div class="teacher-user-role">
                                @if(Auth::user() && Auth::user()->teacherGrade)
                                    Grade {{ Auth::user()->teacherGrade }} Teacher
                                @else
                                    {{ Auth::user() ? ucfirst(Auth::user()->role) : '' }}
                                @endif
                            </div>
                        </div>

                        <!-- Teacher Dropdown Menu -->
                        <div class="teacher-dropdown-menu" id="teacherUserDropdownMenu">
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;"
                                id="teacherLogoutForm">
                                @csrf
                                <button type="submit" class="teacher-dropdown-item teacher-logout-item"
                                    style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;"
                                    onclick="console.log('Teacher logout button clicked');">
                                    <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                        <path
                                            d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <button class="sidebar-menu-toggle" id="sidebarMenuToggle">
                        <svg viewBox="0 0 24 24" fill="currentColor" style="width: 20px; height: 20px;">
                            <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                        </svg>
                    </button>
                </div>
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

        // Teacher user dropdown functionality
        function toggleTeacherUserDropdown() {
            const teacherDropdown = document.querySelector('.teacher-user-dropdown');
            const teacherDropdownMenu = document.getElementById('teacherUserDropdownMenu');

            if (!teacherDropdown || !teacherDropdownMenu) {
                console.error('Teacher dropdown elements not found');
                return;
            }

            teacherDropdown.classList.toggle('active');
            teacherDropdownMenu.classList.toggle('show');

            // Force show the dropdown if it's not showing
            if (teacherDropdownMenu.classList.contains('show')) {
                teacherDropdownMenu.style.display = 'block';
                teacherDropdownMenu.style.opacity = '1';
                teacherDropdownMenu.style.visibility = 'visible';
                teacherDropdownMenu.style.transform = 'translateY(0)';
                teacherDropdownMenu.style.background = 'white';
                teacherDropdownMenu.style.border = '2px solid #0E61BA';
            } else {
                teacherDropdownMenu.style.display = '';
                teacherDropdownMenu.style.opacity = '';
                teacherDropdownMenu.style.visibility = '';
                teacherDropdownMenu.style.transform = '';
                teacherDropdownMenu.style.background = '';
                teacherDropdownMenu.style.border = '';
            }
        }

        // Initialize teacher dropdown functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', function () {
            const teacherUserDropdownToggle = document.getElementById('teacherUserDropdownToggle');

            if (teacherUserDropdownToggle) {
                teacherUserDropdownToggle.addEventListener('click', function (e) {
                    // Don't prevent default or stop propagation if clicking on form elements
                    if (e.target.closest('form') || e.target.closest('button[type="submit"]')) {
                        return;
                    }

                    e.preventDefault();
                    e.stopPropagation();
                    toggleTeacherUserDropdown();
                });

                teacherUserDropdownToggle.style.cursor = 'pointer';
            } else {
                console.error('Teacher user dropdown toggle element not found!');
            }
        });

        // Close teacher dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const teacherUserDropdown = document.querySelector('.teacher-user-dropdown');
            const teacherDropdownMenu = document.getElementById('teacherUserDropdownMenu');

            if (teacherUserDropdown && teacherDropdownMenu && !teacherUserDropdown.contains(event.target)) {
                teacherUserDropdown.classList.remove('active');
                teacherDropdownMenu.classList.remove('show');
                teacherDropdownMenu.style.display = '';
                teacherDropdownMenu.style.opacity = '';
                teacherDropdownMenu.style.visibility = '';
                teacherDropdownMenu.style.transform = '';
                teacherDropdownMenu.style.background = '';
                teacherDropdownMenu.style.border = '';
            }
        });

        // Add sidebar toggle functionality
        const sidebarMenuToggle = document.querySelector('.sidebar-menu-toggle');
        const teacherSidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        if (sidebarMenuToggle && teacherSidebar && sidebarOverlay) {
            // Toggle sidebar when burger menu is clicked
            sidebarMenuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                teacherSidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = teacherSidebar.classList.contains('active') ? 'hidden' : '';
            });

            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', () => {
                teacherSidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Close sidebar when clicking anywhere outside (on mobile)
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 768 && teacherSidebar.classList.contains('active')) {
                    // Don't close if clicking on sidebar itself or burger menu
                    if (!teacherSidebar.contains(e.target) && !sidebarMenuToggle.contains(e.target)) {
                        teacherSidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                }
            });

            // Close sidebar on window resize if desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    teacherSidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }

        // Active state is now handled by Laravel route detection
        // No need for manual JavaScript active state management

        // Ensure teacher logout form works properly
        document.addEventListener('DOMContentLoaded', function () {
            const teacherLogoutForm = document.getElementById('teacherLogoutForm');
            const teacherLogoutButton = teacherLogoutForm ? teacherLogoutForm.querySelector('button[type="submit"]') : null;

            if (teacherLogoutForm && teacherLogoutButton) {
                // Add event listener to the form
                teacherLogoutForm.addEventListener('submit', function (e) {
                    console.log('Teacher logout form submitted');
                    // Show loading state
                    teacherLogoutButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging out...';
                    teacherLogoutButton.disabled = true;
                    // Don't prevent default - let the form submit normally
                });

                // Add event listener to the button
                teacherLogoutButton.addEventListener('click', function (e) {
                    console.log('Teacher logout button clicked via event listener');
                    // Don't prevent default - let the form submit normally
                });
            } else {
                console.error('Teacher logout form or button not found');
            }


        });

        // Ensure header shadow is always visible
        function ensureHeaderShadow() {
            const header = document.querySelector('header');
            if (header) {
                // Force header shadow to be visible
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                header.style.borderBottom = '1px solid rgba(0, 0, 0, 0.1)';
                header.style.zIndex = '1002';

                // Add additional shadow element if it doesn't exist
                if (!header.querySelector('.header-shadow')) {
                    const shadowElement = document.createElement('div');
                    shadowElement.className = 'header-shadow';
                    shadowElement.style.cssText = `
                        position: absolute;
                        bottom: -8px;
                        left: 0;
                        width: 100%;
                        height: 8px;
                        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), transparent);
                        pointer-events: none;
                        z-index: -1;
                    `;
                    header.appendChild(shadowElement);
                }
            }
        }

        // Call on page load and navigation
        document.addEventListener('DOMContentLoaded', ensureHeaderShadow);
        window.addEventListener('load', ensureHeaderShadow);

        // Re-apply shadow when navigating (for SPA-like behavior)
        if (window.history && window.history.pushState) {
            const originalPushState = window.history.pushState;
            window.history.pushState = function () {
                originalPushState.apply(window.history, arguments);
                setTimeout(ensureHeaderShadow, 100);
            };
        }
    </script>
</body>

</html>