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
  <h2>STUDENT {{ strtoupper($language) }} REPORTS</h2>
  <h3>Grade 7 Students : <span class="underline">SECTION {{ strtoupper($section) }}</span></h3>

  <!-- STUDENT CARD DISPLAY -->
  <div class="student-wrapper">
  @if($students->count() > 0)
    @foreach($students as $i => $student)
      <div class="student-column">
        <h4>{{ $i + 1 }}. {{ $student->student_name }}</h4>

        <!-- READING SPEED CHART -->
        <div class="section-box">
          <div class="chart-section">
            <canvas id="chart{{ $i }}_reading"></canvas>
            <div class="label-box italic-label">READING SPEED: <span class="bold-value">{{ $student->reading_speed }}</span></div>
          </div>
        </div>

        <!-- COMPREHENSION CHART -->
        <div class="section-box">
          <div class="chart-section">
            <canvas id="chart{{ $i }}_comp"></canvas>
            <div class="label-box italic-label">COMPREHENSION: <span class="bold-value">{{ $student->comprehension }}</span></div>
          </div>
        </div>

        <!-- WORD RECOGNITION CHART -->
        <div class="section-box">
          <div class="chart-section">
            <canvas id="chart{{ $i }}_word"></canvas>
            <div class="label-box italic-label">WORD READING: <span class="bold-value">{{ $student->word_label }}</span></div>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="alert alert-info w-100 text-center">
      No reading data available for {{ strtoupper($section) }} section in {{ strtoupper($language) }}.
    </div>
  @endif
  </div>
</div>

<!-- CHART.JS SCRIPT TO GENERATE STUDENT GRAPHS -->
@if($students->count() > 0)
<script>
@foreach($students as $i => $student)
  const ctxR{{ $i }} = document.getElementById('chart{{ $i }}_reading');
  const ctxC{{ $i }} = document.getElementById('chart{{ $i }}_comp');
  const ctxW{{ $i }} = document.getElementById('chart{{ $i }}_word');

  // Reading Speed Chart
  new Chart(ctxR{{ $i }}, {
    type: 'bar',
    data: {
      labels: ['Reading Time', 'Total Words'],
      datasets: [{
        data: [{{ $student->reading_time }}, {{ $student->total_words }}],
        backgroundColor: ['#247ba0', '#70c1b3']
      }]
    },
    options: {
      indexAxis: 'y',
      plugins: { legend: { display: false } },
      scales: {
        x: {
          beginAtZero: true,
          max: {{ $student->total_words }}
        }
      }
    }
  });

  // Comprehension Chart
  new Chart(ctxC{{ $i }}, {
    type: 'bar',
    data: {
      labels: ['Correct Answers', 'Total Questions'],
      datasets: [{
        data: [{{ $student->correct_answers }}, {{ $student->total_questions }}],
        backgroundColor: ['#38B6FF', '#00d4ff']
      }]
    },
    options: {
      indexAxis: 'y',
      plugins: { legend: { display: false } },
      scales: { x: { beginAtZero: true } }
    }
  });
  
  // Word Reading Chart
  new Chart(ctxW{{ $i }}, {
    type: 'bar',
    data: {
      labels: ['Reading Miscues', 'Correct Reading', 'Total Words'],
      datasets: [{
        data: [
          {{ $student->miscues }},
          {{ $student->total_words - $student->miscues }},
          {{ $student->total_words }}
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
          }
        }
      }
    },
    plugins: [ChartDataLabels]
  });
@endforeach
</script>
@endif




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
