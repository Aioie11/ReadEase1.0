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

    function toggleStudentFields(role) {
        const studentFields = document.getElementById('studentFields');
        const studentInputs = studentFields.getElementsByClassName('student-field');
        
        if (role === 'student') {
            studentFields.style.display = 'block';
            Array.from(studentInputs).forEach(input => input.required = true);
            // Reset sections when role changes
            document.getElementById('profileSection').innerHTML = '<option value="">Select Section</option>';
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
            // Reset sections when role changes
            document.getElementById('editProfileSection').innerHTML = '<option value="">Select Section</option>';
        } else {
            studentFields.style.display = 'none';
            Array.from(studentInputs).forEach(input => input.required = false);
        }
    }

    function openEditProfileModal(id, name, userId, role, grade = '', section = '', gender = '') {
        document.getElementById('editProfileId').value = id;
        document.getElementById('editProfileName').value = name;
        document.getElementById('editProfileUserId').value = userId;
        document.getElementById('editProfileRole').value = role;
        
        if (role === 'student') {
            document.getElementById('editStudentFields').style.display = 'block';
            document.getElementById('editProfileGrade').value = grade;
            // Update sections based on grade
            updateEditSections(grade);
            document.getElementById('editProfileSection').value = section;
            document.getElementById('editProfileGender').value = gender;
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
                        <button class="edit" title="Edit Profile" onclick="openEditProfileModal(${user.id}, '${user.name}', '${user.userId}', '${user.role}', '${user.grade || ''}', '${user.section || ''}', '${user.gender || ''}')">Edit</button>
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
                loadProfiles(); // Refresh the table
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