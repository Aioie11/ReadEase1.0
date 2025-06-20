@extends('layouts.head-stud')

@section('title', 'English Questions')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>English Question</h1>
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
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            margin-bottom: 30px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }

        .dashboard-header h1 {
            color: #2c3e50;
            font-size: 1.8em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .dashboard-header p {
            color: #7f8c8d;
            margin: 0;
            font-size: 1.1em;
        }

        .grade-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            margin-bottom: 30px;
        }

        .grade-card h2 {
            color: #2c3e50;
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #666666;
            font-weight: 700;
        }

        .passage-container {
            margin: 20px 0;
            padding: 25px;
            background: white;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .passage-container h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
            border-bottom: 2px solid #666666;
            padding-bottom: 10px;
        }

        .passage {
            line-height: 1.7;
            color: #2c3e50;
            font-size: 1.05em;
        }

        .questions-container {
            margin-top: 30px;
        }

        .questions-container h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #666666;
            padding-bottom: 10px;
        }

        .question-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .question-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .question {
            color: #2c3e50;
            font-size: 1.1em;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .choices {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .choice {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .choice:hover {
            background-color: #e3f2fd;
            border-color: #3498db;
        }

        .choice input[type="radio"]:checked + span {
            color: #3498db;
            font-weight: 600;
        }

        .choice input[type="text"] {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 1em;
        }

        .submit-container {
            margin-top: 30px;
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
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
@endsection