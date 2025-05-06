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
    
    <div class="maincont">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <div class="hero-content d-flex flex-column align-items-center">
                        <img src="{{ asset('pic/logo .png') }}" class="mb-4" height="90" width="100" alt="ReadEase Logo">
                        <h1 class="mb-3">SkimVett</h1>
                        <p class="mb-2">Smart Reading assessments for Better teaching!</p>
                        <p class="mb-0">This helps learners to be evaluated on how they learn from reading to answering question and this tool helps teacher to navigate easily.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
@endsection