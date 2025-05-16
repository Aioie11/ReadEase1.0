@extends('admin.layouts.head')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>English Reading</h1>
                <p>Read each passage and answer the questions given.</p>
            </div>

            <form action="{{ url('student/add') }}" method="post">
            {{ csrf_field() }}
            <div class="grade-card">
                <h2><i class="fas fa-book-open"></i> Reading Passage</h2>
                
                <!-- Reading Passage -->
                <div class="passage-container">
                    <h3>Telling Time</h3>
                    <div class="passage">
                        <p>Telling Time Humans have used different objects to tell time. In the beginning, they used an hourglass. This is a cylindrical glass with a narrow center which allows sand to flow from its upper to its lower portion.
                        Once all the sand has trickled to the lower portion, one knows that an hour has passed. Using the same idea, water clocks were constructed to measure time by having water flow through a narrow passage from one container to another.
                        On the other hand, sundials allowed people to estimate an hour by looking at the position of the shadow cast by the sun on a plate. At night, people measured time by checking the alignment of the stars in the sky. None of these were accurate, though. 
                        The clock was the first accurate instrument or telling time.</p>
                    </div>
                </div>

                <!-- Questions -->
                <div class="questions-container">
                    <h3>Questions</h3>
                    
                    <!-- Question 1 -->
                    <div class="question-card">
                        <p class="question">1. Which of the following ways of telling time made use of sand?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c1" value="A"><span>A. Waterclocks</span></label>
                            <label class="choice"><input type="radio" name="c1" value="B"><span>B. Hourglass</span></label>
                            <label class="choice"><input type="radio" name="c1" value="C"><span>C. Sundials</span></label>
                            <label class="choice"><input type="radio" name="c1" value="D"><span>D. Clock</span></label>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="question-card">
                        <p class="question">2. None of the clocks used long ago were accurate. Accurate in the sentence means_____.</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c2" value="A"><span>A. Free from error</span></label>
                            <label class="choice"><input type="radio" name="c2" value="B"><span>B. Comparable</span></label>
                            <label class="choice"><input type="radio" name="c2" value="C"><span>C. Very useful</span></label>
                            <label class="choice"><input type="radio" name="c2" value="D"><span>D. Effecient</span></label>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="question-card">
                        <p class="question">3. When men of long ago told time at night, they looked at the __________________ to tell the time.</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c3" value="A"><span>A. Cloud Formation</span></label>
                            <label class="choice"><input type="radio" name="c3" value="B"><span>B. Moon</span></label>
                            <label class="choice"><input type="radio" name="c3" value="C"><span>C. Star</span></label>
                            <label class="choice"><input type="radio" name="c3" value="D"><span>D. Sun</span></label>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="question-card">
                        <p class="question">4. The sundials may not be useful in telling time____________.</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c4" value="A"><span>A. at noontime</span></label>
                            <label class="choice"><input type="radio" name="c4" value="B"><span>B. in the morning</span></label>
                            <label class="choice"><input type="radio" name="c4" value="C"><span>C. during a rainy day</span></label>
                            <label class="choice"><input type="radio" name="c4" value="D"><span>D. when the sun shines brightly</span></label>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="question-card">
                        <p class="question">5. How are the hourglass and the water clock similar?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c5" value="A"><span>A. Both tell time by the hour.</span></label>
                            <label class="choice"><input type="radio" name="c5" value="B"><span>B. Both use water to tell time.</span></label>
                            <label class="choice"><input type="radio" name="c5" value="C"><span>C. Both are used only in the daytime.</span></label>
                            <label class="choice"><input type="radio" name="c5" value="D"><span>D. Both have a narrow center through which something flows.</span></label>
                        </div>
                    </div>

                    <!-- Question 6 -->
                    <div class="question-card">
                        <p class="question">6. The best title of the selection is ______________________.</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c6" value="A"><span>A. The Uses of Clocks</span></label>
                            <label class="choice"><input type="radio" name="c6" value="B"><span>B. Why People Need to Tell Time</span></label>
                            <label class="choice"><input type="radio" name="c6" value="C"><span>C. Ways of Telling Time: Then and Now</span></label>
                            <label class="choice"><input type="radio" name="c6" value="D"><span>D. Comparing the Different Types of Clocks</span></label>
                        </div>
                    </div>

                    <!-- Question 7 -->
                    <div class="question-card">
                        <p class="question">7. Which of these sentences is a topic sentence?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c7" value="A"><span>A. The invention of the clock 600 years ago was the first accurate measurement of time.</span></label>
                            <label class="choice"><input type="radio" name="c7" value="B"><span>B. Hourglass contained sand that fell through one container to another</span></label>
                            <label class="choice"><input type="radio" name="c7" value="C"><span>C. Long ago people used simple tools such as the hour glass.</span></label>
                            <label class="choice"><input type="radio" name="c7" value="D"><span>D. Humans have used different objects to tell the time.</span></label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="submit-container">
                    <button type="submit" class="submit-btn">Submit Answers</button>
                    <button type="reset" class="submit-btn" style="background-color: #dc3545; margin-left: 10px;">Clear Form</button>
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