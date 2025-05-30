@extends('layouts.head-tech')

@section('title', 'Student Management')

@section('content')
  <!-- Main Content -->
  <div class="main-content">
    <style>
    /* Student Management Page Styles */
    .page {
      padding: 32px;
      padding-top: 2rem;
      background: #f7f9fb;
    }

    .dashboard-header {
      margin-bottom: 2rem;
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
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .search-input {
      padding: 12px 16px;
      border: 1px solid #d0d7de;
      border-radius: 8px;
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
      border-radius: 8px;
      border: 1px solid #d0d7de;
      font-size: 1rem;
      background: white;
      cursor: pointer;
    }

    .add-btn {
      background: #00B8A9;
      color: #fff;
      border: none;
      border-radius: 8px;
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
      padding: 16px 12px;
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
      border-bottom: 1px solid #e2e8f0;
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

    .badge-excellent {
      background: #d1fae5;
      color: #065f46;
    }

    .badge-good {
      background: #fef3c7;
      color: #92400e;
    }

    .badge-average {
      background: #fed7aa;
      color: #c2410c;
    }

    .badge-needs {
      background: #fecaca;
      color: #991b1b;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .action-btn {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
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
      border-radius: 8px;
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
      padding: 8px 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
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
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
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
    <div class="dashboard-header">
      <div class="header-content">
      <h1>Student Management</h1>
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
        <th>Latest Score</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1001</td>
        <td>
        <div class="student-info">
          <div class="student-avatar avatar-blue">EB</div>
          <div class="student-name">Emma Brown</div>
        </div>
        </td>
        <td>Grade 7 - Section Narra</td>
        <td><span class="badge badge-excellent">Excellent</span></td>
        <td>95/100</td>
        <td>
        <div class="action-buttons">
          <a href="{{ route('teacher.view') }}" class="action-btn btn-view">View</a>
          <a href="{{ route('teacher.passage') }}" class="action-btn btn-assess"> Completed</a>
        </div>
        </td>
      </tr>
      <tr>
        <td>1002</td>
        <td>
        <div class="student-info">
          <div class="student-avatar avatar-green">JD</div>
          <div class="student-name">James Davis</div>
        </div>
        </td>
        <td>Grade 7 - Section Lawaan</td>
        <td><span class="badge badge-good">Good</span></td>
        <td>88/100</td>
        <td>
        <div class="action-buttons">
          <a href="{{ route('teacher.view') }}" class="action-btn btn-view">View</a>
          <a href="{{ route('teacher.passage') }}" class="action-btn btn-assess">Incomplete</a>

        </div>
        </td>
      </tr>
      <tr>
        <td>1003</td>
        <td>
        <div class="student-info">
          <div class="student-avatar avatar-orange">OT</div>
          <div class="student-name">Olivia Thompson</div>
        </div>
        </td>
        <td>Grade 8 - Section Dao</td>
        <td><span class="badge badge-excellent">Excellent</span></td>
        <td>96/100</td>
        <td>
        <div class="action-buttons">
          <a href="{{ route('teacher.view') }}" class="action-btn btn-view">View</a>
          <a href="{{ route('teacher.passage') }}" class="action-btn btn-assess">Incomplete</a>
        </div>
        </td>
      </tr>
      <tr>
        <td>1004</td>
        <td>
        <div class="student-info">
          <div class="student-avatar avatar-purple">MS</div>
          <div class="student-name">Michael Smith</div>
        </div>
        </td>
        <td>Grade 9 - Section Zinc</td>
        <td><span class="badge badge-average">Average</span></td>
        <td>75/100</td>
        <td>
        <div class="action-buttons">
          <a href="{{ route('teacher.view') }}" class="action-btn btn-view">View</a>
          <a href="{{ route('teacher.passage') }}" class="action-btn btn-assess">Completed</a>
        </div>
        </td>
      </tr>
      <tr>
        <td>1005</td>
        <td>
        <div class="student-info">
          <div class="student-avatar avatar-pink">SJ</div>
          <div class="student-name">Sarah Johnson</div>
        </div>
        </td>
        <td>Grade 10 - Section Newton</td>
        <td><span class="badge badge-good">Good</span></td>
        <td>89/100</td>
        <td>
        <div class="action-buttons">
          <a href="{{ route('teacher.view') }}" class="action-btn btn-view">View</a>
          <a href="{{ route('teacher.passage') }}" class="action-btn btn-assess">Completed</a>
        </div>
        </td>
      </tr>
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