<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReadEase - Assessment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #0E61BA;
            --primary-light: #3b82f6;
            --secondary: #6CC24A;
            --accent: #F9A602;
            --danger: #D11149;
            --neutral: #F4F4F4;
            --neutral-light: #fff;
            --text: #232323;
            --text-light: #4b5563;
            --shadow-md: 0 4px 6px rgba(0,0,0,0.08);
            --radius: 18px;
            --transition: all 0.2s cubic-bezier(.4,0,.2,1);
        }
        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--neutral); color: var(--text); margin: 0; }
        header {
            background: var(--primary);
            color: var(--neutral-light);
            padding: 1rem 0;
            box-shadow: var(--shadow-md);
        }
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo { font-size: 1.5rem; font-weight: 700; color: var(--neutral-light); text-decoration: none; }
        nav { display: flex; gap: 2rem; }
        nav a { color: var(--neutral-light); text-decoration: none; font-weight: 500; padding: 0.5rem 1rem; border-radius: 8px; transition: var(--transition); }
        nav a:hover, nav a.active { background: var(--primary-light); }
        .dropdown { position: relative; }
        .dropdown-content { display: none; position: absolute; background: var(--neutral-light); color: var(--text); min-width: 160px; box-shadow: var(--shadow-md); border-radius: 8px; top: 2.5rem; left: 0; z-index: 10; }
        .dropdown:hover .dropdown-content { display: block; }
        .dropdown-content a { color: var(--text); padding: 0.7rem 1rem; display: block; border-radius: 8px; }
        .dropdown-content a:hover { background: var(--neutral); }
        .dropdown-content a.selected { background: var(--primary-light); color: #fff; }
        .main { max-width: 1100px; margin: 2.5rem auto; padding: 0 1rem; }
        .search-bar { display: flex; align-items: center; background: var(--neutral-light); border-radius: 50px; box-shadow: var(--shadow-md); padding: 0.5rem 1rem; margin-bottom: 2rem; max-width: 400px; }
        .search-bar input { border: none; outline: none; background: transparent; flex: 1; font-size: 1rem; padding: 0.5rem; }
        .search-bar button { background: var(--primary); color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; cursor: pointer; transition: var(--transition); }
        .search-bar button:hover { background: var(--primary-light); }
        .card { background: var(--neutral-light); border-radius: var(--radius); box-shadow: var(--shadow-md); padding: 2rem; margin-bottom: 2rem; }
        .section-title { color: var(--primary); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; }
        .passage { color: var(--text-light); font-size: 1.1rem; margin-bottom: 1.5rem; }
        .student-card { background: var(--neutral-light); border-radius: var(--radius); box-shadow: var(--shadow-md); padding: 1.5rem; margin-bottom: 1rem; display: flex; flex-direction: column; gap: 1rem; }
        .student-header { font-weight: 600; font-size: 1.1rem; color: var(--primary); margin-bottom: 0.2rem; }
        .student-meta { color: var(--text-light); font-size: 0.95rem; margin-bottom: 0.5rem; }
        .assessment-controls { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; }
        .miscues-input { padding: 0.4rem 0.7rem; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem; width: 90px; }
        .timer { font-family: 'Poppins', monospace; font-size: 1.1rem; margin: 0 1rem; }
        .btn { border: none; outline: none; padding: 0.5rem 1.2rem; border-radius: 8px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: var(--transition); margin-right: 0.5rem; }
        .btn.start { background: var(--secondary); color: #fff; }
        .btn.start:hover { background: #4fa13a; }
        .btn.stop { background: var(--primary); color: #fff; }
        .btn.stop:hover { background: var(--primary-light); }
        .btn.reset { background: var(--danger); color: #fff; }
        .btn.reset:hover { background: #a50c36; }
        .back-btn { background: var(--neutral); color: var(--primary); border: 1px solid var(--primary); margin-bottom: 1.5rem; }
        .back-btn:hover { background: var(--primary); color: #fff; }
        @media (max-width: 700px) {
            .main { padding: 0; }
            .card, .student-card { padding: 1rem; }
            .assessment-controls { flex-direction: column; align-items: flex-start; gap: 0.7rem; }
        }
        .card-header-row { display: flex; justify-content: flex-end; align-items: center; margin-bottom: 1rem; }
        .dropdown { position: relative; }
        .dropdown > a { font-weight: 500; color: var(--primary); background: var(--neutral); border-radius: 8px; padding: 0.5rem 1.2rem; text-decoration: none; transition: var(--transition); border: 1px solid var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .dropdown > a:hover { background: var(--primary); color: #fff; }
        .dropdown-content { right: 0; left: auto; min-width: 140px; }
        .dropdown-content a { color: var(--text); }
        .dropdown-content a.selected { background: var(--primary-light); color: #fff; }
        .btn.save {
            background: var(--secondary);
            color: #fff;
            margin-left: 1rem;
        }
        .btn.save:hover {
            background: #4fa13a;
        }
        .btn.save:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="#" class="logo">ReadEase</a>
            <nav>

                </div>
            </nav>
        </div>
    </header>
    <div class="main">
        <button class="btn back-btn" onclick="window.history.back()"><i class="fas fa-arrow-left"></i> Back to Section</button>
        <form class="search-bar" onsubmit="return false;">
            <input type="text" id="searchInput" placeholder="Search student or passage...">
            <button type="submit" onclick="searchStudent()"><i class="fas fa-search"></i></button>
        </form>
        <div class="card">
            <div class="card-header-row">
                <div class="dropdown">
                    <a href="#">Reading Languages <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#" id="lang-english">English</a>
                        <a href="#" id="lang-filipino">Filipino</a>
                    </div>
                </div>
            </div>
            <div class="section-title" id="passage-title">TALATA SA PAGBASA</div>
            <div class="passage" id="passage-text">
                Narito ang isang kwento tungkol sa isang batang babae na nagngangalang Maria. Sa isang maliit na bayan sa tabi ng bundok, nakatira siya sa kanyang lola at lolo. Bawat umaga, masaya niyang tinutulungan ang kanyang mga lolo at lola sa mga gawain sa bahay, tulad ng paghuhugas ng pinggan at pag-aalaga sa mga hayop. Laking tuwa ni Maria kapag nakikita niyang maligaya ang kanyang mga lolo at lola. Mahilig din siya sa pagbabasa ng mga aklat, lalo na ng mga kwento tungkol sa kalikasan. Pinapangarap niyang maging isang guro balang araw upang matulungan ang mga batang katulad niya na nais matuto at magkaroon ng magandang kinabukasan.
            </div>
        </div>
        <div class="student-card" id="studentContainer">
            <div class="student-header">Search for a student</div>
            <div class="student-meta">Enter a student name above to begin</div>
        </div>
    </div>
    <script>
        // Timer logic
        let timerInterval;
        let elapsed = 0;
        function startTimer() {
            if (timerInterval) return;
            let start = Date.now() - elapsed;
            timerInterval = setInterval(() => {
                elapsed = Date.now() - start;
                document.getElementById('timer').textContent = formatTime(elapsed);
            }, 100);
        }
        function stopTimer() {
            clearInterval(timerInterval);
            timerInterval = null;
            
            // Add save button when timer is stopped
            const assessmentControls = document.querySelector('.assessment-controls');
            if (assessmentControls && !document.getElementById('saveButton')) {
                const saveButton = document.createElement('button');
                saveButton.id = 'saveButton';
                saveButton.className = 'btn save';
                saveButton.innerHTML = '<i class="fas fa-save"></i> Save Assessment';
                saveButton.onclick = saveReadingData;
                assessmentControls.appendChild(saveButton);
            }
        }
        function resetTimer() {
            stopTimer();
            elapsed = 0;
            document.getElementById('timer').textContent = '00:00:00';
        }
        function formatTime(ms) {
            let totalSeconds = Math.floor(ms / 1000);
            let hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            let minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            let seconds = String(totalSeconds % 60).padStart(2, '0');
            return `${hours}:${minutes}:${seconds}`;
        }

        // Search functionality
        function searchStudent() {
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.trim();
            const studentContainer = document.getElementById('studentContainer');

            if (!searchTerm) {
                studentContainer.innerHTML = `
                    <div class="student-header">Please enter a student name</div>
                    <div class="student-meta">Enter a student name above to begin</div>
                `;
                return;
            }

            studentContainer.innerHTML = `
                <div class="student-header">Searching...</div>
                <div class="student-meta">Please wait while we find the student</div>
            `;

            console.log('Searching for:', searchTerm);

            fetch(`/teacher/search-student?query=${encodeURIComponent(searchTerm)}&section=Narra`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(students => {
                console.log('Received students:', students);
                if (students && students.length > 0) {
                    const student = students[0];
                    studentContainer.innerHTML = `
                        <div class="student-header">${student.name}</div>
                        <div class="student-meta">Section: ${student.section} &nbsp; | &nbsp; Grade Level: ${student.grade_level}</div>
                        <div class="assessment-controls">
                            <label for="miscues">Miscues</label>
                            <input type="number" id="miscues" class="miscues-input" min="0" value="0">
                            <span class="timer" id="timer">00:00:00</span>
                            <button class="btn start" onclick="startTimer()">Start Time</button>
                            <button class="btn stop" onclick="stopTimer()">Stop Time</button>
                            <button class="btn reset" onclick="resetTimer()">Reset Time</button>
                        </div>
                    `;
                } else {
                    studentContainer.innerHTML = `
                        <div class="student-header">No student found</div>
                        <div class="student-meta">Please try searching with a different name</div>
                    `;
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                studentContainer.innerHTML = `
                    <div class="student-header">Error</div>
                    <div class="student-meta">An error occurred while searching. Please try again.</div>
                `;
            });
        }

        // Add event listener for Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchStudent();
            }
        });

        // Passage switching logic
        const passages = {
            filipino: {
                title: 'TALATA SA PAGBASA',
                text: 'Narito ang isang kwento tungkol sa isang batang babae na nagngangalang Maria. Sa isang maliit na bayan sa tabi ng bundok, nakatira siya sa kanyang lola at lolo. Bawat umaga, masaya niyang tinutulungan ang kanyang mga lolo at lola sa mga gawain sa bahay, tulad ng paghuhugas ng pinggan at pag-aalaga sa mga hayop. Laking tuwa ni Maria kapag nakikita niyang maligaya ang kanyang mga lolo at lola. Mahilig din siya sa pagbabasa ng mga aklat, lalo na ng mga kwento tungkol sa kalikasan. Pinapangarap niyang maging isang guro balang araw upang matulungan ang mga batang katulad niya na nais matuto at magkaroon ng magandang kinabukasan.'
            },
            english: {
                title: 'READING PASSAGE',
                text: 'Here is a story about a young girl named Maria. In a small town by the mountains, she lives with her grandmother and grandfather. Every morning, she happily helps her grandparents with household chores, such as washing dishes and taking care of the animals. Maria feels great joy when she sees her grandparents happy. She also loves reading books, especially stories about nature. She dreams of becoming a teacher one day to help children like her learn and have a bright future.'
            }
        };

        function setPassage(lang) {
            document.getElementById('passage-title').textContent = passages[lang].title;
            document.getElementById('passage-text').textContent = passages[lang].text;
            document.querySelectorAll('.dropdown-content a').forEach(a => a.classList.remove('selected'));
            document.getElementById('lang-' + lang).classList.add('selected');
        }

        document.addEventListener('DOMContentLoaded', function() {
            setPassage('filipino');
            document.getElementById('lang-english').addEventListener('click', function(e) { e.preventDefault(); setPassage('english'); });
            document.getElementById('lang-filipino').addEventListener('click', function(e) { e.preventDefault(); setPassage('filipino'); });
        });

        function saveReadingData() {
            const studentContainer = document.getElementById('studentContainer');
            const studentName = studentContainer.querySelector('.student-header').textContent;
            const miscues = document.getElementById('miscues').value;
            const readingTime = elapsed / 1000; // Convert to seconds
            const totalWords = document.getElementById('passage-text').textContent.split(/\s+/).length;

            // Calculate reading speed (words per minute)
            const readingSpeed = Math.round((totalWords / readingTime) * 60);

            // Calculate word recognition percentage
            const wordRecognition = Math.round(((totalWords - miscues) / totalWords) * 100);
            
            // Determine word reading level
            let wordLabel = 'Frustration';
            if (wordRecognition >= 98) {
                wordLabel = 'Independent';
            } else if (wordRecognition >= 90) {
                wordLabel = 'Instructional';
            }

            // Get current language from the passage title
            const currentLanguage = document.getElementById('passage-title').textContent === 'TALATA SA PAGBASA' ? 'Filipino' : 'English';

            const data = {
                student_name: studentName,
                reading_time: readingTime,
                miscues: parseInt(miscues),
                total_words: totalWords,
                reading_speed: readingSpeed,
                word_recognition: wordRecognition,
                word_label: wordLabel,
                comprehension: 'Instructional', // Default value, can be updated if you have comprehension data
                section: 'Narra', // You might want to make this dynamic
                language: currentLanguage,
                assessment_date: new Date().toISOString()
            };

            console.log('Saving reading data:', data);

            fetch('/teacher/update-reading', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Failed to save reading assessment');
                    });
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    alert('Reading assessment saved successfully!');
                    // Redirect to viewreports with the correct section and language
                    window.location.href = `/teacher/viewreports?section=Narra&language=${currentLanguage}`;
                } else {
                    throw new Error(result.message || 'Failed to save reading assessment');
                }
            })
            .catch(error => {
                console.error('Error saving reading data:', error);
                alert('Error: ' + error.message);
            });
        }
    </script>
</body>
</html>