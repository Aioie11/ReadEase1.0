@extends('layouts.head-stud')

@section('title', 'Filipino Questions')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Filipino Question</h1>
                <p>Basahin ang bawat talata at sagutin ang mga tanong.</p>

                <!-- Reading Timer Display -->
                <div class="timer-container">
                    <div class="timer-display">
                        <i class="fas fa-clock"></i>
                        <span class="timer-label">Oras ng Pagbabasa:</span>
                        <span id="timer" class="timer-value">00:00</span>
                    </div>
                    <div class="timer-status">
                        <span id="timer-status">📖 Nagbabasa...</span>
                    </div>
                </div>
            </div>

            <form action="{{ url('student/add') }}" method="post">
                {{ csrf_field() }}
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
                                <p>Walang reading material available sa ngayon.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Questions -->
                    <div class="questions-container">
                        <h3>Mga Tanong</h3>

                        @if(isset($readingMaterial) && $readingMaterial->questions)
                            @foreach($readingMaterial->questions as $index => $question)
                                <div class="question-card">
                                    <p class="question">{{ $index + 1 }}. {{ $question->question }}</p>
                                    <div class="choices">
                                        @if($question->type === 'multiple' && $question->options)
                                            @foreach($question->options as $option)
                                                <label class="choice">
                                                    <input type="radio" name="c{{ $index + 1 }}" value="{{ $option }}">
                                                    <span>{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        @else
                                            <div class="choice">
                                                <input type="text" name="c{{ $index + 1 }}" class="form-control"
                                                    placeholder="Ilagay ang iyong sagot">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="question-card">
                                <p>Walang mga tanong available para sa reading material na ito.</p>
                            </div>
                        @endif

                        <div class="submit-container">
                            <button type="submit" class="submit-btn">Ipasa ang mga Sagot</button>
                        </div>
                    </div>
                </div>
            </form>
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