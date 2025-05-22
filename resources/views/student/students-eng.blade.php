@extends('student.2hf')

@section('content')
        <div>
            <div class="passage">
                <div class="p-5 col-md-12">
                    <div class="row">
                        <div class="col-md-10">
                            <p>Name: Alibanga, Alexander Ven A. </p> 
                        </div>

                        <div class="col-md-2 ">
                            <p> Grade 7: Section Narra </p>
                        </div>
                    </div>
                    
                    <p class="fw-bold fs-4 mb-0">Online Reading Passage</p>
                    @if(isset($readingMaterial))
                        <h3>{{ $readingMaterial->title }}</h3>
                        <p class="pjust">{{ $readingMaterial->content }}</p>
                    @else
                        <p class="pjust">No reading material available at the moment.</p>
                    @endif
                </div>
            </div><br>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('student/add') }}" method="post">
            {{ csrf_field() }}
                <div class="wquestions container">
                    <div class="text-justify p-4 col-md-12">
                        <h4>READING COMPREHENSION QUESTIONS</h4><br>
                        
                        <div class="d-flex align-items-center">
                            <label class="ps-4 me-2" for="studentId">Student Id:</label>
                            <input class="form-control w-25 custom-input" name="student_id" type="text" aria-label="ID Number">
                        </div>
                        <br>

                        @if(isset($readingMaterial) && $readingMaterial->questions)
                            @foreach($readingMaterial->questions as $index => $question)
                                <div class="questions text-justify p-3 col-md-12">
                                    <p>{{ $index + 1 }}. {{ $question->question }}</p>
                                    @if($question->type === 'multiple' && $question->options)
                                        @foreach($question->options as $option)
                                            <div class="choice">
                                                <input type="radio" name="c{{ $index + 1 }}" value="{{ $option }}">
                                                {{ $option }}
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="choice">
                                            <input type="text" name="c{{ $index + 1 }}" class="form-control" placeholder="Enter your answer">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p>No questions available for this reading material.</p>
                        @endif

                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Clear Form</button>
                        <br>
                    </div>  
                </div><br>
            </form>
        </div>
@endsection