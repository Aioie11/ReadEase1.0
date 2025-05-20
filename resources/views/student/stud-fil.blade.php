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
            
            <form action="{{ url('student/add') }}" method="post">
            {{ csrf_field() }}
            <div class="grade-card">
                <h2><i class="fas fa-book-open"></i> Reading Passage</h2>
                
                <!-- Reading Passage -->
                <div class="passage-container">
                    <h3>Pagbibilang ng mga Oras</h3>
                    <div class="passage">
                        <p>Nang magpasya ang mga tao na hatiin ang araw sa dalawampu't apat na oras, 
                        ginamit nila ang mga numerong isa hanggang labindalawa ng dalawang beses. Bilang resulta, may oras na isang o'clock sa 
                        araw at isa pang isang o'clock pagkatapos ng hatingabi. Nagdulot ito ng kalituhan. Kung sinabi ng isang tao na isumite 
                        ang proyekto sa alas-siyete, ibig bang sabihin nito ay alas-siyete ng umaga o ng gabi? Nagbigay ng solusyon ang mga Romano
                         sa problemang ito. Inisip nila na ang tanghali, ang oras kung kailan ang araw ay nasa kanyang pinakamataas na punto, ay 
                         isang mahalagang oras. Tinawag nila itong Meridies at dito nila sinukat ang oras. Tinawag nilang ante meridiem ang umaga, 
                         na nangangahulugang "bago ang tanghali" samantalang ang "pagkatapos ng tanghali" ay tinawag na post meridiem. Ang ante meridiem 
                         ay pinadali sa A.M. habang ang post meridiem ay pinadali sa P.M.</p>
                    </div>
                </div>

                <!-- Questions -->
                <div class="questions-container">
                    <h3>Questions</h3>
                    
                    <!-- Question 1 -->
                    <div class="question-card">
                        <p class="question">1. Ano ang ginamit na mga numero upang ipahayag ang oras?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c1" value="A"><span>A. isa hanggang siyam</span></label>
                            <label class="choice"><input type="radio" name="c1" value="B"><span>B. isa hanggang labindalawa</span></label>
                            <label class="choice"><input type="radio" name="c1" value="C"><span>C. isa hanggang tatlumpu</span></label>
                            <label class="choice"><input type="radio" name="c1" value="D"><span>D. isa hanggang dalawampu't apat</span></label>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="question-card">
                        <p class="question">2. Bakit nagdulot ng kalituhan na may isang numero na ginagamit ng dalawang beses?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c2" value="A"><span>A. pagkakaiba</span></label>
                            <label class="choice"><input type="radio" name="c2" value="B"><span>B. talakayan</span></label>
                            <label class="choice"><input type="radio" name="c2" value="C"><span>C. problema</span></label>
                            <label class="choice"><input type="radio" name="c2" value="D"><span>D. pagkakamali</span></label>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="question-card">
                        <p class="question">3. Ano ang ibig sabihin ng mga Romano na nakapagbigay ng solusyon?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c3" value="A"><span>A. isang sagot sa problema</span></label>
                            <label class="choice"><input type="radio" name="c3" value="B"><span>B. mas mahusay na interpretasyon</span></label>
                            <label class="choice"><input type="radio" name="c3" value="C"><span>C. bagong set ng mga numero</span></label>
                            <label class="choice"><input type="radio" name="c3" value="D"><span>D. ibang orasan</span></label>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="question-card">
                        <p class="question">4. Ano ang kahulugan ng Meridies?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c4" value="A"><span>A. pinakamataas na punto</span></label>
                            <label class="choice"><input type="radio" name="c4" value="B"><span>B. tanghali</span></label>
                            <label class="choice"><input type="radio" name="c4" value="C"><span>C. bago</span></label>
                            <label class="choice"><input type="radio" name="c4" value="D"><span>D. liwanag</span></label>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="question-card">
                        <p class="question">5. Ano ang ibig sabihin ng apex?</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c5" value="A"><span>A. pinakamataas na punto</span></label>
                            <label class="choice"><input type="radio" name="c5" value="B"><span>B. pinakamababa na punto</span></label>
                            <label class="choice"><input type="radio" name="c5" value="C"><span>C. pinakamalayong punto</span></label>
                            <label class="choice"><input type="radio" name="c5" value="D"><span>D. pinakamalapit na punto</span></label>
                        </div>
                    </div>

                    <!-- Question 6 -->
                    <div class="question-card">
                        <p class="question">6. Isang magandang pamagat para sa seleksyon na ito ay _____________.</p>
                        <div class="choices">
                            <label class="choice"><input type="radio" name="c6" value="A"><span>A. Bakit Dalawampu't Apat na Oras ang Isang Araw</span></label>
                            <label class="choice"><input type="radio" name="c6" value="B"><span>B. Bakit Mahalaga ang Tanghali sa mga Romano</span></label>
                            <label class="choice"><input type="radio" name="c6" value="C"><span>C. Paano Nagsukat ng Oras ang mga Romano</span></label>
                            <label class="choice"><input type="radio" name="c6" value="D"><span>D. Ang Kahulugan ng A.M. at P.M.</span></label>
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