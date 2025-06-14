@extends('layouts.head-tech')

@section('title', 'Reading Assessment')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <style>
            /* Page-specific styles */
            .main {
                max-width: 1100px;
                margin: 2.5rem auto;
                padding: 0 1rem;
            }

            .search-bar {
                display: flex;
                align-items: center;
                background: var(--neutral-light);
                border-radius: 50px;
                box-shadow: var(--shadow-md);
                padding: 0.5rem 1rem;
                margin-bottom: 2rem;
                max-width: 400px;
            }

            .search-bar input {
                border: none;
                outline: none;
                background: transparent;
                flex: 1;
                font-size: 1rem;
                padding: 0.5rem;
            }

            .search-bar button {
                background: var(--primary);
                color: #fff;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                cursor: pointer;
                transition: var(--transition);
            }

            .search-bar button:hover {
                background: var(--primary-light);
            }

            .card {
                background: var(--neutral-light);
                border-radius: var(--radius);
                box-shadow: var(--shadow-md);
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .section-title {
                color: var(--primary);
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }

            .passage {
                color: var(--text-light);
                font-size: 1.1rem;
                margin-bottom: 1rem;
                line-height: 1.6;
            }

            .word-count-display {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
                padding: 0.5rem 1rem;
                background: var(--neutral);
                border-radius: 8px;
                border-left: 4px solid var(--primary);
            }

            .word-count-label {
                color: var(--text);
                font-weight: 600;
                font-size: 0.95rem;
            }

            .word-count-number {
                color: var(--primary);
                font-weight: 700;
                font-size: 1.1rem;
                background: var(--neutral-light);
                padding: 0.2rem 0.6rem;
                border-radius: 4px;
                min-width: 40px;
                text-align: center;
            }

            .student-card {
                background: var(--neutral-light);
                border-radius: var(--radius);
                box-shadow: var(--shadow-md);
                padding: 1.5rem;
                margin-bottom: 1rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .student-header {
                font-weight: 600;
                font-size: 1.1rem;
                color: var(--primary);
                margin-bottom: 0.2rem;
            }

            .student-meta {
                color: var(--text-light);
                font-size: 0.95rem;
                margin-bottom: 0.5rem;
            }

            .assessment-group {
                margin-bottom: 1.5rem;
            }

            .assessment-group label {
                display: block;
                font-weight: 600;
                color: var(--text);
                margin-bottom: 0.5rem;
            }

            .assessment-select {
                width: 100%;
                padding: 0.8rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 1rem;
                background: white;
                cursor: pointer;
            }

            .assessment-select:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 2px rgba(14, 97, 186, 0.1);
            }

            .assessment-layout {
                display: flex;
                gap: 2rem;
                margin-bottom: 1.5rem;
                align-items: flex-start;
            }

            .left-controls {
                flex: 1;
                min-width: 200px;
            }

            .right-controls {
                flex: 2;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .assessment-controls {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .control-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .control-group label {
                font-weight: 600;
                color: var(--text);
                font-size: 0.9rem;
            }

            .assessment-input {
                padding: 0.6rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 1rem;
                width: 100%;
            }

            .assessment-input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 2px rgba(14, 97, 186, 0.1);
            }

            .input-note {
                font-size: 0.8rem;
                color: var(--text-light);
                margin-top: 0.3rem;
                font-style: italic;
            }

            .timer-controls {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                background: var(--neutral-light);
                border-radius: 8px;
                border: 1px solid #e0e0e0;
                flex-wrap: wrap;
            }

            .timer-buttons {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }

            .save-controls {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: flex-end;
                margin-top: 1rem;
            }

            .save-assessment {
                background: var(--secondary);
                color: white;
                border: none;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
            }

            .save-assessment:hover {
                background: #4fa13a;
                transform: translateY(-2px);
            }

            .clear-assessment {
                background: var(--neutral);
                color: var(--text);
                border: 1px solid #ddd;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
            }

            .clear-assessment:hover {
                background: #e5e5e5;
            }

            .miscues-input {
                padding: 0.4rem 0.7rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 1rem;
                width: 90px;
            }

            .timer {
                font-family: 'Poppins', monospace;
                font-size: 1.1rem;
                margin: 0 1rem;
                font-weight: 600;
                color: var(--primary);
            }

            .btn {
                border: none;
                outline: none;
                padding: 0.5rem 1.2rem;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 500;
                cursor: pointer;
                transition: var(--transition);
                margin-right: 0.5rem;
            }

            .btn.start {
                background: var(--secondary);
                color: #fff;
            }

            .btn.start:hover {
                background: #4fa13a;
            }

            .btn.stop {
                background: var(--primary);
                color: #fff;
            }

            .btn.stop:hover {
                background: var(--primary-light);
            }

            .btn.reset {
                background: var(--danger);
                color: #fff;
            }

            .btn.reset:hover {
                background: #a50c36;
            }

            .back-btn {
                background: var(--neutral);
                color: var(--primary);
                border: 1px solid var(--primary);
                margin-bottom: 1.5rem;
            }

            .back-btn:hover {
                background: var(--primary);
                color: #fff;
            }

            .card-header-row {
                display: flex;
                justify-content: flex-end;
                align-items: center;
                margin-bottom: 1rem;
            }

            .dropdown {
                position: relative;
            }

            .dropdown>a {
                font-weight: 500;
                color: var(--primary);
                background: var(--neutral);
                border-radius: 8px;
                padding: 0.5rem 1.2rem;
                text-decoration: none;
                transition: var(--transition);
                border: 1px solid var(--primary);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .dropdown>a:hover {
                background: var(--primary);
                color: #fff;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background: var(--neutral-light);
                color: var(--text);
                min-width: 160px;
                box-shadow: var(--shadow-md);
                border-radius: 8px;
                top: 2.5rem;
                right: 0;
                left: auto;
                z-index: 10;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropdown-content a {
                color: var(--text);
                padding: 0.7rem 1rem;
                display: block;
                border-radius: 8px;
                text-decoration: none;
            }

            .dropdown-content a:hover {
                background: var(--neutral);
            }

            .dropdown-content a.selected {
                background: var(--primary-light);
                color: #fff;
            }

            /* Passage Header and Word Count Styles */
            .passage-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid var(--neutral-light);
            }

            .word-count-display {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                background: var(--primary);
                color: var(--text-white);
                padding: 0.5rem 1rem;
                border-radius: 8px;
                font-size: 0.9rem;
                font-weight: 500;
                box-shadow: var(--shadow-sm);
            }

            .word-count-display i {
                font-size: 1rem;
                color: var(--text-white);
            }

            .word-count-display strong {
                font-weight: 700;
                font-size: 1rem;
            }

            .input-note {
                color: var(--text-light);
                font-size: 0.8rem;
                margin-top: 0.25rem;
                font-style: italic;
            }

            #totalWords {
                background-color: var(--neutral-light);
                cursor: not-allowed;
            }

            /* Feedback Section Styles */
            .feedback-section {
                background: var(--neutral-light);
                border-radius: var(--radius);
                box-shadow: var(--shadow-md);
                padding: 1.5rem;
                margin-top: 2rem;
            }

            .feedback-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--neutral);
            }

            .feedback-header h3 {
                color: var(--primary);
                font-size: 1.2rem;
                margin: 0;
            }

            .feedback-form {
                display: grid;
                gap: 1.5rem;
            }

            .feedback-group {
                display: grid;
                gap: 0.5rem;
            }

            .feedback-group label {
                color: var(--text);
                font-weight: 500;
            }

            .feedback-input {
                width: 100%;
                padding: 0.8rem;
                border: 1px solid var(--neutral);
                border-radius: 8px;
                font-family: inherit;
                font-size: 1rem;
                transition: var(--transition);
                resize: vertical;
                min-height: 100px;
            }

            .feedback-input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 2px rgba(14, 97, 186, 0.1);
            }



            .feedback-actions {
                display: flex;
                gap: 1rem;
                justify-content: flex-end;
                margin-top: 1rem;
            }

            .btn-save {
                background: var(--primary);
                color: var(--neutral-light);
                border: none;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                font-weight: 500;
                cursor: pointer;
                transition: var(--transition);
            }

            .btn-save:hover {
                background: var(--primary-light);
                transform: translateY(-2px);
            }

            .btn-cancel {
                background: var(--neutral);
                color: var(--text);
                border: 1px solid #ddd;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                font-weight: 500;
                cursor: pointer;
                transition: var(--transition);
            }

            .btn-cancel:hover {
                background: #e5e5e5;
            }

            .feedback-history {
                margin-top: 2rem;
            }

            .feedback-history h4 {
                color: var(--text);
                margin-bottom: 1rem;
            }

            .feedback-item {
                background: var(--neutral);
                border-radius: 8px;
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .feedback-meta {
                display: flex;
                justify-content: space-between;
                color: var(--text-light);
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }

            .feedback-content {
                color: var(--text);
                line-height: 1.5;
            }

            .feedback-content p {
                margin-bottom: 0.5rem;
            }

            .feedback-rating {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-top: 0.5rem;
            }

            .feedback-rating i {
                color: #FFD700;
                /* Golden Yellow */
            }

            .feedback-rating .far {
                color: #ddd;
            }

            .feedback-actions-history {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid #e5e5e5;
            }

            .btn-send {
                background: var(--secondary);
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                font-size: 0.9rem;
                cursor: pointer;
                transition: var(--transition);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-send:hover {
                background: #4fa13a;
                transform: translateY(-1px);
            }

            .btn-send:disabled {
                background: #ccc;
                cursor: not-allowed;
                transform: none;
            }

            .send-status {
                font-size: 0.9rem;
                padding: 0.3rem 0.8rem;
                border-radius: 4px;
                font-weight: 500;
            }

            .send-status.sent {
                background: #e8f5e8;
                color: #388e3c;
            }

            .send-status.pending {
                background: #fff3e0;
                color: #f57c00;
            }

            .send-status.not-sent {
                background: #ffebee;
                color: #d32f2f;
            }

            @media (max-width: 700px) {
                .main {
                    padding: 0;
                }

                .card,
                .student-card {
                    padding: 1rem;
                }

                .assessment-layout {
                    flex-direction: column;
                    gap: 1rem;
                }

                .right-controls {
                    gap: 0.8rem;
                }

                .timer-buttons {
                    justify-content: center;
                }

                .save-controls {
                    justify-content: flex-end;
                }

                .assessment-controls {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.7rem;
                }
            }
        </style>

        <div class="main">
            <button class="btn back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back
            </button>

            <div class="card">
                <div class="card-header-row">
                    <div class="dropdown">
                        <a href="#">Reading Languages <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="#" id="lang-english">English</a>
                            <a href="#" id="lang-filipino">Filipino</a>
                        </div>
                    </div>
                </div>

                <div class="passage-header">
                    <div class="section-title" id="passage-title">READING PASSAGE</div>
                    <div class="word-count-display">
                        <i class="fas fa-file-word"></i>
                        <span>Total Words: <strong id="passageWordCount">0</strong></span>
                    </div>
                </div>
                <div class="passage" id="passage-text">
                    @if(isset($readingMaterial))
                        <h3>{{ $readingMaterial->title }}</h3>
                        <div class="reading-content">
                            <p>{{ $readingMaterial->content }}</p>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-book"></i>
                            <p>No reading material has been published for this grade level and subject yet.</p>
                        </div>
                    @endif
                </div>
            </div>



            <div class="student-card">
                <div class="student-header">Student Reading Assessment</div>
                <div class="student-meta">Section: {{ ucfirst($section ?? 'Narra') }} &nbsp; | &nbsp; Grade Level:
                    {{ str_replace('grade', '', $grade ?? 'grade7') }}
                </div>

                <!-- Student Selection -->
                <div class="assessment-group">
                    <label for="studentSelect">Select Student:</label>
                    <select id="studentSelect" class="assessment-select">
                        <option value="">Choose a student...</option>
                        @foreach($students as $student)
                            @if($student->grade_level == str_replace('grade', '', $grade) && $student->section == ucfirst($section))
                                <option value="{{ $student->student_number }}">{{ $student->last_name }}, {{ $student->first_name }}
                                    {{ $student->middle_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>



                <!-- Assessment Controls -->
                <div class="assessment-controls">
                    <!-- Reading Miscues -->
                    <div class="control-group">
                        <label for="miscues">Reading Miscues</label>
                        <input type="number" id="miscues" class="assessment-input" min="0" value="0">
                    </div>

                    <!-- Total Words (Auto-calculated) -->
                    <div class="control-group">
                        <label for="totalWords">Total Words (Auto-calculated)</label>
                        <input type="number" id="totalWords" class="assessment-input" readonly>
                        <div class="input-note">This field is automatically updated based on the reading passage</div>
                    </div>
                </div>

                <!-- Timer Controls -->
                <div class="timer-controls">
                    <span class="timer" id="timer">00:00:00</span>
                    <button class="btn start" onclick="startTimer()">Start Time</button>
                    <button class="btn stop" onclick="stopTimer()">Stop Time</button>
                    <button class="btn reset" onclick="resetTimer()">Reset Time</button>
                </div>

                <!-- Save Assessment Button -->
                <div class="save-controls">
                    <button class="btn save-assessment" onclick="saveAssessment()">Save Assessment</button>
                    <button class="btn clear-assessment" onclick="clearAssessment()">Clear All</button>
                </div>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="feedback-section">
            <div class="feedback-header">
                <h3>Student Reading Assessment Feedback</h3>
            </div>
            <form class="feedback-form" id="feedbackForm">
                <div class="feedback-group">
                    <label for="strengths">Reading Strengths:</label>
                    <textarea id="strengths" class="feedback-input"
                        placeholder="What did the student do well in their reading?"></textarea>
                </div>

                <div class="feedback-group">
                    <label for="areasForImprovement">Areas for Improvement:</label>
                    <textarea id="areasForImprovement" class="feedback-input"
                        placeholder="What areas need more practice?"></textarea>
                </div>

                <div class="feedback-group">
                    <label for="recommendations">Recommendations:</label>
                    <textarea id="recommendations" class="feedback-input"
                        placeholder="Specific recommendations for improvement..."></textarea>
                </div>

                <div class="feedback-actions">
                    <button type="button" class="btn-cancel" onclick="resetFeedback()">Clear</button>
                    <button type="submit" class="btn-save">Save Feedback</button>
                </div>
            </form>
            <div class="feedback-history">
                <h4>Previous Feedback</h4>
                <div id="feedbackHistory"></div>
                <div class="empty-state" id="noFeedbackMessage" style="display: none;">
                    <i class="fas fa-comment-slash"></i>
                    <p>No previous feedback available.</p>
                </div>
            </div>

            <!-- <div class="feedback-history">
                                        <h4>Previous Feedback</h4>
                                        <div class="feedback-item">
                                            <div class="feedback-meta">
                                                <span>Date: 12/15/2024</span>
                                                <span>Reading Level: Grade 7</span>
                                            </div>
                                            <div class="feedback-content">
                                                <p><strong>Strengths:</strong> Good pronunciation and clear voice projection</p>
                                                <p><strong>Areas for Improvement:</strong> Reading speed and comprehension</p>
                                                <p><strong>Recommendations:</strong> Practice with shorter passages first</p>
                                            </div>

                                            <div class="feedback-actions-history">
                                                <button class="btn-send" onclick="sendFeedbackToStudent(this, 'sample-feedback-1')">
                                                    <i class="fas fa-paper-plane"></i> Send to Student
                                                </button>
                                                <span class="send-status sent">✓ Sent</span>
                                            </div>
                                        </div>
                                    </div> -->
        </div>
    </div>

    <script>
        // Timer functionality
        let startTime = null;
        let timerInterval = null;
        let isRunning = false;

        function startTimer() {
            if (!isRunning) {
                startTime = new Date().getTime();
                isRunning = true;
                timerInterval = setInterval(updateTimer, 1000);

                // Update button states
                document.querySelector('.btn.start').disabled = true;
                document.querySelector('.btn.stop').disabled = false;
                document.querySelector('.btn.reset').disabled = false;
            }
        }

        function stopTimer() {
            if (isRunning) {
                clearInterval(timerInterval);
                isRunning = false;

                // Update button states
                document.querySelector('.btn.start').disabled = false;
                document.querySelector('.btn.stop').disabled = true;
            }
        }

        function resetTimer() {
            clearInterval(timerInterval);
            isRunning = false;
            startTime = null;
            document.getElementById('timer').textContent = '00:00:00';

            // Reset button states
            document.querySelector('.btn.start').disabled = false;
            document.querySelector('.btn.stop').disabled = true;
            document.querySelector('.btn.reset').disabled = true;
        }

        function updateTimer() {
            if (startTime) {
                const currentTime = new Date().getTime();
                const elapsedTime = currentTime - startTime;

                const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
                const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                const formattedTime =
                    String(hours).padStart(2, '0') + ':' +
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');

                document.getElementById('timer').textContent = formattedTime;
            }
        }

        // Language switching functionality
        const passages = {
            english: {
                title: 'READING PASSAGE',
                text: 'Here is a story about a young girl named Maria. In a small town by the mountains, she lives with her grandmother and grandfather. Every morning, she happily helps her grandparents with household chores, such as washing dishes and taking care of the animals. Maria feels great joy when she sees her grandparents happy. She also loves reading books, especially stories about nature. She dreams of becoming a teacher one day to help children like her learn and have a bright future.'
            },
            filipino: {
                title: 'TALATA SA PAGBASA',
                text: 'Narito ang isang kwento tungkol sa isang batang babae na nagngangalang Maria. Sa isang maliit na bayan sa tabi ng bundok, nakatira siya sa kanyang lola at lolo. Bawat umaga, masaya niyang tinutulungan ang kanyang mga lolo at lola sa mga gawain sa bahay, tulad ng paghuhugas ng pinggan at pag-aalaga sa mga hayop. Laking tuwa ni Maria kapag nakikita niyang maligaya ang kanyang mga lolo at lola. Mahilig din siya sa pagbabasa ng mga aklat, lalo na ng mga kwento tungkol sa kalikasan. Pinapangarap niyang maging isang guro balang araw upang matulungan ang mga batang katulad niya na nais matuto at magkaroon ng magandang kinabukasan.'
            }
        };

        // Language switching event listeners
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('lang-english').addEventListener('click', function (e) {
                e.preventDefault();
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('language', 'english');
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            document.getElementById('lang-filipino').addEventListener('click', function (e) {
                e.preventDefault();
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('language', 'filipino');
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            // Initialize button states
            document.querySelector('.btn.stop').disabled = true;
            document.querySelector('.btn.reset').disabled = true;

            // Set default language selection based on current language
            const urlParams = new URLSearchParams(window.location.search);
            const currentLanguage = urlParams.get('language') || 'english';
            document.getElementById('lang-' + currentLanguage).classList.add('selected');

            // Initialize word count on page load
            updateWordCount();

            // Set up observer to watch for passage content changes
            const passageText = document.getElementById('passage-text');
            if (passageText) {
                const observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.type === 'childList' || mutation.type === 'characterData') {
                            updateWordCount();
                        }
                    });
                });

                observer.observe(passageText, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });
            }
        });

        function switchLanguage(language) {
            const passage = passages[language];
            document.getElementById('passage-title').textContent = passage.title;
            document.getElementById('passage-text').textContent = passage.text;

            // Update selected state
            document.querySelectorAll('.dropdown-content a').forEach(link => {
                link.classList.remove('selected');
            });
            document.getElementById('lang-' + language).classList.add('selected');

            // Update word count when language changes
            updateWordCount();
        }

        // Word counting functionality
        function countWords(text) {
            // Remove extra whitespace and split by spaces
            // Also remove common punctuation and normalize text
            const cleanText = text.replace(/[^\w\s]/g, ' ').replace(/\s+/g, ' ').trim();
            return cleanText.split(/\s+/).filter(word => word.length > 0).length;
        }

        function updateWordCount() {
            const passageElement = document.getElementById('passage-text');
            let passageText = '';

            // Check if there's content from database or use default passages
            const readingContent = passageElement.querySelector('.reading-content p');
            const emptyState = passageElement.querySelector('.empty-state');

            if (readingContent && !emptyState) {
                // Use database content
                passageText = readingContent.textContent || readingContent.innerText || '';
            } else if (!emptyState) {
                // Use default passage content (when language switching)
                passageText = passageElement.textContent || passageElement.innerText || '';
            } else {
                // No content available
                passageText = '';
            }

            const wordCount = countWords(passageText);

            // Update the word count display
            const wordCountElement = document.getElementById('passageWordCount');
            if (wordCountElement) {
                wordCountElement.textContent = wordCount;
            }

            // Auto-update the Total Words input field
            const totalWordsInput = document.getElementById('totalWords');
            if (totalWordsInput) {
                totalWordsInput.value = wordCount;
            }

            // Log for debugging
            console.log('Word count updated:', wordCount, 'from text:', passageText.substring(0, 50) + '...');
        }

        // Feedback Form Functionality
        const feedbackForm = document.getElementById('feedbackForm');

        // Form Submission
        feedbackForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const studentSelect = document.getElementById('studentSelect');
            const studentId = studentSelect.value;

            if (!studentId) {
                alert('Please select a student first!');
                return;
            }

            // Get current page parameters
            const urlParams = new URLSearchParams(window.location.search);
            const grade = urlParams.get('grade') || 'grade7';
            const section = urlParams.get('section') || 'narra';
            const language = urlParams.get('language') || 'english';

            const feedback = {
                student_id: studentId,
                language: language,
                grade_level: parseInt(grade.replace('grade', '')),
                section: section,
                strengths: document.getElementById('strengths').value,
                areas_for_improvement: document.getElementById('areasForImprovement').value,
                recommendations: document.getElementById('recommendations').value
            };

            // Show loading state
            const saveButton = feedbackForm.querySelector('.btn-save');
            const originalText = saveButton.textContent;
            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            // Send to backend
            fetch('/teacher/save-feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(feedback)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Feedback saved successfully!');

                        // Add to feedback history
                        addFeedbackToHistory(data.feedback);

                        // Reset form
                        resetFeedback();
                    } else {
                        alert('Error saving feedback: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving feedback. Please try again.');
                })
                .finally(() => {
                    saveButton.disabled = false;
                    saveButton.textContent = originalText;
                });
        });

        function resetFeedback() {
            feedbackForm.reset();
        }

        function addFeedbackToHistory(feedback) {
            const feedbackHistory = document.querySelector('.feedback-history');
            const feedbackItem = document.createElement('div');
            feedbackItem.className = 'feedback-item';

            // Use the feedback ID from the backend
            const feedbackId = feedback.id;
            const feedbackDate = new Date(feedback.created_at).toLocaleDateString();

            feedbackItem.innerHTML = `
                                        <div class="feedback-meta">
                                            <span>Date: ${feedbackDate}</span>
                                            <span>Reading Level: Grade ${feedback.grade_level}</span>
                                            <span>Language: ${feedback.language.charAt(0).toUpperCase() + feedback.language.slice(1)}</span>
                                        </div>
                                        <div class="feedback-content">
                                            <p><strong>Strengths:</strong> ${feedback.strengths || 'Not specified'}</p>
                                            <p><strong>Areas for Improvement:</strong> ${feedback.areas_for_improvement || 'Not specified'}</p>
                                            <p><strong>Recommendations:</strong> ${feedback.recommendations || 'Not specified'}</p>
                                        </div>

                                        <div class="feedback-actions-history">
                                            <button class="btn-send" onclick="sendFeedbackToStudent(this, ${feedbackId})">
                                                <i class="fas fa-paper-plane"></i> Send to Student
                                            </button>
                                            <span class="send-status ${feedback.is_sent ? 'sent' : 'not-sent'}">
                                                ${feedback.is_sent ? '✓ Sent' : 'Not Sent'}
                                            </span>
                                        </div>
                                    `;

            // Store feedback data for sending
            feedbackItem.dataset.feedbackData = JSON.stringify(feedback);
            feedbackItem.dataset.feedbackId = feedbackId;

            // Insert at the beginning of feedback history
            const existingItems = feedbackHistory.querySelectorAll('.feedback-item');
            if (existingItems.length > 0) {
                feedbackHistory.insertBefore(feedbackItem, existingItems[0]);
            } else {
                feedbackHistory.appendChild(feedbackItem);
            }
        }

        // Send feedback to student function
        function sendFeedbackToStudent(button, feedbackId) {
            const feedbackItem = button.closest('.feedback-item');
            const statusSpan = feedbackItem.querySelector('.send-status');
            const feedbackData = JSON.parse(feedbackItem.dataset.feedbackData || '{}');

            // Get current student ID
            const studentSelect = document.getElementById('studentSelect');
            const studentId = studentSelect.value;

            if (!studentId) {
                alert('Please select a student first!');
                return;
            }

            // Update button and status to show sending
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            statusSpan.className = 'send-status pending';
            statusSpan.textContent = 'Sending...';

            // Send to backend
            fetch('/teacher/send-feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    feedback_id: feedbackId,
                    student_id: studentId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI to show sent status
                        button.innerHTML = '<i class="fas fa-check"></i> Sent';
                        button.style.background = '#388e3c';
                        statusSpan.className = 'send-status sent';
                        statusSpan.textContent = '✓ Sent';

                        // Show success message
                        alert(data.message);

                        // Disable button after successful send
                        setTimeout(() => {
                            button.disabled = true;
                        }, 1000);
                    } else {
                        // Reset button on error
                        button.disabled = false;
                        button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Student';
                        statusSpan.className = 'send-status not-sent';
                        statusSpan.textContent = 'Not Sent';

                        alert('Error sending feedback: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Reset button on error
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Student';
                    statusSpan.className = 'send-status not-sent';
                    statusSpan.textContent = 'Not Sent';

                    alert('Error sending feedback. Please try again.');
                });
        }



        // Assessment saving functionality
        function saveAssessment() {
            const studentSelect = document.getElementById('studentSelect');
            const studentId = studentSelect.value; // Student ID is in the value attribute
            const selectedOption = studentSelect.options[studentSelect.selectedIndex];
            const studentName = selectedOption.textContent.trim(); // Get the display name from option text

            const miscues = parseInt(document.getElementById('miscues').value) || 0;
            const totalWords = parseInt(document.getElementById('totalWords').value) || 0;

            // Set default comprehension values (will be handled on student side)
            const correctAnswers = 0;
            const totalQuestions = 0;

            // Get timer data
            const timerElement = document.getElementById('timer');
            const timeText = timerElement.textContent;
            const timeParts = timeText.split(':');
            const totalSeconds = (parseInt(timeParts[0]) * 3600) + (parseInt(timeParts[1]) * 60) + parseInt(timeParts[2]);

            // Calculate reading speed (WPM) - allow 0 minutes
            const readingTimeMinutes = totalSeconds / 60; // Allow any time including 0
            const readingSpeed = readingTimeMinutes > 0 ? Math.round(totalWords / readingTimeMinutes) : 0;

            // Calculate comprehension percentage
            const comprehension = totalQuestions > 0 ? Math.round((correctAnswers / totalQuestions) * 100) : 0;

            // Calculate correct reading percentage (words read correctly)
            const correctReading = totalWords > 0 ? Math.round(((totalWords - miscues) / totalWords) * 100) : 0;

            // Get current page parameters
            const urlParams = new URLSearchParams(window.location.search);
            const grade = urlParams.get('grade') || 'grade7';
            const section = urlParams.get('section') || 'narra';
            const language = urlParams.get('language') || 'english';

            // Validation
            if (!studentId) {
                alert('Please select a student first!');
                return;
            }

            if (totalWords <= 0) {
                alert('Please enter the total number of words!');
                return;
            }

            // Show confirmation dialog
            const confirmMessage = `Save assessment for ${studentName}?\n\nReading Speed: ${readingSpeed} wpm\nCorrect Reading: ${correctReading}%\nTime: ${timeText}`;

            if (!confirm(confirmMessage)) {
                return; // User cancelled
            }

            // Allow 0 seconds minimum - no minimum time validation needed

            // Prepare assessment data
            const assessmentData = {
                student_id: studentId,
                student_name: studentName,
                reading_time: totalSeconds,
                miscues: miscues,
                total_words: totalWords,
                correct_answers: correctAnswers,
                total_questions: totalQuestions,
                reading_speed: readingSpeed,
                comprehension: comprehension,
                correct_reading: correctReading,
                section: section,
                language: language,
                grade: grade.replace('grade', ''),
                assessment_date: new Date().toISOString()
            };

            // Show loading state
            const saveButton = document.querySelector('.save-assessment');
            const originalText = saveButton.textContent;
            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            // Send to backend
            fetch('/teacher/save-reading-assessment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(assessmentData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Assessment saved successfully - no popup needed
                        console.log('Assessment saved successfully!');

                        // Refresh charts with new data
                        refreshStudentCharts(studentId);

                        // Clear the form for next assessment
                        clearAssessment();
                    } else {
                        alert('Error saving assessment: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving assessment. Please try again.');
                })
                .finally(() => {
                    saveButton.disabled = false;
                    saveButton.textContent = originalText;
                });
        }

        function clearAssessment() {
            // Reset all form fields
            document.getElementById('studentSelect').value = '';
            document.getElementById('miscues').value = '0';

            // Reset timer
            resetTimer();

            // Recalculate word count from current passage
            updateWordCount();

            // Show confirmation
            console.log('Assessment form cleared');
        }

        // Function to refresh student charts after assessment saving
        function refreshStudentCharts(studentId) {
            if (!studentId) {
                console.log('No student ID provided for chart refresh');
                return;
            }

            console.log('Assessment saved for student ID:', studentId);

            // Just log the success - don't open any new windows or redirect
            console.log('Assessment data has been saved to the student record');

            // No page redirection or new window opening
            // Charts will be updated when user manually navigates to student view
        }
    </script>
@endsection