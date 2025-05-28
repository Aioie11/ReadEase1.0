@extends('layouts.head-tech')

@section('title', 'Student Dashboard')

@section('content')

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
            <div class="grade-card">
                <h2><i class="fas fa-graduation-cap"></i> Grade 10</h2>
                <ul class="sections-list">
                    <li class="section-item">
                        <div class="section-info">
                            <i class="fas fa-book"></i>
                            <span>Section A</span>
                        </div>
                        <div class="section-stats">
                            <span class="stat-item">
                                <i class="fas fa-user"></i>
                                32 Students
                            </span>
                        </div>
                    </li>
                    <li class="section-item">
                        <div class="section-info">
                            <i class="fas fa-book"></i>
                            <span>Section B</span>
                        </div>
                        <div class="section-stats">
                            <span class="stat-item">
                                <i class="fas fa-user"></i>
                                29 Students
                            </span>
                        </div>
                    </li>
                </ul>
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

@endsection