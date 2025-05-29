@extends('layouts.head-stud')

@section('title', 'English Questions')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>English Question</h1>
                <p>Read each passage and answer the questions given.</p>

                <!-- Reading Timer Display -->
                <div class="timer-container">
                    <div class="timer-display">
                        <i class="fas fa-clock"></i>
                        <span class="timer-label">Reading Time:</span>
                        <span id="timer" class="timer-value">00:00</span>
                    </div>
                    <div class="timer-status">
                        <span id="timer-status">📖 Reading in progress...</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="answerForm" action="{{ route('student.add.english') }}" method="post">
                @csrf
                <div class="grade-card">
                    <h2><i class="fas fa-book-open"></i> Reading Passage</h2>

                    <!-- Reading Passage -->
                    <div class="passage-container">
                        @if(isset($readingMaterial))
                            <h3>{{ $readingMaterial->title }}</h3>
                            <div class="passage">
                                <p>{{ $readingMaterial->content }}</p>
                            </div>
                        @else
                            <div class="passage">
                                <p>No reading material available at the moment.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Questions -->
                    <div class="questions-container">
                        <h3>Questions</h3>

                        @if(isset($readingMaterial) && $readingMaterial->questions)
                            @foreach($readingMaterial->questions as $index => $question)
                                <div class="question-card">
                                    <p class="question">{{ $index + 1 }}. {{ $question->question }}</p>
                                    <div class="choices">
                                        @if($question->type === 'multiple' && $question->options)
                                            @foreach($question->options as $option)
                                                <label class="choice">
                                                    <input type="radio" name="c{{ $index + 1 }}" value="{{ $option }}" required>
                                                    <span>{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        @else
                                            <div class="choice">
                                                <input type="text" name="c{{ $index + 1 }}" class="form-control"
                                                    placeholder="Enter your answer" required>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="question-card">
                                <p>No questions available for this reading material.</p>
                            </div>
                        @endif

                        <div class="submit-container">
                            <button type="button" class="submit-btn" onclick="confirmSubmit()">Submit Answers</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal">
        <div class="confirmation-content">
            <h2>Confirm Submission</h2>
            <p>Are you sure you want to submit your answers? This action cannot be undone.</p>
            <div class="confirmation-buttons">
                <button class="confirm-submit" onclick="submitForm()">Submit</button>
                <button class="cancel-submit" onclick="closeConfirmationModal()">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="confirmation-content">
            <h2>Success!</h2>
            <p>Your answers have been submitted successfully.</p>
            <div class="confirmation-buttons">
                <button class="confirm-submit" onclick="closeSuccessModal()">OK</button>
            </div>
        </div>
    </div>

    <style>
        /* Timer Styles */
        .timer-container {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border: 2px solid #00B8A9;
            box-shadow: 0 4px 12px rgba(0, 184, 169, 0.15);
        }

        .timer-display {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .timer-display i {
            color: #00B8A9;
            font-size: 1.2rem;
        }

        .timer-label {
            font-weight: 600;
            color: #1a237e;
            font-size: 1.1rem;
        }

        .timer-value {
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            color: #00B8A9;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 2px solid #00B8A9;
            min-width: 80px;
            text-align: center;
        }

        .timer-status {
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
        }

        .timer-status.completed {
            color: #4caf50;
            font-weight: 600;
        }

        .passage-container {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .passage {
            line-height: 1.6;
            color: #333;
        }

        .passage p {
            margin-bottom: 15px;
        }

        .questions-container {
            margin: 20px 0;
        }

        .question-card {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .question {
            font-weight: 600;
            margin-bottom: 15px;
            color: #1a237e;
        }

        .choices {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .choice {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .choice:hover {
            background-color: #e3f2fd;
        }

        .choice input[type="radio"] {
            margin-right: 10px;
        }

        .submit-container {
            text-align: center;
            margin: 20px 0;
        }

        .submit-btn {
            background-color: #1a237e;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0d47a1;
            transform: translateY(-2px);
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
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .confirmation-content {
            background: var(--neutral-light);
            margin: 15% auto;
            padding: 2rem;
            width: 90%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .confirmation-content h2 {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .confirmation-content p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .confirm-submit {
            background: var(--primary);
            color: var(--neutral-light);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .confirm-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .cancel-submit {
            background: var(--neutral);
            color: var(--text);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .cancel-submit:hover {
            background: var(--neutral-dark);
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            position: relative;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-dismissible {
            padding-right: 4rem;
        }

        .btn-close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 1.25rem;
            background: transparent;
            border: 0;
            cursor: pointer;
        }

        .fade {
            transition: opacity .15s linear;
        }

        .fade.show {
            opacity: 1;
        }
    </style>

    <script>
        // Timer Variables
        let startTime = Date.now();
        let timerInterval;
        let readingTimeSeconds = 0;

        // Start timer when page loads
        window.addEventListener('load', function () {
            startTimer();
            console.log('Reading timer started');
        });

        function startTimer() {
            timerInterval = setInterval(function () {
                readingTimeSeconds = Math.floor((Date.now() - startTime) / 1000);
                const minutes = Math.floor(readingTimeSeconds / 60);
                const seconds = readingTimeSeconds % 60;

                // Update timer display
                document.getElementById('timer').textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Update status based on time
                updateTimerStatus(readingTimeSeconds);
            }, 1000);
        }

        function updateTimerStatus(seconds) {
            const statusElement = document.getElementById('timer-status');
            const minutes = Math.floor(seconds / 60);

            if (minutes < 2) {
                statusElement.textContent = '📖 Reading in progress...';
                statusElement.className = '';
            } else if (minutes < 5) {
                statusElement.textContent = '⏰ Good reading pace';
                statusElement.className = '';
            } else if (minutes < 10) {
                statusElement.textContent = '🤔 Take your time to understand';
                statusElement.className = '';
            } else {
                statusElement.textContent = '📚 Thorough reading - great job!';
                statusElement.className = '';
            }
        }

        function stopTimer() {
            if (timerInterval) {
                clearInterval(timerInterval);
                document.getElementById('timer-status').textContent = '✅ Reading completed!';
                document.getElementById('timer-status').className = 'completed';
                console.log('Reading timer stopped. Total time:', readingTimeSeconds, 'seconds');
            }
        }

        function confirmSubmit() {
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function closeSuccessModal() {
            document.getElementById('successModal').style.display = 'none';
            window.location.href = "{{ route('student.reports') }}";
        }

        function submitForm() {
            // Stop the timer first
            stopTimer();

            const form = document.getElementById('answerForm');
            const formData = new FormData(form);

            // Add reading time to form data
            formData.append('reading_time', readingTimeSeconds);
            console.log('Submitting with reading time:', readingTimeSeconds, 'seconds');

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    closeConfirmationModal();
                    if (data.success) {
                        document.getElementById('successModal').style.display = 'block';
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting your answers. Please try again.');
                });
        }

        // Close modals when clicking outside
        window.onclick = function (event) {
            const confirmationModal = document.getElementById('confirmationModal');
            const successModal = document.getElementById('successModal');
            if (event.target === confirmationModal) {
                closeConfirmationModal();
            }
            if (event.target === successModal) {
                closeSuccessModal();
            }
        }
    </script>
@endsection