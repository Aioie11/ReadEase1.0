<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Records</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styles */
        .sidebar {
            width: 200px;
            background-color: #e0f2f7;
            padding: 20px;
            box-sizing: border-box;
          
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #b0bec5;
        }

        .sidebar li:hover {
            background-color: #b2ebf2;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-left: 50px;
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            background-color: #f5f5f5;
        }

        /* Header styles */
        .header {
            background-color: #003399;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-controls {
            display: flex;
            gap: 15px;
        }

        .user-controls span {
            cursor: pointer;
            font-size: 20px;
        }

        /* Search and add student section */
        .search-section {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
        }

        .search-box {
            flex: 1;
            margin-right: 20px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding-right: 30px;
        }

        .search-box button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
        }

        .add-student-btn {
            padding: 8px 16px;
            background-color: #87CEEB;
            border: none;
            border-radius: 5px;
            color: #333;
            cursor: pointer;
        }

        /* Students masterlist section */
        .masterlist-section {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .masterlist-header {
            background: linear-gradient(135deg, #87CEEB, #4a90e2);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .masterlist-header h2 {
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Grade section styles */
        .grade-section {
            background-color: white;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .grade-header {
            background: linear-gradient(135deg, #87CEEB, #4a90e2);
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .grade-header:hover {
            background: linear-gradient(135deg, #4a90e2, #87CEEB);
        }

        .grade-header i {
            margin-right: 15px;
            font-size: 20px;
        }

        .section-group {
            margin: 15px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            background: #f8f9fa;
            color: #333;
            padding: 12px 20px;
            margin: 0;
            font-size: 1.1em;
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin: 0;
        }

        .student-table th {
            background: #f8f9fa;
            color: #333;
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #e9ecef;
        }

        .student-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            color: #444;
        }

        .student-table tr:hover {
            background-color: #f8f9fa;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            margin: 3% auto;
            padding: 35px;
            width: 700px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-content h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 26px;
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
            background: linear-gradient(135deg, #87CEEB, #4a90e2);
            border-radius: 2px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
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
            border-color: #87CEEB;
            outline: none;
            box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.2);
            background-color: white;
        }

        .form-group input::placeholder {
            color: #999;
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
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .button-group button {
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .save-btn {
            background: linear-gradient(135deg, #87CEEB, #4a90e2);
            color: white;
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #4a90e2, #87CEEB);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .clear-btn {
            background: #ff6b6b;
            color: white;
        }

        .clear-btn:hover {
            background: #ff5252;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cancel-btn {
            background: #e9ecef;
            color: #333;
        }

        .cancel-btn:hover {
            background: #dee2e6;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        /* Responsive design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }

            .student-info {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            background: #e3f2fd;
            margin-bottom: 10px;
            border-radius: 5px;
            overflow: hidden;
        }
        .student-table th, .student-table td {
            padding: 10px 12px;
            text-align: left;
        }
        .student-table th {
            background: #b2ebf2;
            font-weight: bold;
            border-bottom: 2px solid #90caf9;
        }
        .student-table tr:nth-child(even) {
            background: #f5fafd;
        }
        .student-table tr:hover {
            background: #e1f5fe;
        }

        .section-group {
            margin-bottom: 20px;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }

        .section-header {
            background: #87CEEB;
            color: #333;
            padding: 10px 15px;
            margin: 0;
            font-size: 1.1em;
            border-bottom: 2px solid #90caf9;
        }

        .student-table {
            margin: 0;
            border-radius: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <ul>
        <img src="{{ asset('pic/logo .png') }}" alt="Logo" class="logo">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.test-management') }}">Test Management</a></li>
            <li><a href="{{ route('admin.student-records') }}">Student Record</a></li>
            <li><a href="{{ route('admin.reports') }}">Reports</a></li>
            <li><a href="{{ route('admin.settings') }}">Settings</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <main class="main-content">
        <header class="header">
            <h1>STUDENT RECORDS</h1>
            <div class="user-controls">
                <span>♪</span>
                <span>○</span>
            </div>
        </header>

        <!-- Search and Add Student Section -->
        <section class="search-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Find Student">
                <button onclick="searchStudents()">🔍</button>
            </div>
            <button class="add-student-btn" onclick="openAddStudentModal()">+ Add Student</button>
        </section>

        <!-- Students Masterlist Section -->
        <section class="masterlist-section">
            <div class="masterlist-header">
                <h2>STUDENTS MASTERLIST</h2>
            </div>

            @foreach([7, 8, 9, 10] as $grade)
            <div class="grade-section">
                <div class="grade-header" onclick="toggleGrade('grade{{ $grade }}')">
                    <i>👤</i> GRADE {{ $grade }}
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
                            <div class="section-group">
                                <h3 class="section-header">{{ $section }}</h3>
                                <table class="student-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Grade Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students[$grade]->where('section', $section) as $student)
                                            <tr>
                                                <td>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>Grade {{ $student->grade_level }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @else
                        <div style="padding: 10px; color: #888;">No students in this grade.</div>
                    @endif
                </div>
            </div>
            @endforeach
        </section>

        <!-- Add Student Modal -->
        <div id="addStudentModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Add New Student</h2>
                <form id="addStudentForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="last_name" required placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="first_name" required placeholder="Enter first name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middle_name" placeholder="Enter middle name">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="gradeLevel">Grade Level</label>
                            <select id="gradeLevel" name="grade_level" required onchange="updateSections()">
                                <option value="">Select Grade Level</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="section">Section</label>
                            <select id="section" name="section" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="button" class="clear-btn" onclick="clearForm()">Clear Form</button>
                        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="save-btn">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Toggle grade sections
        function toggleGrade(gradeId) {
            const gradeElement = document.getElementById(gradeId);
            const currentDisplay = gradeElement.style.display;
            gradeElement.style.display = currentDisplay === 'none' ? 'block' : 'none';
        }

        // Define sections for each grade level
        const gradeSections = {
            7: ['Narra', 'Dao', 'Mahugani', 'Lawaan'],
            8: ['Avocado', 'Guava', 'Duhat', 'Mango'],
            9: ['Gold', 'Silver', 'Zinc'],
            10: ['Galileo', 'Edison', 'Newton']
        };

        // Function to update sections based on selected grade
        function updateSections() {
            const gradeLevel = document.getElementById('gradeLevel').value;
            const sectionSelect = document.getElementById('section');
            
            // Clear existing options
            sectionSelect.innerHTML = '<option value="">Select Section</option>';
            
            // Add new options based on grade level
            if (gradeLevel && gradeSections[gradeLevel]) {
                gradeSections[gradeLevel].forEach(section => {
                    const option = document.createElement('option');
                    option.value = section;
                    option.textContent = section;
                    sectionSelect.appendChild(option);
                });
            }
        }

        // Modal functions
        function openAddStudentModal() {
            document.getElementById('addStudentModal').style.display = 'block';
            updateSections(); // Initialize sections for the default grade level
        }

        function closeModal() {
            document.getElementById('addStudentModal').style.display = 'none';
        }

        function clearForm() {
            document.getElementById('addStudentForm').reset();
        }

        // Search functionality
        function searchStudents() {
            const query = document.getElementById('searchInput').value.trim();
            fetch(`/admin/students/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    // Clear all grade tables
                    [7,8,9,10].forEach(grade => {
                        const gradeElement = document.getElementById(`grade${grade}`);
                        if (gradeElement) gradeElement.innerHTML = '';
                    });

                    // Render filtered students
                    Object.keys(data).forEach(grade => {
                        const students = data[grade];
                        const gradeElement = document.getElementById(`grade${grade}`);
                        if (gradeElement && students.length > 0) {
                            let tableHtml = `
                                <table class="student-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Section</th>
                                            <th>Gender</th>
                                            <th>Grade Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            `;
                            students.forEach(student => {
                                tableHtml += `
                                    <tr>
                                        <td>${student.last_name}, ${student.first_name} ${student.middle_name || ''}</td>
                                        <td>${student.section}</td>
                                        <td>${student.gender}</td>
                                        <td>Grade ${student.grade_level}</td>
                                    </tr>
                                `;
                            });
                            tableHtml += '</tbody></table>';
                            gradeElement.innerHTML = tableHtml;
                        }
                    });
                });
        }

        // Form submission
        document.getElementById('addStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const formValues = Object.fromEntries(formData);
            
            // Display all form values in console
            console.log('Form Input Values:');
            console.log('First Name:', formValues.first_name);
            console.log('Last Name:', formValues.last_name);
            console.log('Middle Name:', formValues.middle_name);
            console.log('Gender:', formValues.gender);
            console.log('Grade Level:', formValues.grade_level);
            console.log('Section:', formValues.section);
            
            fetch('/admin/students', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // Get the grade level of the new student
                const gradeLevel = data.student.grade_level;
                
                // Find the grade section
                const gradeElement = document.getElementById(`grade${gradeLevel}`);
                
                if (gradeElement) {
                    // Create new student item HTML
                    const newStudentHtml = `
                        <div class="student-item">
                            <img src="placeholder-profile.png" alt="Profile" class="student-profile">
                            <div class="student-info">
                                <span>${data.student.student_number}</span>
                                <span>${data.student.last_name}</span>
                                <span>${data.student.first_name}</span>
                                <span>${data.student.middle_name || ''}</span>
                                <span>${data.student.gender}</span>
                            </div>
                        </div>
                    `;
                    
                    // Add the new student to the grade section
                    gradeElement.insertAdjacentHTML('beforeend', newStudentHtml);
                    
                    // Show success message
                    alert('Student added successfully!');
                    
                    // Close the modal and clear the form
                    closeModal();
                    clearForm();
                } else {
                    alert('Error: Could not find grade section');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors) {
                    // Display validation errors
                    let errorMessage = 'Please fix the following errors:\n';
                    Object.entries(error.errors).forEach(([field, messages]) => {
                        errorMessage += `\n${field}: ${messages.join(', ')}`;
                    });
                    alert(errorMessage);
                } else {
                    alert('An error occurred while saving the student. Please try again.');
                }
            });
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                closeModal();
            }
        }

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchStudents();
            }
        });
    </script>
</body>
</html>