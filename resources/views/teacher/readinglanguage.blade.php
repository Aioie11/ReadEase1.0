<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>ReadEase</title>
    <style>
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

  /* Header */
header {
    align-items: center;
    padding: 15px 30px;
    background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);
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

/* Nested dropdowns open beside their parent */
.dropdown-menu {
    display: none;
    position: absolute;
    left: 100%;
    top: 0;
    background-color: white;
    padding: 0;
    margin: 0;
    list-style: none;
    border: 1px solid #ddd;
    border-radius: 4px;
    min-width: 160px;
    z-index: 1000;
}

.dropdown-container {
    position: relative;
}

.dropdown-menu a {
    color: #003366;
    padding: 8px 12px;
    display: block;
    text-decoration: none;
    white-space: nowrap;
}

.dropdown-menu a:hover {
    background-color: #f2f2f2;
}


        /* Hero Section */
        .hero {
            color: white;
            text-align: center;
            padding: 110px 30px;
            min-height: 400px;
            display: flex;
            justify-content: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
        }

        .hero .overlay {
            background: rgba(0, 0, 0, 0.5);
            padding: 50px;
            max-width: 900px;
            margin: auto;
            border-radius: 10px;
        }

        .hero h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 18px;
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

            <!-- Reading Languages with Side Dropdown -->
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
                                    <li><a href="{{ route('teacher.english') }}#narra">Narra</a></li>
                                    <li><a href="{{ route('teacher.english-mahugani') }}#mahugani">Mahugani</a></li>
                                    <li><a href="{{ route('teacher.english-lawaan') }}#lawaan">Lawaan</a></li>
                                    <li><a href="{{ route('teacher.english-dao') }}#dao">Dao</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 8▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Avocado</a></li>
                                    <li><a href="#">Guava</a></li>
                                    <li><a href="#">Duhat</a></li>
                                    <li><a href="#">Mango</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 9▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Gold</a></li>
                                    <li><a href="#">Silver</a></li>
                                    <li><a href="#">Zinc</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 10▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Galileo</a></li>
                                    <li><a href="#">Newton</a></li>
                                    <li><a href="#">Edison</a></li>
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
                                    <li><a href="{{ route('teacher.filipino') }}#narra">Narra</a></li>
                                    <li><a href="{{ route('teacher.filipino-mahugani') }}#mahugani">Mahugani</a></li>
                                    <li><a href="{{ route('teacher.filipino-lawaan') }}#lawaan">Lawaan</a></li>
                                    <li><a href="{{ route('teacher.filipino-dao') }}#dao">Dao</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 8▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Avocado</a></li>
                                    <li><a href="#">Guava</a></li>
                                    <li><a href="#">Duhat</a></li>
                                    <li><a href="#">Mango</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 9▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Gold</a></li>
                                    <li><a href="#">Silver</a></li>
                                    <li><a href="#">Zinc</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-container">
                                <a href="#">Grade 10▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Galileo</a></li>
                                    <li><a href="#">Newton</a></li>
                                    <li><a href="#">Edison</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <main>
        <section class="hero">
            <div class="overlay">
                <h2>Mission</h2>
                <p>This is created to provide classroom teachers a tool for measuring and describing reading 
                   performance. It is an assessment tool composed of graded passages designed to determine a student's 
                   reading level. The Phil-IRI only provides an approximation of the learner's abilities.</p>
            </div>
        </section>


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

            <div class="col-md-4 foot">
                <form>
                    <input class ="btnsearch" type="text" placeholder="Search.." aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </form><br>
            
                <p><img src="{{ asset('pic/location.png') }}" height="25px" weight = "25px"> Calingcaguing, Banug, Philippines, 6519<p>
                <p><img src="{{ asset('pic/mail.png ') }}" height="25px" weight = "25px"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}" height="25px" weight = "25px"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer>

        <!-- <div class="vision-contact">
            <div class="vision">
                <h2>VISION</h2>
                <p>The Philippine Informal Reading Inventory (Phil-IRI) is an initiative of the Bureau of Learning Delivery,
                   Department of Education that directly addresses its thrust to make every Filipino child a reader.</p>
            </div>

            <div class="calingcaguing"><img src="school.png" alt="SkimVett Logo" class="logo"></div> 

            <div class="contact-info">
                <input type="text" placeholder="Search..">
                <p><img src="{{ asset('pic/location.png') }}" height="50px" weight = "50px"> Calingcaguing, Barugo, Philippines, 6519<p>
                <p><img src="{{ asset('pic/mail.png ') }}"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer> -->
    <script>
    // Handle dropdown toggle logic
    document.querySelectorAll('nav .dropdown-container > a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const menu = this.nextElementSibling;

            // Toggle this menu only
            if (menu) {
                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
            }

            // Optional: close other open dropdowns at the same level
            const siblings = this.parentElement.parentElement.querySelectorAll('.dropdown-menu');
            siblings.forEach(sibling => {
                if (sibling !== menu) sibling.style.display = 'none';
            });
        });
    });

    // Close dropdowns when clicking outside
    window.addEventListener('click', function (e) {
        if (!e.target.closest('nav')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.style.display = 'none');
        }
    });
</script>

</body>
</html>
