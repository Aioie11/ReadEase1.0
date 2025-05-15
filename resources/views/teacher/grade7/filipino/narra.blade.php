<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReadEase - Grade 7 Assessment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Copy the existing styles from passsage.blade.php */
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
        /* ... (copy all other styles from passsage.blade.php) ... */
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="#" class="logo">ReadEase</a>
            <nav>
                <!-- Navigation items -->
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
            <div class="section-title" id="passage-title">GRADE 7 - READING PASSAGE</div>
            <div class="passage" id="passage-text">
                Here is a story about a young girl named Maria. In a small town by the mountains, she lives with her grandmother and grandfather. Every morning, she happily helps her grandparents with household chores, such as washing dishes and taking care of the animals. Maria feels great joy when she sees her grandparents happy. She also loves reading books, especially stories about nature. She dreams of becoming a teacher one day to help children like her learn and have a bright future.
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

            const data = {
                student_name: studentName,
                reading_time: readingTime,
                miscues: parseInt(miscues),
                total_words: totalWords,
                reading_speed: readingSpeed,
                section: 'Narra', // You might want to make this dynamic
                language: document.getElementById('passage-title').textContent === 'TALATA SA PAGBASA' ? 'Filipino' : 'English'
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
                    // Disable the save button after successful save
                    const saveButton = document.getElementById('saveButton');
                    if (saveButton) {
                        saveButton.disabled = true;
                        saveButton.innerHTML = '<i class="fas fa-check"></i> Saved';
                    }
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