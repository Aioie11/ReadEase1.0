@extends('layouts.head-tech')

@section('title', 'Grade Management')

@section('content')
  <!-- Main Content -->
  <div class="main-content">
    <style>
    /* Grade Management Page Styles */
    .page {
      padding: 40px;
      background: #f8fafc;
      min-height: 100vh;
    }

    .welcome-message {
      background: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
      border: 1px solid #e2e8f0;
      text-align: center;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .welcome-message:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .welcome-content h2 {
      text-align: left;
      color: #00B8A9;
      font-size: 2em;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .welcome-content p {
      text-align: left;
      color: #64748b;
      font-size: 1.1rem;
      margin: 0;
      max-width: 600px;
      line-height: 1.6;
    }

    /* Promotion Controls */
    .promotion-controls {
      background: white;
      padding: 25px 30px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
      border: 1px solid #e2e8f0;
      position: sticky;
      top: 20px;
      z-index: 100;
      backdrop-filter: blur(10px);
    }

    .promotion-form {
      display: flex;
      align-items: center;
      gap: 25px;
      flex-wrap: wrap;
    }

    .selected-count {
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      padding: 12px 20px;
      border-radius: 25px;
      font-weight: 600;
      font-size: 0.95em;
      box-shadow: 0 4px 15px rgba(0, 184, 169, 0.3);
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-weight: 600;
      color: #334155;
      font-size: 0.9em;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-group select {
      padding: 12px 18px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 0.95em;
      min-width: 160px;
      background: white;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .form-group select:focus {
      outline: none;
      border-color: #00B8A9;
      box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
    }

    .promote-btn {
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      border: none;
      padding: 14px 28px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 0.95em;
      box-shadow: 0 4px 15px rgba(0, 184, 169, 0.3);
    }

    .promote-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 184, 169, 0.4);
    }

    .promote-btn:disabled {
      background: #94a3b8;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    /* Grade Container Styles */
    .grade-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
      border: 1px solid #e2e8f0;
      overflow: hidden;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .grade-container:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .grade-header {
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      padding: 25px 30px;
      font-size: 1.5em;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 15px;
      position: relative;
    }

    .grade-header i {
      font-size: 1.3em;
      opacity: 0.9;
    }

    .grade-header .student-count {
      background: rgba(255, 255, 255, 0.2);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: 600;
      margin-left: auto;
    }

    .grade-content {
      padding: 0;
    }

    /* Section Container Styles */
    .section-container {
      margin: 0;
      border: none;
      border-radius: 0;
      background: transparent;
      position: relative;
    }

    .section-container:not(:last-child) {
      border-bottom: 2px solid #f1f5f9;
    }

    .section-header {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      padding: 20px 30px;
      border: none;
      border-radius: 0;
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 600;
      color: #475569;
      font-size: 1.1em;
      border-left: 4px solid #00B8A9;
    }

    .section-header i {
      color: #00B8A9;
      font-size: 1.2em;
    }

    .section-name {
      font-size: 1.2em;
      flex-grow: 1;
      font-weight: 700;
    }

    .section-count {
      background: #e2e8f0;
      color: #475569;
      padding: 6px 12px;
      border-radius: 15px;
      font-size: 0.85em;
      font-weight: 600;
    }

    .section-students {
      padding: 25px 30px;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 20px;
      background: #fafbfc;
    }

    .empty-section {
      text-align: center;
      padding: 40px 20px;
      color: #94a3b8;
      font-style: italic;
      background: #f8fafc;
    }

    .empty-section i {
      font-size: 2.5em;
      margin-bottom: 15px;
      display: block;
      opacity: 0.4;
      color: #cbd5e1;
    }

    .empty-section p {
      font-size: 1.1em;
      margin: 0;
    }

    /* Student Card Styles */
    .student-card {
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      padding: 20px;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      overflow: hidden;
    }

    .student-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .student-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
      border-color: #00B8A9;
    }

    .student-card:hover::before {
      transform: scaleX(1);
    }

    .student-card.selected {
      background: #f0fdfa;
      border-color: #00B8A9;
      box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.15);
    }

    .student-card.selected::before {
      transform: scaleX(1);
    }

    .student-info {
      display: flex;
      align-items: center;
      gap: 18px;
      margin-bottom: 18px;
    }

    .student-avatar {
      width: 55px;
      height: 55px;
      border-radius: 50%;
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1.2em;
      box-shadow: 0 4px 15px rgba(0, 184, 169, 0.3);
    }

    .student-details h4 {
      margin: 0;
      color: #1e293b;
      font-size: 1.1em;
      font-weight: 700;
      line-height: 1.3;
    }

    .student-details p {
      margin: 6px 0 0 0;
      color: #64748b;
      font-size: 0.9em;
      font-weight: 500;
    }

    .student-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.85em;
      color: #64748b;
      font-weight: 600;
    }

    .section-badge {
      background: #e2e8f0;
      color: #475569;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.8em;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .grade-badge {
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.8em;
    }

    .edit-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #64748b;
      color: white;
      border: none;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 0.9em;
      opacity: 0;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .student-card:hover .edit-btn {
      opacity: 1;
    }

    .edit-btn:hover {
      background: #00B8A9;
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(0, 184, 169, 0.4);
    }

    .empty-grade {
      text-align: center;
      padding: 60px 40px;
      color: #94a3b8;
      margin: 0;
      background: #f8fafc;
    }

    .empty-grade i {
      font-size: 3.5em;
      margin-bottom: 20px;
      display: block;
      opacity: 0.3;
      color: #cbd5e1;
    }

    .empty-grade p {
      font-size: 1.2em;
      margin: 0;
      font-weight: 500;
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
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(5px);
    }

    .modal-content {
      background-color: white;
      margin: 8% auto;
      padding: 0;
      border-radius: 16px;
      width: 90%;
      max-width: 600px;
      max-height: 85vh;
      overflow-y: auto;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      animation: modalSlideIn 0.3s ease;
      scrollbar-width: thin;
      scrollbar-color: #cbd5e1 #f1f5f9;
    }

    .modal-content::-webkit-scrollbar {
      width: 8px;
    }

    .modal-content::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 4px;
    }

    .modal-content::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }

    @keyframes modalSlideIn {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      padding: 20px 25px;
      border-radius: 16px 16px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .modal-header h3 {
      margin: 0;
      font-size: 1.4em;
      font-weight: 700;
    }

    .close {
      color: white;
      font-size: 32px;
      font-weight: bold;
      cursor: pointer;
      line-height: 1;
      opacity: 0.8;
      transition: opacity 0.2s ease;
    }

    .close:hover {
      opacity: 1;
    }

    .modal-body {
      padding: 25px 30px;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-field.full-width {
      grid-column: 1 / -1;
    }

    /* Compact form styling */
    .modal-body form {
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    /* Optimize spacing for better organization */
    .form-row:last-child {
      margin-bottom: 0;
    }

    /* Make readonly fields visually distinct */
    .form-field input[readonly] {
      background-color: #f8fafc;
      color: #64748b;
      cursor: not-allowed;
      border-color: #cbd5e1;
    }

    .form-field label {
      font-weight: 600;
      color: #334155;
      font-size: 0.9em;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 2px;
    }

    .form-field input,
    .form-field select {
      padding: 12px 16px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 0.95em;
      transition: all 0.2s ease;
      background: white;
    }

    .form-field input:focus,
    .form-field select:focus {
      outline: none;
      border-color: #00B8A9;
      box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
    }

    .form-field input[readonly] {
      background-color: #f8fafc;
      color: #64748b;
      cursor: not-allowed;
    }

    .modal-footer {
      padding: 20px 30px;
      border-top: 2px solid #f1f5f9;
      display: flex;
      justify-content: flex-end;
      gap: 20px;
      background: #fafbfc;
      border-radius: 0 0 16px 16px;
      position: sticky;
      bottom: 0;
      z-index: 10;
    }

    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 0.95em;
    }

    .btn-secondary {
      background: #64748b;
      color: white;
    }

    .btn-secondary:hover {
      background: #475569;
      transform: translateY(-1px);
    }

    .btn-primary {
      background: linear-gradient(135deg, #00B8A9 0%, #00A693 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(0, 184, 169, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(0, 184, 169, 0.4);
    }

    .btn:disabled {
      background: #94a3b8;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .page {
        padding: 30px 20px;
      }
      
      .section-students {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 15px;
        padding: 20px;
      }

      .modal-content {
        max-width: 550px;
        margin: 3% auto;
      }

      .modal-body {
        padding: 20px 25px;
      }

      .form-row {
        gap: 18px;
        margin-bottom: 18px;
      }
    }

    @media (max-width: 768px) {
      .page {
        padding: 20px 15px;
      }

      .welcome-message {
        padding: 25px 20px;
        margin-bottom: 30px;
      }

      .welcome-content h2 {
        font-size: 1.6em;
      }

      .promotion-controls {
        padding: 20px;
        margin-bottom: 30px;
      }

      .promotion-form {
        flex-direction: column;
        align-items: stretch;
        gap: 20px;
      }

      .grade-header {
        padding: 20px;
        font-size: 1.3em;
      }

      .section-header {
        padding: 15px 20px;
        font-size: 1em;
      }

      .section-students {
        grid-template-columns: 1fr;
        padding: 20px;
        gap: 15px;
      }

      .student-card {
        padding: 18px;
      }

      .form-row {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .modal-content {
        width: 95%;
        margin: 5% auto;
        max-height: 90vh;
      }

      .modal-body {
        padding: 20px 20px;
      }

      .modal-header {
        padding: 18px 20px;
      }

      .modal-footer {
        padding: 18px 20px;
      }

      .modal-footer {
        padding: 20px;
        flex-direction: column;
      }

      .btn {
        width: 100%;
        text-align: center;
      }
    }

    @media (max-width: 480px) {
      .page {
        padding: 15px 10px;
      }

      .welcome-message {
        padding: 20px 15px;
      }

      .grade-header {
        padding: 15px;
        font-size: 1.2em;
      }

      .section-header {
        padding: 12px 15px;
      }

      .section-students {
        padding: 15px;
      }

      .student-card {
        padding: 15px;
      }

      .student-info {
        gap: 12px;
      }

      .student-avatar {
        width: 45px;
        height: 45px;
        font-size: 1em;
      }
    }
    </style>

    <!-- Minimal professional theme overrides -->
    <style>
      /* Keep layout spacing but simplify visuals */
      .welcome-message { box-shadow: none; border: 1px solid #e5e7eb; }
      .welcome-message:hover { transform: none; box-shadow: none; }

      .grade-container { box-shadow: none; border: 1px solid #e5e7eb; }
      .grade-container:hover { transform: none; box-shadow: none; }

      .grade-header { background: #ffffff; color: #111827; border-bottom: 1px solid #e5e7eb; }
      .grade-header i { color: #6b7280; }
      .grade-header .student-count { background: #f3f4f6; color: #374151; }

      .section-header { background: #ffffff; color: #374151; border-left: 4px solid #111827; }
      .section-count { background: #f3f4f6; color: #374151; }

      .promotion-controls { backdrop-filter: none; border: 1px solid #e5e7eb; }
      .promote-btn { background: #111827; color: #ffffff; box-shadow: none; }
      .promote-btn:hover { transform: none; background: #1f2937; }
      .promote-btn:disabled { background: #9ca3af; }

      .btn-primary { background: #111827; color: #ffffff; box-shadow: none; }
      .btn-primary:hover { transform: none; background: #1f2937; box-shadow: none; }
      .btn-secondary { background: #6b7280; }
      .btn-secondary:hover { background: #4b5563; transform: none; }

      .student-card { box-shadow: none; border-color: #e5e7eb; }
      .student-card:hover { transform: none; border-color: #d1d5db; box-shadow: none; }
      .student-card::before { display: none; }
      .student-card.selected { background: #f9fafb; box-shadow: none; }

      .section-badge { background: #f3f4f6; color: #374151; }
      .grade-badge { background: #111827; color: #ffffff; }

      .edit-btn { box-shadow: none; background: #6b7280; }
      .edit-btn:hover { background: #374151; transform: none; box-shadow: none; }
    </style>

    <!-- Grade Management Content -->
    <div class="page">
      <div class="welcome-message">
        <div class="welcome-content">
          <h2>Grade Management</h2>
          <p>Organize and manage student grade levels, sections, and promote students to the next grade level efficiently</p>
        </div>
      </div>

      <!-- Promotion Controls -->
      <div class="promotion-controls" id="promotionControls" style="display: none;">
        <div class="promotion-form">
          <div class="selected-count" id="selectedCount">0 students selected</div>
          
          <div class="form-group">
            <label for="newGrade">Promote to Grade:</label>
            <select id="newGrade" name="new_grade">
              <option value="">Select Grade</option>
              <option value="7">Grade 7</option>
              <option value="8">Grade 8</option>
              <option value="9">Grade 9</option>
              <option value="10">Grade 10</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="newSection">Section:</label>
            <select id="newSection" name="new_section">
              <option value="">Select Section</option>
            </select>
          </div>
          
          <button type="button" class="promote-btn" id="promoteBtn" disabled>
            <i class="fas fa-graduation-cap"></i> Promote Selected Students
          </button>
        </div>
      </div>

      <!-- Students by Grade and Section -->
      @php
        $gradeSections = [
          7 => ['Narra', 'Lawaan', 'Dao', 'Mahugani'],
          8 => ['Avocado', 'Duhat', 'Mango', 'Guava'],
          9 => ['Gold', 'Zinc', 'Silver'],
          10 => ['Galileo', 'Newton', 'Edison']
        ];
      @endphp

      @foreach([7, 8, 9, 10] as $grade)
        <div class="grade-container">
          <div class="grade-header">
            <i class="fas fa-graduation-cap"></i>
            Grade {{ $grade }}
            @if(isset($studentsByGrade[$grade]))
              <span class="student-count">{{ $studentsByGrade[$grade]->count() }} students</span>
            @else
              <span class="student-count">0 students</span>
            @endif
          </div>

          <div class="grade-content">
            @if(isset($studentsByGrade[$grade]) && $studentsByGrade[$grade]->count() > 0)
              @foreach($gradeSections[$grade] as $section)
                @php
                  $sectionStudents = $studentsByGrade[$grade]->where('section', $section);
                @endphp

                <div class="section-container">
                  <div class="section-header">
                    <i class="fas fa-users"></i>
                    <span class="section-name">Section {{ $section }}</span>
                    <span class="section-count">{{ $sectionStudents->count() }} students</span>
                  </div>

                  @if($sectionStudents->count() > 0)
                    <div class="section-students">
                      @foreach($sectionStudents as $student)
                        <div class="student-card" data-student-id="{{ $student->id }}" data-current-grade="{{ $student->grade_level }}">
                          <button class="edit-btn" onclick="event.stopPropagation(); openEditModal({{ $student->id }}, '{{ $student->first_name }}', '{{ $student->last_name }}', '{{ $student->middle_name }}', '{{ $student->gender }}', {{ $student->grade_level }}, '{{ $student->section }}', '{{ $student->student_number }}')">
                            <i class="fas fa-edit"></i>
                          </button>
                          <div class="student-info">
                            <div class="student-avatar">
                              {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                            </div>
                            <div class="student-details">
                              <h4>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</h4>
                              <p>Student ID: {{ $student->student_number }}</p>
                            </div>
                          </div>
                          <div class="student-meta">
                            <span class="section-badge">{{ $student->section }}</span>
                            <span class="grade-badge">Grade {{ $student->grade_level }}</span>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="empty-section">
                      <i class="fas fa-user-slash"></i>
                      <p>No students in Section {{ $section }}</p>
                    </div>
                  @endif
                </div>
              @endforeach
            @else
              <div class="empty-grade">
                <i class="fas fa-users"></i>
                <p>No students enrolled in Grade {{ $grade }}</p>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Edit Student Modal -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3><i class="fas fa-user-edit"></i> Edit Student Information</h3>
        <span class="close" onclick="closeEditModal()">&times;</span>
      </div>
      <div class="modal-body">
        <form id="editStudentForm">
          <input type="hidden" id="editStudentId" name="student_id">

          <div class="form-row">
            <div class="form-field">
              <label for="editFirstName">First Name</label>
              <input type="text" id="editFirstName" name="first_name" required>
            </div>
            <div class="form-field">
              <label for="editLastName">Last Name</label>
              <input type="text" id="editLastName" name="last_name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-field">
              <label for="editMiddleName">Middle Name</label>
              <input type="text" id="editMiddleName" name="middle_name">
            </div>
            <div class="form-field">
              <label for="editGender">Gender</label>
              <select id="editGender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-field">
              <label for="editGradeLevel">Grade Level</label>
              <select id="editGradeLevel" name="grade_level" required>
                <option value="">Select Grade</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
              </select>
            </div>
            <div class="form-field">
              <label for="editSection">Section</label>
              <select id="editSection" name="section" required>
                <option value="">Select Section</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-field full-width">
              <label for="editStudentNumber">Student ID</label>
              <input type="text" id="editStudentNumber" name="student_number" readonly>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveStudentBtn" onclick="saveStudent()">
          <i class="fas fa-save"></i> Save Changes
        </button>
      </div>
    </div>
  </div>

  <script>
    // Grade-section mapping
    const gradeSectionMapping = {
      7: ['Narra', 'Lawaan', 'Dao', 'Mahugani'],
      8: ['Avocado', 'Duhat', 'Mango', 'Guava'],
      9: ['Gold', 'Zinc', 'Silver'],
      10: ['Galileo', 'Newton', 'Edison']
    };



    let selectedStudents = [];

    document.addEventListener('DOMContentLoaded', function() {

      
      const studentCards = document.querySelectorAll('.student-card');
      const promotionControls = document.getElementById('promotionControls');
      const selectedCount = document.getElementById('selectedCount');
      const newGradeSelect = document.getElementById('newGrade');
      const newSectionSelect = document.getElementById('newSection');
      const promoteBtn = document.getElementById('promoteBtn');

      // Handle student card selection
      studentCards.forEach(card => {
        card.addEventListener('click', function() {
          const studentId = parseInt(this.dataset.studentId);
          const currentGrade = parseInt(this.dataset.currentGrade);

          if (this.classList.contains('selected')) {
            // Deselect
            this.classList.remove('selected');
            selectedStudents = selectedStudents.filter(s => s.id !== studentId);
          } else {
            // Select
            this.classList.add('selected');
            selectedStudents.push({
              id: studentId,
              currentGrade: currentGrade,
              element: this
            });
          }

          updatePromotionControls();
        });
      });

      // Handle grade selection change
      newGradeSelect.addEventListener('change', function() {
        const selectedGrade = this.value;
        updateSectionOptions(selectedGrade);
        updatePromoteButton();
      });

      // Handle section selection change
      newSectionSelect.addEventListener('change', function() {
        updatePromoteButton();
      });

      // Handle promote button click
      promoteBtn.addEventListener('click', function() {
        if (selectedStudents.length === 0) return;

        const newGrade = newGradeSelect.value;
        const newSection = newSectionSelect.value;

        if (!newGrade || !newSection) {
          alert('Please select both grade and section.');
          return;
        }

        // Confirm promotion
        const studentNames = selectedStudents.map(s => {
          const nameElement = s.element.querySelector('.student-details h4');
          return nameElement.textContent;
        }).join(', ');

        if (confirm(`Are you sure you want to promote the following students to Grade ${newGrade} (${newSection})?\n\n${studentNames}`)) {
          promoteStudents();
        }
      });

      function updatePromotionControls() {
        if (selectedStudents.length > 0) {
          promotionControls.style.display = 'block';
          selectedCount.textContent = `${selectedStudents.length} student${selectedStudents.length > 1 ? 's' : ''} selected`;

          // Set default grade to next grade for selected students
          const currentGrades = [...new Set(selectedStudents.map(s => s.currentGrade))];
          if (currentGrades.length === 1 && currentGrades[0] < 10) {
            newGradeSelect.value = currentGrades[0] + 1;
            updateSectionOptions(currentGrades[0] + 1);
          } else {
            newGradeSelect.value = '';
            updateSectionOptions('');
          }
        } else {
          promotionControls.style.display = 'none';
          newGradeSelect.value = '';
          updateSectionOptions('');
        }
        updatePromoteButton();
      }

      function updateSectionOptions(grade) {
        newSectionSelect.innerHTML = '<option value="">Select Section</option>';

        if (grade && gradeSectionMapping[grade]) {
          gradeSectionMapping[grade].forEach(section => {
            const option = document.createElement('option');
            option.value = section;
            option.textContent = section;
            newSectionSelect.appendChild(option);
          });
        }
      }

      function updatePromoteButton() {
        const hasSelection = selectedStudents.length > 0;
        const hasGrade = newGradeSelect.value !== '';
        const hasSection = newSectionSelect.value !== '';

        promoteBtn.disabled = !(hasSelection && hasGrade && hasSection);
      }
    });

    function promoteStudents() {
      // Query needed elements locally to avoid scope issues
      const newGradeSelect = document.getElementById('newGrade');
      const newSectionSelect = document.getElementById('newSection');
      const promoteBtn = document.getElementById('promoteBtn');
      const promotionControls = document.getElementById('promotionControls');
      const selectedCount = document.getElementById('selectedCount');

      const newGrade = newGradeSelect ? newGradeSelect.value : '';
      const newSection = newSectionSelect ? newSectionSelect.value : '';

      if (!newGrade || !newSection || selectedStudents.length === 0) {
        return;
      }

      promoteBtn.disabled = true;
      promoteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Promoting...';

      // Promote students one by one
      let promotedCount = 0;
      let errors = [];

      selectedStudents.forEach((student, index) => {
        fetch('{{ route("teacher.promote-student") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            student_id: student.id,
            new_grade: parseInt(newGrade),
            new_section: newSection
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            promotedCount++;
            // Remove student card from current grade
            student.element.remove();
          } else {
            errors.push(`${student.element.querySelector('.student-details h4').textContent}: ${data.message}`);
          }
        })
        .catch(() => {
          errors.push(`${student.element.querySelector('.student-details h4').textContent}: Network error`);
        })
        .finally(() => {
          // After last request completes
          if (index === selectedStudents.length - 1) {
            setTimeout(() => {
              if (promotedCount > 0) {
                alert(`Successfully promoted ${promotedCount} student${promotedCount > 1 ? 's' : ''} to Grade ${newGrade} (${newSection}).`);
              }

              if (errors.length > 0) {
                alert(`Errors occurred:\n${errors.join('\n')}`);
              }

              // Reset UI without relying on inner-scoped helpers
              selectedStudents = [];
              // Clear any selected card state just in case
              document.querySelectorAll('.student-card.selected').forEach(el => el.classList.remove('selected'));
              if (promotionControls) promotionControls.style.display = 'none';
              if (selectedCount) selectedCount.textContent = '0 students selected';
              if (newGradeSelect) newGradeSelect.value = '';
              if (newSectionSelect) {
                newSectionSelect.innerHTML = '<option value="">Select Section</option>';
              }
              if (promoteBtn) {
                promoteBtn.disabled = true;
                promoteBtn.innerHTML = '<i class="fas fa-graduation-cap"></i> Promote Selected Students';
              }

              // Refresh page to show updated data
              if (promotedCount > 0) {
                window.location.reload();
              }
            }, 500);
          }
        });
      });
    }

    // Edit Modal Functions
    let editModalInitialized = false;

    function openEditModal(studentId, firstName, lastName, middleName, gender, gradeLevel, section, studentNumber) {
      document.getElementById('editStudentId').value = studentId;
      document.getElementById('editFirstName').value = firstName;
      document.getElementById('editLastName').value = lastName;
      document.getElementById('editMiddleName').value = middleName || '';
      document.getElementById('editGender').value = gender;
      document.getElementById('editGradeLevel').value = gradeLevel;
      document.getElementById('editStudentNumber').value = studentNumber;

      // Update section options based on grade
      updateEditSectionOptions(gradeLevel);
      document.getElementById('editSection').value = section;

      // Add event listener for grade level changes only once
      if (!editModalInitialized) {
        const editGradeLevelSelect = document.getElementById('editGradeLevel');
        if (editGradeLevelSelect) {
          editGradeLevelSelect.addEventListener('change', function() {
            const newGrade = this.value;
            updateEditSectionOptions(newGrade);
            // Clear section selection when grade changes
            document.getElementById('editSection').value = '';
          });
          editModalInitialized = true;
        }
      }

      document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
      document.getElementById('editModal').style.display = 'none';
    }

    function updateEditSectionOptions(grade) {
      const editSectionSelect = document.getElementById('editSection');
      if (!editSectionSelect) {
        return;
      }
      
      editSectionSelect.innerHTML = '<option value="">Select Section</option>';

      // Convert grade to number if it's a string
      const gradeNum = parseInt(grade);
      
      if (gradeNum && gradeSectionMapping[gradeNum]) {
        gradeSectionMapping[gradeNum].forEach(section => {
          const option = document.createElement('option');
          option.value = section;
          option.textContent = section;
          editSectionSelect.appendChild(option);
        });
      } else {
        // If grade is invalid, ensure section is cleared
        editSectionSelect.value = '';
      }
    }

    function saveStudent() {
      const form = document.getElementById('editStudentForm');
      const formData = new FormData(form);
      const saveBtn = document.getElementById('saveStudentBtn');

      // Validate required fields
      const requiredFields = ['first_name', 'last_name', 'gender', 'grade_level', 'section'];
      for (let field of requiredFields) {
        if (!formData.get(field)) {
          alert(`Please fill in the ${field.replace('_', ' ')} field.`);
          return;
        }
      }

      saveBtn.disabled = true;
      saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

      const data = {
        student_id: parseInt(formData.get('student_id')),
        first_name: formData.get('first_name'),
        last_name: formData.get('last_name'),
        middle_name: formData.get('middle_name'),
        gender: formData.get('gender'),
        grade_level: parseInt(formData.get('grade_level')),
        section: formData.get('section')
      };

      fetch('{{ route("teacher.update-student") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          closeEditModal();
          window.location.reload(); // Refresh to show updated data
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        alert('Network error occurred while saving student information.');
        console.error('Error:', error);
      })
      .finally(() => {
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Changes';
      });
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
      const modal = document.getElementById('editModal');
      if (event.target === modal) {
        closeEditModal();
      }
    }
  </script>
@endsection
