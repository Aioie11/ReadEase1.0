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
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--neutral-light);
            text-decoration: none;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-right {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
            position: relative;
            margin-left: auto;
        }

        .logout-btn {
            background: var(--accent);
            color: var(--neutral-light);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-weight: 500;
        }

        .logout-btn:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
        }

        /* User Dropdown Styles */
        .user-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .user-dropdown:hover {
            background: rgba(255, 255, 255, 0.1);
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
            font-size: 1rem;
            color: var(--neutral-light);
        }

        .user-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.3rem;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            line-height: 1.2;
            margin-bottom: 0.1rem;
        }

        .user-role {
            font-size: 0.8rem;
            opacity: 0.8;
            line-height: 1;
        }

        .dropdown-arrow {
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .user-dropdown.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Dropdown Menu */
        .dropdown-menu {
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

        .dropdown-menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            display: block !important;
            background: white !important;
            border: 2px solid #0E61BA !important;
        }

        /* Alternative hover-based dropdown for testing */
        .user-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            border-bottom: 1px solid var(--neutral-dark);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: var(--neutral);
            color: var(--primary);
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
            font-size: 0.9rem;
        }

        .logout-item {
            color: var(--text);
        }

        .logout-item:hover {
            background: var(--text);
            color: #dc3545;
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

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-info {
            flex: 1;
        }

        .admin-name {
            font-weight: 600;
            margin-bottom: 0.2rem;
            font-size: 1rem;
            letter-spacing: 0.3px;
            background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .admin-role {
            font-size: 0.85rem;
            opacity: 0.9;
            color: #e0e0e0;
            letter-spacing: 0.2px;
        }

        /* Adjust main content for sidebar */
        .main-content {
            margin-left: 250px;
            padding-top: 5rem;
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
    <aside class="sidebar">
        <div class="sidebar-header">
            <a class="sidebar-logo">
                <img src="{{ asset('pic/RElogo.png') }}" alt="ReadEase Logo">
                <span>ReadEase</span>
            </a>
        </div>
        <nav>
            <ul class="nav-menu">
                <div class="nav-section">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.test-management') }}" class="nav-link">
                            <i class="fas fa-question"></i>
                            Test Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.student-records') }}" class="nav-link">
                            <i class="fas fa-question"></i>
                            Student Records
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reports') }}" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.user-management') }}" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            User Management
                        </a>
                    </li>

                </div>
            </ul>
        </nav>


        <div class="sidebar-footer">
            <div class="admin-profile">
                <div class="admin-avatar">{{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '' }}</div>
                <div class="admin-info">
                    <div class="admin-name">{{ Auth::user() ? Auth::user()->name : '' }}</div>
                    <div class="admin-role">{{ Auth::user() ? Auth::user()->role : '' }}</div>
                </div>
            </div>
        </div>
    </aside>

    <header>
        <div class="header-container">
            <div class="header-left">
                <button class="menu-toggle">
                    <svg viewBox="0 0 24 24" fill="currentColor" style="width: 20px; height: 20px;">
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                </button>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-dropdown" id="userDropdownToggle">
                        <div class="user-avatar">
                            {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '' }}
                        </div>
                        <div class="user-details">
                            <div class="user-name">{{ Auth::user() ? Auth::user()->name : '' }}</div>
                            <div class="user-role">{{ Auth::user() ? Auth::user()->role : '' }}</div>
                        </div>
                        <svg viewBox="0 0 24 24" fill="currentColor" class="dropdown-arrow"
                            style="width: 16px; height: 16px;">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>

                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu" id="userDropdownMenu">
                            <a href="#" class="dropdown-item">
                                <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                                <span>Profile</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                    <path
                                        d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z" />
                                </svg>
                                <span>Settings</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item logout-item"
                                    style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                                    <svg viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                        <path
                                            d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
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

        // User dropdown functionality
        function toggleUserDropdown() {
            const dropdown = document.querySelector('.user-dropdown');
            const dropdownMenu = document.getElementById('userDropdownMenu');

            console.log('Dropdown clicked!'); // Debug log
            console.log('Dropdown element:', dropdown);
            console.log('Menu element:', dropdownMenu);

            dropdown.classList.toggle('active');
            dropdownMenu.classList.toggle('show');

            // Force show the dropdown if it's not showing
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.style.display = 'block';
                dropdownMenu.style.opacity = '1';
                dropdownMenu.style.visibility = 'visible';
                dropdownMenu.style.transform = 'translateY(0)';
            } else {
                dropdownMenu.style.display = '';
                dropdownMenu.style.opacity = '';
                dropdownMenu.style.visibility = '';
                dropdownMenu.style.transform = '';
            }
        }

        // Initialize dropdown functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', function () {
            const userDropdownToggle = document.getElementById('userDropdownToggle');
            console.log('DOM loaded, dropdown toggle element:', userDropdownToggle);

            if (userDropdownToggle) {
                userDropdownToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('User dropdown clicked!');
                    toggleUserDropdown();
                });

                // Also add a test alert
                userDropdownToggle.style.cursor = 'pointer';
                console.log('Dropdown event listener added successfully');
            } else {
                console.error('User dropdown toggle element not found!');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const userDropdown = document.querySelector('.user-dropdown');
            const dropdownMenu = document.getElementById('userDropdownMenu');

            if (!userDropdown.contains(event.target)) {
                userDropdown.classList.remove('active');
                dropdownMenu.classList.remove('show');
            }
        });

        // Add sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

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