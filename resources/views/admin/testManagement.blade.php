@extends('layouts.head-ad')

@section('title', 'Test Management')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
        /* Main Content - Clean Stud-Dash Style */
        .main-content {
            margin-top: 60px;
            padding: 50px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Dashboard Container - Clean Organization */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1rem;
        }

        /* Page Header - Clean Stud-Dash Style */
        .page-header {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .page-header h1 {
            color: #00B8A9;;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-header p {
            color: #7f8c8d;
            margin: 0.5rem 0 0 0;
            font-size: 1rem;
            line-height: 0.9;
        }

        /* Control Panel - Clean Stud-Dash Style */
        .control-panel {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
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
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: white;
            color: #2c3e50;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .action-btn:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btn.primary {
            background: #00B8A9;
            color: white;
            border-color: #00B8A9;
        }

        .action-btn.primary:hover {
            background: #009688;
            color: white;
        }

        .action-btn.danger {
            border-color: #e74c3c;
            color: #e74c3c;
        }

        .action-btn.danger:hover {
            background: #e74c3c;
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
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: white;
            color: #2c3e50;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        /* Subject Tabs */
        .subject-tabs {
            display: flex;
            gap: 0.5rem;
        }

        .subject-tab {
            padding: 0.75rem 1.5rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: white;
            color: #2c3e50;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .subject-tab:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .subject-tab.active {
            background: #00B8A9;
            color: white;
            border-color: #00B8A9;
        }

        /* Content Display */
        .content-display {
            display: grid;
            gap: 2rem;
        }

        /* Reading Materials List */
        .materials-list-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .materials-list-header {
            padding: 1.5rem;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .materials-list-header h3 {
            color: #2c3e50;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .materials-list-header h3 i {
            color: #00B8A9;
        }

        .materials-list-body {
            padding: 1.5rem;
            max-height: 300px;
            overflow-y: auto;
        }

        .material-item {
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .material-item:last-child {
            margin-bottom: 0;
        }

        .material-item:hover {
            border-color: #00B8A9;
            box-shadow: 0 2px 8px rgba(0, 184, 169, 0.1);
            transform: translateY(-1px);
        }

        .material-item.selected {
            border-color: #00B8A9;
            background: rgba(0, 184, 169, 0.05);
            box-shadow: 0 2px 8px rgba(0, 184, 169, 0.15);
        }

        .material-title {
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .material-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        .material-status {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .material-status.published {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
        }

        .material-status.draft {
            background: rgba(149, 165, 166, 0.1);
            color: #95a5a6;
        }

        /* Radio Button Styling */
        .material-radio {
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .material-radio input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #00B8A9;
            cursor: pointer;
        }

        .material-content {
            flex: 1;
            min-width: 0;
        }

        .material-item.published {
            border-color: #00B8A9;
            background: rgba(0, 184, 169, 0.02);
        }

        .material-item.published .material-title {
            color: #00B8A9;
            font-weight: 700;
        }

        .published-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            background: #00B8A9;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .published-badge i {
            font-size: 0.6rem;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .content-card-header {
            padding: 1.5rem;
            background: #f8f9fa;
        }

        .content-card-header h3 {
            color: #2c3e50;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .content-card-header h3 i {
            color: #00B8A9;
        }

        .content-card-body {
            padding: 1.5rem;
        }

        /* Reading Passage Styles */
        .reading-content {
            line-height: 1.7;
            color: #2c3e50;
            font-size: 0.95rem;
        }

        .reading-title {
            color: #2c3e50;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Questions Display */
        .question-item {
            background: white;
            padding: 1.25rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .question-item:last-child {
            margin-bottom: 0;
        }

        .question-text {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .question-options {
            display: grid;
            gap: 0.5rem;
        }

        .option-item {
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 6px;
            color: #2c3e50;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .correct-answer {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
            font-weight: 600;
        }

        .text-answer {
            padding: 0.75rem;
            background: rgba(39, 174, 96, 0.1);
            border-radius: 6px;
            color: #27ae60;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--background-white);
            border-radius: 12px;
            border: 2px dashed var(--border-color);
        }

        .empty-state-icon {
            font-size: 2.5rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .empty-state-title {
            color: var(--text-primary);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Loading State */
        .loading-state {
            text-align: center;
            padding: 2rem;
            color: var(--text-secondary);
        }

        .loading-spinner {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            border: 3px solid var(--border-color);
            border-top: 3px solid var(--primary-color);
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
            font-weight: 600;
        }

        .status-published {
            background: rgba(5, 150, 105, 0.1);
            color: var(--success-color);
        }

        .status-draft {
            background: rgba(107, 114, 128, 0.1);
            color: var(--text-secondary);
        }

        /* Modal Styles - Clean Modern Design */
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
            backdrop-filter: blur(4px);
        }

        .modal.active {
            display: flex;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 0;
            max-width: 800px;
            width: 95vw;
            max-height: 90vh;
            overflow: hidden;
            position: relative;
            margin: 2rem 0;
        }

        .modal-header {
            background: linear-gradient(135deg, #00B8A9 0%, #009688 100%);
            color: white;
            padding: 2rem;
            margin: 0;
            border-radius: 20px 20px 0 0;
            position: relative;
        }

        .modal-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .modal-title i {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 2.5rem;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: #2c3e50;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-size: 1.1rem;
            font-weight: bold;
            z-index: 10;
        }

        .close-modal:hover {
            background: #e74c3c;
            color: white;
            border-color: #e74c3c;
            transform: scale(1.1);
        }

        .close-modal i {
            font-size: 1rem;
        }

        /* Modal Body */
        .modal-body {
            padding: 2rem;
            max-height: calc(90vh - 120px);
            overflow-y: auto;
        }

        /* Enhanced Form Styles */
        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #2c3e50;
            font-weight: 500;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-light);
            font-style: italic;
        }

        .question-container {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 12px;
            margin: 1.5rem 0;
            border: 1px solid #e9ecef;
            position: relative;
        }

        /* Form Section Styling */
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }

        .form-section-title {
            color: #2c3e50;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-section-title i {
            color: #00B8A9;
        }

        /* Enhanced Button Styling for Forms */
        .form-submit-btn {
            background: #00B8A9;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-submit-btn:hover {
            background: #009688;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Question Type Toggle Styling */
        .question-type-section {
            background: var(--background-white);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            margin: 1rem 0;
        }

        .multiple-choice-options,
        .text-answer-option {
            margin-top: 1rem;
            padding: 1rem;
            background: var(--background-white);
            border-radius: 8px;
            border: 1px solid var(--border-light);
        }

        /* Remove Question Button */
        .remove-question-btn {
            background: var(--danger-color);
            color: var(--background-white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
        }

        .remove-question-btn:hover {
            background: #b91c1c;
            transform: translateY(-1px);
        }
        /* Responsive Design - Clean Stud-Dash Style */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .dashboard-container {
                padding-top: 0;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
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
                max-height: 95vh;
            }

            .modal-body {
                padding: 1rem;
                max-height: calc(95vh - 100px);
            }

            .modal-header {
                padding: 1.5rem;
            }

            .control-panel {
                padding: 1rem;
            }
        }
    </style>

    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Test Management</h1>
                <p>Create, edit, and manage reading comprehension tests for students</p>
            </div>

        <!-- Control Panel -->
        <div class="control-panel">
            <!-- Action Buttons -->
            <div class="control-section">
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
                    <button class="action-btn" onclick="publishSelectedMaterial()">
                        <i class="fas fa-paper-plane"></i>
                        Publish Selected
                    </button>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="control-section">
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
            <!-- Reading Materials List Card -->
            <div class="materials-list-card">
                <div class="materials-list-header">
                    <h3><i class="fas fa-list"></i> Available Reading Materials</h3>
                    <p style="margin: 0.5rem 0 0 0; font-size: 0.85rem; color: #7f8c8d; font-style: italic;">
                        <i class="fas fa-info-circle" style="color: #00B8A9;"></i>
                        Select a radio button to choose which material to publish, then click "Publish Selected" button. Only one material can be active per language.
                    </p>
                </div>
                <div class="materials-list-body" id="materialsListContent">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="empty-state-title">No Reading Materials</div>
                        <div class="empty-state-text">
                            Select a grade and subject to view available reading materials, or create new content using the "Add New Material" button above. Once created, select a material with the radio button and click "Publish Selected" to make it available to students and teachers.
                        </div>
                    </div>
                </div>
            </div>

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
                        <div class="empty-state-title">No Reading Passage Selected</div>
                        <div class="empty-state-text">
                            Click on a reading material title from the list above to view its content.
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
                <h2 class="modal-title">
                    <i class="fas fa-plus-circle"></i>
                    Create New Reading Material
                </h2>
            </div>
            <div class="modal-body">
                <form id="createForm">
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-cog"></i>
                        Basic Information
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="grade"> Grade Level</label>
                        <select class="form-select" id="grade" required>
                            <option value="">Select Grade Level</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="subject"> Subject</label>
                        <select class="form-select" id="subject" required>
                            <option value="">Select Subject</option>
                            <option value="english">English</option>
                            <option value="filipino">Filipino</option>
                        </select>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-book-open"></i>
                        Reading Material
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="title"> Reading Title</label>
                        <input class="form-input" type="text" id="title" required placeholder="Enter an engaging title for the reading material">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="content"> Reading Content</label>
                        <textarea class="form-textarea" id="content" rows="8" required placeholder="Enter the complete reading passage content here..."></textarea>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-question-circle"></i>
                        Comprehension Questions
                    </div>
                    <div id="questionsContainer">
                        <div class="form-group">
                            <button type="button" class="action-btn primary" onclick="addQuestion()">
                                <i class="fas fa-plus"></i>
                                Add New Question
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e9ecef; text-align: center;">
                    <button type="submit" class="form-submit-btn" style="width: 100%;">
                        <i class="fas fa-save"></i>
                        Save Reading Material
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal('editModal')">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Reading Material
                </h2>
            </div>
            <div class="modal-body">
                <form id="editForm">
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-cog"></i>
                        Basic Information
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-grade"> Grade Level</label>
                        <select class="form-select" id="edit-grade" required>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-subject"> Subject</label>
                        <select class="form-select" id="edit-subject" required>
                            <option value="english">English</option>
                            <option value="filipino">Filipino</option>
                        </select>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-book-open"></i>
                        Reading Material
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-title"> Reading Title</label>
                        <input class="form-input" type="text" id="edit-title" required placeholder="Enter an engaging title for the reading material">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-content"> Reading Content</label>
                        <textarea class="form-textarea" id="edit-content" rows="8" required placeholder="Enter the complete reading passage content here..."></textarea>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-question-circle"></i>
                        Comprehension Questions
                    </div>
                    <div id="editQuestionsContainer">
                        <div class="form-group">
                            <button type="button" class="action-btn primary" onclick="addEditQuestion()">
                                <i class="fas fa-plus"></i>
                                Add New Question
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e9ecef; text-align: center;">
                    <button type="submit" class="form-submit-btn" style="width: 100%;">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Global variable to store current materials
        let currentMaterials = [];
        let selectedMaterialId = null;

        // Function to fetch and display reading materials
        function fetchAndDisplayReadingMaterials() {
            const selectedGrade = document.querySelector('#gradeFilter').value;
            const selectedSubjectButton = document.querySelector('.subject-tab.active');
            const selectedSubject = selectedSubjectButton ? selectedSubjectButton.dataset.subject : null;

            const materialsListContent = document.getElementById('materialsListContent');
            const readingContent = document.getElementById('readingPassageContent');
            const questionsContent = document.getElementById('questionsContent');

            if (!selectedGrade || !selectedSubject) {
                console.log('Grade or subject not selected.');
                // Show empty state for all sections
                showEmptyStates();
                return;
            }

            // Show loading state for all sections
            materialsListContent.innerHTML = `
                <div class="loading-state">
                    <div class="loading-spinner"></div>
                    <p>Loading reading materials...</p>
                </div>
            `;
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
                currentMaterials = data || [];

                if (data && data.length > 0) {
                    // Display materials list
                    displayMaterialsList(data);

                    // Clear reading passage and questions content
                    readingContent.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="empty-state-title">No Reading Passage Selected</div>
                            <div class="empty-state-text">
                                Click on a reading material title from the list above to view its content.
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
                                Select a reading material to view its comprehension questions.
                            </div>
                        </div>
                    `;
                } else {
                    // Display empty state if no data
                    showEmptyStates();
                }
            })
            .catch(error => {
                console.error('Error fetching reading materials:', error);
                // Display error state for all sections
                showErrorStates(error.message);
            });
        }

        // Helper function to show empty states
        function showEmptyStates() {
            const materialsListContent = document.getElementById('materialsListContent');
            const readingContent = document.getElementById('readingPassageContent');
            const questionsContent = document.getElementById('questionsContent');

            materialsListContent.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="empty-state-title">No Reading Materials</div>
                    <div class="empty-state-text">
                        Select a grade and subject to view available reading materials, or create new content using the "Add New Material" button above.
                    </div>
                </div>
            `;
            readingContent.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="empty-state-title">No Reading Passage Selected</div>
                    <div class="empty-state-text">
                        Click on a reading material title from the list above to view its content.
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
                        Select a reading material to view its comprehension questions.
                    </div>
                </div>
            `;
        }

        // Helper function to show error states
        function showErrorStates(errorMessage) {
            const materialsListContent = document.getElementById('materialsListContent');
            const readingContent = document.getElementById('readingPassageContent');
            const questionsContent = document.getElementById('questionsContent');

            const errorHtml = `
                <div class="empty-state">
                    <div class="empty-state-icon" style="color: #e74c3c;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="empty-state-title" style="color: #e74c3c;">Error Loading Content</div>
                    <div class="empty-state-text" style="color: #e74c3c;">
                        Error: ${errorMessage}
                    </div>
                </div>
            `;

            materialsListContent.innerHTML = errorHtml;
            readingContent.innerHTML = errorHtml;
            questionsContent.innerHTML = errorHtml;
        }

        // Function to display materials list
        function displayMaterialsList(materials) {
            const materialsListContent = document.getElementById('materialsListContent');

            if (!materials || materials.length === 0) {
                materialsListContent.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <div class="empty-state-title">No Reading Materials</div>
                        <div class="empty-state-text">
                            No reading materials found for this grade and subject. Click "Add New Material" to create content.
                        </div>
                    </div>
                `;
                return;
            }

            let materialsHtml = '';
            materials.forEach(material => {
                const statusClass = material.is_published ? 'published' : 'draft';
                const statusText = material.is_published ? 'Published' : 'Draft';
                const statusIcon = material.is_published ? 'fas fa-check-circle' : 'fas fa-edit';
                const itemClass = material.is_published ? 'material-item published' : 'material-item';
                const checkedAttribute = material.is_published ? 'checked' : '';

                materialsHtml += `
                    <div class="${itemClass}" data-material-id="${material.id}">
                        <div class="material-radio">
                            <input type="radio"
                                   name="materialToPublish"
                                   value="${material.id}"
                                   ${material.is_published ? 'checked' : ''}
                                   title="Select this material for publishing">
                        </div>
                        <div class="material-content" onclick="selectMaterial(${material.id})">
                            <div class="material-title">
                                ${material.title}
                                ${material.is_published ? '<span class="published-badge"><i class="fas fa-star"></i> ACTIVE</span>' : ''}
                            </div>
                            <div class="material-meta">
                                <span>Grade ${material.grade_level} • ${material.subject.charAt(0).toUpperCase() + material.subject.slice(1)}</span>
                                <span class="material-status ${statusClass}">
                                    <i class="${statusIcon}"></i>
                                    ${statusText}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
            });

            materialsListContent.innerHTML = materialsHtml;
        }

        // Function to select and display a specific material
        function selectMaterial(materialId) {
            selectedMaterialId = materialId;
            const material = currentMaterials.find(m => m.id === materialId);

            if (!material) {
                console.error('Material not found:', materialId);
                return;
            }

            // Update visual selection in the list
            document.querySelectorAll('.material-item').forEach(item => {
                item.classList.remove('selected');
            });
            document.querySelector(`[data-material-id="${materialId}"]`).classList.add('selected');

            // Display the selected material
            displaySelectedMaterial(material);
        }

        // Function to display selected material content and questions
        function displaySelectedMaterial(material) {
            const readingContent = document.getElementById('readingPassageContent');
            const questionsContent = document.getElementById('questionsContent');

            // Display Reading Passage
            const statusClass = material.is_published ? 'status-published' : 'status-draft';
            const statusText = material.is_published ? 'Published' : 'Draft';
            const statusIcon = material.is_published ? 'fas fa-check-circle' : 'fas fa-edit';

            readingContent.innerHTML = `
                <div class="reading-title">${material.title}</div>
                <div class="reading-content">${material.content}</div>
                <div class="status-indicator ${statusClass}" style="margin-top: 1rem;">
                    <i class="${statusIcon}"></i>
                    ${statusText}
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
        }



        // Updated publish function that works with radio button selection
        function publishMaterialById(materialId) {
            const material = currentMaterials.find(m => m.id === materialId);
            if (!material) {
                alert('Selected reading material not found');
                return;
            }

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Show loading state
            const radioButton = document.querySelector(`input[name="materialToPublish"][value="${materialId}"]`);
            const originalDisabled = radioButton.disabled;
            radioButton.disabled = true;

            // Publish the selected material
            fetch(`/api/reading-materials/${materialId}/publish`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({}),
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to publish reading material');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(`Reading material "${material.title}" published successfully!\n\nGrade: ${material.grade_level}\nSubject: ${material.subject.charAt(0).toUpperCase() + material.subject.slice(1)}\n\nThis material is now visible to students and teachers.`);
                    // Refresh the display to show updated status
                    fetchAndDisplayReadingMaterials();
                } else {
                    throw new Error(data.message || 'Failed to publish reading material');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + (error.message || 'Failed to publish reading material'));

                // Revert radio button selection on error
                const currentPublished = currentMaterials.find(m => m.is_published);
                if (currentPublished) {
                    document.querySelector(`input[name="materialToPublish"][value="${currentPublished.id}"]`).checked = true;
                } else {
                    document.querySelector(`input[name="materialToPublish"][value="${materialId}"]`).checked = false;
                }
            })
            .finally(() => {
                // Reset radio button state
                radioButton.disabled = originalDisabled;
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
                    // Clear questions container
                    document.getElementById('questionsContainer').innerHTML = `
                        <div class="form-group">
                            <button type="button" class="action-btn primary" onclick="addQuestion()">
                                <i class="fas fa-plus"></i>
                                Add New Question
                            </button>
                        </div>
                    `;
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

        // Publish selected material function (works with radio button selection)
        function publishSelectedMaterial() {
            // Get the selected radio button
            const selectedRadio = document.querySelector('input[name="materialToPublish"]:checked');

            if (!selectedRadio) {
                alert('Please select a reading material to publish by clicking the radio button next to it.');
                return;
            }

            const materialId = parseInt(selectedRadio.value);
            const material = currentMaterials.find(m => m.id === materialId);

            if (!material) {
                alert('Selected reading material not found');
                return;
            }

            // Check if it's already published
            if (material.is_published) {
                alert(`"${material.title}" is already published and active for students and teachers.`);
                return;
            }

            // Show confirmation dialog before publishing
            if (!confirm(`Are you sure you want to publish "${material.title}"?\n\nThis will:\n• Make this material available to students and teachers\n• Unpublish any other materials for Grade ${material.grade_level} ${material.subject.charAt(0).toUpperCase() + material.subject.slice(1)}\n\nContinue?`)) {
                return;
            }

            // Proceed with publishing
            publishMaterialById(materialId);
        }

        // CRUD Operations
        function openCreateModal() {
            document.getElementById('createModal').classList.add('active');
        }

        function openEditModal() {
            if (!selectedMaterialId) {
                alert('Please select a reading material from the list first');
                return;
            }

            const material = currentMaterials.find(m => m.id === selectedMaterialId);
            if (!material) {
                alert('Selected reading material not found');
                return;
            }

            // Use the selected material directly
            try {
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
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading reading material: ' + error.message);
            }
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
            if (!selectedMaterialId) {
                alert('Please select a reading material from the list first');
                return;
            }

            const material = currentMaterials.find(m => m.id === selectedMaterialId);
            if (!material) {
                alert('Selected reading material not found');
                return;
            }

            if (!confirm(`Are you sure you want to delete "${material.title}"? This action cannot be undone.`)) {
                return;
            }

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Delete the selected material directly
            fetch(`/api/reading-materials/${selectedMaterialId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
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

            // Use the selected material ID directly
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/api/reading-materials/${selectedMaterialId}`, {
                method: 'PUT',
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
@endsection