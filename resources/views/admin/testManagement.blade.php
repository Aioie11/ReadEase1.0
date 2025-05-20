<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Management System</title>
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

        /* Content Box */
        .content-box {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        /* Admin Controls */
        .admin-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .admin-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            background: var(--primary);
            color: var(--neutral-light);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .admin-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .admin-btn.delete {
            background: #dc2626;
        }

        .admin-btn.delete:hover {
            background: #b91c1c;
        }

        /* Grade Selector */
        .grade-selector {
            background: var(--neutral);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .grade-selector select {
            padding: 0.5rem 1rem;
            border: 1px solid var(--neutral-dark);
            border-radius: 6px;
            background: var(--neutral-light);
            color: var(--text);
            font-size: 0.95rem;
        }

        /* Subject Selection */
        .subject-selection {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .subject-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            background: var(--neutral);
            color: var(--text);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .subject-btn:hover, .subject-btn.active {
            background: var(--primary);
            color: var(--neutral-light);
        }

        /* Reading Passage */
        .reading-passage {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .reading-passage h3 {
            color: var(--text);
            margin-bottom: 1rem;
        }

        /* Questions Section */
        .questions-section {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .questions-section h3 {
            color: var(--text);
            margin-bottom: 1.5rem;
        }

        .question {
            background: var(--neutral);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .radio-option {
            display: block;
            padding: 1rem;
            margin: 0.5rem 0;
            background: var(--neutral-light);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .radio-option:hover {
            background: var(--primary-light);
            color: var(--neutral-light);
        }

        .text-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--neutral-dark);
            border-radius: 6px;
            margin: 0.5rem 0;
            font-size: 0.95rem;
        }

        /* Button Group */
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .submit-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            background: var(--primary);
            color: var(--neutral-light);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .clear-btn {
            padding: 0.8rem 1.5rem;
            border: 1px solid var(--primary);
            border-radius: 8px;
            background: transparent;
            color: var(--primary);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .clear-btn:hover {
            background: var(--primary);
            color: var(--neutral-light);
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

        .close-modal {
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

        .close-modal:hover {
            color: var(--text);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--neutral-dark);
            border-radius: 6px;
            font-size: 0.95rem;
        }

        .question-container {
            background: var(--neutral);
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
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

            .admin-controls {
                flex-direction: column;
            }

            .subject-selection {
                flex-direction: column;
            }

            .button-group {
                flex-direction: column;
            }
        }

        /* Add these new styles */
        .options-list {
            margin-top: 1rem;
        }

        .option-item {
            padding: 0.8rem;
            margin: 0.5rem 0;
            background: var(--neutral);
            border-radius: 6px;
            color: var(--text);
        }

        .text-answer {
            padding: 0.8rem;
            margin: 0.5rem 0;
            background: var(--neutral);
            border-radius: 6px;
            color: var(--text);
            font-style: italic;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            background: var(--neutral);
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--text-light);
            font-size: 1.1rem;
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
                    <a href="{{ route('admin.test-management') }}" class="nav-link active">
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
                    <a href="{{ route('admin.settings') }}" class="nav-link">
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
        <div class="content-box">
            <h2 style="margin-bottom: 2rem;">QUESTIONS</h2>
            
            <!-- Admin Controls -->
            <div class="admin-controls">
                <button class="admin-btn" onclick="openCreateModal()">Add New Reading Material</button>
                <button class="admin-btn" onclick="openEditModal()">Edit Selected</button>
                <button class="admin-btn delete" onclick="deleteSelected()">Delete Selected</button>
            </div>

            <!-- Grade Selection Dropdowns -->
            <div class="grade-selector">
                <i class="fas fa-graduation-cap"></i>
                <select>
                    <option>GRADE 7</option>
                    <option>GRADE 8</option>
                    <option>GRADE 9</option>
                    <option>GRADE 10</option>
                </select>
            </div>

            <!-- Subject Selection -->
            <div class="subject-selection">
                <button class="subject-btn" data-subject="english">English</button>
                <button class="subject-btn" data-subject="filipino">Filipino</button>
            </div>

            <!-- Reading Passage -->
            <div class="reading-passage">
                <h3>Reading Passage</h3>
                <div class="empty-state">
                    <i class="fas fa-book"></i>
                    <p>No reading passage added yet. Click "Add New Reading Material" to create content.</p>
                </div>
            </div>

            <!-- Questions Section -->
            <div class="questions-section">
                <h3>Reading Comprehension Questions</h3>
                
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="fas fa-question-circle"></i>
                    <p>No questions added yet. Click "Add New Reading Material" to create questions.</p>
                </div>

                <!-- Button Group -->
                <div class="button-group">
                    <button class="submit-btn">Save Questions</button>
                    <button class="clear-btn">Clear Form</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Modals -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('createModal')">&times;</span>
            <h2>Create New Reading Material</h2>
            <form id="createForm">
                <div class="form-group">
                    <label for="grade">Grade Level:</label>
                    <select id="grade" required>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select id="subject" required>
                        <option value="english">English</option>
                        <option value="filipino">Filipino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Reading Title:</label>
                    <input type="text" id="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Reading Content:</label>
                    <textarea id="content" rows="6" required></textarea>
                </div>
                <div id="questionsContainer">
                    <h3>Questions</h3>
                    <button type="button" class="admin-btn" onclick="addQuestion()">Add Question</button>
                </div>
                <div style="margin-top: 2rem;">
                    <button type="submit" class="admin-btn">Save Reading Material</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('editModal')">&times;</span>
            <h2>Edit Reading Material</h2>
            <form id="editForm">
                <div class="form-group">
                    <label for="edit-grade">Grade Level:</label>
                    <select id="edit-grade" required>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-subject">Subject:</label>
                    <select id="edit-subject" required>
                        <option value="english">English</option>
                        <option value="filipino">Filipino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-title">Reading Title:</label>
                    <input type="text" id="edit-title" required>
                </div>
                <div class="form-group">
                    <label for="edit-content">Reading Content:</label>
                    <textarea id="edit-content" rows="6" required></textarea>
                </div>
                <div id="editQuestionsContainer">
                    <h3>Questions</h3>
                    <button type="button" class="admin-btn" onclick="addEditQuestion()">Add Question</button>
                </div>
                <div style="margin-top: 2rem;">
                    <button type="submit" class="admin-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Grade selector functionality
        document.querySelector('.grade-selector select').addEventListener('change', function(e) {
            const selectedGrade = e.target.value;
            console.log('Selected grade:', selectedGrade);
            // Add your grade change logic here
        });

        // Subject button functionality
        document.querySelectorAll('.subject-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.subject-btn').forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const subject = this.dataset.subject;
                console.log('Selected subject:', subject);
                // Add your subject change logic here
            });
        });

        // Form submission handling
        document.querySelector('.submit-btn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Collect form data
            const formData = {
                grade: document.querySelector('.grade-selector select').value,
                subject: document.querySelector('.subject-btn.active')?.dataset.subject,
                answers: {
                    q1: document.querySelector('input[name="q1"]:checked')?.value,
                    q2: document.querySelector('input[name="q2"]:checked')?.value,
                    q3: document.querySelector('.text-input').value
                }
            };

            // Validate form
            if (!formData.answers.q1 || !formData.answers.q2 || !formData.answers.q3) {
                alert('Please answer all questions before submitting.');
                return;
            }

            console.log('Form data:', formData);
            // Add your form submission logic here
            alert('Test submitted successfully!');
        });

        // Clear form functionality
        document.querySelector('.clear-btn').addEventListener('click', function() {
            // Clear radio buttons
            document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
            // Clear text input
            document.querySelector('.text-input').value = '';
            // Remove active class from subject buttons
            document.querySelectorAll('.subject-btn').forEach(btn => btn.classList.remove('active'));
            // Reset grade selector
            document.querySelector('.grade-selector select').selectedIndex = 0;
        });

        // Add values to radio buttons
        document.querySelectorAll('input[name="q1"]').forEach((radio, index) => {
            radio.value = radio.parentElement.textContent.trim();
        });
        document.querySelectorAll('input[name="q2"]').forEach((radio, index) => {
            radio.value = radio.parentElement.textContent.trim();
        });

        // CRUD Operations
        function openCreateModal() {
            document.getElementById('createModal').style.display = 'block';
        }

        function openEditModal() {
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function addQuestion() {
            const container = document.getElementById('questionsContainer');
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question-container';
            questionDiv.innerHTML = `
                <div class="form-group">
                    <label>Question:</label>
                    <input type="text" name="questions[]" required>
                </div>
                <div class="form-group">
                    <label>Question Type:</label>
                    <select name="questionTypes[]" onchange="toggleAnswerType(this)">
                        <option value="multiple">Multiple Choice</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="multiple-choice-options">
                    <div class="form-group">
                        <label>Options (one per line):</label>
                        <textarea name="options[]" rows="4" placeholder="Enter each option on a new line"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Correct Answer:</label>
                        <select name="correct[]">
                            <option value="">Select correct answer</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="admin-btn delete" onclick="removeQuestion(this)">Remove Question</button>
            `;
            container.appendChild(questionDiv);
        }

        function removeQuestion(button) {
            button.parentElement.remove();
        }

        function toggleAnswerType(select) {
            const multipleChoiceDiv = select.parentElement.nextElementSibling;
            multipleChoiceDiv.style.display = select.value === 'multiple' ? 'block' : 'none';
        }

        function deleteSelected() {
            if (confirm('Are you sure you want to delete the selected reading material?')) {
                console.log('Deleting selected reading material');
            }
        }

        // Form submission handlers
        document.getElementById('createForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            console.log('Creating new reading material');
        });

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }

        // Add sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Update the select options when options textarea changes
        function updateCorrectAnswerOptions(textarea) {
            const select = textarea.parentElement.nextElementSibling.querySelector('select');
            const options = textarea.value.split('\n').filter(option => option.trim() !== '');
            
            // Clear existing options except the first one
            while (select.options.length > 1) {
                select.remove(1);
            }
            
            // Add new options
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.trim();
                optionElement.textContent = option.trim();
                select.appendChild(optionElement);
            });
        }

        // Add event listener to options textarea
        document.addEventListener('input', function(e) {
            if (e.target.name === 'options[]') {
                updateCorrectAnswerOptions(e.target);
            }
        });

        function addEditQuestion() {
            const container = document.getElementById('editQuestionsContainer');
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question-container';
            questionDiv.innerHTML = `
                <div class="form-group">
                    <label>Question:</label>
                    <input type="text" name="edit-questions[]" required>
                </div>
                <div class="form-group">
                    <label>Question Type:</label>
                    <select name="edit-questionTypes[]" onchange="toggleEditAnswerType(this)">
                        <option value="multiple">Multiple Choice</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="multiple-choice-options">
                    <div class="form-group">
                        <label>Options (one per line):</label>
                        <textarea name="edit-options[]" rows="4" placeholder="Enter each option on a new line"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Correct Answer:</label>
                        <select name="edit-correct[]">
                            <option value="">Select correct answer</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="admin-btn delete" onclick="removeEditQuestion(this)">Remove Question</button>
            `;
            container.appendChild(questionDiv);
        }

        function removeEditQuestion(button) {
            button.parentElement.remove();
        }

        function toggleEditAnswerType(select) {
            const multipleChoiceDiv = select.parentElement.nextElementSibling;
            multipleChoiceDiv.style.display = select.value === 'multiple' ? 'block' : 'none';
        }

        // Update the select options when options textarea changes for edit form
        document.addEventListener('input', function(e) {
            if (e.target.name === 'edit-options[]') {
                updateEditCorrectAnswerOptions(e.target);
            }
        });

        function updateEditCorrectAnswerOptions(textarea) {
            const select = textarea.parentElement.nextElementSibling.querySelector('select');
            const options = textarea.value.split('\n').filter(option => option.trim() !== '');
            
            // Clear existing options except the first one
            while (select.options.length > 1) {
                select.remove(1);
            }
            
            // Add new options
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.trim();
                optionElement.textContent = option.trim();
                select.appendChild(optionElement);
            });
        }

        // Form submission handlers
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            console.log('Updating reading material');
        });
    </script>
</body>

</html>