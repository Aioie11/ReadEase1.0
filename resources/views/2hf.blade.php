<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/students.css') }}">
    <script src="{{ asset('js/students.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>ReadEase</title>
</head>
<body>

<div class= "header-container">
<header>
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('pic/RElogo.png') }}" height="90" width="100" alt="ReadEase Logo">
        <div class="title lh-sm"> 
            <p class="fs-3 fw-bold mb-1">ReadEase</p> 
            <p class="fs-5 mb-0">Smarter Reading assessments for Better teaching!</p> 
        </div>
    </div>
</header>


<nav>
        <ul>
            <li><a href="{{ url('/') }}">HOME</a></li>
            <li><a href="{{ url('/about') }}">ABOUT</a></li>

            <li class="dropdown-container">
                <a href="#" id="readingLanguagesBtn">READING LANGUAGES </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-container">
                    <a href="{{ url('/students-eng') }}" >English</a>
                    </li>   

                    <li class="dropdown-container">
                        <a href="{{ url('/students-tag') }}" id="englishBtn">Filipino</a>
                    </li>
                    
                </ul>
            </li>

            <li><a href="{{ url('/students-results') }}">RESULTS</a></li>
        </ul>
    </nav>
</div>

@yield ('content')
   
<div class="footerA row m-0">
            <div class="col-md-4">
                <h2>VISION</h2>
                <p class="pjust">The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.
                   The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.</p>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('pic/slogo.png') }}" height="148" width="150" alt="ReadEase Logo">
                <p class="mt-2">Calingcaguing National Highschool</p>
            </div>

            <div class="col-md-4">
                <form>
                    <input class ="btnsearch" type="text" placeholder="Search.." aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </form><br><br>
            
                <p><img src="{{ asset('pic/home.png') }}" height="35px" weight = "35px"> Calingcaguing, Banug, Philippines, 6519<p>
                <p><img src="{{ asset('pic/envelope.png ') }}" height="35px" weight = "35px"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}" height="35px" weight = "35px"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer>
</body>
</html>