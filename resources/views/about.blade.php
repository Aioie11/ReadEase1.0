<!--about.blade.php-->
@extends('1hf')

@section('content')
    <nav>
        <ul>
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>

            <!-- Reading Languages with Side Dropdown -->
            <li class="dropdown-container">
                <a href="{{ url('/readinglanguage') }}" id="readingLanguagesBtn">Reading Languages ▸</a>
                <ul class="dropdown-menu">
                    <!-- English -->
                <li class="dropdown-container">
                        <a href="#" id="englishBtn">English▸</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-container">  
                                <a href="#">Grade 7▸</a>
                                <ul class="dropdown-menu">
                                <li><a href="{{ url('/english') }}#dao">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 8▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 9▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 10▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <!-- Filipino -->
                <li class="dropdown-container">
                        <a href="#" id="englishBtn">Filipino▸</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-container">
                                <a href="#">Grade 7▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/filipino') }}#dao">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 8▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 9▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 10▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
                                    <li><a href="#">Mahugani</a></li>
                                    <li><a href="#">Lawaan</a></li>
                                    <li><a href="#">Narra</a></li>
                                </ul>
                    </li>
                </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <main>
        <div>
            <div class="maincont">
                <div class="p-5 col-md-12">
                    <h3 class = "text-center">Welcome to ReadEase</h3>
                    <p class="pjust">Discover a revolutionary approach to reading assessments designed to enhance teaching and learning experiences. With ReadEase, educators
                         gain access to smarter tools that not only evaluate reading proficiency but also provide actionable insights tailored for individual learners. Our platform 
                         supports multiple languages, making it accessible to diverse student populations. Join us in transforming literacy education through innovative assessments and
                          comprehensive results that empower teachers to foster better reading skills in their classrooms. Experience the future of reading assessments—where clarity meets 
                          simplicity for optimal teaching outcomes!</p>
                </div>
            </div><br>
@endsection