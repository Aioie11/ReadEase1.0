<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Management System</title>
    <style>
   
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

        .nav-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            color: #333;
            text-decoration: none;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .nav-item i {
            margin-right: 10px;
            font-style: normal;
            font-family: Arial, sans-serif;
            font-size: 14px;
            width: 20px;
            display: inline-block;
            text-align: center;
        }

        .user-controls span {
            font-size: 16px;
            margin-left: 15px;
            cursor: pointer;
            color: white;
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #003399;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-box {
            background-color: white;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Grade selection styles */
        .grade-selector {
            background-color: #87CEEB;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .grade-selector select {
            margin-left: 10px;
            padding: 5px;
        }

        /* Reading passage styles */
        .reading-passage {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        /* Question styles */
        .question {
            background-color: #E6F3F7;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        .radio-option {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .text-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Button styles */
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .submit-btn {
            padding: 10px 20px;
            background-color: #87CEEB;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .clear-btn {
            padding: 10px 20px;
            background-color: transparent;
            border: none;
            color: #87CEEB;
            cursor: pointer;
        }

        /* Subject button styles */
        .subject-btn {
            padding: 8px 16px;
            margin: 0 10px;
            border: none;
            background-color: #E6F3F7;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .subject-btn.active {
            background-color: #87CEEB;
            color: white;
        }

        .subject-btn:hover {
            background-color: #87CEEB;
            color: white;
        }

        /* Admin control buttons */
        .admin-controls {
            margin: 20px 0;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        .admin-btn {
            padding: 8px 16px;
            margin: 0 10px;
            border: none;
            background-color: #5EC0F2;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .admin-btn:hover {
            background-color: #4BA3D8;
        }

        .admin-btn.delete {
            background-color: #ff6b6b;
        }

        .admin-btn.delete:hover {
            background-color: #ff5252;
        }

        /* Modal styles */
        .modal {
            display: none;
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background-color:  #38B6FF;
           
        }

        .modal-content {
            position: relative;
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 70%;
            max-width: 600px;
            border-radius: 5px;
            box-shadow:  #38B6FF;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .question-container {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 10px;
            }

            .main-content {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('pic/logo .png') }}" alt="Logo" class="logo">
            </div>
            <ul>
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
            <h1>TEST MANAGEMENT</h1>
            <div class="user-controls">
                <span>♪</span>
                <span>○</span>
            </div>
        </header>

        <div class="content-box">
            <h2> QUESTIONS</h2>
            
            <!-- Admin Controls -->
            <div class="admin-controls">
                <button class="admin-btn" onclick="openCreateModal()">Add New Reading Material</button>
                <button class="admin-btn" onclick="openEditModal()">Edit Selected</button>
                <button class="admin-btn delete" onclick="deleteSelected()">Delete Selected</button>
            </div>

            <!-- Grade Selection Dropdowns -->
            <div class="grade-selector">
                <i>○</i>
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
                <h3>Online Reading Passage</h3>
                <p>Telling Time Humans have used different objects to tell time. In the beginning, they used an hourglass. This is a cylindrical glass with a narrow center which allows sand to flow from its upper to its lower portion. Once all the sand has trickled to the lower portion, one knows that an hour has passed. Using the same idea, water clocks were constructed to measure time by having water flow through a narrow passage from one container to another. On the other hand, sundials allowed people to estimate an hour by looking at the position of the shadow cast by the sun on a plate. At night, people measured time by checking the alignment of the stars in the sky. None of these were accurate, though. The clock was the first accurate instrument or telling time.</p>
            </div>

            <!-- Questions Section -->
            <div class="questions-section">
                <h3>READING COMPREHENSION QUESTIONS</h3>
                
                <!-- Question 1 -->
                <div class="question">
                    <p>1. Which of the following ways of telling time made use of sand?</p>
                    <label class="radio-option">
                        <input type="radio" name="q1"> Water Clocks
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="q1"> Hourglass
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="q1"> Sundials
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="q1"> Stars
                    </label>
                </div>

                <!-- Question 2 -->
                <div class="question">
                    <p>2. Which of the following ways of telling time made use of sand?</p>
                    <label class="radio-option">
                        <input type="radio" name="q2"> Water Clocks
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="q2"> Hourglass
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="q2"> Sundials
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="q2"> Stars
                    </label>
                </div>

                <!-- Question 3 -->
                <div class="question">
                    <p>3. Which of the following ways of telling time made use of sand?</p>
                    <input type="text" class="text-input" placeholder="Type your answere here">
                </div>

                <!-- Button Group -->
                <div class="button-group">
                    <button class="submit-btn">Submit</button>
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
                <button type="submit" class="admin-btn">Save Reading Material</button>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('editModal')">&times;</span>
            <h2>Edit Reading Material</h2>
            <form id="editForm">
                <!-- Similar form fields as create modal -->
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
            // For example, send to server using fetch:
            /*
            fetch('submit_test.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                alert('Test submitted successfully!');
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Error submitting test. Please try again.');
            });
            */
            
            // Temporary success message
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
            // Populate form with selected reading material data
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
                        <textarea name="options[]" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Correct Answer:</label>
                        <input type="text" name="correct[]">
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
                // Add your delete logic here
                console.log('Deleting selected reading material');
                /*
                fetch('delete_reading.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: selectedId })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    // Refresh the page or update the UI
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting reading material');
                });
                */
            }
        }

        // Form submission handlers
        document.getElementById('createForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            console.log('Creating new reading material');
            /*
            fetch('create_reading.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                closeModal('createModal');
                // Refresh the page or update the UI
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating reading material');
            });
            */
        });

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>

</html>