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
                <!-- <div class="timer-container">
                    <div class="timer-display">
                        <i class="fas fa-clock"></i>
                        <span class="timer-label">Reading Time:</span>
                        <span id="timer" class="timer-value">00:00</span>
                    </div>
                    <div class="timer-status">
                        <span id="timer-status">📖 Reading in progress...</span>
                    </div>
                </div>
            </div> -->

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
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .confirmation-content {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .confirmation-content h2 {
            color: #1a237e;
            margin-bottom: 1rem;
        }

        .confirmation-content p {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .confirm-submit, .cancel-submit {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .confirm-submit {
            background-color: #1a237e;
            color: white;
        }

        .confirm-submit:hover {
            background-color: #0d47a1;
            transform: translateY(-2px);
        }

        .cancel-submit {
            background-color: #e0e0e0;
            color: #333;
        }

        .cancel-submit:hover {
            background-color: #bdbdbd;
            transform: translateY(-2px);
        }

        .score-display {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a237e;
            margin: 1rem 0;
        }
    </style>
@endsection