<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadEase - Reading Progress Report</title>
    <style>
        body {
            margin: 0;
            font-family: sans-serif; /* Use a common sans-serif font */
            background-color: #f4f7f6; /* Light grey background */
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #1a3b6b; /* Blue color from the image */
            color: white;
            padding: 20px;
            height: 100vh;
            box-sizing: border-box;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 15px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar ul li a:hover, .sidebar ul li.active a {
            background-color: #2a4f85; /* Slightly darker blue on hover/active */
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .filters {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }
        .filters label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 0.9em;
        }
        .filters input, .filters select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .filters button {
            background-color: #007bff; /* Example blue button color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .summary-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .card {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .charts {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .chart-container {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .student-table {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .student-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .student-table th, .student-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .student-table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .progress-bar-container {
            background-color: #eee;
            border-radius: 5px;
            overflow: hidden;
            height: 10px;
            width: 100px; /* Adjust as needed */
        }
        .progress-bar {
            height: 100%;
            background-color: green; /* Default color, should be dynamic */
            width: 75%; /* Example width, should be dynamic */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>ReadEase</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Students</a></li>
            <li class="active"><a href="{{ route('teacher.reading-progress') }}">Reports</a></li>
        </ul>
        <div style="position: absolute; bottom: 20px; text-align: center; width: calc(250px - 40px);">
            <div style="width: 40px; height: 40px; background-color: orange; color: white; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; font-size: 1.2em; margin-bottom: 5px;">T</div>
            <div>Teacher Name</div>
            <div style="font-size: 0.9em;">Reading Specialist</div>
        </div>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Welcome, Reading Specialist</h1>
            <div>Friday, May 24, 2025</div> <!-- Should be dynamic -->
            <div>
                <!-- Notification and User Icon placeholder -->
            </div>
        </div>

        <div class="filters">
            <div>
                <label for="date-range-from">Date Range</label>
                <input type="date" id="date-range-from" value="2025-04-01"> <!-- Example values -->
                <span>to</span>
                <input type="date" id="date-range-to" value="2025-05-24"> <!-- Example values -->
            </div>
            <div>
                <label for="grade">Grade</label>
                <select id="grade">
                    <option value="all">All Grades</option>
                    <!-- Other grade options -->
                </select>
            </div>
            <div>
                <label for="reading-level">Reading Level</label>
                <select id="reading-level">
                    <option value="all">All Levels</option>
                    <!-- Other level options -->
                </select>
            </div>
            <button>Apply Filters</button>
        </div>

        <div class="summary-cards">
            <div class="card">
                <h3>Average Reading Level</h3>
                <h2>Intermediate <span style="color: green; font-size: 0.9em;">^12%</span></h2>
                <!-- Icon placeholder -->
            </div>
            <div class="card">
                 <h3>Reading Speed (WPM)</h3>
                <h2>185 <span style="color: green; font-size: 0.9em;">^8%</span></h2>
                <!-- Icon placeholder -->
            </div>
            <div class="card">
                 <h3>Comprehension Rate</h3>
                <h2>78% <span style="color: green; font-size: 0.9em;">^5%</span></h2>
                <!-- Icon placeholder -->
            </div>
        </div>

        <div class="charts">
            <div class="chart-container">
                <h3>Reading Level Progress</h3>
                <!-- Chart placeholder - needs a charting library like Chart.js -->
                <div style="height: 300px; background-color: #eee;">Chart Placeholder</div>
            </div>
            <div class="chart-container">
                <h3>Reading Comprehension</h3>
                 <!-- Chart placeholder - needs a charting library like Chart.js -->
                 <div style="height: 300px; background-color: #eee;">Chart Placeholder</div>
            </div>
        </div>

        <div class="student-table">
            <h3>Student Reading Progress</h3>
            <table>
                <thead>
                    <tr>
                        <th>STUDENT</th>
                        <th>GRADE</th>
                        <th>READING LEVEL</th>
                        <th>BOOKS READ</th>
                        <th>READING SPEED</th>
                        <th>COMPREHENSION</th>
                        <th>PROGRESS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; background-color: blue; color: white; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; font-size: 1em; margin-right: 10px;">E</div>
                                Emily Thompson
                            </div>
                        </td>
                        <td>Grade 7A</td>
                        <td>Advanced</td>
                        <td>12</td>
                        <td>210 WPM</td>
                        <td>92%</td>
                         <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 92%; background-color: green;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                         <td>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; background-color: green; color: white; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; font-size: 1em; margin-right: 10px;">J</div>
                                James Wilson
                            </div>
                        </td>
                        <td>Grade 7B</td>
                        <td>Intermediate</td>
                        <td>8</td>
                        <td>165 WPM</td>
                        <td>78%</td>
                         <td>
                             <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 78%; background-color: orange;"></div>
                            </div>
                        </td>
                    </tr>
                     <tr>
                         <td>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; background-color: purple; color: white; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; font-size: 1em; margin-right: 10px;">S</div>
                                Sophia Martinez
                            </div>
                        </td>
                        <td>Grade 8A</td>
                        <td>Advanced</td>
                        <td>15</td>
                        <td>225 WPM</td>
                        <td>95%</td>
                         <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 95%; background-color: green;"></div>
                            </div>
                        </td>
                    </tr>
                     <tr>
                         <td>
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; background-color: red; color: white; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; font-size: 1em; margin-right: 10px;">L</div>
                                Liam Johnson
                            </div>
                        </td>
                        <td>Grade 8B</td>
                        <td>Beginner</td>
                        <td>5</td>
                        <td>120 WPM</td>
                        <td>65%</td>
                         <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: 65%; background-color: red;"></div>
                            </div>
                        </td>
                    </tr>
                    <!-- More rows -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
