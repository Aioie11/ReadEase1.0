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
                    
                    
                    <p class = "fw-bold fs-4 mb-0">Pagbibilang ng mga Oras</p>
                    <p class="pjust">Nang magpasya ang mga tao na hatiin ang araw sa dalawampu't apat na oras, 
                        ginamit nila ang mga numerong isa hanggang labindalawa ng dalawang beses. Bilang resulta, may oras na isang o’clock sa 
                        araw at isa pang isang o’clock pagkatapos ng hatingabi. Nagdulot ito ng kalituhan. Kung sinabi ng isang tao na isumite 
                        ang proyekto sa alas-siyete, ibig bang sabihin nito ay alas-siyete ng umaga o ng gabi? Nagbigay ng solusyon ang mga Romano
                         sa problemang ito. Inisip nila na ang tanghali, ang oras kung kailan ang araw ay nasa kanyang pinakamataas na punto, ay 
                         isang mahalagang oras. Tinawag nila itong Meridies at dito nila sinukat ang oras. Tinawag nilang ante meridiem ang umaga, 
                         na nangangahulugang "bago ang tanghali" samantalang ang "pagkatapos ng tanghali" ay tinawag na post meridiem. Ang ante meridiem 
                         ay pinadali sa A.M. habang ang post meridiem ay pinadali sa P.M.</p>
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
                                <p>1. Ano ang ginamit na mga numero upang ipahayag ang oras?</p>
                                <div class="choice"><input type="radio" name="c1" value="A"> A. isa hanggang siyam</div>
                                <div class="choice"><input type="radio" name="c1" value="B"> B. isa hanggang labindalawa</div>
                                <div class="choice"><input type="radio" name="c1" value="C"> C. isa hanggang tatlumpu</div>
                                <div class="choice"><input type="radio" name="c1" value="D"> D. isa hanggang dalawampu't apat</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>2. Bakit nagdulot ng kalituhan na may isang numero na ginagamit ng dalawang beses? </p>
                                <div class="choice"><input type="radio" name="c2" value="A"> A. pagkakaiba</div>
                                <div class="choice"><input type="radio" name="c2" value="B"> B. talakayan</div>
                                <div class="choice"><input type="radio" name="c2" value="C"> C. problema</div>
                                <div class="choice"><input type="radio" name="c2" value="D"> D. pagkakamali</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>3. Ano ang ibig sabihin ng mga Romano na nakapagbigay ng solusyon?</p>
                                <div class="choice"><input type="radio" name="c3" value="A"> A. isang sagot sa problema</div>
                                <div class="choice"><input type="radio" name="c3" value="B"> B. mas mahusay na interpretasyon</div>
                                <div class="choice"><input type="radio" name="c3" value="C"> C. bagong set ng mga numer</div>
                                <div class="choice"><input type="radio" name="c3" value="D"> D. ibang orasan</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>4. Ano ang kahulugan ng Meridies?</p>
                                <div class="choice"><input type="radio" name="c4" value="A"> A. pinakamataas na punto</div>
                                <div class="choice"><input type="radio" name="c4" value="B"> B. tanghali</div>
                                <div class="choice"><input type="radio" name="c4" value="C"> C. bago</div>
                                <div class="choice"><input type="radio" name="c4" value="D"> D. liwanag</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>5. Ano ang ibig sabihin ng apex?</p>
                                <div class="choice"><input type="radio" name="c5" value="A"> A. pinakamataas na punto</div>
                                <div class="choice"><input type="radio" name="c5" value="B"> B. pinakamababa na punto</div>
                                <div class="choice"><input type="radio" name="c5" value="C"> C. pinakamalayong punto</div>
                                <div class="choice"><input type="radio" name="c5" value="D"> D. pinakamalapit na punto</div>
                            </div>

                            <div class=" questions text-justify p-3 col-md-12">
                                <p>6. Isang magandang pamagat para sa seleksyon na ito ay _____________.</p>
                                <div class="choice"><input type="radio" name="c6" value="A"> A. Bakit Dalawampu’t Apat na Oras ang Isang Araw </div>
                                <div class="choice"><input type="radio" name="c6" value="B"> B. Bakit Mahalaga ang Tanghali sa mga Romano</div>
                                <div class="choice"><input type="radio" name="c6" value="C"> C. Paano Nagsukat ng Oras ang mga Romano</div>
                                <div class="choice"><input type="radio" name="c6" value="D"> D. Ang Kahulugan ng A.M. at P.M.</div>
                            </div>
                        </div>
                        <br>
                                    <button type="submit">Submit</button>
                                    <button type="reset">Clear Form</button>
                                    <br>
                                             
                    </div>  
                </div><br>
@endsection