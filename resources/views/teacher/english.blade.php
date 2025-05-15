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

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
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
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav ul li:hover > a {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 200px;
            z-index: 1000;
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .dropdown-menu a {
            color: #333;
            padding: 10px 20px;
            display: block;
            transition: all 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f0f7ff;
            color: #0032A0;
            transform: translateX(5px);
        }

        .hero {
            padding: 30px;
        }

        .hero .content {
            background: white;
            padding: 40px;
            max-width: 1500px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .hero h2 {
            font-size: 28px;
            color: #0032A0;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .hero p {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 25px;
            text-align: justify;
        }

        .input-group {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 50px;
            overflow: hidden;
        }

        .input-group input[type="text"] {
            border: 1px solid #e0e0e0;
            padding: 12px 20px;
            font-size: 15px;
        }

        .input-group .btn {
            padding: 12px 25px;
            background: #0032A0;
            border: none;
            transition: all 0.3s ease;
        }

        .input-group .btn:hover {
            background: #002080;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #28a745;
            padding: 12px 25px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .student-list {
            margin-top: 30px;
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
        }

        .student-list h3 {
            color: #0032A0;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .student {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .student:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .student .controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .student .controls button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .student .controls button:hover {
            transform: translateY(-2px);
        }

        .start { 
            background-color: #4CAF50; 
            color: white;
        }
        .stop { 
            background-color: #2196F3; 
            color: white;
        }
        .reset { 
            background-color: #f44336; 
            color: white;
        }

        .feedback {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .feedback label {
            display: block;
            font-weight: 600;
            color: #0032A0;
            margin-bottom: 10px;
        }

        .feedback textarea {
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px;
            resize: vertical;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .feedback textarea:focus {
            border-color: #0032A0;
            box-shadow: 0 0 0 2px rgba(0, 50, 160, 0.1);
            outline: none;
        }

        .submit-feedback {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #0032A0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-feedback:hover {
            background-color: #002080;
            transform: translateY(-2px);
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

        /* Animation for student list */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .student {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsive design improvements */
        @media (max-width: 768px) {
            .hero .content {
                padding: 20px;
            }

            .student {
                flex-direction: column;
                gap: 15px;
            }

            .student .controls {
                flex-wrap: wrap;
                justify-content: center;
            }
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
        <li class="dropdown-container">
        <a href="{{ route('teacher.readinglanguage') }}" id="readingLanguagesBtn">Reading Languages ▸</a>
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
        <li><a href="{{ route('teacher.viewreports') }}">View Reports</a></li>
    </ul>
</nav>

<section class="hero">
    <div class="content">
        <h3 class="mb-4" style="color: #0032A0;">Grade 7 Students : SECTION NARRA</h3>
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div class="input-group" style="max-width: 400px;">
                <input type="text" id="searchInput" class="form-control rounded-start-pill" placeholder="Find Student">
                <button class="btn btn-primary rounded-end-pill" onclick="searchStudent()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <a href="{{ route('teacher.viewreports') }}" class="btn btn-success rounded-pill" style="margin-left: auto; padding: 10px 10px;">
                <i class="fas fa-file-alt"></i> View Reports
            </a>
        </div>

        <a id="dao"></a>
        <h2>Online Reading Passage</h2>
        <p>Telling Time Humans have used different objects to tell time. In the beginning, they used an hourglass.
           This is a cylindrical glass with a narrow center which allows sand to flow from its upper to its lower 
           portion. Once all the sand has trickled to the lower portion, one knows that an hour has passed. Using 
           the same idea, water clocks were constructed to measure time by having water flow through a narrow passage 
           from one container to another. On the other hand, sundials allowed people to estimate an hour by looking at 
           the position of the shadow cast by the sun on a plate. At night, people measured time by checking the alignment 
           of the stars in the sky. None of these were accurate, though. The clock was the first accurate instrument or telling time.</p>

            <div id="studentContainer">
                <!-- Student information will be displayed here -->
            </div>
            <div class="feedback">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" rows="3" placeholder="Write feedback here..."></textarea>
                <button class="submit-feedback">Submit Feedback</button>
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
            
            // Ensure readingData has the necessary fields
            if (!readingData[name]) {
                readingData[name] = {
                    student_name: name,
                    total_words: 70, // Default value
                    total_questions: 6, // Default value
                    correct_answers: 0 // Default value
                };
            }
            
            // Store the reading time in seconds
            readingData[name].reading_time = Math.floor(timers[name].elapsedTime / 1000);
            
            // Debug log
            console.log('Stopping timer for:', name);
            console.log('Current reading data:', readingData[name]);
            
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
            // Calculate reading speed (words per minute)
            const readingSpeed = Math.round((readingData[name].total_words / (readingData[name].reading_time / 60)));
            
            // Calculate word recognition percentage
            const wordRecognition = Math.round((readingData[name].total_words - readingData[name].miscues) / readingData[name].total_words * 100);
            
            // Determine word reading level
            let wordLabel = 'Frustration';
            if (wordRecognition >= 98) {
                wordLabel = 'Independent';
            } else if (wordRecognition >= 90) {
                wordLabel = 'Instructional';
            }

            // Determine comprehension level
            let comprehension = 'Frustration';
            const comprehensionScore = (readingData[name].correct_answers / readingData[name].total_questions) * 100;
            if (comprehensionScore >= 90) {
                comprehension = 'Independent';
            } else if (comprehensionScore >= 70) {
                comprehension = 'Instructional';
            }

            const dataToSend = {
                ...readingData[name],
                reading_speed: `${readingSpeed} WPM`,
                word_recognition: wordRecognition,
                word_label: wordLabel,
                comprehension: comprehension,
                section: 'narra',
                language: 'english'
            };

            // Debug log
            console.log('Sending data:', dataToSend);

            fetch('/teacher/update-reading', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(dataToSend)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // Show success message
                alert('Reading data saved successfully!');
                // Redirect to reports page
                window.location.href = '/teacher/viewreports?section=narra&language=english';
            })
            .catch((error) => {
                console.error('Error details:', error);
                alert('Error saving reading data: ' + error.message);
            });
        } else {
            console.error('No reading data available for student:', name);
            alert('No reading data available to save. Please ensure you have started the timer and entered miscues.');
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

        fetch(`/teacher/search-student?query=${encodeURIComponent(searchTerm)}&section=Narra`, {
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
                studentContainer.innerHTML = '<p class="text-warning">No students found in Narra section with that name</p>';
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
