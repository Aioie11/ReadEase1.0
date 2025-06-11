@extends('layouts.head-ad')

@section('title', 'Test Management')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
        /* Main Content */
        .main-content {
            margin-top: 50px;
            margin-left: 280px;
            padding: 6rem 5% 2rem;
            transition: var(--transition);
            background: var(--background);
            min-height: 100vh;
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            border-left: 4px solid var(--primary);
        }

        .page-header h1 {
            color: var(--text-dark);
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .page-header p {
            color: var(--text-light);
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }

        /* Control Panel */
        .control-panel {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .control-section {
            margin-bottom: 1.5rem;
        }

        .control-section:last-child {
            margin-bottom: 0;
        }

        .control-label {
            display: block;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            padding: 0.875rem 1.25rem;
            border: 1px solid var(--neutral-light);
            border-radius: 8px;
            background: white;
            color: var(--text);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .action-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .action-btn.primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .action-btn.primary:hover {
            background: var(--primary-dark);
            color: white;
        }

        .action-btn.danger {
            border-color: var(--danger);
            color: var(--danger);
        }

        .action-btn.danger:hover {
            background: var(--danger);
            color: white;
        }

        /* Filter Controls */
        .filter-controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 1px solid var(--neutral-light);
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        /* Subject Tabs */
        .subject-tabs {
            display: flex;
            gap: 0.5rem;
        }

        .subject-tab {
            padding: 0.75rem 1.5rem;
            border: 1px solid var(--neutral-light);
            border-radius: 8px;
            background: white;
            color: var(--text);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .subject-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .subject-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Content Display */
        .content-display {
            display: grid;
            gap: 2rem;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .content-card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--neutral-light);
            background: var(--background-secondary);
        }

        .content-card-header h3 {
            color: var(--text-dark);
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .content-card-body {
            padding: 1.5rem;
        }

        /* Reading Passage Styles */
        .reading-content {
            line-height: 1.7;
            color: var(--text);
            font-size: 0.95rem;
        }

        .reading-title {
            color: var(--text-dark);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Questions Display */
        .question-item {
            background: var(--background);
            padding: 1.25rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 3px solid var(--primary);
        }

        .question-item:last-child {
            margin-bottom: 0;
        }

        .question-text {
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .question-options {
            display: grid;
            gap: 0.5rem;
        }

        .option-item {
            padding: 0.75rem;
            background: white;
            border: 1px solid var(--neutral-light);
            border-radius: 6px;
            color: var(--text);
            font-size: 0.9rem;
        }

        .correct-answer {
            background: rgba(0, 184, 169, 0.1);
            border-color: var(--primary);
            color: var(--primary);
            font-weight: 500;
        }

        .text-answer {
            padding: 0.75rem;
            background: rgba(0, 184, 169, 0.1);
            border: 1px solid var(--primary);
            border-radius: 6px;
            color: var(--primary);
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--background);
            border-radius: 12px;
            border: 2px dashed var(--neutral-light);
        }

        .empty-state-icon {
            font-size: 2.5rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .empty-state-title {
            color: var(--text);
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Loading State */
        .loading-state {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
        }

        .loading-spinner {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            border: 3px solid var(--neutral-light);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Status Indicators */
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-published {
            background: rgba(0, 184, 169, 0.1);
            color: var(--primary);
        }

        .status-draft {
            background: rgba(113, 128, 150, 0.1);
            color: var(--text-light);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            max-width: 700px;
            width: 95vw;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            margin: 2rem 0;
        }

        .modal-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--neutral-light);
        }

        .modal-title {
            color: var(--text-dark);
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2rem;
            height: 2rem;
            border: none;
            background: var(--neutral-light);
            border-radius: 50%;
            color: var(--text);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .close-modal:hover {
            background: var(--neutral);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--neutral-light);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: white;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        .question-container {
            background: var(--background);
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
            border: 1px solid var(--neutral-light);
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 6rem 3% 2rem;
            }

            .filter-controls {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .subject-tabs {
                flex-direction: column;
            }

            .modal-content {
                width: 98vw;
                margin: 1rem 0;
                padding: 1.5rem;
            }
        }
    </style>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fas fa-clipboard-list"></i> Test Management</h1>
            <p>Create, edit, and manage reading comprehension tests for students</p>
        </div>

        <!-- Control Panel -->
        <div class="control-panel">
            <!-- Action Buttons -->
            <div class="control-section">
                <label class="control-label">Actions</label>
                <div class="action-buttons">
                    <button class="action-btn primary" onclick="openCreateModal()">
                        <i class="fas fa-plus"></i>
                        Add New Material
                    </button>
                    <button class="action-btn" onclick="openEditModal()">
                        <i class="fas fa-edit"></i>
                        Edit Selected
                    </button>
                    <button class="action-btn danger" onclick="deleteSelected()">
                        <i class="fas fa-trash"></i>
                        Delete Selected
                    </button>
                    <button class="action-btn" onclick="publishMaterial()">
                        <i class="fas fa-paper-plane"></i>
                        Publish Material
                    </button>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="control-section">
                <label class="control-label">Filters</label>
                <div class="filter-controls">
                    <div class="filter-group">
                        <label class="form-label">Grade Level</label>
                        <select class="filter-select" id="gradeFilter">
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Subject</label>
                        <div class="subject-tabs">
                            <button class="subject-tab" data-subject="english">
                                <i class="fas fa-language"></i>
                                English
                            </button>
                            <button class="subject-tab" data-subject="filipino">
                                <i class="fas fa-flag"></i>
                                Filipino
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Display -->
        <div class="content-display">
            <!-- Reading Passage Card -->
            <div class="content-card">
                <div class="content-card-header">
                    <h3><i class="fas fa-book-open"></i> Reading Passage</h3>
                </div>
                <div class="content-card-body" id="readingPassageContent">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="empty-state-title">No Reading Passage</div>
                        <div class="empty-state-text">
                            Select a grade and subject to view reading materials, or create new content using the "Add New Material" button above.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questions Card -->
            <div class="content-card">
                <div class="content-card-header">
                    <h3><i class="fas fa-question-circle"></i> Comprehension Questions</h3>
                </div>
                <div class="content-card-body" id="questionsContent">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="empty-state-title">No Questions Available</div>
                        <div class="empty-state-text">
                            Questions will appear here when you select a reading material that contains comprehension questions.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Create Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('createModal')">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title">Create New Reading Material</h2>
            </div>
            <form id="createForm">
                <div class="form-group">
                    <label class="form-label" for="grade">Grade Level</label>
                    <select class="form-select" id="grade" required>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="subject">Subject</label>
                    <select class="form-select" id="subject" required>
                        <option value="english">English</option>
                        <option value="filipino">Filipino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="title">Reading Title</label>
                    <input class="form-input" type="text" id="title" required placeholder="Enter the title of the reading material">
                </div>
                <div class="form-group">
                    <label class="form-label" for="content">Reading Content</label>
                    <textarea class="form-textarea" id="content" rows="6" required placeholder="Enter the reading passage content"></textarea>
                </div>
                <div id="questionsContainer">
                    <div class="form-group">
                        <label class="form-label">Questions</label>
                        <button type="button" class="action-btn" onclick="addQuestion()">
                            <i class="fas fa-plus"></i>
                            Add Question
                        </button>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--neutral-light);">
                    <button type="submit" class="action-btn primary" style="width: 100%;">
                        <i class="fas fa-save"></i>
                        Save Reading Material
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('editModal')">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title">Edit Reading Material</h2>
            </div>
            <form id="editForm">
                <div class="form-group">
                    <label class="form-label" for="edit-grade">Grade Level</label>
                    <select class="form-select" id="edit-grade" required>
                        <option value="7">Grade 7</option>
                        <option value="8">Grade 8</option>
                        <option value="9">Grade 9</option>
                        <option value="10">Grade 10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit-subject">Subject</label>
                    <select class="form-select" id="edit-subject" required>
                        <option value="english">English</option>
                        <option value="filipino">Filipino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit-title">Reading Title</label>
                    <input class="form-input" type="text" id="edit-title" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit-content">Reading Content</label>
                    <textarea class="form-textarea" id="edit-content" rows="6" required></textarea>
                </div>
                <div id="editQuestionsContainer">
                    <div class="form-group">
                        <label class="form-label">Questions</label>
                        <button type="button" class="action-btn" onclick="addEditQuestion()">
                            <i class="fas fa-plus"></i>
                            Add Question
                        </button>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--neutral-light);">
                    <button type="submit" class="action-btn primary" style="width: 100%;">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to fetch and display reading materials
        function fetchAndDisplayReadingMaterials() {
            const selectedGrade = document.querySelector('#gradeFilter').value;
            const selectedSubjectButton = document.querySelector('.subject-tab.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            const readingContent = document.getElementById('readingPassageContent');
            const questionsContent = document.getElementById('questionsContent');

            if (!selectedGrade || !selectedSubject) {
                console.log('Grade or subject not selected.');
                // Show empty state
                readingContent.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="empty-state-title">No Reading Passage</div>
                        <div class="empty-state-text">
                            Select a grade and subject to view reading materials, or create new content using the "Add New Material" button above.
                        </div>
                    </div>
                `;
                questionsContent.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="empty-state-title">No Questions Available</div>
                        <div class="empty-state-text">
                            Questions will appear here when you select a reading material that contains comprehension questions.
                        </div>
                    </div>
                `;
                return;
            }

            // Show loading state
            readingContent.innerHTML = `
                <div class="loading-state">
                    <div class="loading-spinner"></div>
                    <p>Loading reading material...</p>
                </div>
            `;
            questionsContent.innerHTML = `
                <div class="loading-state">
                    <div class="loading-spinner"></div>
                    <p>Loading questions...</p>
                </div>
            `;

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
                    readingContent.innerHTML = `
                        <div class="reading-title">${material.title}</div>
                        <div class="reading-content">${material.content}</div>
                        <div class="status-indicator status-published" style="margin-top: 1rem;">
                            <i class="fas fa-check-circle"></i>
                            Published
                        </div>
                    `;

                    // Display Questions
                    let questionsHtml = '';
                    if (material.questions && material.questions.length > 0) {
                        material.questions.forEach((question, index) => {
                            questionsHtml += `
                                <div class="question-item">
                                    <div class="question-text">Question ${index + 1}: ${question.question}</div>
                            `;
                            if (question.type === 'multiple' && question.options) {
                                questionsHtml += '<div class="question-options">';
                                question.options.forEach(option => {
                                    const isCorrect = option === question.correct_answer;
                                    questionsHtml += `<div class="option-item ${isCorrect ? 'correct-answer' : ''}">${option}${isCorrect ? ' ✓' : ''}</div>`;
                                });
                                questionsHtml += '</div>';
                            } else if (question.type === 'text') {
                                questionsHtml += `<div class="text-answer">Correct Answer: ${question.correct_answer}</div>`;
                            }
                            questionsHtml += `</div>`;
                        });
                    } else {
                        questionsHtml = `
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="empty-state-title">No Questions Available</div>
                                <div class="empty-state-text">
                                    No questions available for this reading material.
                                </div>
                            </div>
                        `;
                    }
                    questionsContent.innerHTML = questionsHtml;
                } else {
                    // Display empty state if no data
                    readingContent.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="empty-state-title">No Reading Passage</div>
                            <div class="empty-state-text">
                                No reading passage added yet. Click "Add New Material" to create content.
                            </div>
                        </div>
                    `;
                    questionsContent.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <div class="empty-state-title">No Questions Available</div>
                            <div class="empty-state-text">
                                No questions added yet. Click "Add New Material" to create questions.
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error fetching reading materials:', error);
                // Display error state
                readingContent.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon" style="color: var(--danger);">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="empty-state-title" style="color: var(--danger);">Error Loading Content</div>
                        <div class="empty-state-text" style="color: var(--danger);">
                            Error loading reading materials: ${error.message}
                        </div>
                    </div>
                `;
                questionsContent.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon" style="color: var(--danger);">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="empty-state-title" style="color: var(--danger);">Error Loading Questions</div>
                        <div class="empty-state-text" style="color: var(--danger);">
                            Error loading questions: ${error.message}
                        </div>
                    </div>
                `;
            });
        }

        // Grade selector functionality
        document.querySelector('#gradeFilter').addEventListener('change', function(e) {
            const selectedGrade = e.target.value;
            console.log('Selected grade:', selectedGrade);
            fetchAndDisplayReadingMaterials();
        });

        // Subject tab functionality
        document.querySelectorAll('.subject-tab').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.subject-tab').forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                const subject = this.dataset.subject;
                console.log('Selected subject:', subject);
                fetchAndDisplayReadingMaterials();
            });
        });

        // Initial load: Select a default subject (e.g., English) and fetch data
        document.addEventListener('DOMContentLoaded', function() {
            const defaultSubjectTab = document.querySelector('.subject-tab[data-subject="english"]');
            if (defaultSubjectTab) {
                defaultSubjectTab.classList.add('active');
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
                let correctAnswer;
                let options = null;

                if (questionType === 'multiple') {
                    options = container.querySelector('textarea[name="options[]"]').value.split('\n').filter(opt => opt.trim());
                    correctAnswer = container.querySelector('select[name="correct[]"]').value;

                    if (options.length < 2) {
                        alert('Multiple choice questions must have at least 2 options');
                        return;
                    }
                } else {
                    correctAnswer = container.querySelector('input[name="correct-text[]"]').value;
                }

                if (!questionText || !questionType || !correctAnswer) {
                    alert('Please fill in all question fields');
                    return;
                }

                formData.questions.push({
                    question: questionText,
                    type: questionType,
                    options: options,
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

        // Publish material function
        function publishMaterial() {
            const selectedGrade = document.querySelector('#gradeFilter').value;
            const selectedSubjectButton = document.querySelector('.subject-tab.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            if (!selectedGrade || !selectedSubject) {
                alert('Please select a grade and subject first');
                return;
            }

            if (!confirm('Are you sure you want to publish the reading material for Grade ' + selectedGrade + ' ' + selectedSubject + '? This will make it available to students.')) {
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
                        body: JSON.stringify({}),
                        credentials: 'same-origin'
                    });
                } else {
                    throw new Error('No reading material found to publish');
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to publish reading material');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(`Reading material published successfully!\n\nGrade: ${selectedGrade}\nSubject: ${selectedSubject.charAt(0).toUpperCase() + selectedSubject.slice(1)}\n\nThis material is now visible to Grade ${selectedGrade} students in the ${selectedSubject.charAt(0).toUpperCase() + selectedSubject.slice(1)} section.`);
                    // Refresh the display
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

        // CRUD Operations
        function openCreateModal() {
            document.getElementById('createModal').classList.add('active');
        }

        function openEditModal() {
            const selectedGrade = document.querySelector('#gradeFilter').value;
            const selectedSubjectButton = document.querySelector('.subject-tab.active');
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
                    questionsContainer.innerHTML = `
                        <div class="form-group">
                            <label class="form-label">Questions</label>
                        </div>
                    `;
                    material.questions.forEach(question => {
                        const questionDiv = document.createElement('div');
                        questionDiv.className = 'question-container';
                        if (question.type === 'multiple') {
                            questionDiv.innerHTML = `
                                <div class="form-group">
                                    <label class="form-label">Question</label>
                                    <input class="form-input" type="text" name="edit-questions[]" value="${question.question}" required placeholder="Enter your question">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Question Type</label>
                                    <select class="form-select" name="edit-questionTypes[]" onchange="toggleEditAnswerType(this)">
                                        <option value="multiple" selected>Multiple Choice</option>
                                        <option value="text">Text Answer</option>
                                    </select>
                                </div>
                                <div class="multiple-choice-options" style="display: block">
                                    <div class="form-group">
                                        <label class="form-label">Options (one per line)</label>
                                        <textarea class="form-textarea" name="edit-options[]" rows="4" placeholder="Enter each option on a new line">${question.options ? question.options.join('\n') : ''}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Correct Answer</label>
                                        <select class="form-select" name="edit-correct[]">
                                            <option value="">Select correct answer</option>
                                            ${question.options ? question.options.map(opt =>
                                                `<option value="${opt}" ${opt === question.correct_answer ? 'selected' : ''}>${opt}</option>`
                                            ).join('') : ''}
                                        </select>
                                    </div>
                                </div>
                                <div class="text-answer-option" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Correct Answer (Text)</label>
                                        <input class="form-input" type="text" name="edit-correct-text[]" placeholder="Enter correct answer">
                                    </div>
                                </div>
                                <button type="button" class="action-btn danger" onclick="removeEditQuestion(this)" style="margin-top: 1rem;">
                                    <i class="fas fa-trash"></i>
                                    Remove Question
                                </button>
                            `;
                        } else {
                            questionDiv.innerHTML = `
                                <div class="form-group">
                                    <label class="form-label">Question</label>
                                    <input class="form-input" type="text" name="edit-questions[]" value="${question.question}" required placeholder="Enter your question">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Question Type</label>
                                    <select class="form-select" name="edit-questionTypes[]" onchange="toggleEditAnswerType(this)">
                                        <option value="multiple">Multiple Choice</option>
                                        <option value="text" selected>Text Answer</option>
                                    </select>
                                </div>
                                <div class="multiple-choice-options" style="display: none">
                                    <div class="form-group">
                                        <label class="form-label">Options (one per line)</label>
                                        <textarea class="form-textarea" name="edit-options[]" rows="4" placeholder="Enter each option on a new line"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Correct Answer</label>
                                        <select class="form-select" name="edit-correct[]">
                                            <option value="">Select correct answer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-answer-option" style="display: block;">
                                    <div class="form-group">
                                        <label class="form-label">Correct Answer (Text)</label>
                                        <input class="form-input" type="text" name="edit-correct-text[]" value="${question.correct_answer || ''}" placeholder="Enter correct answer">
                                    </div>
                                </div>
                                <button type="button" class="action-btn danger" onclick="removeEditQuestion(this)" style="margin-top: 1rem;">
                                    <i class="fas fa-trash"></i>
                                    Remove Question
                                </button>
                            `;
                        }
                        questionsContainer.appendChild(questionDiv);
                    });
                    const addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.className = 'action-btn';
                    addButton.innerHTML = '<i class="fas fa-plus"></i> Add Question';
                    addButton.onclick = addEditQuestion;
                    questionsContainer.appendChild(addButton);
                    document.getElementById('editModal').classList.add('active');
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
            document.getElementById(modalId).classList.remove('active');
        }

        function addQuestion() {
            const container = document.getElementById('questionsContainer');
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question-container';
            questionDiv.innerHTML = `
                <div class="form-group">
                    <label class="form-label">Question</label>
                    <input class="form-input" type="text" name="questions[]" required placeholder="Enter your question">
                </div>
                <div class="form-group">
                    <label class="form-label">Question Type</label>
                    <select class="form-select" name="questionTypes[]" onchange="toggleAnswerType(this)">
                        <option value="multiple">Multiple Choice</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="multiple-choice-options">
                    <div class="form-group">
                        <label class="form-label">Options (one per line)</label>
                        <textarea class="form-textarea" name="options[]" rows="4" placeholder="Enter each option on a new line"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correct Answer</label>
                        <select class="form-select" name="correct[]">
                            <option value="">Select correct answer</option>
                        </select>
                    </div>
                </div>
                <div class="text-answer-option" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Correct Answer (Text)</label>
                        <input class="form-input" type="text" name="correct-text[]" placeholder="Enter correct answer">
                    </div>
                </div>
                <button type="button" class="action-btn danger" onclick="removeQuestion(this)" style="margin-top: 1rem;">
                    <i class="fas fa-trash"></i>
                    Remove Question
                </button>
            `;
            container.appendChild(questionDiv);
        }

        function removeQuestion(button) {
            button.parentElement.remove();
        }

        function toggleAnswerType(select) {
            const container = select.closest('.question-container');
            const multipleChoiceDiv = container.querySelector('.multiple-choice-options');
            const textAnswerDiv = container.querySelector('.text-answer-option');

            if (select.value === 'multiple') {
                multipleChoiceDiv.style.display = 'block';
                textAnswerDiv.style.display = 'none';
            } else {
                multipleChoiceDiv.style.display = 'none';
                textAnswerDiv.style.display = 'block';
            }
        }

        function deleteSelected() {
            const selectedGrade = document.querySelector('#gradeFilter').value;
            const selectedSubjectButton = document.querySelector('.subject-tab.active');
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
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
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
            const container = textarea.closest('.question-container');
            const select = container.querySelector('select[name="correct[]"]');
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
                    <label class="form-label">Question</label>
                    <input class="form-input" type="text" name="edit-questions[]" required placeholder="Enter your question">
                </div>
                <div class="form-group">
                    <label class="form-label">Question Type</label>
                    <select class="form-select" name="edit-questionTypes[]" onchange="toggleEditAnswerType(this)">
                        <option value="multiple">Multiple Choice</option>
                        <option value="text">Text Answer</option>
                    </select>
                </div>
                <div class="multiple-choice-options">
                    <div class="form-group">
                        <label class="form-label">Options (one per line)</label>
                        <textarea class="form-textarea" name="edit-options[]" rows="4" placeholder="Enter each option on a new line"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correct Answer</label>
                        <select class="form-select" name="edit-correct[]">
                            <option value="">Select correct answer</option>
                        </select>
                    </div>
                </div>
                <div class="text-answer-option" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Correct Answer (Text)</label>
                        <input class="form-input" type="text" name="edit-correct-text[]" placeholder="Enter correct answer">
                    </div>
                </div>
                <button type="button" class="action-btn danger" onclick="removeEditQuestion(this)" style="margin-top: 1rem;">
                    <i class="fas fa-trash"></i>
                    Remove Question
                </button>
            `;
            container.appendChild(questionDiv);
        }

        function removeEditQuestion(button) {
            button.parentElement.remove();
        }

        function toggleEditAnswerType(select) {
            const container = select.closest('.question-container');
            const multipleChoiceDiv = container.querySelector('.multiple-choice-options');
            const textAnswerDiv = container.querySelector('.text-answer-option');

            if (select.value === 'multiple') {
                multipleChoiceDiv.style.display = 'block';
                textAnswerDiv.style.display = 'none';
            } else {
                multipleChoiceDiv.style.display = 'none';
                textAnswerDiv.style.display = 'block';
            }
        }

        // Update the select options when options textarea changes for edit form
        document.addEventListener('input', function(e) {
            if (e.target.name === 'edit-options[]') {
                updateEditCorrectAnswerOptions(e.target);
            }
        });

        function updateEditCorrectAnswerOptions(textarea) {
            const container = textarea.closest('.question-container');
            const select = container.querySelector('select[name="edit-correct[]"]');
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
                let correctAnswer;
                let options = null;

                if (questionType === 'multiple') {
                    options = container.querySelector('textarea[name="edit-options[]"]').value.split('\n').filter(opt => opt.trim());
                    correctAnswer = container.querySelector('select[name="edit-correct[]"]').value;

                    if (options.length < 2) {
                        alert('Multiple choice questions must have at least 2 options');
                        return;
                    }
                } else {
                    correctAnswer = container.querySelector('input[name="edit-correct-text[]"]').value;
                }

                if (!questionText || !questionType || !correctAnswer) {
                    alert('Please fill in all question fields');
                    return;
                }

                formData.questions.push({
                    question: questionText,
                    type: questionType,
                    options: options,
                    correct_answer: correctAnswer
                });
            });

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Saving...';

            // Get the material ID from the current selection
            const selectedGrade = document.querySelector('#gradeFilter').value;
            const selectedSubjectButton = document.querySelector('.subject-tab.active');
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


    </script>
<!-- </body>

</html> -->
@endsection