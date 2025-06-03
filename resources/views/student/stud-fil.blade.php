@extends('layouts.head-stud')

@section('title', 'Filipino Questions')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Filipino Question</h1>
                <p>Read each passage and answer the questions given.</p>
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

            <form id="answerForm" action="{{ route('student.add.filipino') }}" method="post">
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
                                                <input type="text" name="c{{ $index + 1 }}" class="form-control" placeholder="Ilagay ang iyong sagot" required>
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
                <button class="cancel-submit" onclick="closeConfirmationModal()">cancel</button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="confirmation-content">
            <h2>Success!</h2>
            <p>Your answers have been submitted successfully.</p>
            @if(session('score'))
                <p class="score-display">Your score: {{ session('score') }}/{{ session('total_questions') }}</p>
            @endif
           
        </div>
    </div>

    <!-- Alert Modal -->
    <div id="alertModal" class="modal">
        <div class="confirmation-content">
            <h2>Incomplete Answers</h2>
            <p>Please answer all questions before submitting.</p>
            <div class="confirmation-buttons">
                <button class="confirm-submit" onclick="closeAlertModal()">OK</button>
            </div>
        </div>
    </div>

    <script>
        function confirmSubmit() {
            // Check if all questions are answered
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            const textInputs = document.querySelectorAll('input[type="text"]');
            const allQuestions = document.querySelectorAll('.question-card');
            
            // Check if all questions have an answer
            let allAnswered = true;
            allQuestions.forEach((question, index) => {
                const questionNumber = index + 1;
                const radioInputs = question.querySelectorAll(`input[name="c${questionNumber}"]`);
                const textInput = question.querySelector(`input[name="c${questionNumber}"]`);
                
                if (radioInputs.length > 0) {
                    // For radio button questions
                    const isAnswered = Array.from(radioInputs).some(radio => radio.checked);
                    if (!isAnswered) {
                        allAnswered = false;
                    }
                } else if (textInput) {
                    // For text input questions
                    if (!textInput.value.trim()) {
                        allAnswered = false;
                    }
                }
            });
            
            if (!allAnswered) {
                document.getElementById('alertModal').classList.add('show');
                return;
            }
            
            // Show confirmation modal
            document.getElementById('confirmationModal').classList.add('show');
        }

        function submitForm() {
            document.getElementById('answerForm').submit();
            // Show success modal immediately after submission
            document.getElementById('successModal').classList.add('show');
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').classList.remove('show');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('show');
            window.location.href = "{{ route('student.reports') }}";
        }

        function closeAlertModal() {
            document.getElementById('alertModal').classList.remove('show');
        }

        // Show success modal if there's a success message
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('successModal').classList.add('show');
            });
        @endif
    </script>

    <style>
        .main-content {
            padding: 20px;
            background-color: #f5f6fa;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: var(--primary);
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: #7f8c8d;
            margin: 0;
        }

        .grade-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .grade-card h2 {
            color: var(--primary);
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #95a5a6;
        }

        .passage-container {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .passage-container h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .passage {
            line-height: 1.6;
            color: #333;
        }

        .questions-container {
            margin-top: 30px;
        }

        .questions-container h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .question-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .question {
            color: var(--primary-dark);
            font-size: 1.1em;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .choices {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .choice {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .choice:hover {
            background-color: #e9ecef;
        }

        .submit-container {
            margin-top: 30px;
            text-align: center;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        /* Modal Styles */
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

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .confirmation-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }

        .confirmation-content h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
        }

        .confirm-submit, .cancel-submit {
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.2s;
        }

        .confirm-submit {
            background-color: #3498db;
            color: white;
        }

        .confirm-submit:hover {
            background-color: #2980b9;
        }

        .cancel-submit {
            background-color: #e74c3c;
            color: white;
        }

        .cancel-submit:hover {
            background-color: #c0392b;
        }

        .score-display {
            font-size: 1.2em;
            color: #2c3e50;
            margin-top: 15px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .grade-card {
                padding: 15px;
            }

            .confirmation-content {
                width: 95%;
                padding: 20px;
            }
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
            console.log('Filipino reading timer started');
        });

        function startTimer() {
            timerInterval = setInterval(function () {
                readingTimeSeconds = Math.floor((Date.now() - startTime) / 1000);
                const minutes = Math.floor(readingTimeSeconds / 60);
                const seconds = readingTimeSeconds % 60;

                // Update timer display
                document.getElementById('timer').textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Update status based on time (in Filipino)
                updateTimerStatus(readingTimeSeconds);
            }, 1000);
        }

        function updateTimerStatus(seconds) {
            const statusElement = document.getElementById('timer-status');
            const minutes = Math.floor(seconds / 60);

            if (minutes < 2) {
                statusElement.textContent = '📖 Nagbabasa...';
                statusElement.className = '';
            } else if (minutes < 5) {
                statusElement.textContent = '⏰ Magandang bilis ng pagbabasa';
                statusElement.className = '';
            } else if (minutes < 10) {
                statusElement.textContent = '🤔 Masinsinan na pagbabasa';
                statusElement.className = '';
            } else {
                statusElement.textContent = '📚 Masusing pagbabasa - magaling!';
                statusElement.className = '';
            }
        }

        function stopTimer() {
            if (timerInterval) {
                clearInterval(timerInterval);
                document.getElementById('timer-status').textContent = '✅ Tapos na ang pagbabasa!';
                document.getElementById('timer-status').className = 'completed';
                console.log('Filipino reading timer stopped. Total time:', readingTimeSeconds, 'seconds');
            }
        }

        // Add reading time to form before submission
        document.querySelector('form').addEventListener('submit', function (e) {
            stopTimer();

            // Create hidden input for reading time
            const readingTimeInput = document.createElement('input');
            readingTimeInput.type = 'hidden';
            readingTimeInput.name = 'reading_time';
            readingTimeInput.value = readingTimeSeconds;

            this.appendChild(readingTimeInput);
            console.log('Submitting Filipino form with reading time:', readingTimeSeconds, 'seconds');
        });
    </script>
@endsection