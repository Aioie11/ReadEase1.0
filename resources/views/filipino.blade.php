<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/Students.css') }}"> -->
    <title>Students</title>
</head>
    <style>
{

    margin: 0;
    padding: 0;
    box-sizing: border-box;
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

/* Hero Section */
.hero {
            padding: 20px 20px;
            position: relative;
        }

        .hero .content {
            background: rgba(67, 77, 170, 0.5);
            padding: 50px;
            max-width: 1500px;
            margin: auto;
            border-radius: 10px;
        }

        .hero h2 {
            font-size: 24px;
            margin-top: -3%;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .content {
            padding: 20px;
        }

        .content input[type=text] {
            padding: 6px;
            border-radius: 20px;
            margin-top: 8px;
            margin-right: 10px;
            font-size: 15px;
        }

        .student-list {
            margin-top: 20px;
        }
        .student {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f0f8ff;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .student .controls button {
            margin-left: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .student a {
            margin-left: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #FFC107; color: #fff;
        }


        .start { background-color: #4CAF50; color: #fff; }
        .stop { background-color: #2196F3; color: #fff; }
        .reset { background-color: #f44336; color: #fff; }
        .question { background-color: #FFC107; color: #fff; }

        .feedback {
            margin-top: 10px;
        }

        .feedback label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .feedback textarea {
            width: 100%;
            border-radius: 8px;
            padding: 8px;
            resize: vertical;
        }

        .submit-feedback {
            margin-top: 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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


.passage {
    background-color: #9DD4F0;
    color: black; 
  }

.questions {
    background-color: #5EC0F2;
    color: black; 
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
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>

            <!-- Reading Languages with Side Dropdown -->
            <li class="dropdown-container">
                <a href="#" id="readingLanguagesBtn">Reading Languages ▸</a>
                <ul class="dropdown-menu">
                    <!-- English -->
                <li class="dropdown-container">
                        <a href="#" id="englishBtn">English▸</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-container">
                                <a href="#">Grade 7▸</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dao</a></li>
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
                                    <li><a href="filipino.php#dao">Dao</a></li>
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


    <section class="hero">
    <div class="content">
    <a id="dao"></a> <!-- Anchor Tag for Dao Section -->
            <h2>TALATA SA PAGBASA</h2>
            <p>Narito ang isang kwento tungkol sa isang batang babae na nagngangalang Maria.
               Sa isang maliit na bayan sa tabi ng bundok, nakatira siya sa kanyang lola at lolo.
               Bawat umaga, masaya niyang tinutulungan ang kanyang mga lolo at lola sa mga gawain sa bahay,
               tulad ng paghuhugas ng pinggan at pag-aalaga sa mga hayop. Laking tuwa ni Maria kapag nakikita
               niyang maligaya ang kanyang mga lolo at lola. Mahilig din siya sa pagbabasa ng mga aklat, lalo na
               ang mga kuwento tungkol sa kalikasan. Pinapangarap niyang maging isang guro balang araw upang matulungan
               ang mga batang katulad niya na nais matuto at magkaroon ng magandang kinabukasan.</p>
            <input type="text" placeholder="Find Student"> 
            <button>View Reports</button>
            
            <div class="student-list">
                <h3>Grade 7 Students : SECTION NARRA</h3>
                <div class="student">
                    1. Albiniga, Alexander V.A.
                    <div class="controls">
                        <button class="start">Start Time</button>
                        <button class="stop">Stop Time</button>
                        <button class="reset">Reset Time</button>
                        </div>
                </div>
                <div class="feedback">
                        <label for="feedback-Alexander">Feedback:</label>
                        <textarea id="feedback-Alexander" rows="3" placeholder="Write feedback here..."></textarea>
                        <button class="submit-feedback">Submit Feedback</button>
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
                </form><br><br>
            
                <p><img src="{{ asset('pic/location.png') }}" height="25px" weight = "25px"> Calingcaguing, Banug, Philippines, 6519<p>
                <p><img src="{{ asset('pic/mail.png ') }}" height="25px" weight = "25px"> calingcaguingnationalhighschool@gmail.com<p>
                <p><img src="{{ asset('pic/phone.png') }}" height="25px" weight = "25px"> (053)-545-0025<p>
            </div>
        </div>
    </main>

    <footer>
        <p class ="fw-bold mb-0" class="copyright">&copy; 2025 ReadEase | All Rights Reserved</p>
    </footer>

    <script>
        // Timer Object to Track Multiple Timers
    const timers = {};

// Function to Start or Resume Timer
function startTimer(studentName, displayElement) {
    if (!timers[studentName]) {
        // Start new timer if none exists
        timers[studentName] = {
            elapsedTime: 0,   // Tracks paused time
            startTime: Date.now(),  
            interval: setInterval(() => {
                const elapsedTime = Date.now() - timers[studentName].startTime + timers[studentName].elapsedTime;
                displayElement.textContent = formatTime(elapsedTime);
            }, 1000)
        };
    } else if (!timers[studentName].interval) {
        // Resume timer if stopped
        timers[studentName].startTime = Date.now();
        timers[studentName].interval = setInterval(() => {
            const elapsedTime = Date.now() - timers[studentName].startTime + timers[studentName].elapsedTime;
            displayElement.textContent = formatTime(elapsedTime);
        }, 1000);
    }
}

// Function to Stop Timer
function stopTimer(studentName) {
    if (timers[studentName] && timers[studentName].interval) {
        clearInterval(timers[studentName].interval);
        timers[studentName].interval = null; // Mark as paused
        // Save elapsed time for resuming later
        timers[studentName].elapsedTime += Date.now() - timers[studentName].startTime;
    }
}

// Function to Reset Timer
function resetTimer(studentName, displayElement) {
    if (timers[studentName]) {
        clearInterval(timers[studentName].interval);
        delete timers[studentName];
    }
    displayElement.textContent = "00:00:00";
}

// Format Time into hh:mm:ss
function formatTime(ms) {
    const totalSeconds = Math.floor(ms / 1000);
    const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
    const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
    const seconds = String(totalSeconds % 60).padStart(2, '0');
    return `${hours}:${minutes}:${seconds}`;
}

// Attach event listeners to each student's controls
document.querySelectorAll('.student').forEach(student => {
    const studentName = student.textContent.trim().split('.')[1].trim();
    const displayElement = document.createElement('span');
    displayElement.textContent = "00:00:00";
    displayElement.style.marginRight = "15px";
    displayElement.style.fontWeight = "bold";

    // Insert Timer Display Before Start Button
    const controlsDiv = student.querySelector('.controls');
    controlsDiv.insertBefore(displayElement, controlsDiv.querySelector('.start'));

    student.querySelector('.start').addEventListener('click', () => startTimer(studentName, displayElement));
    student.querySelector('.stop').addEventListener('click', () => stopTimer(studentName));
    student.querySelector('.reset').addEventListener('click', () => resetTimer(studentName, displayElement));
});
        // // Dropdown logic for main and submenus
        // document.querySelectorAll('.dropdown-container > a').forEach(link => {
        //     link.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         const submenu = this.nextElementSibling;
        //         submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        //     });
        // });
    </script>
</body>
</html>
</html>
