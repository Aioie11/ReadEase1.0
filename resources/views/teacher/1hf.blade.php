<!--1hf.blade.php-->
<!DOCTYPE html>
<html lang="en">`
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="{{ asset('js/students.js') }}" defer></script>
    <title>ReadEase</title>
    <style>
        /*css.students.php*/
/*main*/
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
body {
    background: url('{{ asset("pic/bgr.jpg") }}');
    background-color: #e0f0ff;
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

.maincont {
    background-color: rgba(14, 13, 13, 0.5);
    color: white;
    margin-top: 220px; /* Add margin to account for fixed header and nav */
    padding: 20px;
    margin-bottom: 90px;
}


/* Header */
header {
    align-items: center;
    padding: 15px 30px;
    background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo {
    width: 50px;
    margin-right: 10px;
}

.title h1 {
    font-size: 24px;
}

.title p {
    font-size: 14px;
}


/* Navigation */
nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background-color: #0032A0;
    position: fixed;
    top: 120px;
    left: 0;
    right: 0;
    z-index: 999;
}

nav ul li {
    position: relative;
    margin: 0 20px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    padding: 10px;
}

nav ul li:hover > a {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
}

/* Dropdown Container */
.dropdown-container {
    position: relative;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 0;
    left: 100%;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 165px;
    z-index: 1;
}

.dropdown-menu a {
    display: block;
    color: #003366;
    padding: 5px;
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}

/*footer*/
.footerA{
    padding: 40px 20px;
    color: white;
    background-color:  #0032A0;
}

.footerSL{
    align-items: center;
}

footer{
    text-align: center;
    background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);
    color: black;
    padding: 10px 0;
}

.btnsearch{
    border: none;
    padding: 5.8px 15px;
    border-radius: 10px;
    width: 70%;
}

</style>
</head>
<body>

<header>
<div class="d-flex align-items-center gap-2">
        <img src="{{ asset('pic/logo .png') }}" height="90" width="100" alt="ReadEase Logo">
        <div class="title lh-sm"> 
            <p class="fs-3 fw-bold mb-1">ReadEase</p> 
            <p class="fs-5 mb-0">Smarter Reading assessments for Better teaching!</p> 
        </div>
    </div>
</header>

<nav>
    <ul>
        <li><a href="{{ route('teacher.dashboard') }}">Home</a></li>
        <li><a href="{{ route('teacher.about') }}">About</a></li>
        <li class="dropdown-container">
            <a href="{{ route('teacher.readinglanguage') }}" id="readingLanguagesBtn">Reading Languages ▸</a>
            <ul class="dropdown-menu">
                <!-- English -->
                <li class="dropdown-container">
                    <a href="#" id="englishBtn">English▸</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-container">  
                            <a href="#">Grade 7▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('teacher.viewreports') }}?section=narra">Narra</a></li>
                                <li><a href="{{ route('teacher.viewreports') }}?section=mahugani">Mahugani</a></li>
                                <li><a href="{{ route('teacher.viewreports') }}?section=lawaan">Lawaan</a></li>
                                <li><a href="{{ route('teacher.viewreports') }}?section=dao">Dao</a></li>
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
                    <a href="#" id="filipinoBtn">Filipino▸</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-container">
                            <a href="#">Grade 7▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('teacher.viewreports') }}?section=dao&language=filipino">Dao</a></li>
                                <li><a href="{{ route('teacher.viewreports') }}?section=mahugani&language=filipino">Mahugani</a></li>
                                <li><a href="{{ route('teacher.viewreports') }}?section=lawaan&language=filipino">Lawaan</a></li>
                                <li><a href="{{ route('teacher.viewreports') }}?section=narra&language=filipino">Narra</a></li>
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
                </form><br>
            
                <p><img src="{{ asset('pic/location.png') }}" height="35px" weight = "35px"> Calingcaguing, Banug, Philippines, 6519<p>
                <p><img src="{{ asset('pic/mail.png ') }}" height="35px" weight = "35px"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}" height="35px" weight = "35px"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer>
</body>
</html>