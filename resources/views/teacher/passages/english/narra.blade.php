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
            <div class="section-title" id="passage-title">READING PASSAGE</div>
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
        // Copy the JavaScript code from passsage.blade.php
        // ... (copy all JavaScript functions) ...
    </script>
</body>
</html> 