@extends('layouts.head-ad')

@section('title', 'Student Record')

@section('content')
<style>
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        /* Main Content - AdminDashboard Style */
        .main-content {
            margin-top: 60px;
            padding: 50px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Dashboard Container - AdminDashboard Style */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1rem;
        }

        /* Search Section - AdminDashboard Style */
        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px;
            padding-right: 3rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-box input:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        .search-box button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
        }

        .search-box button:hover {
            color: #00B8A9;
        }

        /* Masterlist Section - Exact AdminDashboard Style */
        .masterlist-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .masterlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .masterlist-header h2 {
            color: #2c3e50;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .masterlist-header h2 i {
            color: #00B8A9;
        }

        /* Grade Section - Beautiful Design */
        .grade-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .grade-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .grade-header {
            background: linear-gradient(135deg, #00B8A9, #009688);
            color: white;
            padding: 1.5rem 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border: none;
        }

        .grade-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .grade-header:hover::before {
            left: 100%;
        }

        .grade-header:hover {
            background: linear-gradient(135deg, #009688, #00796b);
        }

        .grade-title {
            color: white;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .grade-title i {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .student-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .grade-header span {
            font-size: 1.3rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .grade-header i {
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .grade-header.collapsed i {
            transform: rotate(-90deg);
        }

        .grade-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .grade-stats .stat-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .student-list {
            display: none;
            padding: 1rem;
        }

        .student-list.active {
            display: block;
        }

        .grade-content {
            padding: 2rem;
            background: #f8f9fa;
        }

        .section-group {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .section-group:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-1px);
        }

        .section-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border-bottom: 1px solid #e9ecef;
        }

        .section-header:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
        }

        .section-title {
            color: #00B8A9;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-title i {
            color: #00B8A9;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Section Name Styling - Green and Bold */
        .section-name {
            color: #00B8A9 !important;
            font-size: 1.3rem !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-header span {
            font-size: 1.1rem;
            letter-spacing: 0.3px;
        }

        .section-header i {
            transition: transform 0.3s ease;
            font-size: 1.1rem;
        }

        .section-header.collapsed i {
            transform: rotate(-90deg);
        }

        .section-stats {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .section-stats .stat-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 1rem;
        }

        .section-content {
            display: none;
            padding: 1.5rem;
            background: white;
        }

        .section-content.active {
            display: block;
        }

        /* Student Table - AdminDashboard Style */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .student-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #4A5568;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 20px;
            text-align: left;
        }

        .student-table td {
            padding: 16px 20px;
            text-align: left;
            color: #2c3e50;
            vertical-align: middle;
        }

        .student-table tbody tr:not(:last-child) {
            border-bottom: 1px solid #e9ecef;
        }

        .student-table tbody tr:hover {
            background-color: rgba(0, 184, 169, 0.05);
        }

        .student-name-cell {
            font-weight: 600;
            color: var(--primary);
        }

        .student-number {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.2rem;
        }

        .gender-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .gender-badge.male {
            background: #dbeafe;
            color: #1e40af;
        }

        .gender-badge.female {
            background: #fce7f3;
            color: #be185d;
        }

        /* Summary Statistics - AdminDashboard Style */
        .summary-section {
            margin-bottom: 2rem;
        }

        .summary-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #00B8A9;
            color: white !important;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .stat-icon i {
            color: white !important;
            font-size: 1.3rem;
            display: block;
            line-height: 1;
        }

        .stat-icon.total {
            background: #00B8A9;
        }

        .stat-icon.male {
            background: #3498db;
        }

        .stat-icon.female {
            background: #e74c3c;
        }

        .stat-icon.sections {
            background: #9b59b6;
        }

        /* Additional Icon Stability */
        .search-box button i {
            color: #7f8c8d !important;
            font-size: 1rem;
            display: block;
            line-height: 1;
        }

        .expand-all-btn i, .collapse-all-btn i {
            font-size: 0.9rem;
            display: block;
            line-height: 1;
        }

        .stat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
            margin: 0;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #6c757d;
            margin: 0;
            font-weight: 500;
            text-transform: capitalize;
        }

        /* Specific colors for each stat type */
        .stat-card.total .stat-number {
            color: #00B8A9;
        }

        .stat-card.male .stat-number {
            color: #3498db;
        }

        .stat-card.female .stat-number {
            color: #e74c3c;
        }

        .stat-card.sections .stat-number {
            color: #00B8A9;
        }

        /* Masterlist Controls */
        .masterlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem 0;
            border-bottom: 2px solid var(--primary);
        }

        .masterlist-controls {
            display: flex;
            gap: 0.8rem;
        }

        .expand-all-btn, .collapse-all-btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .expand-all-btn {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
        }

        .expand-all-btn:hover {
            background: linear-gradient(135deg, #229954, #1e8449);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .collapse-all-btn {
            background: linear-gradient(135deg, #e67e22, #d35400);
            color: white;
        }

        .collapse-all-btn:hover {
            background: linear-gradient(135deg, #d35400, #ba4a00);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
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

        /* Responsive Design - AdminDashboard Style */
        @media (max-width: 1200px) {
            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .dashboard-container {
                padding-top: 0;
            }

            .search-section {
                flex-direction: column;
                padding: 1.5rem;
            }

            .summary-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .masterlist-section {
                padding: 1.5rem;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .student-table th,
            .student-table td {
                padding: 12px 8px;
                font-size: 0.85rem;
            }
        }

        /* Status Badges - Exact AdminDashboard Style */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-in-progress {
            background: #fef3c7;
            color: #92400e;
        }

        .status-not-started {
            background: #f3f4f6;
            color: #4b5563;
        }

        .status-icon {
            font-size: 0.8rem;
        }

        .student-table-scroll {
            max-height: 300px;
            overflow-y: auto;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-container">
            <!-- Search Section -->
        <section class="search-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Find Student">
                <button onclick="searchStudents()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </section>

        <!-- Summary Statistics Section -->
        <section class="summary-section">
            @php
                $totalStudents = collect($students)->flatten()->count();
                $totalMale = collect($students)->flatten()->where('gender', 'Male')->count();
                $totalFemale = collect($students)->flatten()->where('gender', 'Female')->count();
                $totalSections = collect($students)->map(function($gradeStudents) {
                    return $gradeStudents->groupBy('section')->count();
                })->sum();
            @endphp

            <div class="summary-stats">
                <div class="stat-card total">
                    <div class="stat-icon total">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalStudents }}</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                </div>

                <div class="stat-card male">
                    <div class="stat-icon male">
                        <i class="fas fa-male"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalMale }}</div>
                        <div class="stat-label">Male Students</div>
                    </div>
                </div>

                <div class="stat-card female">
                    <div class="stat-icon female">
                        <i class="fas fa-female"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalFemale }}</div>
                        <div class="stat-label">Female Students</div>
                    </div>
                </div>

                <div class="stat-card sections">
                    <div class="stat-icon sections">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalSections }}</div>
                        <div class="stat-label">Total Sections</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Students Masterlist Section -->
        <section class="masterlist-section">
            <div class="masterlist-header">
                <h2>
                    <i class="fas fa-users"></i>
                    STUDENTS MASTERLIST
                </h2>
                <div class="masterlist-controls">
                    <button class="expand-all-btn" onclick="expandAll()">
                        <i class="fas fa-expand-arrows-alt"></i>
                        Expand All
                    </button>
                    <button class="collapse-all-btn" onclick="collapseAll()">
                        <i class="fas fa-compress-arrows-alt"></i>
                        Collapse All
                    </button>
                </div>
            </div>

            @foreach([7, 8, 9, 10] as $grade)
            <div class="grade-section">
                <div class="grade-header collapsed" onclick="toggleGrade('grade{{ $grade }}')">
                    <div>
                        <span>GRADE {{ $grade }}</span>
                        @if(isset($students[$grade]))
                            <div class="grade-stats">
                                <div class="stat-item">
                                    <span>{{ $students[$grade]->count() }} Students</span>
                                </div>
                                <div class="stat-item">
                                    <span>{{ $students[$grade]->groupBy('section')->count() }} Sections</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div id="grade{{ $grade }}" class="student-list">
                    @if(isset($students[$grade]) && count($students[$grade]))
                        @php
                            $sections = [];
                            switch($grade) {
                                case 7:
                                    $sections = ['Narra', 'Dao', 'Mahugani', 'Lawaan'];
                                    break;
                                case 8:
                                    $sections = ['Avocado', 'Guava', 'Duhat', 'Mango'];
                                    break;
                                case 9:
                                    $sections = ['Gold', 'Silver', 'Zinc'];
                                    break;
                                case 10:
                                    $sections = ['Galileo', 'Edison', 'Newton'];
                                    break;
                            }
                        @endphp

                        @foreach($sections as $section)
                            @php
                                $sectionStudents = $students[$grade]->where('section', $section);
                                $sectionCount = $sectionStudents->count();
                            @endphp
                            <div class="section-group">
                                <div class="section-header collapsed" onclick="toggleSection('section-{{ $grade }}-{{ $section }}')">
                                    <div>
                                        <span class="section-name">{{ $section }}</span>
                                        <div class="section-stats">
                                            <div class="stat-badge">
                                               
                                                {{ $sectionCount }} {{ $sectionCount == 1 ? 'Student' : 'Students' }}
                                            </div>
                                            @if($sectionCount > 0)
                                                @php
                                                    $maleCount = $sectionStudents->where('gender', 'Male')->count();
                                                    $femaleCount = $sectionStudents->where('gender', 'Female')->count();
                                                @endphp
                                                <div class="stat-badge">
                                                    <span style="color: #4FC3F7;">Male</span> {{ $maleCount }}
                                                    <span style="color: #F48FB1; margin-left: 0.3rem;">Female</span> {{ $femaleCount }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div id="section-{{ $grade }}-{{ $section }}" class="section-content">
                                    <div class="student-table-scroll">
                                        <table class="student-table">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Student Information</th>
                                                    <th>Gender</th>
                                                    <th>Test Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students[$grade]->where('section', $section)->sortBy('last_name') as $index => $student)
                                                    <tr>
                                                        <td style="font-weight: 600; color: var(--primary);">{{ $student->student_number }}</td>
                                                        <td class="student-name-cell">
                                                            <div>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</div>
                                                        </td>
                                                        <td>
                                                            <span class="gender-badge {{ strtolower($student->gender) }}">
                                                                <i class="fas fa-{{ $student->gender == 'Male' ? 'mars' : 'venus' }}"></i>
                                                                {{ $student->gender }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $status = $student->test_status ?? 'No Assessment';
                                                                $statusClass = '';
                                                                $statusText = '';
                                                                $statusIcon = '';

                                                                switch($status) {
                                                                    case 'Complete':
                                                                        $statusClass = 'status-completed';
                                                                        $statusText = 'Complete';
                                                                        $statusIcon = 'fa-check-circle';
                                                                        break;
                                                                    case 'Incomplete':
                                                                        $statusClass = 'status-in-progress';
                                                                        $statusText = 'Incomplete';
                                                                        $statusIcon = 'fa-clock';
                                                                        break;
                                                                    default:
                                                                        $statusClass = 'status-not-started';
                                                                        $statusText = 'No Assessment';
                                                                        $statusIcon = 'fa-circle';
                                                                        break;
                                                                }
                                                            @endphp
                                                            <span class="status-badge {{ $statusClass }}">
                                                                <i class="fas {{ $statusIcon }} status-icon"></i>
                                                                {{ $statusText }}
                                                            </span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="padding: 1rem; color: var(--text-light);">No students in this grade.</div>
                    @endif
                </div>
            </div>
            @endforeach
        </section>
        </div>
    </main>

    <script>
        // Toggle grade sections
        function toggleGrade(gradeId) {
            const gradeElement = document.getElementById(gradeId);
            const gradeHeader = gradeElement.previousElementSibling;

            gradeElement.classList.toggle('active');
            gradeHeader.classList.toggle('collapsed');

            // If closing the grade, also close all its sections
            if (!gradeElement.classList.contains('active')) {
                const sections = gradeElement.querySelectorAll('.section-content');
                const headers = gradeElement.querySelectorAll('.section-header');
                sections.forEach(section => section.classList.remove('active'));
                headers.forEach(header => header.classList.add('collapsed'));
            }
        }

        // Toggle section
        function toggleSection(sectionId) {
            const sectionElement = document.getElementById(sectionId);
            const sectionHeader = sectionElement.previousElementSibling;

            sectionElement.classList.toggle('active');
            sectionHeader.classList.toggle('collapsed');
        }

        // Expand all grades and sections
        function expandAll() {
            // Expand all grades
            document.querySelectorAll('.student-list').forEach(gradeList => {
                gradeList.classList.add('active');
            });
            document.querySelectorAll('.grade-header').forEach(header => {
                header.classList.remove('collapsed');
            });

            // Expand all sections
            document.querySelectorAll('.section-content').forEach(sectionContent => {
                sectionContent.classList.add('active');
            });
            document.querySelectorAll('.section-header').forEach(header => {
                header.classList.remove('collapsed');
            });
        }

        // Collapse all grades and sections
        function collapseAll() {
            // Collapse all sections first
            document.querySelectorAll('.section-content').forEach(sectionContent => {
                sectionContent.classList.remove('active');
            });
            document.querySelectorAll('.section-header').forEach(header => {
                header.classList.add('collapsed');
            });

            // Collapse all grades
            document.querySelectorAll('.student-list').forEach(gradeList => {
                gradeList.classList.remove('active');
            });
            document.querySelectorAll('.grade-header').forEach(header => {
                header.classList.add('collapsed');
            });
        }

        // Search functionality
        function searchStudents() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            
            // Get all student rows from all tables
            const allRows = document.querySelectorAll('.student-table tbody tr');
            
            // Hide all grade sections first
            document.querySelectorAll('.grade-section').forEach(gradeSection => {
                gradeSection.style.display = 'none';
            });
            
            // If search is empty, show all sections and return
            if (!query) {
                document.querySelectorAll('.grade-section').forEach(gradeSection => {
                    gradeSection.style.display = 'block';
                });
                return;
            }
            
            // Track which grade sections have matching students
            const matchingGrades = new Set();
            
            // Search through all rows
            allRows.forEach(row => {
                const nameCell = row.querySelector('.student-name-cell');
                const fullName = nameCell.textContent.toLowerCase();
                const studentNumber = row.querySelector('.student-number') ? row.querySelector('.student-number').textContent.toLowerCase() : '';

                // Check if name or student number contains the search query
                if (fullName.includes(query) || studentNumber.includes(query)) {
                    // Show the row
                    row.style.display = '';
                    
                    // Find the parent grade section and show it
                    const gradeSection = row.closest('.grade-section');
                    if (gradeSection) {
                        gradeSection.style.display = 'block';
                        matchingGrades.add(gradeSection);
                        
                        // Expand the grade section
                        const gradeHeader = gradeSection.querySelector('.grade-header');
                        const studentList = gradeSection.querySelector('.student-list');
                        if (gradeHeader && studentList) {
                            gradeHeader.classList.remove('collapsed');
                            studentList.classList.add('active');
                        }
                        
                        // Find and expand the section containing the student
                        const sectionGroup = row.closest('.section-group');
                        if (sectionGroup) {
                            const sectionHeader = sectionGroup.querySelector('.section-header');
                            const sectionContent = sectionGroup.querySelector('.section-content');
                            if (sectionHeader && sectionContent) {
                                sectionHeader.classList.remove('collapsed');
                                sectionContent.classList.add('active');
                            }
                        }
                    }
                } else {
                    // Hide the row if it doesn't match
                    row.style.display = 'none';
                }
            });
            
            // Hide grade sections that have no matching students
            document.querySelectorAll('.grade-section').forEach(gradeSection => {
                if (!matchingGrades.has(gradeSection)) {
                    gradeSection.style.display = 'none';
                }
            });
        }

        // Add event listener for search input
        document.getElementById('searchInput').addEventListener('input', function() {
            searchStudents();
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
    </script>
<!-- </body>
</html> -->
@endsection
