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

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 6rem 5% 2rem;
            transition: var(--transition);
        }

        /* Search Section */
        .search-section {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
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
            padding: 0.8rem 1rem;
            padding-right: 3rem;
            border: 1px solid var(--neutral-dark);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 97, 186, 0.1);
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
            color: var(--primary);
        }

        .add-student-btn {
            padding: 0.8rem 1.5rem;
            background: var(--primary);
            color: var(--neutral-light);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-student-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Masterlist Section */
        .masterlist-section {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .masterlist-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .masterlist-header h2 {
            color: var(--primary);
            font-size: 1.8rem;
            font-weight: 600;
        }

        /* Grade Section */
        .grade-section {
            margin-bottom: 1rem;
            background: var(--neutral-light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .grade-header {
            background: var(--primary);
            color: var(--neutral-light);
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: var(--transition);
        }

        .grade-header:hover {
            background: var(--primary-dark);
        }

        .grade-header i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .grade-header.collapsed i {
            transform: rotate(-90deg);
        }

        .student-list {
            display: none;
            padding: 1rem;
        }

        .student-list.active {
            display: block;
        }

        .section-group {
            margin-bottom: 1rem;
            background: var(--neutral);
            border-radius: 8px;
            overflow: hidden;
        }

        .section-header {
            background: var(--primary-light);
            color: var(--neutral-light);
            padding: 1rem 1.2rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: var(--transition);
        }

        .section-header:hover {
            background: var(--primary-dark);
        }

        .section-header i {
            transition: transform 0.3s ease;
        }

        .section-header.collapsed i {
            transform: rotate(-90deg);
        }

        .section-content {
            display: none;
            padding: 1rem;
            background: var(--neutral-light);
        }

        .section-content.active {
            display: block;
        }

        /* Student Table */
        .student-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--neutral-light);
        }

        .student-table th {
            background: var(--neutral);
            color: var(--text);
            font-weight: 500;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid var(--neutral-dark);
        }

        .student-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--neutral-dark);
            color: var(--text);
        }

        .student-table tr:hover {
            background: var(--neutral);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1002;
            overflow-y: auto;
        }

        .modal-content {
            position: relative;
            background: var(--neutral-light);
            margin: 2rem auto;
            padding: 2rem;
            width: 90%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: var(--neutral);
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        .close {
            position: sticky;
            top: 0;
            right: 1.5rem;
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
            background: var(--neutral-light);
            padding: 0.5rem;
            z-index: 1;
        }

        .close:hover {
            color: var(--text);
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--neutral-dark);
            border-radius: 6px;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 97, 186, 0.1);
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--neutral-dark);
        }

        .button-group button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .save-btn {
            background: var(--primary);
            color: var(--neutral-light);
        }

        .save-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .clear-btn {
            background: #dc2626;
            color: var(--neutral-light);
        }

        .clear-btn:hover {
            background: #b91c1c;
            transform: translateY(-2px);
        }

        .cancel-btn {
            background: var(--neutral);
            color: var(--text);
        }

        .cancel-btn:hover {
            background: var(--neutral-dark);
            transform: translateY(-2px);
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

            .search-section {
                flex-direction: column;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* Add these styles to your existing CSS */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
        }

        .edit-btn, .delete-btn {
            padding: 0.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-btn {
            background: var(--primary);
            color: var(--neutral-light);
        }

        .edit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .delete-btn {
            background: #dc2626;
            color: var(--neutral-light);
        }

        .delete-btn:hover {
            background: #b91c1c;
            transform: translateY(-2px);
        }

        /* Confirmation Modal Styles */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1002;
        }

        .confirmation-content {
            position: relative;
            background: var(--neutral-light);
            margin: 15% auto;
            padding: 2rem;
            width: 90%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .confirm-delete {
            background: #dc2626;
            color: var(--neutral-light);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .confirm-delete:hover {
            background: #b91c1c;
            transform: translateY(-2px);
        }

        .cancel-delete {
            background: var(--neutral);
            color: var(--text);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .cancel-delete:hover {
            background: var(--neutral-dark);
            transform: translateY(-2px);
        }

        /* Add these styles to your existing CSS */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
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
        <!-- Search and Add Student Section -->
        <section class="search-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Find Student">
                <button onclick="searchStudents()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="add-student-btn" onclick="openAddStudentModal()">
                <i class="fas fa-plus"></i>
                Add Student
            </button>
        </section>

        <!-- Students Masterlist Section -->
        <section class="masterlist-section">
            <div class="masterlist-header">
                <h2>STUDENTS MASTERLIST</h2>
            </div>

            @foreach([7, 8, 9, 10] as $grade)
            <div class="grade-section">
                <div class="grade-header collapsed" onclick="toggleGrade('grade{{ $grade }}')">
                    <span>GRADE {{ $grade }}</span>
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
                            <div class="section-group">
                                <div class="section-header collapsed" onclick="toggleSection('section-{{ $grade }}-{{ $section }}')">
                                    <span>{{ $section }}</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div id="section-{{ $grade }}-{{ $section }}" class="section-content">
                                    <div class="student-table-scroll">
                                        <table class="student-table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Grade Level</th>
                                                    <th>Test Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students[$grade]->where('section', $section) as $student)
                                                    <tr>
                                                        <td>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</td>
                                                        <td>{{ $student->gender }}</td>
                                                        <td>Grade {{ $student->grade_level }}</td>
                                                        <td>
                                                            @php
                                                                $status = $student->test_status ?? 'not_started';
                                                                $statusClass = '';
                                                                $statusText = '';
                                                                $statusIcon = '';
                                                                
                                                                switch($status) {
                                                                    case 'completed':
                                                                        $statusClass = 'status-completed';
                                                                        $statusText = 'Completed';
                                                                        $statusIcon = 'fa-check-circle';
                                                                        break;
                                                                    case 'in_progress':
                                                                        $statusClass = 'status-in-progress';
                                                                        $statusText = 'In Progress';
                                                                        $statusIcon = 'fa-clock';
                                                                        break;
                                                                    default:
                                                                        $statusClass = 'status-not-started';
                                                                        $statusText = 'Not Started';
                                                                        $statusIcon = 'fa-circle';
                                                                        break;
                                                                }
                                                            @endphp
                                                            <span class="status-badge {{ $statusClass }}">
                                                                <i class="fas {{ $statusIcon }} status-icon"></i>
                                                                {{ $statusText }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <button class="edit-btn" onclick="openEditModal('{{ $student->id }}', '{{ $student->last_name }}', '{{ $student->first_name }}', '{{ $student->middle_name }}', '{{ $student->gender }}', '{{ $student->grade_level }}', '{{ $student->section }}', '{{ $status }}')">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="delete-btn" onclick="confirmDelete('{{ $student->id }}', '{{ $student->last_name }}, {{ $student->first_name }}')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
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
                    <div class="form-row">
                        <div class="form-group">
                            <label for="testStatus">Test Status</label>
                            <select id="testStatus" name="test_status" required>
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
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

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('editModal')">&times;</span>
                <h2>Edit Student Record</h2>
                <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-student-id" name="student_id">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-lastName">Last Name</label>
                            <input type="text" id="edit-lastName" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-firstName">First Name</label>
                            <input type="text" id="edit-firstName" name="first_name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-middleName">Middle Name</label>
                            <input type="text" id="edit-middleName" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="edit-gender">Gender</label>
                            <select id="edit-gender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-gradeLevel">Grade Level</label>
                            <select id="edit-gradeLevel" name="grade_level" required onchange="updateEditSections()">
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-section">Section</label>
                            <select id="edit-section" name="section" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-testStatus">Test Status</label>
                            <select id="edit-testStatus" name="test_status" required>
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="button" class="cancel-btn" onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit" class="save-btn">Update Student</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Confirmation Modal -->
        <div id="confirmationModal" class="confirmation-modal">
            <div class="confirmation-content">
                <h3>Confirm Delete</h3>
                <p>Are you sure you want to delete this student?</p>
                <p id="studentToDelete" style="font-weight: 500; margin: 1rem 0;"></p>
                <div class="confirmation-buttons">
                    <button class="cancel-delete" onclick="closeConfirmationModal()">Cancel</button>
                    <button class="confirm-delete" onclick="deleteStudent()">Delete</button>
                </div>
            </div>
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
            console.log('Test Status:', formValues.test_status);
            
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
                    // Create new student item HTML with status
                    const status = data.student.test_status || 'not_started';
                    const statusClass = getStatusClass(status);
                    const statusText = getStatusText(status);
                    const statusIcon = getStatusIcon(status);
                    
                    const newStudentHtml = `
                        <div class="student-item">
                            <img src="placeholder-profile.png" alt="Profile" class="student-profile">
                            <div class="student-info">
                                <span>${data.student.student_number}</span>
                                <span>${data.student.last_name}</span>
                                <span>${data.student.first_name}</span>
                                <span>${data.student.middle_name || ''}</span>
                                <span>${data.student.gender}</span>
                                <span class="status-badge ${statusClass}">
                                    <i class="fas ${statusIcon} status-icon"></i>
                                    ${statusText}
                                </span>
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

        // Add sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Add these functions to your existing JavaScript
        let studentToDeleteId = null;

        function confirmDelete(id, name) {
            studentToDeleteId = id;
            document.getElementById('studentToDelete').textContent = name;
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'none';
            studentToDeleteId = null;
        }

        function deleteStudent() {
            if (!studentToDeleteId) return;

            fetch(`/admin/students/${studentToDeleteId}`, {
                method: 'DELETE',
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
                closeConfirmationModal();
                // Remove the student row from the table
                const row = document.querySelector(`tr[data-student-id="${studentToDeleteId}"]`);
                if (row) {
                    row.remove();
                }
                // Show success message
                alert('Student deleted successfully');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete student. Please try again.');
            });
        }

        // Close confirmation modal when clicking outside
        window.onclick = function(event) {
            const confirmationModal = document.getElementById('confirmationModal');
            if (event.target == confirmationModal) {
                closeConfirmationModal();
            }
        }

        // Add these functions to your existing JavaScript
        function openEditModal(id, lastName, firstName, middleName, gender, gradeLevel, section, status) {
            const modal = document.getElementById('editModal');
            modal.style.display = 'block';
            
            // Set form values
            document.getElementById('edit-student-id').value = id;
            document.getElementById('edit-lastName').value = lastName;
            document.getElementById('edit-firstName').value = firstName;
            document.getElementById('edit-middleName').value = middleName || '';
            document.getElementById('edit-gender').value = gender;
            document.getElementById('edit-gradeLevel').value = gradeLevel;
            document.getElementById('edit-testStatus').value = status;
            
            // Update sections based on grade level
            updateEditSections();
            
            // Set the section value after sections are populated
            setTimeout(() => {
                document.getElementById('edit-section').value = section;
            }, 100);
        }

        function updateEditSections() {
            const gradeLevel = document.getElementById('edit-gradeLevel').value;
            const sectionSelect = document.getElementById('edit-section');
            
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

        // Add event listener for edit form submission
        document.getElementById('editStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const studentId = document.getElementById('edit-student-id').value;
            
            fetch(`/admin/students/${studentId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update the table row with new data
                const row = document.querySelector(`tr[data-student-id="${studentId}"]`);
                if (row) {
                    row.querySelector('td:nth-child(1)').textContent = `${formData.get('last_name')}, ${formData.get('first_name')} ${formData.get('middle_name')}`;
                    row.querySelector('td:nth-child(2)').textContent = formData.get('gender');
                    row.querySelector('td:nth-child(3)').textContent = `Grade ${formData.get('grade_level')}`;
                    
                    // Update status badge
                    const status = formData.get('test_status');
                    const statusClass = getStatusClass(status);
                    const statusText = getStatusText(status);
                    const statusIcon = getStatusIcon(status);
                    
                    const statusCell = row.querySelector('td:nth-child(4)');
                    statusCell.innerHTML = `
                        <span class="status-badge ${statusClass}">
                            <i class="fas ${statusIcon} status-icon"></i>
                            ${statusText}
                        </span>
                    `;
                }
                
                // Close modal and show success message
                closeModal('editModal');
                alert('Student record updated successfully!');
                
                // Refresh the page to show updated data
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the student record. Please try again.');
            });
        });

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Update window click handler
        window.onclick = function(event) {
            const addModal = document.getElementById('addStudentModal');
            const editModal = document.getElementById('editModal');
            const confirmationModal = document.getElementById('confirmationModal');
            
            if (event.target === addModal) {
                closeModal('addStudentModal');
            }
            if (event.target === editModal) {
                closeModal('editModal');
            }
            if (event.target === confirmationModal) {
                closeConfirmationModal();
            }
        }

        // Helper functions for status
        function getStatusClass(status) {
            switch(status) {
                case 'completed': return 'status-completed';
                case 'in_progress': return 'status-in-progress';
                default: return 'status-not-started';
            }
        }

        function getStatusText(status) {
            switch(status) {
                case 'completed': return 'Completed';
                case 'in_progress': return 'In Progress';
                default: return 'Not Started';
            }
        }

        function getStatusIcon(status) {
            switch(status) {
                case 'completed': return 'fa-check-circle';
                case 'in_progress': return 'fa-clock';
                default: return 'fa-circle';
            }
        }

        // Add this function to your existing JavaScript
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const header = section.previousElementSibling;
            
            section.classList.toggle('active');
            header.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
@endsection