@extends('layouts.head-tech')

@section('title', 'Student Management')

@section('content')
  <!-- Main Content -->
  <div class="main-content">
    <style>
    /* Student Management Page Styles */
    .page {
      padding: 60px;
      background: #f7f9fb;
    }

    .welcome-message {
                background: white;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                margin-bottom: 30px;
                border: 1px solid #e9ecef;
                text-align: center;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .welcome-message:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .welcome-content h2 {
               text-align: left;
                color: #00B8A9;
                font-size: 1.8em;
                font-weight: 700;
            }

            .welcome-content p {
                text-align: left;
                color: #7f8c8d;
                font-size: 1rem;
                margin: 0;
                max-width: 600px;
              }
   
    .dashboard-header {
      padding: 25px;
      border-radius: 12px;
      border: 1px solid #e9ecef;
      margin-bottom: 30px;
    }

    .header-content h1 {
      color: #00B8A9;
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }

    .header-content p {
      color: #718096;
      margin: 0;
    }

    .controls {
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #e9ecef;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }

    .search-input {
      padding: 12px 16px;
      border: 1px solid #e9ecef;
      border-radius: 12px;
      font-size: 1rem;
      width: 280px;
      transition: border-color 0.2s;
    }

    .search-input:focus {
      outline: none;
      border-color: #00B8A9;
    }

    .dropdowns {
      display: flex;
      gap: 12px;
    }

    .dropdowns select {
      padding: 12px 16px;
      border-radius: 12px;
      border: 1px solid #e9ecef;
      font-size: 1rem;
      background: white;
      cursor: pointer;
    }

    .add-btn {
      background: #00B8A9;
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 12px 20px;
      font-size: 1rem;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.2s;
    }

    .add-btn:hover {
      background: #007F75;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 16px 20px;
      text-align: left;
    }

    th {
      background: #f8f9fa;
      font-weight: 600;
      color: #4A5568;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    tbody tr:not(:last-child) {
      border-bottom: 1px solid #e9ecef;
    }

    tbody tr:hover {
      background-color: rgba(0, 184, 169, 0.05);
    }

    .student-avatar {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      color: #fff;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 12px;
      font-size: 1rem;
      font-weight: bold;
    }

    .avatar-blue {
      background: #00B8A9;
    }

    .avatar-green {
      background: #38B2AC;
    }

    .avatar-orange {
      background: #F6AD55;
    }

    .avatar-red {
      background: #E53E3E;
    }

    .avatar-purple {
      background: #7FD9D2;
    }

    .avatar-pink {
      background: #F8615A;
    }

    .student-info {
      display: flex;
      align-items: center;
    }

    .student-name {
      font-weight: 500;
      color: #1a202c;
    }

    .badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
      display: inline-block;
    }

    .badge-complete {
      background: #d1fae5;
      color: #065f46;
    }

    .badge-incomplete {
      background: #fef3c7;
      color: #92400e;
    }

    .badge-no-assessment {
      background: #f3f4f6;
      color: #6b7280;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .action-btn {
      padding: 8px 16px;
      border: 1px solid transparent;
      border-radius: 12px;
      font-size: 0.85rem;
      cursor: pointer;
      transition: all 0.2s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-view {
      background: #E8F5E8;
      color: #00B8A9;
    }

    .btn-view:hover {
      background: #7FD9D2;
      color: white;
    }

    .btn-assess {
      background: #f0fdf4;
      color: #166534;
    }

    .btn-assess:hover {
      background: #dcfce7;
    }

    .btn-comment {
      background: #6CC24A;
      color: white;
      border: none;
      cursor: pointer;
    }

    .btn-comment:hover {
      background: #5ba83a;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: white;
      margin: 5% auto;
      padding: 0;
      border-radius: 12px;
      border: 1px solid #e9ecef;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
      padding: 20px;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h3 {
      margin: 0;
      color: #0E61BA;
      font-size: 1.2rem;
    }

    .close {
      color: #9ca3af;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      line-height: 1;
    }

    .close:hover {
      color: #374151;
    }

    .modal-body {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #374151;
    }

    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #e9ecef;
      border-radius: 12px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .modal-footer {
      padding: 20px;
      border-top: 1px solid #e5e7eb;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn {
      padding: 12px 24px;
      border: 1px solid transparent;
      border-radius: 12px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.2s;
    }

    .btn-cancel {
      background: #f3f4f6;
      color: #374151;
    }

    .btn-cancel:hover {
      background: #e5e7eb;
    }

    .btn-send {
      background: #0E61BA;
      color: white;
    }

    .btn-send:hover {
      background: #0d4b94;
    }

    @media (max-width: 768px) {
      .controls {
      flex-direction: column;
      align-items: stretch;
      }

      .search-input {
      width: 100%;
      }

      .dropdowns {
      justify-content: space-between;
      }

      .dropdowns select {
      flex: 1;
      }
    }
    </style>

    <!-- Student Management Content -->
    <div class="page">
    <div class="welcome-message">
        <div class="welcome-content">
            <h2>Student Management</h2>
            <p>View and manage all student information</p>
        </div>
    </div>

    <div class="controls">
      <input type="text" placeholder="Search students..." class="search-input">
      <div class="dropdowns">
      <select id="gradeFilter">
        <option>All Grades</option>
        <option>Grade 7</option>
        <option>Grade 8</option>
        <option>Grade 9</option>
        <option>Grade 10</option>
      </select>
      <select id="sectionFilter">
        <option>All Sections</option>
        <option>Section Narra</option>
        <option>Section Lawaan</option>
        <option>Section Dao</option>
        <option>Section Mahugani</option>
      </select>
      </div>
    </div>

    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Grade & Section</th>
        <th>Academic Status</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody id="studentsTableBody">
      @if(isset($students) && $students->count() > 0)
      @foreach($students as $index => $student)
      <tr data-grade="{{ $student['grade_level'] }}" data-section="{{ $student['section'] }}">
        <td>{{ $student['student_number'] }}</td>
        <td>
        <div class="student-info">
        @php
      $avatarColors = ['avatar-blue', 'avatar-green', 'avatar-orange', 'avatar-red', 'avatar-purple', 'avatar-pink'];
      $avatarClass = $avatarColors[$index % count($avatarColors)];
      @endphp
        
        <div class="student-name">{{ $student['name'] }}</div>
        </div>
        </td>
        <td>Grade {{ $student['grade_level'] }} - Section {{ $student['section'] }}</td>
        <td>
        <span class="badge
      @if($student['status'] == 'Complete') badge-complete
      @elseif($student['status'] == 'Incomplete') badge-incomplete
      @elseif($student['status'] == 'No Assessment') badge-no-assessment
      @else badge-no-assessment @endif">
        {{ $student['status'] }}
        </span>
        </td>

        <td>
        <div class="action-buttons">
        <a href="{{ route('teacher.view', ['student_id' => $student['id']]) }}"
        class="action-btn btn-view">View</a>
        <a href="{{ route('teacher.passage', ['grade' => 'grade' . $student['grade_level'], 'section' => strtolower($student['section']), 'student_number' => $student['student_number']]) }}"
        class="action-btn btn-assess">
        @if($student['total_assessments'] > 0)
        {{ $student['total_assessments'] }} Assessment{{ $student['total_assessments'] > 1 ? 's' : '' }}
      @else
        Start Assessment
      @endif
        </a>
        </div>
        </td>
      </tr>
      @endforeach
    @else
      <tr>
      <td colspan="5" class="text-center" style="padding: 40px;">
      <div style="color: #718096;">
        <i class="fas fa-users" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
        <h3 style="margin: 0 0 8px 0; font-size: 18px;">No Students Found</h3>
        <p style="margin: 0; font-size: 14px;">Students will appear here once they are added to the system.</p>
      </div>
      </td>
      </tr>
    @endif
      </tbody>
    </table>
    </div>

    <!-- Comment Modal -->
    <div id="commentModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
      <h3>Send Comment to <span id="studentName"></span></h3>
      <span class="close" onclick="closeCommentModal()">&times;</span>
      </div>
      <div class="modal-body">
      <form id="commentForm">
        <input type="hidden" id="studentId" name="student_id">
        <div class="form-group">
        <label for="commentType">Comment Type:</label>
        <select id="commentType" name="comment_type" required>
          <option value="">Select type...</option>
          <option value="feedback">Reading Feedback</option>
          <option value="encouragement">Encouragement</option>
          <option value="improvement">Areas for Improvement</option>
          <option value="achievement">Achievement Recognition</option>
          <option value="general">General Comment</option>
        </select>
        </div>
        <div class="form-group">
        <label for="commentText">Message:</label>
        <textarea id="commentText" name="comment_text" rows="5" placeholder="Write your comment here..."
          required></textarea>
        </div>
        <div class="form-group">
        <label for="priority">Priority:</label>
        <select id="priority" name="priority">
          <option value="normal">Normal</option>
          <option value="important">Important</option>
          <option value="urgent">Urgent</option>
        </select>
        </div>
      </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-cancel" onclick="closeCommentModal()">Cancel</button>
      <button type="button" class="btn btn-send" onclick="sendComment()">Send Comment</button>
      </div>
    </div>
    </div>
  </div>

  <script>
    // Search and Filter Functionality
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.search-input');
    const gradeFilter = document.getElementById('gradeFilter');
    const sectionFilter = document.getElementById('sectionFilter');
    const tableBody = document.getElementById('studentsTableBody');
    const rows = tableBody.querySelectorAll('tr[data-grade]');

    // Store all available sections for each grade
    const gradeSections = {};

    // Build grade-section mapping from existing student data
    rows.forEach(row => {
      const grade = row.getAttribute('data-grade');
      const section = row.getAttribute('data-section');

      if (!gradeSections[grade]) {
      gradeSections[grade] = new Set();
      }
      gradeSections[grade].add(section);
    });

    // Function to update section dropdown based on selected grade
    function updateSectionOptions() {
      const selectedGrade = gradeFilter.value;
      const currentSection = sectionFilter.value;

      // Clear current options except "All Sections"
      sectionFilter.innerHTML = '<option>All Sections</option>';

      if (selectedGrade === 'All Grades') {
      // Show all sections from all grades
      const allSections = new Set();
      Object.values(gradeSections).forEach(sections => {
        sections.forEach(section => allSections.add(section));
      });

      Array.from(allSections).sort().forEach(section => {
        const option = document.createElement('option');
        option.value = `Section ${section}`;
        option.textContent = `Section ${section}`;
        sectionFilter.appendChild(option);
      });
      } else {
      // Show only sections for the selected grade
      const gradeNumber = selectedGrade.replace('Grade ', '');
      const sectionsForGrade = gradeSections[gradeNumber];

      if (sectionsForGrade) {
        Array.from(sectionsForGrade).sort().forEach(section => {
        const option = document.createElement('option');
        option.value = `Section ${section}`;
        option.textContent = `Section ${section}`;
        sectionFilter.appendChild(option);
        });
      }
      }

      // Try to restore previous selection if it's still available
      const options = Array.from(sectionFilter.options);
      const matchingOption = options.find(option => option.value === currentSection);
      if (matchingOption) {
      sectionFilter.value = currentSection;
      } else {
      sectionFilter.value = 'All Sections';
      }
    }

    function filterTable() {
      const searchTerm = searchInput.value.toLowerCase();
      const selectedGrade = gradeFilter.value;
      const selectedSection = sectionFilter.value;

      rows.forEach(row => {
      const studentName = row.querySelector('.student-name').textContent.toLowerCase();
      const grade = row.getAttribute('data-grade');
      const section = row.getAttribute('data-section');

      const matchesSearch = studentName.includes(searchTerm);
      const matchesGrade = selectedGrade === 'All Grades' || selectedGrade === `Grade ${grade}`;
      const matchesSection = selectedSection === 'All Sections' || selectedSection === `Section ${section}`;

      if (matchesSearch && matchesGrade && matchesSection) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
      });

      // Show/hide "no results" message
      const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
      const noResultsRow = tableBody.querySelector('#noResultsRow');

      if (visibleRows.length === 0 && rows.length > 0) {
      if (!noResultsRow) {
        const noResults = document.createElement('tr');
        noResults.innerHTML = `
      <td colspan="5" class="text-center" style="padding: 40px;">
      <div style="color: #718096;">
      <i class="fas fa-search" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
      <h3 style="margin: 0 0 8px 0; font-size: 18px;">No Students Found</h3>
      <p style="margin: 0; font-size: 14px;">Try adjusting your search criteria.</p>
      </div>
      </td>
      `;
        noResults.id = 'noResultsRow';
        tableBody.appendChild(noResults);
      }
      } else if (noResultsRow) {
      noResultsRow.remove();
      }
    }

    // Event listeners
    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (gradeFilter) {
      gradeFilter.addEventListener('change', function () {
      updateSectionOptions(); // Update sections first
      filterTable(); // Then filter the table
      });
    }
    if (sectionFilter) sectionFilter.addEventListener('change', filterTable);

    // Initialize section options on page load
    updateSectionOptions();

    // Auto-refresh data every 30 seconds to show updated assessment info
    setInterval(function () {
      // Only refresh if user is not actively searching/filtering
      if (searchInput && gradeFilter && sectionFilter) {
      if (searchInput.value === '' && gradeFilter.value === 'All Grades' && sectionFilter.value === 'All Sections') {
        location.reload();
      }
      }
    }, 30000);
    });

    // Comment Modal Functions
    function openCommentModal(studentId, studentName) {
    document.getElementById('studentId').value = studentId;
    document.getElementById('studentName').textContent = studentName;
    document.getElementById('commentModal').style.display = 'block';

    // Reset form
    document.getElementById('commentForm').reset();
    document.getElementById('studentId').value = studentId; // Keep student ID after reset
    }

    function closeCommentModal() {
    document.getElementById('commentModal').style.display = 'none';
    }

    function sendComment() {
    const studentId = document.getElementById('studentId').value;
    const studentName = document.getElementById('studentName').textContent;
    const commentType = document.getElementById('commentType').value;
    const commentText = document.getElementById('commentText').value;
    const priority = document.getElementById('priority').value;

    // Validate form
    if (!commentType || !commentText.trim()) {
      alert('Please fill in all required fields.');
      return;
    }

    // Simulate sending comment (replace with actual AJAX call)
    const commentData = {
      student_id: studentId,
      student_name: studentName,
      comment_type: commentType,
      comment_text: commentText.trim(),
      priority: priority,
      timestamp: new Date().toISOString()
    };

    // Show success message
    alert(`Comment sent successfully to ${studentName}!\n\nType: ${commentType}\nPriority: ${priority}\nMessage: ${commentText.trim()}`);

    // Close modal
    closeCommentModal();

    // Here you would typically send the data to your backend
    console.log('Comment data:', commentData);
    }

    // Close modal when clicking outside of it
    window.onclick = function (event) {
    const modal = document.getElementById('commentModal');
    if (event.target === modal) {
      closeCommentModal();
    }
    }
  </script>
@endsection