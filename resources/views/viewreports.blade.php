<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <title>ReadEase</title>
    <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
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


   /* Main content wrapper */
   .report-container {
      max-width: 1300px;
      margin: 1rem auto;
      padding: 3rem;
      background:rgb(23, 150, 219);
      border-radius: 10px;
     
    }

    h2, h3 {
      text-align: left;
      margin: 0.5rem 0;
      color:black;
    }
    .underline {
      text-decoration: underline;
    }  
    

    /* Student cards container */
    .student-wrapper {
      background:skyblue;
      border-radius: 15px;
      padding: 2rem;
      border: 2px solid black;
      display: flex;
      justify-content: space-around;
      gap: 1rem;
      flex-wrap: wrap;
      
    }

    /* Individual student card */
    .student-column {
      width: 300px;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin: 0.5rem;

     
      
    }

    .student-column h4 {
      margin: 0;
      text-align: center;
      font-size: 1rem;
      font-weight: bold;
      color: black;
    }

    /* Container for each chart + label */
    .section-box {
    position: relative;
    background: #f7fcff;
    border-radius: 10px;
    padding: 1rem 0.8rem 1.5rem; /* Add space at bottom for the label */
  box-shadow: inset 0 0 4px rgba(0, 0, 0, 0.05);
  border: 1px solid black;
  overflow: visible;
}

    .chart-section {
      margin-bottom: 0.3rem;
    }

    /* Label under each chart */
    .label-box {
      position: absolute;
      bottom:-0.8rem; /* Aligns directly on the bottom edge */
      left: 50%;
      transform: translate(-50%); /* Pushes it 50% below the bottom edge */
      background: #bfe3f7;
      text-align: center;
      padding: 0.25rem 1rem;
      border-radius: 5px;
      font-size: 0.85rem;
      color:black;
      font-weight: normal;
      border: 1px solid black;
      white-space: nowrap;
      font-style: italic;
    }


    .bold-value{
      font-weight: bold;
    }
    /* Chart canvas responsive */
    canvas {
      max-height: 80px;
      width: 100% !important;
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
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>

            <!-- Reading Languages with Side Dropdown -->
            <li class="dropdown-container">
                <a href="{{ url('/readinglanguage') }}" id="readingLanguagesBtn">Reading Languages ▸</a>
                <ul class="dropdown-menu">
                    <!-- English -->
                <li class="dropdown-container">
                        <a href="#" id="englishBtn">English▸</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-container">  
                                <a href="#">Grade 7▸</a>
                                <ul class="dropdown-menu">
                                <li><a href="{{ url('/english') }}#dao">Dao</a></li>
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
                                    <li><a href="{{ url('/filipino') }}#dao">Dao</a></li>
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

    <main>

      <!-- REPORT SECTION FOR STUDENTS -->
<div class="report-container">
  <h2>STUDENT FILIPINO REPORTS</h2>
  <h3>Grade 7 Students : <span class="underline">SECTION NARRA</span></h3>

  <?php
  // STUDENT DATA (normally from a database)
  $results = DB::select('select * from users');
  // echo $results;
  dump($results);
  $students = [
    [
      'name' => 'AlbingA, Alexander Ven A.',
      'reading_time' => 42,
      'total_words' => 70,
      'reading_speed' => '96 WPM',
      'correct_answers' => 4,
      'total_questions' => 6,
      'comprehension' => 'Instructional',
      'word_recognition' => 55,
      'word_total' => 70,
      'word_label' => 'Independent'
    ],
    // Additional students
    [
      'name' => 'Acobo, Glenn',
      'reading_time' => 30,
      'total_words' => 68,
      'reading_speed' => '50 WPM',
      'correct_answers' => 5,
      'total_questions' => 6,
      'comprehension' => 'Independent',
      'word_recognition' => 15,
      'correct reading' => 60,
      'word_total' => 70,
      'word_label' => 'Instructional'
    ],
    [
      'name' => 'Adazas, Dexter',
      'reading_time' => 30,
      'total_words' => 70,
      'reading_speed' => '90 WPM',
      'correct_answers' => 3,
      'total_questions' => 6,
      'comprehension' => 'Instructional',
      'word_recognition' => 45,
      'word_total' => 70,
      'word_label' => 'Instructional'
    ]
  ];
  ?>
<!-- STUDENT CARD DISPLAY -->
<div class="student-wrapper">
<?php foreach ($students as $i => $s): 
  $id = "chart$i"; // unique chart ID for each student ?>
  <div class="student-column">
    <h4><?= ($i+1) . ". {$s['name']}" ?></h4>

    <!-- READING SPEED CHART -->
    <div class="section-box">
      <div class="chart-section">
        <canvas id="<?= $id ?>_reading"></canvas>
        <div class="label-box italic-label">READING SPEED: <span class="bold-value"><?= $s['reading_speed'] ?></span></div>
      </div>
    </div>

    <!-- COMPREHENSION CHART -->
    <div class="section-box">
      <div class="chart-section">
        <canvas id="<?= $id ?>_comp"></canvas>
        <div class="label-box italic-label">COMPREHENSION: <span class="bold-value"><?= $s['comprehension'] ?></span></div>
      </div>
    </div>

    <!-- WORD RECOGNITION CHART -->
    <div class="section-box">
      <div class="chart-section">
        <canvas id="<?= $id ?>_word"></canvas>
        <div class="label-box italic-label">WORD READING: <span class="bold-value"><?= $s['word_label'] ?></span></div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
</div>

<!-- CHART.JS SCRIPT TO GENERATE STUDENT GRAPHS -->
<script>
<?php foreach ($students as $i => $s): ?>
  const ctxR<?= $i ?> = document.getElementById('chart<?= $i ?>_reading');
  const ctxC<?= $i ?> = document.getElementById('chart<?= $i ?>_comp');
  const ctxW<?= $i ?> = document.getElementById('chart<?= $i ?>_word');

  // Reading Speed Chart
  new Chart(ctxR<?= $i ?>, {
    type: 'bar',
    data: {
      labels: ['Reading Time', 'Total Words'],
      datasets: [{
        data: [<?= $s['reading_time'] ?>, <?= $s['total_words'] ?>],
        backgroundColor: ['#247ba0', '#70c1b3']
      }]
    },
    options: {
      indexAxis: 'y',
      plugins: { legend: { display: false } },
      scales: {
        x: {
          beginAtZero: true,
          max: <?= $s['total_words'] ?>
        }
      }
    }
  });

  // Comprehension Chart
  new Chart(ctxC<?= $i ?>, {
    type: 'bar',
    data: {
      labels: ['Correct Answers', 'Total Questions'],
      datasets: [{
        data: [<?= $s['correct_answers'] ?>, <?= $s['total_questions'] ?>],
        backgroundColor: ['#38B6FF', '#00d4ff']
      }]
    },
    options: {
      indexAxis: 'y',
      plugins: { legend: { display: false } },
      scales: { x: { beginAtZero: true } }
    }
  });
  
  // Word Reading

new Chart(ctxW<?= $i ?>, {
  type: 'bar',
  data: {
    labels: [
      'Reading Miscues', 
      'Correct Reading',
      'Total Words'
    ],
    datasets: [{
      data: [
        <?= $s['word_total'] - $s['word_recognition'] ?>,
        <?= $s['word_recognition'] ?>,
        <?= $s['word_total'] ?>
      ],
      backgroundColor: ['#94d2bd', '#caf0f8', '#f0efeb']
    }]
  },
  options: {
    indexAxis: 'y',
    plugins: {
      legend: { display: false },
      datalabels: {
        display: function(context) {
          return context.dataIndex === 1;
        },
        anchor: 'start',
        align: 'left',
        formatter: function() {
          return 'Correct Reading';
        },
       
      }
    },
   
  },
  plugins: [ChartDataLabels]
});


<?php endforeach; ?>
</script>




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
