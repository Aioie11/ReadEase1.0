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

        /* Main Content */
        .main-content {
            margin-top: 50px;
            margin-left: 280px;
            padding: 6rem 5% 2rem;
            transition: var(--transition);
        }

        /* Existing Settings Styles */
        .settings-content { 
            flex: 1; 
            padding: 30px;
            background-color: var(--neutral);
        }

        .settings-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--neutral-dark);
        }

        .settings-header h2 { 
            color: var(--text);
            font-size: 28px;
            font-weight: 600;
        }

        .add-profile-button { 
            background: var(--gradient-secondary);
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--shadow-md);
        }

        .add-profile-button:hover { 
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Search Bar Styles */
        .search-bar { 
            display: flex; 
            align-items: center;
            margin-bottom: 25px;
            background: var(--neutral-light);
            padding: 15px;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
        }

        .search-bar input[type="text"] { 
            flex: 1;
            padding: 12px 20px;
            border: 1px solid var(--neutral-dark);
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }

        .search-bar input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 97, 186, 0.1);
        }

        .search-bar button { 
            background: var(--gradient-primary);
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            margin-left: 10px;
            font-weight: 500;
            transition: var(--transition);
        }

        .search-bar button:hover { 
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Table Styles */
        .profile-table { 
            width: 100%; 
            border-collapse: separate;
            border-spacing: 0;
            background: var(--neutral-light);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .profile-table th, 
        .profile-table td { 
            padding: 15px 20px; 
            text-align: left;
        }

        .profile-table th { 
            background: var(--neutral);
            font-weight: 600;
            color: var(--text);
            border-bottom: 2px solid var(--neutral-dark);
        }

        .profile-table tbody tr { 
            transition: var(--transition);
        }

        .profile-table tbody tr:hover { 
            background-color: var(--neutral);
        }

        .profile-table .action-buttons { 
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
        }

        .profile-table .action-buttons button { 
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .profile-table .action-buttons button.access { 
            background-color: #e8f5e9;
            color: #2e7d32;
            border-color: #c8e6c9;
        }

        .profile-table .action-buttons button.edit { 
            background-color: #e3f2fd;
            color: #1565c0;
            border-color: #bbdefb;
        }

        .profile-table .action-buttons button.delete { 
            background-color: #ffebee;
            color: #c62828;
            border-color: #ffcdd2;
        }

        .profile-table .action-buttons button:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            overflow-y: auto;
        }

        .modal-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--neutral-light);
            margin: 0;
            padding: 35px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            max-width: 600px;
            width: 90vw;
            z-index: 2100;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content h2 {
            color: var(--text);
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }

        .modal-content h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--gradient-secondary);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-light);
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--neutral-dark);
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
            background-color: var(--neutral);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 97, 186, 0.1);
            background-color: var(--neutral-light);
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
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--neutral-dark);
        }

        .button-group button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
        }

        .save-btn {
            background: var(--gradient-secondary);
            color: white;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .cancel-btn {
            background: var(--neutral);
            color: var(--text);
        }

        .cancel-btn:hover {
            background: var(--neutral-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .close {
            position: absolute;
            right: 25px;
            top: 20px;
            font-size: 28px;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close:hover {
            color: var(--text);
            background-color: var(--neutral);
        }

        /* User ID Styling */
        .user-id {
            font-weight: 600;
            color: var(--clean-blue-600);
            font-family: 'Courier New', monospace;
        }

        /* User Type Tabs */
        .user-type-tabs {
            display: flex;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--clean-gray-200);
            background-color: var(--clean-white);
            border-radius: 6px 6px 0 0;
            overflow: hidden;
        }

        .tab-button {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            background-color: var(--clean-gray-50);
            color: var(--clean-gray-600);
            font-weight: 500;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .tab-button:hover {
            background-color: var(--clean-gray-100);
            color: var(--clean-gray-700);
        }

        .tab-button.active {
            background-color: var(--clean-white);
            color: var(--clean-blue-600);
            border-bottom-color: var(--clean-blue-600);
        }

        .tab-button .count {
            margin-left: 0.5rem;
            background-color: var(--clean-gray-300);
            color: var(--clean-gray-700);
            padding: 0.125rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .tab-button.active .count {
            background-color: var(--clean-blue-100);
            color: var(--clean-blue-700);
        }

        /* Grade Level Filters for Students */
        .grade-filters {
            display: none;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: var(--clean-gray-50);
            border-radius: 6px;
            border: 1px solid var(--clean-gray-200);
        }

        .grade-filters.show {
            display: block;
        }

        .grade-filters-label {
            font-weight: 600;
            color: var(--clean-gray-700);
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .grade-filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .grade-filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid var(--clean-gray-300);
            background-color: var(--clean-white);
            color: var(--clean-gray-600);
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .grade-filter-btn:hover {
            background-color: var(--clean-gray-50);
            border-color: var(--clean-gray-400);
        }

        .grade-filter-btn.active {
            background-color: var(--clean-blue-600);
            color: var(--clean-white);
            border-color: var(--clean-blue-600);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* User Type Headers */
        .user-type-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: var(--clean-gray-50);
            border-radius: 6px;
            border: 1px solid var(--clean-gray-200);
        }

        .user-type-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--clean-gray-800);
            margin: 0;
        }

        .user-count {
            background-color: var(--clean-blue-100);
            color: var(--clean-blue-700);
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
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
            <div class="settings-header">
                <h2>User Management</h2>
                <button class="add-profile-button" onclick="openAddProfileModal()">+ Add New User</button>
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
                <button onclick="searchUsers()">Search</button>
            </div>

            <!-- Grade Level Filters (for Students only) -->
            <div class="grade-filters" id="gradeFilters">
                <div class="grade-filters-label">Filter by Grade Level:</div>
                <div class="grade-filter-buttons">
                    <button class="grade-filter-btn active" onclick="filterByGrade('all')">All Grades</button>
                    <button class="grade-filter-btn" onclick="filterByGrade('7')">Grade 7</button>
                    <button class="grade-filter-btn" onclick="filterByGrade('8')">Grade 8</button>
                    <button class="grade-filter-btn" onclick="filterByGrade('9')">Grade 9</button>
                    <button class="grade-filter-btn" onclick="filterByGrade('10')">Grade 10</button>
                </div>
            </div>

            <!-- Admin Tab Content -->
            <div class="tab-content active" id="adminContent">
                <div class="user-type-header">
                    <h3 class="user-type-title">System Administrators</h3>
                    <span class="user-count" id="adminDisplayCount">0 users</span>
                </div>
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

            <!-- Teacher Tab Content -->
            <div class="tab-content" id="teacherContent">
                <div class="user-type-header">
                    <h3 class="user-type-title">Teachers</h3>
                    <span class="user-count" id="teacherDisplayCount">0 users</span>
                </div>
                <table class="profile-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Grade Level Access</th>
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

            <!-- Student Tab Content -->
            <div class="tab-content" id="studentContent">
                <div class="user-type-header">
                    <h3 class="user-type-title">Students</h3>
                    <span class="user-count" id="studentDisplayCount">0 users</span>
                </div>
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
    </main>

    <!-- Add Profile Modal -->
    <div id="addProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeProfileModal()">&times;</span>
            <h2>Add New User</h2>
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
                        <label for="profileTeacherGrade">Grade Level Access</label>
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
                            <option value="Other">Other</option>
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

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditProfileModal()">&times;</span>
            <h2>Edit User</h2>
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
                        <label for="editProfileTeacherGrade">Grade Level Access</label>
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
                            <option value="Other">Other</option>
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
            teacherFields.style.display = 'block';
            Array.from(teacherInputs).forEach(input => input.required = true);
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
            teacherFields.style.display = 'block';
            Array.from(teacherInputs).forEach(input => input.required = false); // Teacher grade is optional
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
        document.querySelectorAll('.grade-filter-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

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
                        <button class="access" title="View Profile">View</button>
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${user.userId}', '${user.role}', '', '', '', '${user.email || ''}', '')">Edit</button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">Delete</button>
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
                    <td colspan="6">
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
                <td>${user.teacherGrade ? `Grade ${user.teacherGrade}` : 'Not specified'}</td>
                <td>${user.email || 'Not provided'}</td>
                <td>${new Date(user.created_at).toLocaleDateString()}</td>
                <td>
                    <div class="action-buttons">
                        <button class="access" title="View Profile">View</button>
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${user.userId}', '${user.role}', '', '', '', '${user.email || ''}', '${user.teacherGrade || ''}')">Edit</button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">Delete</button>
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
                        <button class="access" title="View Profile">View</button>
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${user.userId}', '${user.role}', '${user.grade || ''}', '${user.section || ''}', '${user.gender || ''}', '${user.email || ''}', '')">Edit</button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">Delete</button>
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
        if (!confirm('Are you sure you want to delete this profile?')) return;
        
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
                alert('Profile deleted successfully!');
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