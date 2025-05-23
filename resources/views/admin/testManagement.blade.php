@extends('layouts.head-ad')

@section('title', 'Test Management')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <button class="admin-btn" style="background: #10B981;" onclick="publishMaterial()">Publish</button>
            </div>

            <!-- Grade Selection Dropdowns -->
            <div class="grade-selector">
                <i class="fas fa-graduation-cap"></i>
                <select>
                    <option value="7">GRADE 7</option>
                    <option value="8">GRADE 8</option>
                    <option value="9">GRADE 9</option>
                    <option value="10">GRADE 10</option>
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
        // Function to fetch and display reading materials
        function fetchAndDisplayReadingMaterials() {
            const selectedGrade = document.querySelector('.grade-selector select').value;
            const selectedSubjectButton = document.querySelector('.subject-btn.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            if (!selectedGrade || !selectedSubject) {
                console.log('Grade or subject not selected.');
                // Show empty state
                document.querySelector('.reading-passage').innerHTML = `
                    <h3>Reading Passage</h3>
                    <div class="empty-state">
                        <i class="fas fa-book"></i>
                        <p>Select a grade and subject to view reading materials.</p>
                    </div>
                `;
                document.querySelector('.questions-section').innerHTML = `
                    <h3>Reading Comprehension Questions</h3>
                    <div class="empty-state">
                        <i class="fas fa-question-circle"></i>
                        <p>Select a grade and subject to view questions.</p>
                    </div>
                `;
                return;
            }

            // Show loading state
            const readingPassageDiv = document.querySelector('.reading-passage');
            const questionsSectionDiv = document.querySelector('.questions-section');
            readingPassageDiv.innerHTML = '<h3>Reading Passage</h3><div class="empty-state"><i class="fas fa-sync fa-spin"></i><p>Loading...</p></div>';
            questionsSectionDiv.innerHTML = '<h3>Reading Comprehension Questions</h3><div class="empty-state"><i class="fas fa-sync fa-spin"></i><p>Loading...</p></div>';

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Use a different endpoint for admin panel that shows all materials
            fetch(`/api/reading-materials/admin/${selectedGrade}/${selectedSubject}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched data:', data);
                if (data && data.length > 0) {
                    // Display Reading Passage
                    const material = data[0];
                    readingPassageDiv.innerHTML = `
                        <h3>${material.title}</h3>
                        <div class="reading-content">
                            <p>${material.content}</p>
                        </div>
                    `;

                    // Display Questions
                    let questionsHtml = '<h3>Reading Comprehension Questions</h3>';
                    if (material.questions && material.questions.length > 0) {
                        material.questions.forEach(question => {
                            questionsHtml += `
                                <div class="question">
                                    <p><strong>${question.question}</strong></p>
                            `;
                            if (question.type === 'multiple' && question.options) {
                                questionsHtml += '<div class="options-list">';
                                question.options.forEach(option => {
                                    questionsHtml += `<div class="option-item">${option}</div>`;
                                });
                                questionsHtml += '</div>';
                            } else if (question.type === 'text') {
                                questionsHtml += `<div class="text-answer">Correct Answer: ${question.correct_answer}</div>`;
                            }
                            questionsHtml += `</div>`;
                        });
                    } else {
                        questionsHtml += `
                            <div class="empty-state">
                                <i class="fas fa-question-circle"></i>
                                <p>No questions available for this reading material.</p>
                            </div>
                        `;
                    }
                    questionsSectionDiv.innerHTML = questionsHtml;
                } else {
                    // Display empty state if no data
                    readingPassageDiv.innerHTML = `
                        <h3>Reading Passage</h3>
                        <div class="empty-state">
                            <i class="fas fa-book"></i>
                            <p>No reading passage added yet. Click "Add New Reading Material" to create content.</p>
                        </div>
                    `;
                    questionsSectionDiv.innerHTML = `
                        <h3>Reading Comprehension Questions</h3>
                        <div class="empty-state">
                            <i class="fas fa-question-circle"></i>
                            <p>No questions added yet. Click "Add New Reading Material" to create questions.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error fetching reading materials:', error);
                // Display error state
                readingPassageDiv.innerHTML = `
                    <h3>Reading Passage</h3>
                    <div class="empty-state">
                        <i class="fas fa-exclamation-triangle" style="color: #dc2626;"></i>
                        <p style="color: #dc2626;">Error loading reading materials: ${error.message}</p>
                    </div>
                `;
                questionsSectionDiv.innerHTML = `
                    <h3>Reading Comprehension Questions</h3>
                    <div class="empty-state">
                        <i class="fas fa-exclamation-triangle" style="color: #dc2626;"></i>
                        <p style="color: #dc2626;">Error loading questions: ${error.message}</p>
                    </div>
                `;
            });
        }

        // Grade selector functionality
        document.querySelector('.grade-selector select').addEventListener('change', function(e) {
            const selectedGrade = e.target.value;
            console.log('Selected grade:', selectedGrade);
            // Add your grade change logic here
            fetchAndDisplayReadingMaterials(); // Call the new function
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
                fetchAndDisplayReadingMaterials(); // Call the new function
            });
        });

        // Initial load: Select a default subject (e.g., English) and fetch data
        document.addEventListener('DOMContentLoaded', function() {
            const defaultSubjectButton = document.querySelector('.subject-btn[data-subject="english"]');
            if (defaultSubjectButton) {
                defaultSubjectButton.classList.add('active');
            }
            fetchAndDisplayReadingMaterials();
        });

        // Form submission handlers
        document.getElementById('createForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const grade = document.getElementById('grade').value;
            const subject = document.getElementById('subject').value;
            
            if (!title || !content || !grade || !subject) {
                alert('Please fill in all required fields');
                return;
            }

            const questionContainers = document.querySelectorAll('#questionsContainer .question-container');
            if (questionContainers.length === 0) {
                alert('Please add at least one question');
                return;
            }

            const formData = {
                title: title,
                content: content,
                grade_level: grade,
                subject: subject,
                questions: []
            };

            // Collect questions
            questionContainers.forEach(container => {
                const questionText = container.querySelector('input[name="questions[]"]').value;
                const questionType = container.querySelector('select[name="questionTypes[]"]').value;
                const options = container.querySelector('textarea[name="options[]"]').value.split('\n').filter(opt => opt.trim());
                const correctAnswer = container.querySelector('select[name="correct[]"]').value;

                if (!questionText || !questionType || !correctAnswer) {
                    alert('Please fill in all question fields');
                    return;
                }

                if (questionType === 'multiple' && options.length < 2) {
                    alert('Multiple choice questions must have at least 2 options');
                    return;
                }

                formData.questions.push({
                    question: questionText,
                    type: questionType,
                    options: questionType === 'multiple' ? options : null,
                    correct_answer: correctAnswer
                });
            });

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Saving...';

            // Send to server
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/api/reading-materials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData),
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 419) {
                        throw new Error('CSRF token mismatch. Please refresh the page and try again.');
                    }
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Reading material saved successfully!');
                    closeModal('createModal');
                    // Clear the form
                    this.reset();
                    // Refresh the display
                    fetchAndDisplayReadingMaterials();
                } else {
                    throw new Error(data.message || 'Failed to save reading material');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Failed to create reading material'));
            })
            .finally(() => {
                // Reset button state
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
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
            const selectedGrade = document.querySelector('.grade-selector select').value;
            const selectedSubjectButton = document.querySelector('.subject-btn.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            if (!selectedGrade || !selectedSubject) {
                alert('Please select a grade and subject first');
                return;
            }

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Fetch the current reading material using the admin endpoint
            fetch(`/api/reading-materials/admin/${selectedGrade}/${selectedSubject}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.length > 0) {
                    const material = data[0];
                    document.getElementById('edit-grade').value = material.grade_level;
                    document.getElementById('edit-subject').value = material.subject;
                    document.getElementById('edit-title').value = material.title;
                    document.getElementById('edit-content').value = material.content;
                    const questionsContainer = document.getElementById('editQuestionsContainer');
                    questionsContainer.innerHTML = '<h3>Questions</h3>';
                    material.questions.forEach(question => {
                        const questionDiv = document.createElement('div');
                        questionDiv.className = 'question-container';
                        if (question.type === 'multiple') {
                            questionDiv.innerHTML = `
                                <div class="form-group">
                                    <label>Question:</label>
                                    <input type="text" name="edit-questions[]" value="${question.question}" required>
                                </div>
                                <div class="form-group">
                                    <label>Question Type:</label>
                                    <select name="edit-questionTypes[]" onchange="toggleEditAnswerType(this)">
                                        <option value="multiple" selected>Multiple Choice</option>
                                        <option value="text">Text Answer</option>
                                    </select>
                                </div>
                                <div class="multiple-choice-options" style="display: block">
                                    <div class="form-group">
                                        <label>Options (one per line):</label>
                                        <textarea name="edit-options[]" rows="4" placeholder="Enter each option on a new line">${question.options ? question.options.join('\n') : ''}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Correct Answer:</label>
                                        <select name="edit-correct[]">
                                            <option value="">Select correct answer</option>
                                            ${question.options ? question.options.map(opt => 
                                                `<option value="${opt}" ${opt === question.correct_answer ? 'selected' : ''}>${opt}</option>`
                                            ).join('') : ''}
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="admin-btn delete" onclick="removeEditQuestion(this)">Remove Question</button>
                            `;
                        } else {
                            questionDiv.innerHTML = `
                                <div class="form-group">
                                    <label>Question:</label>
                                    <input type="text" name="edit-questions[]" value="${question.question}" required>
                                </div>
                                <div class="form-group">
                                    <label>Question Type:</label>
                                    <select name="edit-questionTypes[]" onchange="toggleEditAnswerType(this)">
                                        <option value="multiple">Multiple Choice</option>
                                        <option value="text" selected>Text Answer</option>
                                    </select>
                                </div>
                                <div class="multiple-choice-options" style="display: none">
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
                                <div class="form-group">
                                    <label>Correct Answer (Text):</label>
                                    <input type="text" name="edit-correct-text[]" value="${question.correct_answer || ''}" placeholder="Enter correct answer">
                                </div>
                                <button type="button" class="admin-btn delete" onclick="removeEditQuestion(this)">Remove Question</button>
                            `;
                        }
                        questionsContainer.appendChild(questionDiv);
                    });
                    const addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.className = 'admin-btn';
                    addButton.textContent = 'Add Question';
                    addButton.onclick = addEditQuestion;
                    questionsContainer.appendChild(addButton);
                    document.getElementById('editModal').style.display = 'block';
                } else {
                    alert('No reading material found for the selected grade and subject');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading reading material: ' + error.message);
            });
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
            const selectedGrade = document.querySelector('.grade-selector select').value;
            const selectedSubjectButton = document.querySelector('.subject-btn.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            if (!selectedGrade || !selectedSubject) {
                alert('Please select a grade and subject first');
                return;
            }

            if (!confirm('Are you sure you want to delete the reading material for Grade ' + selectedGrade + ' ' + selectedSubject + '? This action cannot be undone.')) {
                return;
            }

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // First, get the material ID using the admin endpoint
            fetch(`/api/reading-materials/admin/${selectedGrade}/${selectedSubject}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.length > 0) {
                    const materialId = data[0].id;
                    // Now delete the material
                    return fetch(`/api/reading-materials/${materialId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        credentials: 'same-origin'
                    });
                } else {
                    throw new Error('No reading material found to delete');
                }
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 419) {
                        throw new Error('CSRF token mismatch. Please refresh the page and try again.');
                    }
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Reading material deleted successfully!');
                    // Refresh the display
                    fetchAndDisplayReadingMaterials();
                } else {
                    throw new Error(data.message || 'Failed to delete reading material');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Failed to delete reading material'));
            });
        }

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
            
            // Validate form
            const title = document.getElementById('edit-title').value;
            const content = document.getElementById('edit-content').value;
            const grade = document.getElementById('edit-grade').value;
            const subject = document.getElementById('edit-subject').value;
            
            if (!title || !content || !grade || !subject) {
                alert('Please fill in all required fields');
                return;
            }

            const questionContainers = document.querySelectorAll('#editQuestionsContainer .question-container');
            if (questionContainers.length === 0) {
                alert('Please add at least one question');
                return;
            }

            const formData = {
                title: title,
                content: content,
                grade_level: grade,
                subject: subject,
                questions: []
            };

            // Collect questions
            questionContainers.forEach(container => {
                const questionText = container.querySelector('input[name="edit-questions[]"]').value;
                const questionType = container.querySelector('select[name="edit-questionTypes[]"]').value;
                const options = container.querySelector('textarea[name="edit-options[]"]').value.split('\n').filter(opt => opt.trim());
                const correctAnswer = container.querySelector('select[name="edit-correct[]"]').value;

                if (!questionText || !questionType || !correctAnswer) {
                    alert('Please fill in all question fields');
                    return;
                }

                if (questionType === 'multiple' && options.length < 2) {
                    alert('Multiple choice questions must have at least 2 options');
                    return;
                }

                formData.questions.push({
                    question: questionText,
                    type: questionType,
                    options: questionType === 'multiple' ? options : null,
                    correct_answer: correctAnswer
                });
            });

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Saving...';

            // Get the material ID from the current selection
            const selectedGrade = document.querySelector('.grade-selector select').value;
            const selectedSubjectButton = document.querySelector('.subject-btn.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            // Send to server
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/api/reading-materials/admin/${selectedGrade}/${selectedSubject}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const materialId = data[0].id;
                    return fetch(`/api/reading-materials/${materialId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(formData),
                        credentials: 'same-origin'
                    });
                } else {
                    throw new Error('No reading material found to update');
                }
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 419) {
                        throw new Error('CSRF token mismatch. Please refresh the page and try again.');
                    }
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Reading material updated successfully!');
                    closeModal('editModal');
                    // Refresh the display
                    fetchAndDisplayReadingMaterials();
                } else {
                    throw new Error(data.message || 'Failed to update reading material');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Failed to update reading material'));
            })
            .finally(() => {
                // Reset button state
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
        });

        // Publish functionality
        function publishMaterial() {
            const selectedGrade = document.querySelector('.grade-selector select').value;
            const selectedSubjectButton = document.querySelector('.subject-btn.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            if (!selectedGrade || !selectedSubject) {
                alert('Please select a grade and subject first');
                return;
            }

            if (!confirm('Are you sure you want to publish this reading material? This will make it available to students.')) {
                return;
            }

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // First, get the material ID using the admin endpoint
            fetch(`/api/reading-materials/admin/${selectedGrade}/${selectedSubject}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.length > 0) {
                    const materialId = data[0].id;
                    // Now publish the material
                    return fetch(`/api/reading-materials/${materialId}/publish`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({}), // Send empty object as body
                        credentials: 'same-origin'
                    });
                } else {
                    throw new Error('No reading material found to publish');
                }
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 419) {
                        throw new Error('CSRF token mismatch. Please refresh the page and try again.');
                    }
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Reading material published successfully!');
                    // Refresh the display to show updated status
                    fetchAndDisplayReadingMaterials();
                } else {
                    throw new Error(data.message || 'Failed to publish reading material');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Failed to publish reading material'));
            });
        }
    </script>
</body>

</html>