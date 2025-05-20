<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings</title>
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

        .nav-menu {
            list-style: none;
            margin-bottom: 2rem;
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

        /* Header Styles */
        header {
            background: var(--primary);
            padding: 1rem 5%;
            position: fixed;
            width: calc(100% - 280px);
            margin-left: 280px;
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        /* Main Content */
        .main-content {
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
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .modal-content {
            background: var(--neutral-light);
            margin: 20px auto;
            padding: 35px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            max-width: 600px;
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
                    <a href="{{ route('admin.reports') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link active">
                        <i class="fas fa-cog"></i>
                        Settings
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="settings-content">
            <div class="settings-header">
                <h2>User Management</h2>
                <button class="add-profile-button" onclick="openAddProfileModal()">+ Add New User</button>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search profiles...">
                <button>Search</button>
            </div>
            <table class="profile-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Profile Name</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody id="profileTableBody">
                    <!-- Profiles will be loaded here -->
                </tbody>
            </table>
        </div>
    </main>

    <!-- Add Profile Modal -->
    <div id="addProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeProfileModal()">&times;</span>
            <h2>Add New User</h2>
            <form id="addProfileForm">
                <div class="form-group">
                    <label for="profileName">Full Name</label>
                    <input type="text" id="profileName" name="name" required placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="profileEmail">Email Address</label>
                    <input type="email" id="profileEmail" name="email" required placeholder="Enter email address">
                </div>
                <div class="form-group">
                    <label for="profilePassword">Password</label>
                    <input type="password" id="profilePassword" name="password" required placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="profileRole">Role</label>
                    <select id="profileRole" name="role" required onchange="toggleStudentFields(this.value)">
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div id="studentFields" style="display: none;">
                    <div class="form-group">
                        <label for="profileGrade">Grade Level</label>
                        <select id="profileGrade" name="grade" class="student-field">
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
                            <option value="A">Section A</option>
                            <option value="B">Section B</option>
                            <option value="C">Section C</option>
                            <option value="D">Section D</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="profileUserId">User ID</label>
                    <input type="text" id="profileUserId" name="userId" required placeholder="Enter User ID (e.g., ADMIN123)">
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
                    <label for="editProfileEmail">Email Address</label>
                    <input type="email" id="editProfileEmail" name="email" required placeholder="Enter email address">
                </div>
                <div class="form-group">
                    <label for="editProfilePassword">New Password (optional)</label>
                    <input type="password" id="editProfilePassword" name="password" placeholder="Leave blank to keep current password">
                </div>
                <div class="form-group">
                    <label for="editProfileRole">Role</label>
                    <select id="editProfileRole" name="role" required onchange="toggleEditStudentFields(this.value)">
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div id="editStudentFields" style="display: none;">
                    <div class="form-group">
                        <label for="editProfileGrade">Grade Level</label>
                        <select id="editProfileGrade" name="grade" class="student-field">
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
                            <option value="A">Section A</option>
                            <option value="B">Section B</option>
                            <option value="C">Section C</option>
                            <option value="D">Section D</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="editProfileUserId">User ID</label>
                    <input type="text" id="editProfileUserId" name="userId" required placeholder="Enter User ID (e.g., ADMIN123)">
                </div>
                <div class="button-group">
                    <button type="button" class="cancel-btn" onclick="closeEditProfileModal()">Cancel</button>
                    <button type="submit" class="save-btn">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function toggleStudentFields(role) {
        const studentFields = document.getElementById('studentFields');
        const studentInputs = studentFields.getElementsByClassName('student-field');
        
        if (role === 'student') {
            studentFields.style.display = 'block';
            Array.from(studentInputs).forEach(input => input.required = true);
        } else {
            studentFields.style.display = 'none';
            Array.from(studentInputs).forEach(input => input.required = false);
        }
    }

    function toggleEditStudentFields(role) {
        const studentFields = document.getElementById('editStudentFields');
        const studentInputs = studentFields.getElementsByClassName('student-field');
        
        if (role === 'student') {
            studentFields.style.display = 'block';
            Array.from(studentInputs).forEach(input => input.required = true);
        } else {
            studentFields.style.display = 'none';
            Array.from(studentInputs).forEach(input => input.required = false);
        }
    }

    function openEditProfileModal(id, name, userId, role, grade = '', section = '') {
        document.getElementById('editProfileId').value = id;
        document.getElementById('editProfileName').value = name;
        document.getElementById('editProfileUserId').value = userId;
        document.getElementById('editProfileRole').value = role;
        
        if (role === 'student') {
            document.getElementById('editStudentFields').style.display = 'block';
            document.getElementById('editProfileGrade').value = grade;
            document.getElementById('editProfileSection').value = section;
        } else {
            document.getElementById('editStudentFields').style.display = 'none';
        }
        
        document.getElementById('editProfileModal').style.display = 'block';
    }

    function renderProfiles(users) {
        const tbody = document.getElementById('profileTableBody');
        tbody.innerHTML = '';
        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><span style="font-weight:bold; color:#004aad;">${user.userId}</span></td>
                <td>${user.name}</td>
                <td>${user.role === 'admin' ? 'CRUD Anything' : user.role === 'student' ? 'Student Profile' : 'Teacher Profile'}</td>
                <td>${new Date(user.created_at).toLocaleDateString()}</td>
                <td>
                    <div class="action-buttons">
                        <button class="access" title="Access Profile">Access</button>
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name}', '${user.userId}', '${user.role}', '${user.grade || ''}', '${user.section || ''}')">Edit</button>
                        <button class="delete" title="Delete Profile" onclick="deleteProfile(${user.id})">Delete</button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function loadProfiles() {
        fetch('/admin/users')
            .then(res => res.json())
            .then(renderProfiles);
    }

    // Call on page load
    loadProfiles();

    // After successful add, call loadProfiles() again
    function openAddProfileModal() {
        document.getElementById('addProfileModal').style.display = 'block';
    }
    function closeProfileModal() {
        document.getElementById('addProfileModal').style.display = 'none';
    }
    document.getElementById('addProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/admin/users', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) return response.json().then(err => Promise.reject(err));
            return response.json();
        })
        .then(data => {
            alert('Profile added successfully!');
            closeProfileModal();
            document.getElementById('addProfileForm').reset();
            loadProfiles(); // Refresh the table
        })
        .catch(error => {
            let msg = 'An error occurred.';
            if (error.errors) {
                msg = Object.values(error.errors).flat().join('\n');
            }
            alert(msg);
        });
    });

    function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('editProfileId').value;
        const formData = new FormData(this);
        let data = {};
        formData.forEach((value, key) => { if (value) data[key] = value; });
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
            if (!response.ok) return response.json().then(err => Promise.reject(err));
            return response.json();
        })
        .then(data => {
            alert('Profile updated successfully!');
            closeEditProfileModal();
            loadProfiles();
        })
        .catch(error => {
            let msg = 'An error occurred.';
            if (error.errors) {
                msg = Object.values(error.errors).flat().join('\n');
            }
            alert(msg);
        });
    });

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
</body>
</html>