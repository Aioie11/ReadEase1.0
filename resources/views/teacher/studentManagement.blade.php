<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ReadEase - Student Management</title>
  <link rel="stylesheet" href="styles.css">
  <style>
   body {
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
  background: #f7f9fb;
  color: #222;
}

.sidebar {
  position: fixed;
  left: 0; top: 0; bottom: 0;
  width: 220px;
  background: #0a4fa3;
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  z-index: 2;
  box-shadow: 2px 0 8px #0001;
}

.logo {
  font-size: 1.7em;
  font-weight: bold;
  padding: 24px 0 16px 32px;
  letter-spacing: 1px;
}

.sidebar ul {
  list-style: none;
  padding: 0 0 0 0;
  margin: 0;
}

.sidebar ul li {
  margin: 0;
}

.sidebar ul button {
  width: 100%;
  background: none;
  border: none;
  color: inherit;
  font-size: 1.1em;
  padding: 16px 32px 16px 48px;
  text-align: left;
  cursor: pointer;
  transition: background 0.2s;
  position: relative;
}

.sidebar ul button .icon {
  position: absolute;
  left: 24px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.2em;
  opacity: 0.85;
}

.sidebar ul button.active,
.sidebar ul button:hover {
  background: #1565c0;
}

.teacher-info {
  display: flex;
  align-items: center;
  padding: 16px 16px;
  background: #1565c0;
  gap: 12px;
}

.avatar {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: #ffa726;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 1.2em;
}

.teacher-name {
  font-weight: bold;
}

.teacher-role {
  font-size: 0.9em;
  color: #e3e3e3;
}

.main-content {
  margin-left: 220px;
  padding: 0;
}

.header {
  background: #1565c0;
  color: #fff;
  padding: 18px 32px;
  font-size: 1.2em;
  font-weight: 500;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header .header-avatar {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #ffa726;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 1.1em;
}

.page {
  padding: 32px;
}

h2 {
  margin-top: 0;
}

.controls {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 18px;
}

.search-input {
  padding: 8px 14px;
  border: 1px solid #d0d7de;
  border-radius: 6px;
  font-size: 1em;
  width: 220px;
}

.dropdowns select {
  margin-right: 8px;
  padding: 8px 10px;
  border-radius: 6px;
  border: 1px solid #d0d7de;
  font-size: 1em;
}

.add-btn {
  background: #1565c0;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 10px 18px;
  font-size: 1em;
  cursor: pointer;
  font-weight: 500;
  transition: background 0.2s;
}

.add-btn:hover {
  background: #0a4fa3;
}

table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 8px #0001;
}

th, td {
  padding: 12px 10px;
  text-align: left;
}

th {
  background: #f3f6fa;
  font-weight: 600;
}

tbody tr:not(:last-child) {
  border-bottom: 1px solid #e0e6ed;
}

.avatar {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px;
  font-size: 1em;
  font-weight: bold;
}

.avatar-blue { background: #64b5f6; }
.avatar-green { background: #81c784; }
.avatar-pink { background: #f06292; }
.avatar-orange { background: #ffb74d; }
.avatar-red { background: #e57373; }
.avatar-purple { background: #ba68c8; }

.student-name { font-weight: 500; }
.student-email { font-size: 0.9em; color: #888; }

.badge {
  padding: 3px 10px;
  border-radius: 12px;
  font-size: 0.95em;
  font-weight: 500;
  display: inline-block;
}

.badge-excellent { background: #e0f7fa; color: #009688; }
.badge-good { background: #fff9c4; color: #fbc02d; }
.badge-average { background: #ffe0b2; color: #f57c00; }
.badge-needs { background: #ffcdd2; color: #d32f2f; }

.action-icon {
  margin-right: 8px;
  cursor: pointer;
  font-size: 1.1em;
  color: #888;
  transition: color 0.2s;
}
.action-icon:hover { color: #1565c0; }

  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">ReadEase</div>
    <ul>
      <li><button id="dashboardBtn"><span class="icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9.5L10 4l7 5.5V17a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/><path d="M9 21V12h2v9"/></svg></span>Dashboard</button></li>
      <li><button id="assessmentsBtn"><span class="icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="14" height="14" rx="2"/><path d="M8 2v4m4-4v4"/><path d="M4 10h12"/></svg></span>Assessments</button></li>
      <li><button id="studentsBtn" class="active"><span class="icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="4"/><path d="M16 19v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg></span>Students</button></li>
      <li><button id="reportsBtn"><span class="icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="14" height="14" rx="2"/><path d="M9 9h1v6H9zM13 13h1v2h-1z"/></svg></span>Reports</button></li>
      <li><button id="scheduleBtn"><span class="icon"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="14" height="12" rx="2"/><path d="M16 3v2M8 3v2M3 9h14"/></svg></span>Schedule</button></li>
    </ul>
    <div class="teacher-info">
      <div class="avatar">T</div>
      <div>
        <div class="teacher-name">Teacher Name</div>
        <div class="teacher-role">English Teacher</div>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <span>Welcome, Teacher</span>
      <div class="header-avatar">T</div>
    </div>
    
    <!-- Content container that will be dynamically updated -->
    <div id="content-container">
      <!-- Student Management Content -->
      <div id="student-content" class="page">
        <h2>Student Management</h2>
        <p>View and manage all student information</p>
        <div class="controls">
          <input type="text" placeholder="Search students..." class="search-input">
          <div class="dropdowns">
            <select id="gradeFilter">
              <option>All Grades</option>
              <option>Grade 7</option>
              <option>Grade 8</option>
            </select>
            <select id="sectionFilter">
              <option>All Sections</option>
              <option>Section A</option>
              <option>Section B</option>
            </select>
          </div>
          <button class="add-btn">+ Add New Student</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Student</th>
              <th>Grade & Section</th>
              <th>Academic Status</th>
              <th>Latest Score</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1001</td>
              <td style="display: flex; align-items: center; gap: 10px;">
                <div class="avatar avatar-blue">EB</div>
                <div>
                  <div class="student-name">Emma Brown</div>
                  </div>
              </td>
              <td>Grade 7 - Section A</td>
              <td>95/100</td>
              <td>
                <span class="action-icon" title="View">View</span>
                <span class="action-icon" title="Edit">Assessment</span>
              </td>
            </tr>
            <tr>
              <td>1002</td>
              <td style="display: flex; align-items: center; gap: 10px;">
                <div class="avatar avatar-green">JD</div>
                <div>
                  <div class="student-name">James Davis</div>
                  </div>
              </td>
              <td>Grade 7 - Section A</td>
              <td><span class="badge badge-good">Good</span></td>
              <td>88/100</td>
              <td>
                <span class="action-icon" title="View">View</span>
                <span class="action-icon" title="Edit">Assessment</span>
              </td>
            </tr>
            <tr>
              <td>1005</td>
              <td style="display: flex; align-items: center; gap: 10px;">
                <div class="avatar avatar-orange">OT</div>  
                <div>
                  <div class="student-name">Olivia Thompson</div>
                  </div>
                  </td>
                  <td>Grade 8 - Section A</td>
                  <td><span class="badge badge-excellent">Excellent</span></td>
              
              <td>96/100</td>
              <td>
                <span class="action-icon" title="View">View</span>
                <span class="action-icon" title="Edit">Assessment</span>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('DOM Content Loaded');
      
      // Get all navigation buttons
      const navButtons = document.querySelectorAll('.sidebar button');
      console.log('Found navigation buttons:', navButtons.length);
      
      // Store the student content initially
      const studentContent = document.getElementById('student-content').innerHTML;
      
      // Add click event listeners to all navigation buttons
      navButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault(); // Prevent any default button behavior
          console.log('Button clicked:', this.id);
          
          // Remove active class from all buttons
          navButtons.forEach(btn => btn.classList.remove('active'));
          
          // Add active class to clicked button
          this.classList.add('active');
          
          // Get the button ID to determine which content to show
          const buttonId = this.id;
          
          // For now, we only handle the students button
          if (buttonId === 'studentsBtn') {
            console.log('Loading student content');
            const contentContainer = document.getElementById('content-container');
            if (contentContainer) {
              // Only update the content inside the container, preserving the sidebar and header
              contentContainer.innerHTML = studentContent;
              console.log('Student content loaded');
            } else {
              console.error('Content container not found');
            }
          } else if (buttonId === 'dashboardBtn') {
            // Handle dashboard button click
            const contentContainer = document.getElementById('content-container');
            if (contentContainer) {
              contentContainer.innerHTML = '<div class="page"><h2>Dashboard</h2><p>Welcome to your dashboard</p></div>';
            }
          } else if (buttonId === 'assessmentsBtn') {
            // Handle assessments button click
            const contentContainer = document.getElementById('content-container');
            if (contentContainer) {
              contentContainer.innerHTML = '<div class="page"><h2>Assessments</h2><p>Manage your assessments here</p></div>';
            }
          } else if (buttonId === 'reportsBtn') {
            // Handle reports button click
            const contentContainer = document.getElementById('content-container');
            if (contentContainer) {
              contentContainer.innerHTML = '<div class="page"><h2>Reports</h2><p>View your reports here</p></div>';
            }
          } else if (buttonId === 'scheduleBtn') {
            // Handle schedule button click
            const contentContainer = document.getElementById('content-container');
            if (contentContainer) {
              contentContainer.innerHTML = '<div class="page"><h2>Schedule</h2><p>Manage your schedule here</p></div>';
            }
          }
        });
      });

      // Trigger click on students button if it's active on page load
      const activeButton = document.querySelector('.sidebar button.active');
      if (activeButton && activeButton.id === 'studentsBtn') {
        console.log('Triggering initial student content load');
        activeButton.click();
      }
    });
  </script>
</body>
</html> 