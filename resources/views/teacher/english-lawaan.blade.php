<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Students</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        .dropdown-container:hover > .dropdown-menu {
            display: block;
        }

        .hero {
            padding: 20px;
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
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .input-group input[type="text"] {
    border-right: none;
}

.input-group .btn {
    border-left: none;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
    font-size: 14px;
    padding: 6px 15px;
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
            background-color: #FFC107;
            color: #fff;
            border-radius: 5px;
        }

        .start { background-color: #4CAF50; color: #fff; }
        .stop { background-color: #2196F3; color: #fff; }
        .reset { background-color: #f44336; color: #fff; }

        .feedback {
            margin-top: 10px;
        }

        .feedback label {
            display: block;
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
        }

        .footerA {
            padding: 40px 20px;
            color: white;
            background-color: #0032A0;
        }

        footer {
            text-align: center;
            background: linear-gradient(to right, #38B6FF, white 50%, #38B6FF);
            color: black;
            padding: 10px 0;
        }

        .btnsearch {
            border: none;
            padding: 5.8px 15px;
            border-radius: 10px;
            width: 70%;
        }

        .passage { background-color: #9DD4F0; color: black; }
        .questions { background-color: #5EC0F2; color: black; }
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
            <a href="#">Reading Languages ▸</a>
            <ul class="dropdown-menu">
                <li class="dropdown-container">
                    <a href="#">English ▸</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-container">
                            <a href="#">Grade 7 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-container">
                            <a href="#">Grade 8 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-container">
                            <a href="#">Grade 9 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-container">
                            <a href="#">Grade 10 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="dropdown-container">
                    <a href="#">Filipino ▸</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-container">
                            <a href="#">Grade 7 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="filipino.php#dao">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-container">
                            <a href="#">Grade 8 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-container">
                            <a href="#">Grade 9 ▸</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Dao</a></li>
                                <li><a href="#">Mahugani</a></li>
                                <li><a href="#">Lawaan</a></li>
                                <li><a href="#">Narra</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-container">
                            <a href="#">Grade 10 ▸</a>
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
        <a id="dao"></a>
        <h2>Online Reading Passage</h2>
        <p>Telling Time Humans have used different objects to tell time. In the beginning, they used an hourglass.
           This is a cylindrical glass with a narrow center which allows sand to flow from its upper to its lower 
           portion. Once all the sand has trickled to the lower portion, one knows that an hour has passed. Using 
           the same idea, water clocks were constructed to measure time by having water flow through a narrow passage 
           from one container to another. On the other hand, sundials allowed people to estimate an hour by looking at 
           the position of the shadow cast by the sun on a plate. At night, people measured time by checking the alignment 
           of the stars in the sky. None of these were accurate, though. The clock was the first accurate instrument or telling time.</p>
           <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
    <div class="input-group" style="max-width: 400px;">
        <input type="text" id="searchInput" class="form-control rounded-start-pill" placeholder="Find Student">
        <button class="btn btn-primary rounded-end-pill" onclick="searchStudent()">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <a href="{{ route('teacher.viewreports') }}" class="btn btn-success rounded-pill ms-2">
        <i class="fas fa-file-alt"></i> View Reports
    </a>
</div>

        <div class="student-list">
            <h3>Grade 7 Students : SECTION Lawaan</h3>
            <div id="studentContainer">
                <!-- Student information will be displayed here -->
            </div>
            <div class="feedback">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" rows="3" placeholder="Write feedback here..."></textarea>
                <button class="submit-feedback">Submit Feedback</button>
            </div>
        </div>
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
    <div class="col-md-4 text-center">
        <img src="{{ asset('pic/slogo.png') }}" height="148" width="150" alt="ReadEase Logo">
        <p class="mt-2">Calingcaguing National Highschool</p>
    </div>
    <div class="col-md-4 foot">
        <form>
            <input class="btnsearch" type="text" placeholder="Search..">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form><br>
        <p><img src="{{ asset('pic/location.png') }}" height="25px"> Calingcaguing, Banug, Philippines</p>
        <p><img src="{{ asset('pic/mail.png') }}" height="25px"> calingcaguingnationalhighschool@gmail.com</p>
        <p><img src="{{ asset('pic/phone.png') }}" height="25px"> (053)-545-0025</p>
    </div>
</div>

<footer>
    <p class="fw-bold mb-0">&copy; 2025 ReadEase | All Rights Reserved</p>
</footer>

<script>
    // Timer logic
    const timers = {};
    const readingData = {};

    function startTimer(name, display) {
        if (!timers[name]) {
            timers[name] = {
                elapsedTime: 0,
                startTime: Date.now(),
                interval: setInterval(() => {
                    const elapsed = Date.now() - timers[name].startTime + timers[name].elapsedTime;
                    display.textContent = formatTime(elapsed);
                }, 1000)
            };
        } else if (!timers[name].interval) {
            timers[name].startTime = Date.now();
            timers[name].interval = setInterval(() => {
                const elapsed = Date.now() - timers[name].startTime + timers[name].elapsedTime;
                display.textContent = formatTime(elapsed);
            }, 1000);
        }
    }

    function stopTimer(name) {
        if (timers[name]?.interval) {
            clearInterval(timers[name].interval);
            timers[name].interval = null;
            timers[name].elapsedTime += Date.now() - timers[name].startTime;
            // Store the reading time in seconds
            readingData[name] = {
                ...readingData[name],
                reading_time: Math.floor(timers[name].elapsedTime / 1000)
            };
            submitReadingData(name);
        }
    }

    function resetTimer(name, display) {
        clearInterval(timers[name]?.interval);
        delete timers[name];
        display.textContent = "00:00:00";
    }

    function formatTime(ms) {
        const total = Math.floor(ms / 1000);
        const h = String(Math.floor(total / 3600)).padStart(2, '0');
        const m = String(Math.floor((total % 3600) / 60)).padStart(2, '0');
        const s = String(total % 60).padStart(2, '0');
        return `${h}:${m}:${s}`;
    }

    function handleMiscues(name, input) {
        input.addEventListener('input', function() {
            const value = parseInt(this.value) || 0;
            if (value >= 0) {
                readingData[name] = {
                    ...readingData[name],
                    miscues: value,
                    student_name: name,
                    total_words: 70, // Assuming 70 words in the passage
                    correct_answers: 4, // Default value, can be changed
                    total_questions: 6 // Default value, can be changed
                };
            }
        });
    }

    function submitReadingData(name) {
        if (readingData[name]) {
            fetch('/update-reading', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(readingData[name])
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Redirect to reports page after successful submission
                window.location.href = '/reports';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    }

    document.querySelectorAll('.student').forEach(student => {
        const name = student.textContent.trim().split('.')[1].trim();
        const display = document.createElement('span');
        display.textContent = "00:00:00";
        display.style.marginRight = "15px";
        display.style.fontWeight = "bold";
        const controls = student.querySelector('.controls');
        controls.insertBefore(display, controls.querySelector('.start'));
        
        const miscuesInput = student.querySelector('input[type="number"]');
        handleMiscues(name, miscuesInput);
        
        student.querySelector('.start').addEventListener('click', () => startTimer(name, display));
        student.querySelector('.stop').addEventListener('click', () => stopTimer(name));
        student.querySelector('.reset').addEventListener('click', () => resetTimer(name, display));
    });

    function searchStudent() {
        const searchInput = document.getElementById('searchInput');
        const searchTerm = searchInput.value.trim();
        const studentContainer = document.getElementById('studentContainer');

        if (!searchTerm) {
            studentContainer.innerHTML = '<p class="text-danger">Please enter a student name to search</p>';
            return;
        }

        studentContainer.innerHTML = '<p>Searching...</p>';

        fetch(`/teacher/search-student?query=${encodeURIComponent(searchTerm)}&section=Lawaan`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(students => {
            if (students && students.length > 0) {
                let html = '';
                students.forEach(student => {
                    html += `
                        <div class="student">
                            <div class="student-info">
                                <h4>${student.name}</h4>
                                <p>Section: ${student.section}</p>
                                <p>Grade Level: ${student.grade_level}</p>
                            </div>
                            <div class="controls">
                                <input type="number" placeholder="Miscues" style="width: 100px; margin-right: 10px; padding: 5px; border-radius: 5px;">
                                <button class="start">Start Time</button>
                                <button class="stop">Stop Time</button>
                                <button class="reset">Reset Time</button>
                            </div>
                        </div>
                    `;
                });
                studentContainer.innerHTML = html;

                // Re-attach timer event listeners for each student
                document.querySelectorAll('.student').forEach(studentDiv => {
                    const name = studentDiv.querySelector('h4').textContent;
                    const display = document.createElement('span');
                    display.textContent = "00:00:00";
                    display.style.marginRight = "15px";
                    display.style.fontWeight = "bold";
                    const controls = studentDiv.querySelector('.controls');
                    controls.insertBefore(display, controls.querySelector('.start'));

                    const miscuesInput = studentDiv.querySelector('input[type="number"]');
                    handleMiscues(name, miscuesInput);

                    studentDiv.querySelector('.start').addEventListener('click', () => startTimer(name, display));
                    studentDiv.querySelector('.stop').addEventListener('click', () => stopTimer(name));
                    studentDiv.querySelector('.reset').addEventListener('click', () => resetTimer(name, display));
                });
            } else {
                studentContainer.innerHTML = '<p class="text-warning">No students found in Lawaan section with that name</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            studentContainer.innerHTML = '<p class="text-danger">Error searching for students. Please try again.</p>';
        });
    }

    // Add event listener for Enter key
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchStudent();
        }
    });
</script>

</body>
</html>
