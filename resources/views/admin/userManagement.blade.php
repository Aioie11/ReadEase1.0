@extends('layouts.head-ad')

@section('title', 'User Management')

@section('content')
<style>   
        /* User Info Styles */
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

        /* Dashboard Container - Clean Organization */
        .settings-content {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1rem;
        }

        /* Dashboard Header - Clean AdminDashboard Style */
        

        .add-profile-button {
            background: linear-gradient(135deg, #00B8A9, #009688);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-profile-button:hover {
            background: linear-gradient(135deg, #009688, #00796b);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 184, 169, 0.3);
        }

        .page-header {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .page-header h1 {
            color: #00B8A9;;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-header p {
            color: #7f8c8d;
            margin: 0.5rem 0 0 0;
            font-size: 1rem;
            line-height: 1.5;
        }


        /* Search Bar - AdminDashboard Style */
        .search-bar {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-bar input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            width: 280px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-bar input[type="text"]:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        .search-bar button {
            background: linear-gradient(135deg, #00B8A9, #009688);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-bar button:hover {
            background: linear-gradient(135deg, #009688, #00796b);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 184, 169, 0.3);
        }

        /* Table Styles - Exact AdminDashboard Style */
        .profile-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-table th,
        .profile-table td {
            padding: 16px 20px;
            text-align: left;
        }

        .profile-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #4A5568;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-table tbody tr:not(:last-child) {
            border-bottom: 1px solid #e9ecef;
        }

        .profile-table tbody tr:hover {
            background-color: rgba(0, 184, 169, 0.05);
        }

        .profile-table .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
        }

        .profile-table .action-buttons button {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-table .action-buttons button.edit {
            background: #00B8A9;
            color: white;
        }

        .profile-table .action-buttons button.delete {
            background: #e74c3c;
            color: white;
        }

        .profile-table .action-buttons button:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-table .action-buttons button.edit:hover {
            background: #009688;
        }

        .profile-table .action-buttons button.delete:hover {
            background: #c0392b;
        }

        /* Table Section - AdminDashboard Style */
        .table-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* User ID Styling - AdminDashboard Style */
        .user-id {
            font-weight: 600;
            color: #00B8A9;
            font-family: 'Courier New', monospace;
        }

        /* Icon Styling */
        .user-type-title i {
            color: #00B8A9;
        }

        /* Modal Styles - Modern Design */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 2000;
            overflow-y: auto;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .modal-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            margin: 0;
            padding: 0;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 650px;
            width: 90vw;
            z-index: 2100;
            max-height: 90vh;
            overflow: hidden;
            animation: slideIn 0.4s ease-out;
        }

        /* Modal Header */
        .modal-header {
            background: linear-gradient(135deg, #00B8A9, #009688);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .modal-content h2 {
            color: white;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .modal-content h2::before {
            content: '👤';
            font-size: 1.3rem;
        }

        /* Modal Body */
        .modal-body {
            padding: 2rem;
            max-height: 60vh;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #2c3e50;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
            transform: translateY(-1px);
        }

        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23555' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding: 2rem;
            background: #f8f9fa;
            margin: 0 -2rem -2rem -2rem;
            border-radius: 0 0 20px 20px;
        }

        .button-group button {
            padding: 12px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .save-btn {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
        }

        .save-btn::before {
            content: '✓';
            font-size: 0.9rem;
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #229954, #1e8449);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .cancel-btn {
            background: #6c757d;
            color: white;
        }

        .cancel-btn::before {
            content: '✕';
            font-size: 0.9rem;
        }

        .cancel-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .close {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .close:hover {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        /* User ID Styling */
        .user-id {
            font-weight: 600;
            color: var(--clean-blue-600);
            font-family: 'Courier New', monospace;
        }

        /* User Type Tabs - AdminDashboard Style */
        .user-type-tabs {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
        }

        .tab-button {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 1px solid #e9ecef;
            background: white;
            color: #2c3e50;
            font-weight: 500;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tab-button:hover {
            background: #f8f9fa;
            border-color: #2c3e50;
        }

        .tab-button.active {
            background: #00B8A9;
            color: white;
            border-color: #00B8A9;
        }

        .tab-button .count {
            margin-left: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: inherit;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .tab-button.active .count {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        /* Grade Level Filters - AdminDashboard Style */
        .grade-filters {
            display: none;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .grade-filters.show {
            display: block;
        }

        .grade-filters-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .grade-filter-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e9ecef;
            background: white;
            color: #2c3e50;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23555' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        .grade-filter-select:hover {
            border-color: #2c3e50;
        }

        .grade-filter-select:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* User Type Headers - AdminDashboard Style */
        .user-type-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .user-type-title {
            color: #2c3e50;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-count {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            background: #dbeafe;
            color: #1e40af;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--clean-gray-500);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--clean-gray-300);
        }

        .empty-state h3 {
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
            color: var(--clean-gray-600);
        }

        .empty-state p {
            font-size: 0.875rem;
            margin: 0;
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
    <!-- Main Content -->
    <main class="main-content">
        <div class="settings-content">
            <div class="page-header">
                <h1>User Management</h1>
                <p>Manage system users including administrators, teachers, and students. Create, edit, and organize user accounts with role-based access control.</p>
            </div>

            <!-- User Type Tabs -->
            <div class="user-type-tabs">
                <button class="tab-button active" onclick="switchTab('admin')" id="adminTab">
                    Administrators
                    <span class="count" id="adminCount">0</span>
                </button>
                <button class="tab-button" onclick="switchTab('teacher')" id="teacherTab">
                    Teachers
                    <span class="count" id="teacherCount">0</span>
                </button>
                <button class="tab-button" onclick="switchTab('student')" id="studentTab">
                    Students
                    <span class="count" id="studentCount">0</span>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by User ID or Name...">
                <button onclick="searchUsers()">
                    <i class="fas fa-search"></i>
                    Search
                </button>
                <button class="add-profile-button" onclick="openAddProfileModal()">
                    <i class="fas fa-user-plus"></i>
                    Add New User
                </button>
            </div>

            <!-- Grade Level Filters (for Students only) -->
            <div class="grade-filters" id="gradeFilters">
                <div class="grade-filters-label">Filter by Grade Level:</div>
                <div class="grade-filter-buttons">
                    <select id="gradeFilterSelect" class="grade-filter-select" onchange="filterByGrade(this.value)">
                        <option value="all">All Grades</option>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                    </select>
                </div>
            </div>

            <!-- Admin Tab Content -->
            <div class="tab-content active" id="adminContent">
                <div class="table-section">
                    <div class="user-type-header">
                        <h3 class="user-type-title">
                            <i class="fas fa-user-shield"></i>
                            System Administrators
                        </h3>
                        <span class="user-count" id="adminDisplayCount">0 users</span>
                    </div>
                    <div class="table-container">
                        <table class="profile-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                            <tbody id="adminTableBody">
                                <!-- Admin profiles will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Teacher Tab Content -->
            <div class="tab-content" id="teacherContent">
                <div class="table-section">
                    <div class="user-type-header">
                        <h3 class="user-type-title">
                            <i class="fas fa-chalkboard-teacher"></i>
                            Teachers
                        </h3>
                        <span class="user-count" id="teacherDisplayCount">0 users</span>
                    </div>
                    <div class="table-container">
                        <table class="profile-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                            <tbody id="teacherTableBody">
                                <!-- Teacher profiles will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Student Tab Content -->
            <div class="tab-content" id="studentContent">
                <div class="table-section">
                    <div class="user-type-header">
                        <h3 class="user-type-title">
                            <i class="fas fa-user-graduate"></i>
                            Students
                        </h3>
                        <span class="user-count" id="studentDisplayCount">0 users</span>
                    </div>
                    <div class="table-container">
                        <table class="profile-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>Gender</th>
                            <th>Date Created</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                            <tbody id="studentTableBody">
                                <!-- Student profiles will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Profile Modal -->
    <div id="addProfileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeProfileModal()">&times;</span>
                <h2>Add New User</h2>
            </div>
            <div class="modal-body">
                <form id="addProfileForm">
                <div class="form-group">
                    <label for="profileLastName">Last Name</label>
                    <input type="text" id="profileLastName" name="lastName" required placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="profileFirstName">First Name</label>
                    <input type="text" id="profileFirstName" name="firstName" required placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="profileMiddleInitial">Middle Initial</label>
                    <input type="text" id="profileMiddleInitial" name="middleInitial" maxlength="1" placeholder="Enter middle initial">
                </div>
                <div class="form-group">
                    <label for="profileEmail">Email Address (Optional)</label>
                    <input type="email" id="profileEmail" name="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                    <label for="profilePassword">Password</label>
                    <input type="password" id="profilePassword" name="password" required placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="profileRole">Role</label>
                    <select id="profileRole" name="role" required onchange="toggleRoleFields(this.value)">
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div id="teacherFields" style="display: none;">
                    <div class="form-group">
                        <label for="profileTeacherGrade">Assigned Year Level</label>
                        <select id="profileTeacherGrade" name="teacherGrade" class="teacher-field" required>
                            <option value="">Select Grade Level</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                </div>
                <div id="studentFields" style="display: none;">
                    <div class="form-group">
                        <label for="profileGrade">Grade Level</label>
                        <select id="profileGrade" name="grade" class="student-field" onchange="updateSections(this.value)">
                            <option value="">Select Grade Level</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profileSection">Section</label>
                        <select id="profileSection" name="section" class="student-field">
                            <option value="">Select Section</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profileGender">Gender</label>
                        <select id="profileGender" name="gender" class="student-field" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="profileUserId">User ID</label>
                    <input type="text" id="profileUserId" name="userId" required placeholder="Enter Admin ID, Teacher ID, or Student ID">
                </div>
                    <div class="button-group">
                        <button type="button" class="cancel-btn" onclick="closeProfileModal()">Cancel</button>
                        <button type="submit" class="save-btn">Create Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeEditProfileModal()">&times;</span>
                <h2>Edit User</h2>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                <input type="hidden" id="editProfileId" name="user_id">
                <div class="form-group">
                    <label for="editProfileName">Full Name</label>
                    <input type="text" id="editProfileName" name="name" required placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="editProfileEmail">Email Address (Optional)</label>
                    <input type="email" id="editProfileEmail" name="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                    <label for="editProfilePassword">New Password (optional)</label>
                    <input type="password" id="editProfilePassword" name="password" placeholder="Leave blank to keep current password">
                </div>
                <div class="form-group">
                    <label for="editProfileRole">Role</label>
                    <select id="editProfileRole" name="role" required onchange="toggleEditRoleFields(this.value)">
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div id="editTeacherFields" style="display: none;">
                    <div class="form-group">
                        <label for="editProfileTeacherGrade">Assigned Year Level</label>
                        <select id="editProfileTeacherGrade" name="teacherGrade" class="teacher-field">
                            <option value="">Select Grade Level</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                </div>
                <div id="editStudentFields" style="display: none;">
                    <div class="form-group">
                        <label for="editProfileGrade">Grade Level</label>
                        <select id="editProfileGrade" name="grade" class="student-field" onchange="updateEditSections(this.value)">
                            <option value="">Select Grade Level</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProfileSection">Section</label>
                        <select id="editProfileSection" name="section" class="student-field">
                            <option value="">Select Section</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProfileGender">Gender</label>
                        <select id="editProfileGender" name="gender" class="student-field" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editProfileUserId">User ID</label>
                    <input type="text" id="editProfileUserId" name="userId" required placeholder="Enter Admin ID, Teacher ID, or Student ID">
                </div>
                    <div class="button-group">
                        <button type="button" class="cancel-btn" onclick="closeEditProfileModal()">Cancel</button>
                        <button type="submit" class="save-btn">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Add this new function to handle section options
    function updateSections(grade) {
        const sectionSelect = document.getElementById('profileSection');
        sectionSelect.innerHTML = '<option value="">Select Section</option>';
        
        const sections = {
            '7': ['Narra', 'Dao', 'Mahugani', 'Lawaan'],
            '8': ['Avocado', 'Guava', 'Duhat', 'Mango'],
            '9': ['Gold', 'Silver', 'Zinc'],
            '10': ['Galileo', 'Edison', 'Newton']
        };

        if (grade && sections[grade]) {
            sections[grade].forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                sectionSelect.appendChild(option);
            });
        }
    }

    function updateEditSections(grade) {
        const sectionSelect = document.getElementById('editProfileSection');
        sectionSelect.innerHTML = '<option value="">Select Section</option>';
        
        const sections = {
            '7': ['Narra', 'Dao', 'Mahugani', 'Lawaan'],
            '8': ['Avocado', 'Guava', 'Duhat', 'Mango'],
            '9': ['Gold', 'Silver', 'Zinc'],
            '10': ['Galileo', 'Edison', 'Newton']
        };

        if (grade && sections[grade]) {
            sections[grade].forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                sectionSelect.appendChild(option);
            });
        }
    }

    function toggleRoleFields(role) {
        const studentFields = document.getElementById('studentFields');
        const teacherFields = document.getElementById('teacherFields');
        const studentInputs = studentFields.getElementsByClassName('student-field');
        const teacherInputs = teacherFields.getElementsByClassName('teacher-field');

        // Hide all role-specific fields first
        studentFields.style.display = 'none';
        teacherFields.style.display = 'none';
        Array.from(studentInputs).forEach(input => input.required = false);
        Array.from(teacherInputs).forEach(input => input.required = false);

        // Show and set required fields based on role
        if (role === 'student') {
            studentFields.style.display = 'block';
            Array.from(studentInputs).forEach(input => input.required = true);
            // Reset sections when role changes
            document.getElementById('profileSection').innerHTML = '<option value="">Select Section</option>';
        } else if (role === 'teacher') {
            // For teachers, hide the "Assigned Year Level" field
            // The form will go directly from Role to User ID
            teacherFields.style.display = 'none';
            Array.from(teacherInputs).forEach(input => input.required = false);
        }
    }

    function toggleEditRoleFields(role) {
        const studentFields = document.getElementById('editStudentFields');
        const teacherFields = document.getElementById('editTeacherFields');
        const studentInputs = studentFields.getElementsByClassName('student-field');
        const teacherInputs = teacherFields.getElementsByClassName('teacher-field');

        // Hide all role-specific fields first
        studentFields.style.display = 'none';
        teacherFields.style.display = 'none';
        Array.from(studentInputs).forEach(input => input.required = false);
        Array.from(teacherInputs).forEach(input => input.required = false);

        // Show and set required fields based on role
        if (role === 'student') {
            studentFields.style.display = 'block';
            Array.from(studentInputs).forEach(input => input.required = true);
            // Reset sections when role changes
            document.getElementById('editProfileSection').innerHTML = '<option value="">Select Section</option>';
        } else if (role === 'teacher') {
            // For teachers, hide the "Assigned Year Level" field
            // The form will go directly from Role to User ID
            teacherFields.style.display = 'none';
            Array.from(teacherInputs).forEach(input => input.required = false);
        }
    }

    // Keep the old function name for backward compatibility
    function toggleEditStudentFields(role) {
        toggleEditRoleFields(role);
    }

    function openEditProfileModal(id, name, userId, role, grade = '', section = '', gender = '', email = '', teacherGrade = '') {
        document.getElementById('editProfileId').value = id;
        document.getElementById('editProfileName').value = name;
        document.getElementById('editProfileUserId').value = userId;
        document.getElementById('editProfileRole').value = role;
        document.getElementById('editProfileEmail').value = email || '';

        // Handle role-specific fields
        toggleEditStudentFields(role);

        if (role === 'student') {
            document.getElementById('editProfileGrade').value = grade;
            // Update sections based on grade
            updateEditSections(grade);
            document.getElementById('editProfileSection').value = section;
            document.getElementById('editProfileGender').value = gender;
        } else if (role === 'teacher') {
            // Handle teacher grade field if it exists
            const teacherGradeField = document.getElementById('editProfileTeacherGrade');
            if (teacherGradeField) {
                teacherGradeField.value = teacherGrade;
            }
        }

        document.getElementById('editProfileModal').style.display = 'block';
    }

    // Global variables
    let allUsers = [];
    let currentTab = 'admin';
    let currentGradeFilter = 'all';

    // Tab switching functionality
    function switchTab(tabName) {
        // Update tab buttons
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        document.getElementById(tabName + 'Tab').classList.add('active');

        // Update tab content
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        document.getElementById(tabName + 'Content').classList.add('active');

        // Show/hide grade filters for students
        const gradeFilters = document.getElementById('gradeFilters');
        if (tabName === 'student') {
            gradeFilters.classList.add('show');
        } else {
            gradeFilters.classList.remove('show');
        }

        currentTab = tabName;
        renderUsersByType();
    }

    // Grade filtering for students
    function filterByGrade(grade) {
        currentGradeFilter = grade;
        renderUsersByType();
    }

    // Render users by type
    function renderUsersByType() {
        const adminUsers = allUsers.filter(user => user.role === 'admin');
        const teacherUsers = allUsers.filter(user => user.role === 'teacher');
        let studentUsers = allUsers.filter(user => user.role === 'student');

        // Apply grade filter for students
        if (currentGradeFilter !== 'all') {
            studentUsers = studentUsers.filter(user => user.grade === currentGradeFilter);
        }

        // Update counts
        document.getElementById('adminCount').textContent = adminUsers.length;
        document.getElementById('teacherCount').textContent = teacherUsers.length;
        document.getElementById('studentCount').textContent = allUsers.filter(user => user.role === 'student').length;

        document.getElementById('adminDisplayCount').textContent = `${adminUsers.length} user${adminUsers.length !== 1 ? 's' : ''}`;
        document.getElementById('teacherDisplayCount').textContent = `${teacherUsers.length} user${teacherUsers.length !== 1 ? 's' : ''}`;
        document.getElementById('studentDisplayCount').textContent = `${studentUsers.length} user${studentUsers.length !== 1 ? 's' : ''}`;

        // Render tables
        renderAdminTable(adminUsers);
        renderTeacherTable(teacherUsers);
        renderStudentTable(studentUsers);
    }

    // Search functionality
    function searchUsers() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();

        if (!searchTerm) {
            renderUsersByType();
            return;
        }

        const filteredUsers = allUsers.filter(user =>
            user.userId.toLowerCase().includes(searchTerm) ||
            user.name.toLowerCase().includes(searchTerm)
        );

        // Filter by current tab and render
        const adminUsers = filteredUsers.filter(user => user.role === 'admin');
        const teacherUsers = filteredUsers.filter(user => user.role === 'teacher');
        let studentUsers = filteredUsers.filter(user => user.role === 'student');

        // Apply grade filter for students
        if (currentGradeFilter !== 'all') {
            studentUsers = studentUsers.filter(user => user.grade === currentGradeFilter);
        }

        renderAdminTable(adminUsers);
        renderTeacherTable(teacherUsers);
        renderStudentTable(studentUsers);
    }

    // Load profiles function
    function loadProfiles() {
        fetch('/admin/users')
            .then(res => res.json())
            .then(users => {
                allUsers = users;
                renderUsersByType();
            })
            .catch(error => {
                console.error('Error loading profiles:', error);
            });
    }

    // Initialize page when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener for Enter key in search input
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchUsers();
                }
            });
        }

        // Load profiles on page load
        loadProfiles();

        // Initialize form event listeners
        initializeFormListeners();
    });

    function initializeFormListeners() {
        // Add Profile Form
        const addForm = document.getElementById('addProfileForm');
        if (addForm) {
            addForm.addEventListener('submit', handleAddProfileSubmit);
        }

        // Edit Profile Form
        const editForm = document.getElementById('editProfileForm');
        if (editForm) {
            editForm.addEventListener('submit', handleEditProfileSubmit);
        }
    }

    // Render admin table
    function renderAdminTable(users) {
        const tbody = document.getElementById('adminTableBody');
        tbody.innerHTML = '';

        if (users.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-user-shield"></i>
                            <h3>No Administrators Found</h3>
                            <p>No administrator accounts match your search criteria.</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><span class="user-id">${user.userId}</span></td>
                <td>${user.name}</td>
                <td>${user.email || 'Not provided'}</td>
                <td>${new Date(user.created_at).toLocaleDateString()}</td>
                <td>
                    <div class="action-buttons">
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${user.userId}', '${user.role}', '', '', '', '${user.email || ''}', '')">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Render teacher table
    function renderTeacherTable(users) {
        const tbody = document.getElementById('teacherTableBody');
        tbody.innerHTML = '';

        if (users.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h3>No Teachers Found</h3>
                            <p>No teacher accounts match your search criteria.</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><span class="user-id">${user.userId}</span></td>
                <td>${user.name}</td>
                <td>${user.email || 'Not provided'}</td>
                <td>${new Date(user.created_at).toLocaleDateString()}</td>
                <td>
                    <div class="action-buttons">
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${user.userId}', '${user.role}', '', '', '', '${user.email || ''}', '${user.teacherGrade || ''}')">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Render student table
    function renderStudentTable(users) {
        const tbody = document.getElementById('studentTableBody');
        tbody.innerHTML = '';

        if (users.length === 0) {
            const message = currentGradeFilter === 'all'
                ? 'No student accounts match your search criteria.'
                : `No students found in Grade ${currentGradeFilter} matching your search.`;

            tbody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-user-graduate"></i>
                            <h3>No Students Found</h3>
                            <p>${message}</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><span class="user-id">${user.userId}</span></td>
                <td>${user.name}</td>
                <td>${user.grade ? `Grade ${user.grade}` : 'Not specified'}</td>
                <td>${user.section || 'Not specified'}</td>
                <td>${user.gender || 'Not specified'}</td>
                <td>${new Date(user.created_at).toLocaleDateString()}</td>
                <td>
                    <div class="action-buttons">
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${user.userId}', '${user.role}', '${user.grade || ''}', '${user.section || ''}', '${user.gender || ''}', '${user.email || ''}', '')">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Modal functions
    function openAddProfileModal() {
        document.getElementById('addProfileModal').style.display = 'block';
    }
    function closeProfileModal() {
        document.getElementById('addProfileModal').style.display = 'none';
    }

    function handleAddProfileSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);

        // Convert FormData to JSON
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Combine name fields
        const lastName = data.lastName;
        const firstName = data.firstName;
        const middleInitial = data.middleInitial;
        data.name = `${lastName}, ${firstName}${middleInitial ? ` ${middleInitial}.` : ''}`;

        // Remove the individual name fields
        delete data.lastName;
        delete data.firstName;
        delete data.middleInitial;

        fetch('/admin/users', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Profile added successfully!');
                closeProfileModal();
                document.getElementById('addProfileForm').reset();
                loadProfiles(); // Refresh the tables
            } else {
                throw new Error(data.message || 'Failed to add profile');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            let errorMessage = 'An error occurred while adding the profile.';
            if (error.errors) {
                errorMessage = Object.values(error.errors).flat().join('\n');
            } else if (error.message) {
                errorMessage = error.message;
            }
            alert(errorMessage);
        });
    }

    function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }

    function handleEditProfileSubmit(e) {
        e.preventDefault();
        const id = document.getElementById('editProfileId').value;
        const formData = new FormData(e.target);

        // Convert FormData to object, including empty values for proper validation
        let data = {};
        formData.forEach((value, key) => {
            // Include all values, even empty ones, but clean them up
            data[key] = value.trim();
        });

        // Ensure required fields are present
        if (!data.name || !data.userId || !data.role) {
            alert('Please fill in all required fields (Name, User ID, and Role).');
            return;
        }

        // Remove empty optional fields to avoid validation issues
        Object.keys(data).forEach(key => {
            if (data[key] === '' && ['email', 'password', 'grade', 'section', 'gender', 'teacherGrade'].includes(key)) {
                delete data[key];
            }
        });

        console.log('User ID being updated:', id);
        console.log('Sending update data:', data); // Debug log

        fetch(`/admin/users/${id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Response status:', response.status); // Debug log
            if (!response.ok) {
                return response.json().then(err => {
                    console.error('Server error:', err); // Debug log
                    return Promise.reject(err);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Success response:', data); // Debug log
            alert('Profile updated successfully!');
            closeEditProfileModal();
            loadProfiles();
        })
        .catch(error => {
            console.error('Update error:', error); // Debug log
            let msg = 'An error occurred while updating the profile.';
            if (error.errors) {
                msg = Object.values(error.errors).flat().join('\n');
            } else if (error.message) {
                msg = error.message;
            }
            alert(msg);
        });
    }

    function deleteProfile(id) {
        // Find the user data to determine if it's a student
        const user = allUsers.find(u => u.id === id);

        let confirmMessage = 'Are you sure you want to delete this profile?';

        // Enhanced confirmation for student accounts
        if (user && user.role === 'student') {
            confirmMessage = `⚠️ STUDENT ACCOUNT DELETION ⚠️

Are you sure you want to permanently delete this student account?

Student: ${user.name}
ID: ${user.userId}

This action will permanently delete:
✓ Student profile and account
✓ All reading assessment records
✓ All comprehension test results (English & Filipino)
✓ All teacher feedback and reports
✓ All performance data and statistics

⚠️ THIS CANNOT BE UNDONE ⚠️`;
        }

        // Use simple confirm dialog for all users (no prompt form)
        if (!confirm(confirmMessage)) return;

        fetch(`/admin/users/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (user && user.role === 'student') {
                    alert('✅ Student account and all associated data have been permanently deleted.');
                } else {
                    alert('Profile deleted successfully!');
                }
                loadProfiles();
            } else {
                throw new Error(data.message || 'Failed to delete profile');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            let errorMessage = 'An error occurred while deleting the profile.';
            if (error.message) {
                errorMessage = error.message;
            } else if (error.errors) {
                errorMessage = Object.values(error.errors).flat().join('\n');
            }
            alert(errorMessage);
        });
    }

    // Add sidebar toggle functionality
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const header = document.querySelector('header');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
    </script>
<!-- </body>
</html> -->
@endsection