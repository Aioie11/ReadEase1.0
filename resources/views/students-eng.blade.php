@extends('2hf')

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
                    
                    
                    <p class = "fw-bold fs-4 mb-0">Online Reading Passage</p>
                    <p class="pjust">Telling Time Humans have used different objects to tell time. In the beginning, they used an hourglass. This is a cylindrical glass with a narrow center which allows sand to flow from its upper to its lower portion.
                        Once all the sand has trickled to the lower portion, one knows that an hour has passed. Using the same idea, water clocks were constructed to measure time by having water flow through a narrow passage from one container to another.
                        On the other hand, sundials allowed people to estimate an hour by looking at the position of the shadow cast by the sun on a plate. At night, people measured time by checking the alignment of the stars in the sky. None of these were accurate, though. 
                        The clock was the first accurate instrument or telling time.</p>
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


                        <div class=" questions text-justify p-3 col-md-12">
                            <div class=" questions text-justify p-3 col-md-12">
                                <p>1. Which of the following ways of telling time made use of sand?</p>
                                <div class="choice"><input type="radio" name="c1" value="A"> A. Waterclocks</div>
                                <div class="choice"><input type="radio" name="c1" value="B"> B. Hourglass</div>
                                <div class="choice"><input type="radio" name="c1" value="C"> C. Sundials</div>
                                <div class="choice"><input type="radio" name="c1" value="D"> D. Clock</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>2. None of the clocks used long ago were accurate. Accurate in the sentence means_____. </p>
                                <div class="choice"><input type="radio" name="c2" value="A"> A. Free from error</div>
                                <div class="choice"><input type="radio" name="c2" value="B"> B. Comparable</div>
                                <div class="choice"><input type="radio" name="c2" value="C"> C. Very useful</div>
                                <div class="choice"><input type="radio" name="c2" value="D"> D. Effecient</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>3. When men of long ago told time at night, they looked at the __________________ to tell the time.</p>
                                <div class="choice"><input type="radio" name="c3" value="A"> A. Cloud Formation</div>
                                <div class="choice"><input type="radio" name="c3" value="B"> B. Moon</div>
                                <div class="choice"><input type="radio" name="c3" value="C"> C. Star</div>
                                <div class="choice"><input type="radio" name="c3" value="D"> D. Sun</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>4. The sundials may not be useful in telling time____________.</p>
                                <div class="choice"><input type="radio" name="c4" value="A"> A. at noontime</div>
                                <div class="choice"><input type="radio" name="c4" value="B"> B. in the morning</div>
                                <div class="choice"><input type="radio" name="c4" value="C"> C. during a rainy day</div>
                                <div class="choice"><input type="radio" name="c4" value="D"> D. when the sun shines brightly</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>5. How are the hourglass and the water clock similar?</p>
                                <div class="choice"><input type="radio" name="c5" value="A"> A. Both tell time by the hour.</div>
                                <div class="choice"><input type="radio" name="c5" value="B"> B. Both use water to tell time.</div>
                                <div class="choice"><input type="radio" name="c5" value="C"> C. Both are used only in the daytime.</div>
                                <div class="choice"><input type="radio" name="c5" value="D"> D. Both have a narrow center through which something flows.</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>6. The best title of the selection is ______________________.</p>
                                <div class="choice"><input type="radio" name="c6" value="A"> A. The Uses of Clocks</div>
                                <div class="choice"><input type="radio" name="c6" value="B"> B. Why People Need to Tell Time</div>
                                <div class="choice"><input type="radio" name="c6" value="C"> C. Ways of Telling Time: Then and Now</div>
                                <div class="choice"><input type="radio" name="c6" value="D"> D. Comparing the Different Types of Clocks</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>7. Which of these sentences is a topic sentence?</p>
                                <div class="choice"><input type="radio" name="c7" value="A"> A. The invention of the clock 600 years ago was the first accurate  measurement of time.</div>
                                <div class="choice"><input type="radio" name="c7" value="B"> B. Hourglass contained sand that fell through one container to another</div>
                                <div class="choice"><input type="radio" name="c7" value="C"> C. Long ago people used simple tools such as the hour glass.</div>
                                <div class="choice"><input type="radio" name="c7" value="D"> D. Humans have used different objects to tell the time.</div>
                            </div>
                        </div>
                        <br>
                                    <button type="submit">Submit</button>
                                    <button type="reset">Clear Form</button>
                                    <br>
                                             
                    </div>  
                </div><br>
@endsection