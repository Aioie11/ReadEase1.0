<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadEase - Reading Progress Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            background-color: #f4f6fa;
            color: #333;
        }

        aside {
            width: 250px;
            background-color: #0e3a8c;
            color: white;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 1rem 0;
            display: block;
            padding: 0.5rem;
            border-radius: 5px;
        }

        .nav a:hover, .nav .active {
            background-color: #2563eb;
        }

        main {
            flex: 1;
            padding: 2rem;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filters {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .filters input, .filters select, .filters button {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            flex: 1;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .charts {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .chart-container {
            background: white;
            flex: 1;
            padding: 1rem;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .progress-bar {
            width: 100px;
            height: 10px;
            border-radius: 5px;
            background-color: #ddd;
            position: relative;
        }

        .progress-bar span {
            display: block;
            height: 100%;
            border-radius: 5px;
        }

        .green { background-color: #4ade80; }
        .yellow { background-color: #facc15; }
        .red { background-color: #f87171; }

    </style>
</head>

<body>
    <aside>
        <div>
            <div class="logo"><img src="{{ asset('Downloads/ReadEastlogo.png') }}" alt="ReadEase Logo"></div>
            <div class="nav">
                <a href="#">Dashboard</a>
                <a href="#">Students</a>
                <a class="active" href="#">Reports</a>
            </div>
        </div>
        <div class="user">👤 Marie Dasian<br><small>Grade 7 Teacher</small></div>
    </aside>
    <main>
        <div class="topbar">
            <div>
                <h2>Welcome!</h2>
            </div>
            <div>🔔 🟡</div>
        </div>

        <div class="filters">
            <select>
                <option>English</option>
            </select>
            <select>
                <option>Filipino</option>
            </select>
            <select>
                <option>All Sections</option>
                <option>Narra</option>
                <option>Lawaan</option>
                <option>Dao</option>
                <option>Mahugani</option>
            </select>
            <select>
                <option>All Grades</option>
                <option>Grade 7</option>
                <option>Grade 8</option>
                <option>Grade 9</option>
                <option>Grade 10</option>
            </select>
        </div>

        <div class="stats">
            <div class="card"<br>Average Reading Level<br><strong>Intermediate</strong> <span style="color:green;">+12%</span></div>
            <div class="card"<br>Reading Speed (WPM)<br><strong>185</strong> <span style="color:green;">+8%</span></div>
            <div class="card"<br>Comprehension Rate<br><strong>78%</strong> <span style="color:green;">+5%</span></div>
        </div>

        <div class="charts">
            <div class="chart-container">
                <h4>Reading Level Progress</h4>
                <canvas id="levelChart"></canvas>
            </div>
            <div class="chart-container">
                <h4>Reading Comprehension</h4>
                <canvas id="compChart"></canvas>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Grade</th>
                    <th>Reading Level</th>
                    <th>Books Read</th>
                    <th>Reading Speed</th>
                    <th>Comprehension</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Emily Thompson</td>
                    <td>Grade 7A</td>
                    <td>Advanced</td>
                    <td>12</td>
                    <td>210 WPM</td>
                    <td>92%</td>
                    <td><div class="progress-bar"><span class="green" style="width: 90%;"></span></div></td>
                </tr>
                <tr>
                    <td>James Wilson</td>
                    <td>Grade 7B</td>
                    <td>Intermediate</td>
                    <td>8</td>
                    <td>165 WPM</td>
                    <td>78%</td>
                    <td><div class="progress-bar"><span class="yellow" style="width: 60%;"></span></div></td>
                </tr>
                <tr>
                    <td>Sophia Martinez</td>
                    <td>Grade 8A</td>
                    <td>Advanced</td>
                    <td>15</td>
                    <td>225 WPM</td>
                    <td>95%</td>
                    <td><div class="progress-bar"><span class="green" style="width: 95%;"></span></div></td>
                </tr>
                <tr>
                    <td>Liam Johnson</td>
                    <td>Grade 8B</td>
                    <td>Beginner</td>
                    <td>5</td>
                    <td>120 WPM</td>
                    <td>65%</td>
                    <td><div class="progress-bar"><span class="red" style="width: 40%;"></span></div></td>
                </tr>
            </tbody>
        </table>
    </main>

    <script>
        const ctx1 = document.getElementById('levelChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [
                    { label: 'Grade 7', data: [2, 2.4, 5, 3, 3.3], borderColor: '#3b82f6', fill: false },
                    { label: 'Grade 8', data: [3, 3.2, 3.5, 3.8, 4], borderColor: '#06b6d4', fill: false },
                    { label: 'Grade 9', data: [3.5, 3.6, 3, 3.9, 4.2], borderColor: '#f59e0b', fill: false },
                    { label: 'Grade 10', data: [4, 4.5, 4.2, 4.3, 4.4], borderColor: '#ef4444', fill: false }
                ]
            }
        });

        const ctx2 = document.getElementById('compChart').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [
                    { label: 'Advance', data: [85, 86, 88, 89, 90, 91, 92, 94], borderColor: '#3b82f6', fill: false },
                    { label: 'Average', data: [65, 67, 70, 72, 75, 77, 80, 83], borderColor: '#10b981', fill: false },
                    { label: 'Beginner', data: [70, 57, 60, 63, 66, 69, 72, 75], borderColor: '#f59e0b', fill: false }
                ]
            }
        });
    </script>
</body>

</html>