@extends('layouts.head-stud')

@section('title', 'Filipino Questions')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Filipino Question</h1>
                <p>Basahin ang bawat talata at sagutin ang mga tanong.</p>
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
                                            <input type="text" name="c{{ $index + 1 }}" class="form-control" placeholder="Ilagay ang iyong sagot">
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
@endsection