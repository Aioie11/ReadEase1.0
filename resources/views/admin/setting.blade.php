<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container { 
            display: flex; 
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar { 
            width: 250px; 
            background: linear-gradient(180deg, #e0f2f7 0%, #b2ebf2 100%);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar ul { 
            list-style: none; 
            padding: 0;
            margin-top: 20px;
        }

        .sidebar li { 
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar li:hover { 
            background-color: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: block;
        }

        .logo { 
            width: 120px; 
            height: 120px; 
            margin: 0 auto 20px;
            display: block;
        }

        /* Main Content Styles */
        .settings-content { 
            flex: 1; 
            padding: 30px;
            background-color: #f8f9fa;
        }

        .settings-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }

        .settings-header h2 { 
            color: #2c3e50;
            font-size: 28px;
            font-weight: 600;
        }

        .add-profile-button { 
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .add-profile-button:hover { 
            background: linear-gradient(135deg, #45a049, #4CAF50);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Search Bar Styles */
        .search-bar { 
            display: flex; 
            align-items: center;
            margin-bottom: 25px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-bar input[type="text"] { 
            flex: 1;
            padding: 12px 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-bar input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .search-bar button { 
            background: linear-gradient(135deg, #5EC0F2, #4a90e2);
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            margin-left: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-bar button:hover { 
            background: linear-gradient(135deg, #4a90e2, #5EC0F2);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Table Styles */
        .profile-table { 
            width: 100%; 
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .profile-table th, 
        .profile-table td { 
            padding: 15px 20px; 
            text-align: left;
        }

        .profile-table th { 
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #e9ecef;
        }

        .profile-table tbody tr { 
            transition: all 0.3s ease;
        }

        .profile-table tbody tr:hover { 
            background-color: #f8f9fa;
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
            transition: all 0.2s ease;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .profile-table .action-buttons button.access:hover { 
            background-color: #c8e6c9;
        }

        .profile-table .action-buttons button.edit:hover { 
            background-color: #bbdefb;
        }

        .profile-table .action-buttons button.delete:hover { 
            background-color: #ffcdd2;
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
            background: white;
            margin: 20px auto;
            padding: 35px;
            width: 500px;
            border-radius: 15px;
            position: relative;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .modal-content h2 {
            color: #2c3e50;
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
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            background-color: white;
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
            border-top: 1px solid #eee;
            position: sticky;
            bottom: 0;
            background: white;
            padding-bottom: 10px;
        }

        .button-group button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
        }

        .save-btn {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #45a049, #4CAF50);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .cancel-btn {
            background: #e9ecef;
            color: #333;
        }

        .cancel-btn:hover {
            background: #dee2e6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .close {
            position: absolute;
            right: 25px;
            top: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
            transition: all 0.3s ease;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close:hover {
            color: #333;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="{{ asset('pic/logo .png') }}" alt="Logo" class="logo">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.test-management') }}">Test Management</a></li>
                <li><a href="{{ route('admin.student-records') }}">Student Record</a></li>
                <li><a href="{{ route('admin.reports') }}">Reports</a></li>
                <li><a href="{{ route('admin.settings') }}">Settings</a></li>
            </ul>
        </div>
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
    </div>

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
    </script>
</body>
</html>