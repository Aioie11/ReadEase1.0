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
        /* Copy styles from passsage.blade.php */
        :root {
            --primary: #0E61BA;
            --secondary: #6CC24A;
            --accent: #F9A602;
            --neutral: #F4F4F4;
            --text: #232323;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            line-height: 1.6;
            color: var(--text);
            background-color: var(--neutral);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .passage-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .passage-title {
            color: var(--primary);
            margin-bottom: 1rem;
            text-align: center;
            font-size: 1.5rem;
        }

        .passage-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .timer {
            font-size: 1.2rem;
            color: var(--primary);
        }

        .student-container {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .student-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .student-name {
            font-size: 1.2rem;
            color: var(--primary);
        }

        .assessment-form {
            margin-top: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #0d4b94;
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5aaf3d;
        }

        .search-container {
            margin-bottom: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .language-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .language-btn {
            padding: 0.5rem 1rem;
            border: 1px solid var(--primary);
            border-radius: 4px;
            background: none;
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s;
        }

        .language-btn.active {
            background: var(--primary);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>GRADE 7 - READING PASSAGE</h1>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search for a student...">
        </div>

        <div class="language-selector">
            <button id="lang-english" class="language-btn active">English</button>
            <button id="lang-filipino" class="language-btn">Filipino</button>
        </div>

        <div class="passage-container">
            <h2 id="passage-title" class="passage-title">READING PASSAGE</h2>
            <div class="controls">
                <div class="timer" id="timer">00:00</div>
                <button class="btn btn-primary" onclick="startTimer()">Start Reading</button>
                <button class="btn btn-secondary" onclick="stopTimer()">Stop Reading</button>
            </div>
            <div id="passage-text" class="passage-text">
                Juan was a young boy who loved science. Every day after school, he would rush to his small laboratory in the garage. His parents had given him a microscope for his birthday, and he spent hours looking at different things under it. He collected leaves, insects, and even pond water to study. His dream was to become a scientist and discover new things about the world. His teachers were amazed by his curiosity and knowledge. Juan's passion for learning inspired his classmates to be more interested in science too.
            </div>
        </div>

        <div id="studentContainer" class="student-container" style="display: none;">
            <div class="student-header">
                <span class="student-name"></span>
            </div>
            <form class="assessment-form" onsubmit="saveReadingData(); return false;">
                <div class="form-group">
                    <label for="miscues">Number of Miscues:</label>
                    <input type="number" id="miscues" required min="0">
                </div>
                <button type="submit" class="btn btn-primary">Save Assessment</button>
            </form>
        </div>
    </div>

    <script>
        let timer;
        let elapsed = 0;
        let isTimerRunning = false;

        function startTimer() {
            if (!isTimerRunning) {
                isTimerRunning = true;
                timer = setInterval(updateTimer, 1000);
            }
        }

        function stopTimer() {
            if (isTimerRunning) {
                isTimerRunning = false;
                clearInterval(timer);
            }
        }

        function updateTimer() {
            elapsed++;
            const minutes = Math.floor(elapsed / 60);
            const seconds = elapsed % 60;
            document.getElementById('timer').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function setPassage(language) {
            const title = document.getElementById('passage-title');
            const text = document.getElementById('passage-text');
            const englishBtn = document.getElementById('lang-english');
            const filipinoBtn = document.getElementById('lang-filipino');

            if (language === 'english') {
                title.textContent = 'READING PASSAGE';
                text.textContent = 'Juan was a young boy who loved science. Every day after school, he would rush to his small laboratory in the garage. His parents had given him a microscope for his birthday, and he spent hours looking at different things under it. He collected leaves, insects, and even pond water to study. His dream was to become a scientist and discover new things about the world. His teachers were amazed by his curiosity and knowledge. Juan\'s passion for learning inspired his classmates to be more interested in science too.';
                englishBtn.classList.add('active');
                filipinoBtn.classList.remove('active');
            } else {
                title.textContent = 'TALATA SA PAGBASA';
                text.textContent = 'Si Juan ay isang batang lalaki na mahilig sa agham. Tuwing pagkatapos ng klase, mabilis siyang pumupunta sa kanyang maliit na laboratoryo sa garahe. Binigyan siya ng kanyang mga magulang ng microscope noong kanyang kaarawan, at ginugugol niya ang maraming oras sa pagtingin sa iba\'t ibang bagay sa ilalim nito. Nagtitipon siya ng mga dahon, insekto, at maging tubig sa lawa para pag-aralan. Ang pangarap niya ay maging isang siyentipiko at makadiskubre ng mga bagong bagay tungkol sa mundo. Namangha ang kanyang mga guro sa kanyang pagkamausisa at kaalaman. Ang pagnanais ni Juan na matuto ay naging inspirasyon sa kanyang mga kaklase na maging mas interesado sa agham.';
                filipinoBtn.classList.add('active');
                englishBtn.classList.remove('active');
            }
        }

        function searchStudent() {
            const searchTerm = document.getElementById('searchInput').value;
            console.log('Searching for:', searchTerm);

            fetch(`/teacher/search-student?query=${encodeURIComponent(searchTerm)}&section=lawaan`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received student data:', data);
                const container = document.getElementById('studentContainer');
                const studentName = container.querySelector('.student-name');
                
                if (data.length > 0) {
                    const student = data[0];
                    studentName.textContent = `${student.first_name} ${student.middle_name ? student.middle_name + ' ' : ''}${student.last_name}`;
                    container.style.display = 'block';
                } else {
                    studentName.textContent = 'No student found';
                    container.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                alert('Error searching for student. Please try again.');
            });
        }

        function saveReadingData() {
            const studentContainer = document.getElementById('studentContainer');
            const studentName = studentContainer.querySelector('.student-name').textContent;
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
                section: 'lawaan',
                language: document.getElementById('passage-title').textContent === 'TALATA SA PAGBASA' ? 'Filipino' : 'English'
            };

            console.log('Saving reading data:', data);

            fetch('/teacher/save-reading', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Reading assessment saved successfully!');
                    // Reset the form
                    document.getElementById('miscues').value = '';
                    stopTimer();
                    elapsed = 0;
                    document.getElementById('timer').textContent = '00:00';
                } else {
                    throw new Error(data.message || 'Failed to save reading assessment');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving reading assessment. Please try again.');
            });
        }

        // Add event listener for search input
        document.getElementById('searchInput').addEventListener('input', debounce(searchStudent, 500));

        // Debounce function to limit API calls
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Initialize with English passage
        document.addEventListener('DOMContentLoaded', function() {
            setPassage('english');
            document.getElementById('lang-english').addEventListener('click', function(e) { e.preventDefault(); setPassage('english'); });
            document.getElementById('lang-filipino').addEventListener('click', function(e) { e.preventDefault(); setPassage('filipino'); });
        });
    </script>
</body>
</html> 