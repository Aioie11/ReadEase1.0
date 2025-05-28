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
                margin-bottom: 1.5rem;
                line-height: 1.6;
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

            .timer-controls {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
                justify-content: center;
                padding: 1rem;
                background: var(--neutral-light);
                border-radius: 8px;
            }

            .save-controls {
                display: flex;
                gap: 1rem;
                justify-content: center;
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

            .rating-group {
                display: flex;
                gap: 1rem;
                align-items: center;
            }

            .rating-stars {
                display: flex;
                gap: 0.5rem;
            }

            .rating-stars i {
                color: #ddd;
                cursor: pointer;
                font-size: 1.5rem;
                transition: var(--transition);
            }

            .rating-stars i.active {
                color: var(--accent);
            }

            .rating-stars i:hover {
                transform: scale(1.1);
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
                color: var(--accent);
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

                <div class="section-title" id="passage-title">TALATA SA PAGBASA</div>
                <div class="passage" id="passage-text">
                    Narito ang isang kwento tungkol sa isang batang babae na nagngangalang Maria. Sa isang maliit na bayan
                    sa tabi ng bundok, nakatira siya sa kanyang lola at lolo. Bawat umaga, masaya niyang tinutulungan ang
                    kanyang mga lolo at lola sa mga gawain sa bahay, tulad ng paghuhugas ng pinggan at pag-aalaga sa mga
                    hayop. Laking tuwa ni Maria kapag nakikita niyang maligaya ang kanyang mga lolo at lola. Mahilig din
                    siya sa pagbabasa ng mga aklat, lalo na ng mga kwento tungkol sa kalikasan. Pinapangarap niyang maging
                    isang guro balang araw upang matulungan ang mga batang katulad niya na nais matuto at magkaroon ng
                    magandang kinabukasan.
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
                        <option value="Maria Garcia">Maria Garcia</option>
                        <option value="Juan Santos">Juan Santos</option>
                        <option value="Ana Reyes">Ana Reyes</option>
                        <option value="Carlos Mendoza">Carlos Mendoza</option>
                        <option value="Sofia Cruz">Sofia Cruz</option>
                    </select>
                </div>

                <!-- Reading Assessment Controls -->
                <div class="assessment-controls">
                    <div class="control-group">
                        <label for="miscues">Reading Miscues</label>
                        <input type="number" id="miscues" class="assessment-input" min="0" value="0">
                    </div>

                    <div class="control-group">
                        <label for="totalWords">Total Words</label>
                        <input type="number" id="totalWords" class="assessment-input" min="1" value="150">
                    </div>

                    <div class="control-group">
                        <label for="correctAnswers">Correct Answers</label>
                        <input type="number" id="correctAnswers" class="assessment-input" min="0" value="0">
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
                    <label>Reading Performance Rating:</label>
                    <div class="rating-group">
                        <div class="rating-stars" id="readingRating">
                            <i class="fas fa-star" data-rating="1"></i>
                            <i class="fas fa-star" data-rating="2"></i>
                            <i class="fas fa-star" data-rating="3"></i>
                            <i class="fas fa-star" data-rating="4"></i>
                            <i class="fas fa-star" data-rating="5"></i>
                        </div>
                        <span id="ratingValue">0/5</span>
                    </div>
                </div>

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
                    <div class="feedback-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>3/5</span>
                    </div>
                    <div class="feedback-actions-history">
                        <button class="btn-send" onclick="sendFeedbackToStudent(this, 'sample-feedback-1')">
                            <i class="fas fa-paper-plane"></i> Send to Student
                        </button>
                        <span class="send-status sent">✓ Sent</span>
                    </div>
                </div>
            </div>
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
                switchLanguage('english');
            });

            document.getElementById('lang-filipino').addEventListener('click', function (e) {
                e.preventDefault();
                switchLanguage('filipino');
            });

            // Initialize button states
            document.querySelector('.btn.stop').disabled = true;
            document.querySelector('.btn.reset').disabled = true;

            // Set default language selection
            document.getElementById('lang-filipino').classList.add('selected');

            // Display current section and grade information
            const urlParams = new URLSearchParams(window.location.search);
            const grade = urlParams.get('grade') || '{{ $grade ?? "grade7" }}';
            const section = urlParams.get('section') || '{{ $section ?? "narra" }}';
            const language = urlParams.get('language') || 'english';

            // Update page title based on parameters
            const gradeNumber = grade.replace('grade', '');
            const sectionName = section.charAt(0).toUpperCase() + section.slice(1);

            // Update student card with section info
            const studentMeta = document.querySelector('.student-meta');
            if (studentMeta) {
                studentMeta.innerHTML = `Section: ${sectionName} &nbsp; | &nbsp; Grade Level: ${gradeNumber}`;
            }

            // Set initial language
            if (language === 'filipino') {
                switchLanguage('filipino');
            } else {
                switchLanguage('english');
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
        }

        // Star Rating Functionality
        const readingRating = document.getElementById('readingRating');
        const ratingValue = document.getElementById('ratingValue');
        const feedbackForm = document.getElementById('feedbackForm');
        let currentRating = 0;

        readingRating.addEventListener('click', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const rating = parseInt(e.target.dataset.rating);
                currentRating = rating;
                updateStars(rating);
                ratingValue.textContent = `${rating}/5`;
            }
        });

        readingRating.addEventListener('mouseover', (e) => {
            if (e.target.classList.contains('fa-star')) {
                const rating = parseInt(e.target.dataset.rating);
                updateStars(rating);
            }
        });

        readingRating.addEventListener('mouseout', () => {
            updateStars(currentRating);
        });

        function updateStars(rating) {
            const stars = readingRating.querySelectorAll('i');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // Form Submission
        feedbackForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const feedback = {
                rating: currentRating,
                strengths: document.getElementById('strengths').value,
                areasForImprovement: document.getElementById('areasForImprovement').value,
                recommendations: document.getElementById('recommendations').value,
                date: new Date().toLocaleDateString()
            };

            // Here you would typically send this to your backend
            console.log('Feedback submitted:', feedback);

            // Add to feedback history (for demo purposes)
            addFeedbackToHistory(feedback);

            // Reset form
            resetFeedback();

            // Show success message
            alert('Feedback saved successfully!');
        });

        function resetFeedback() {
            feedbackForm.reset();
            currentRating = 0;
            updateStars(0);
            ratingValue.textContent = '0/5';
        }

        function addFeedbackToHistory(feedback) {
            const feedbackHistory = document.querySelector('.feedback-history');
            const feedbackItem = document.createElement('div');
            feedbackItem.className = 'feedback-item';

            // Generate unique ID for this feedback
            const feedbackId = 'feedback-' + Date.now();

            feedbackItem.innerHTML = `
                                    <div class="feedback-meta">
                                        <span>Date: ${feedback.date}</span>
                                        <span>Reading Level: Grade 7</span>
                                    </div>
                                    <div class="feedback-content">
                                        <p><strong>Strengths:</strong> ${feedback.strengths}</p>
                                        <p><strong>Areas for Improvement:</strong> ${feedback.areasForImprovement}</p>
                                        <p><strong>Recommendations:</strong> ${feedback.recommendations}</p>
                                    </div>
                                    <div class="feedback-rating">
                                        ${Array(5).fill().map((_, i) =>
                `<i class="fas fa-star${i < feedback.rating ? '' : ' far'}"></i>`
            ).join('')}
                                        <span>${feedback.rating}/5</span>
                                    </div>
                                    <div class="feedback-actions-history">
                                        <button class="btn-send" onclick="sendFeedbackToStudent(this, '${feedbackId}')">
                                            <i class="fas fa-paper-plane"></i> Send to Student
                                        </button>
                                        <span class="send-status not-sent">Not Sent</span>
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

            // Get current student info from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const grade = urlParams.get('grade') || 'grade7';
            const section = urlParams.get('section') || 'narra';

            // Update button and status to show sending
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            statusSpan.className = 'send-status pending';
            statusSpan.textContent = 'Sending...';

            // Simulate sending to backend (replace with actual API call)
            setTimeout(() => {
                // Prepare feedback data for student
                const studentFeedback = {
                    id: feedbackId,
                    teacherName: 'Ms. Johnson', // This would come from authenticated user
                    subject: 'Reading Assessment Feedback',
                    grade: grade.replace('grade', ''),
                    section: section.charAt(0).toUpperCase() + section.slice(1),
                    rating: feedbackData.rating,
                    strengths: feedbackData.strengths,
                    areasForImprovement: feedbackData.areasForImprovement,
                    recommendations: feedbackData.recommendations,
                    date: feedbackData.date,
                    sentDate: new Date().toLocaleDateString(),
                    type: 'reading_feedback',
                    priority: 'normal'
                };

                // Here you would typically send this to your backend
                console.log('Sending feedback to student:', studentFeedback);

                // Simulate successful send
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-check"></i> Sent';
                button.style.background = '#388e3c';
                statusSpan.className = 'send-status sent';
                statusSpan.textContent = '✓ Sent';

                // Store in localStorage for demo (in real app, this would be in database)
                const existingFeedback = JSON.parse(localStorage.getItem('studentFeedback') || '[]');
                existingFeedback.unshift(studentFeedback);
                localStorage.setItem('studentFeedback', JSON.stringify(existingFeedback));

                // Show success message
                alert(`Feedback sent successfully to student!\n\nGrade: ${studentFeedback.grade}\nSection: ${studentFeedback.section}\nRating: ${studentFeedback.rating}/5 stars`);

                // Disable button after successful send
                setTimeout(() => {
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-check"></i> Sent';
                }, 1000);

            }, 2000); // Simulate network delay
        }

        // Assessment saving functionality
        function saveAssessment() {
            const studentName = document.getElementById('studentSelect').value;
            const miscues = parseInt(document.getElementById('miscues').value) || 0;
            const totalWords = parseInt(document.getElementById('totalWords').value) || 0;
            const correctAnswers = parseInt(document.getElementById('correctAnswers').value) || 0;
            const totalQuestions = parseInt(document.getElementById('totalQuestions').value) || 0;

            // Get timer data
            const timerElement = document.getElementById('timer');
            const timeText = timerElement.textContent;
            const timeParts = timeText.split(':');
            const totalSeconds = (parseInt(timeParts[0]) * 3600) + (parseInt(timeParts[1]) * 60) + parseInt(timeParts[2]);

            // Calculate reading speed (WPM)
            const readingTimeMinutes = totalSeconds / 60;
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
            if (!studentName) {
                alert('Please select a student first!');
                return;
            }

            if (totalWords <= 0) {
                alert('Please enter the total number of words!');
                return;
            }

            if (totalQuestions <= 0) {
                alert('Please enter the total number of questions!');
                return;
            }

            // Prepare assessment data
            const assessmentData = {
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
                        alert(`Assessment saved successfully!\n\nStudent: ${studentName}\nReading Speed: ${readingSpeed} WPM\nComprehension: ${comprehension}%\nCorrect Reading: ${correctReading}%`);
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
            document.getElementById('totalWords').value = '150';
            document.getElementById('correctAnswers').value = '0';
            document.getElementById('totalQuestions').value = '10';

            // Reset timer
            resetTimer();

            // Show confirmation
            console.log('Assessment form cleared');
        }
    </script>
@endsection