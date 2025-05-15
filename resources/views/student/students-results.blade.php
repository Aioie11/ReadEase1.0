@extends('student.2hf')

@section('content')
        <div>
            <div class="passage">
                <div class="p-5 col-md-12">
                    
                    
                    <div class="d-flex align-items-center gap-2">
                            <img src="{{ asset('pic/profile.png') }}" height="90" width="100" alt="ReadEase Logo">
                        <div class="lh-sm"> 
                            <p class="fs-4 fw-bold mb-1">Alibanga, Alexander Ven A.</p> 
                            <p class="fs-5 mb-0">Grade 7: Section Narra</p> 
                        </div>
                    </div><hr><br>

                    <div class="lh-sm text-center"> 
                        <p class="fs-5 fw-bold mb-1">English Languages Test Result</p> 
                        <p class="mb-0">The graphs below shows the results</p> 
                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <canvas id="myChart"></canvas>
                        </div>

                        <div class="col-md-4">
                            <canvas id="myChart1"></canvas>
                        </div>

                        <div class="col-md-4">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 ps-4 me-2" for="teacherFeedback">Teacher's Feedback:</label>
                            <textarea class="form-control w-80 custom-input" id="teacherFeedback" rows="4" readonly>This is where the teacher's feedback will appear.
                            </textarea>
                    </div><br></hr>

                    <div class="lh-sm text-center"> 
                        <p class="fs-5 fw-bold mb-1">Filipino Languages Test Result</p> 
                        <p class="mb-0">The graphs below shows the results</p> 
                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <canvas id="myChart3"></canvas>
                        </div>

                        <div class="col-md-4">
                            <canvas id="myChart4"></canvas>
                        </div>

                        <div class="col-md-4">
                            <canvas id="myChart5"></canvas>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 ps-4 me-2" for="teacherFeedback">Teacher's Feedback:</label>
                            <textarea class="form-control w-80 custom-input" id="teacherFeedback" rows="4" readonly>This is where the teacher's feedback will appear.
                            </textarea>
                    </div>

                    

                </div>
            </div>
            </div><br>

            @endsection