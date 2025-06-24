@extends('layouts.head-ad')

@section('title', 'Student Record')

@section('content')
<style>
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--neutral-light);
        }

        /* Main Content - AdminDashboard Style */
        .main-content {
            margin-top: 60px;
            padding: 50px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Dashboard Container - AdminDashboard Style */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1rem;
        }

        /* Search Section - AdminDashboard Style */
        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .search-box {
            flex: 1;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px;
            padding-right: 3rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-box input:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
        }

        .search-box button {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
        }

        .search-box button:hover {
            color: #00B8A9;
        }

        .add-student-btn {
            padding: 12px 24px;
            background: #00B8A9;
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .add-student-btn:hover {
            background: #009688;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Masterlist Section - Exact AdminDashboard Style */
        .masterlist-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .masterlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .masterlist-header h2 {
            color: #2c3e50;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .masterlist-header h2 i {
            color: #00B8A9;
        }

        /* Grade Section - Beautiful Design */
        .grade-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .grade-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .grade-header {
            background: linear-gradient(135deg, #00B8A9, #009688);
            color: white;
            padding: 1.5rem 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border: none;
        }

        .grade-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .grade-header:hover::before {
            left: 100%;
        }

        .grade-header:hover {
            background: linear-gradient(135deg, #009688, #00796b);
        }

        .grade-title {
            color: white;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .grade-title i {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .student-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .grade-header span {
            font-size: 1.3rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .grade-header i {
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .grade-header.collapsed i {
            transform: rotate(-90deg);
        }

        .grade-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .grade-stats .stat-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .student-list {
            display: none;
            padding: 1rem;
        }

        .student-list.active {
            display: block;
        }

        .grade-content {
            padding: 2rem;
            background: #f8f9fa;
        }

        .section-group {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .section-group:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-1px);
        }

        .section-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border-bottom: 1px solid #e9ecef;
        }

        .section-header:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
        }

        .section-title {
            color: #00B8A9;
            font-size: 1.3rem;
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-title i {
            color: #00B8A9;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Section Name Styling - Green and Bold */
        .section-name {
            color: #00B8A9 !important;
            font-size: 1.3rem !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-header span {
            font-size: 1.1rem;
            letter-spacing: 0.3px;
        }

        .section-header i {
            transition: transform 0.3s ease;
            font-size: 1.1rem;
        }

        .section-header.collapsed i {
            transform: rotate(-90deg);
        }

        .section-stats {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .section-stats .stat-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 1rem;
        }

        .section-content {
            display: none;
            padding: 1.5rem;
            background: white;
        }

        .section-content.active {
            display: block;
        }

        /* Student Table - AdminDashboard Style */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .student-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #4A5568;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 20px;
            text-align: left;
        }

        .student-table td {
            padding: 16px 20px;
            text-align: left;
            color: #2c3e50;
            vertical-align: middle;
        }

        .student-table tbody tr:not(:last-child) {
            border-bottom: 1px solid #e9ecef;
        }

        .student-table tbody tr:hover {
            background-color: rgba(0, 184, 169, 0.05);
        }

        .student-name-cell {
            font-weight: 600;
            color: var(--primary);
        }

        .student-number {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.2rem;
        }

        .gender-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .gender-badge.male {
            background: #dbeafe;
            color: #1e40af;
        }

        .gender-badge.female {
            background: #fce7f3;
            color: #be185d;
        }

        /* Summary Statistics - AdminDashboard Style */
        .summary-section {
            margin-bottom: 2rem;
        }

        .summary-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #00B8A9;
            color: white !important;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .stat-icon i {
            color: white !important;
            font-size: 1.3rem;
            display: block;
            line-height: 1;
        }

        .stat-icon.total {
            background: #00B8A9;
        }

        .stat-icon.male {
            background: #3498db;
        }

        .stat-icon.female {
            background: #e74c3c;
        }

        .stat-icon.sections {
            background: #9b59b6;
        }

        /* Additional Icon Stability */
        .search-box button i {
            color: #7f8c8d !important;
            font-size: 1rem;
            display: block;
            line-height: 1;
        }

        .add-student-btn i {
            color: white !important;
            font-size: 1rem;
            display: block;
            line-height: 1;
        }

        .edit-btn i, .delete-btn i {
            font-size: 0.9rem;
            display: block;
            line-height: 1;
        }

        .expand-all-btn i, .collapse-all-btn i {
            font-size: 0.9rem;
            display: block;
            line-height: 1;
        }

        .stat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
            margin: 0;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #6c757d;
            margin: 0;
            font-weight: 500;
            text-transform: capitalize;
        }

        /* Specific colors for each stat type */
        .stat-card.total .stat-number {
            color: #00B8A9;
        }

        .stat-card.male .stat-number {
            color: #3498db;
        }

        .stat-card.female .stat-number {
            color: #e74c3c;
        }

        .stat-card.sections .stat-number {
            color: #00B8A9;
        }

        /* Masterlist Controls */
        .masterlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem 0;
            border-bottom: 2px solid var(--primary);
        }

        .masterlist-controls {
            display: flex;
            gap: 0.8rem;
        }

        .expand-all-btn, .collapse-all-btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .expand-all-btn {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
        }

        .expand-all-btn:hover {
            background: linear-gradient(135deg, #229954, #1e8449);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .collapse-all-btn {
            background: linear-gradient(135deg, #e67e22, #d35400);
            color: white;
        }

        .collapse-all-btn:hover {
            background: linear-gradient(135deg, #d35400, #ba4a00);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
        }

        /* Modal Styles - Modern Design */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1002;
            overflow-y: auto;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-content {
            position: relative;
            background: white;
            margin: 2rem auto;
            padding: 0;
            width: 90%;
            max-width: 700px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-height: 90vh;
            overflow: hidden;
            animation: slideIn 0.4s ease-out;
        }

        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: var(--neutral);
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        .close, .close-modal {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            z-index: 10;
            font-weight: bold;
        }

        .close:hover, .close-modal:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: rotate(90deg);
        }

        /* Modal Header - Gradient Design */
        .modal-header {
            background: linear-gradient(135deg, #00B8A9, #009688);
            padding: 2rem;
            text-align: center;
            position: relative;
            border-radius: 20px 20px 0 0;
        }

        .modal-header h2 {
            margin: 0;
            color: white;
            font-size: 1.6rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .modal-header h2::before {
            content: '🎓';
            font-size: 1.4rem;
        }

        /* Modal Body */
        .modal-body {
            padding: 2rem;
            max-height: 60vh;
            overflow-y: auto;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #2c3e50;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00B8A9;
            box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
            transform: translateY(-1px);
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding: 2rem;
            background: #f8f9fa;
            margin: 0 -2rem -2rem -2rem;
            border-radius: 0 0 20px 20px;
        }

        .button-group button {
            padding: 12px 30px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .save-btn {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
        }

        .save-btn::before {
            content: '✓';
            font-size: 0.9rem;
        }

        .save-btn:hover {
            background: linear-gradient(135deg, #229954, #1e8449);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .clear-btn {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .clear-btn::before {
            content: '🗑';
            font-size: 0.9rem;
        }

        .clear-btn:hover {
            background: linear-gradient(135deg, #e67e22, #d35400);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }

        .cancel-btn {
            background: #6c757d;
            color: white;
        }

        .cancel-btn::before {
            content: '✕';
            font-size: 0.9rem;
        }

        .cancel-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        /* Menu Toggle Button */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--neutral-light);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Responsive Design - AdminDashboard Style */
        @media (max-width: 1200px) {
            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .dashboard-container {
                padding-top: 0;
            }

            .search-section {
                flex-direction: column;
                padding: 1.5rem;
            }

            .summary-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .masterlist-section {
                padding: 1.5rem;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .student-table th,
            .student-table td {
                padding: 12px 8px;
                font-size: 0.85rem;
            }
        }

        /* Add these styles to your existing CSS */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .edit-btn {
            background: linear-gradient(135deg, #00B8A9, #009688);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .edit-btn:hover {
            background: linear-gradient(135deg, #009688, #00796b);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 184, 169, 0.3);
        }

        .delete-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .delete-btn:hover {
            background: linear-gradient(135deg, #c0392b, #a93226);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        /* Confirmation Modal Styles */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1002;
        }

        .confirmation-content {
            position: relative;
            background: var(--neutral-light);
            margin: 15% auto;
            padding: 2rem;
            width: 90%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .confirm-delete {
            background: #dc2626;
            color: var(--neutral-light);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .confirm-delete:hover {
            background: #b91c1c;
            transform: translateY(-2px);
        }

        .cancel-delete {
            background: var(--neutral);
            color: var(--text);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .cancel-delete:hover {
            background: var(--neutral-dark);
            transform: translateY(-2px);
        }

        /* Status Badges - Exact AdminDashboard Style */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-in-progress {
            background: #fef3c7;
            color: #92400e;
        }

        .status-not-started {
            background: #f3f4f6;
            color: #4b5563;
        }

        .status-icon {
            font-size: 0.8rem;
        }

        .student-table-scroll {
            max-height: 300px;
            overflow-y: auto;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-container">
            <!-- Search and Add Student Section -->
        <section class="search-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Find Student">
                <button onclick="searchStudents()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="add-student-btn" onclick="openAddStudentModal()">
                <i class="fas fa-plus"></i>
                Add Student
            </button>
        </section>

        <!-- Summary Statistics Section -->
        <section class="summary-section">
            @php
                $totalStudents = collect($students)->flatten()->count();
                $totalMale = collect($students)->flatten()->where('gender', 'Male')->count();
                $totalFemale = collect($students)->flatten()->where('gender', 'Female')->count();
                $totalSections = collect($students)->map(function($gradeStudents) {
                    return $gradeStudents->groupBy('section')->count();
                })->sum();
            @endphp

            <div class="summary-stats">
                <div class="stat-card total">
                    <div class="stat-icon total">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalStudents }}</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                </div>

                <div class="stat-card male">
                    <div class="stat-icon male">
                        <i class="fas fa-male"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalMale }}</div>
                        <div class="stat-label">Male Students</div>
                    </div>
                </div>

                <div class="stat-card female">
                    <div class="stat-icon female">
                        <i class="fas fa-female"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalFemale }}</div>
                        <div class="stat-label">Female Students</div>
                    </div>
                </div>

                <div class="stat-card sections">
                    <div class="stat-icon sections">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $totalSections }}</div>
                        <div class="stat-label">Total Sections</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Students Masterlist Section -->
        <section class="masterlist-section">
            <div class="masterlist-header">
                <h2>
                    <i class="fas fa-users"></i>
                    STUDENTS MASTERLIST
                </h2>
                <div class="masterlist-controls">
                    <button class="expand-all-btn" onclick="expandAll()">
                        <i class="fas fa-expand-arrows-alt"></i>
                        Expand All
                    </button>
                    <button class="collapse-all-btn" onclick="collapseAll()">
                        <i class="fas fa-compress-arrows-alt"></i>
                        Collapse All
                    </button>
                </div>
            </div>

            @foreach([7, 8, 9, 10] as $grade)
            <div class="grade-section">
                <div class="grade-header collapsed" onclick="toggleGrade('grade{{ $grade }}')">
                    <div>
                        <span>GRADE {{ $grade }}</span>
                        @if(isset($students[$grade]))
                            <div class="grade-stats">
                                <div class="stat-item">
                                    <span>{{ $students[$grade]->count() }} Students</span>
                                </div>
                                <div class="stat-item">
                                    <span>{{ $students[$grade]->groupBy('section')->count() }} Sections</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div id="grade{{ $grade }}" class="student-list">
                    @if(isset($students[$grade]) && count($students[$grade]))
                        @php
                            $sections = [];
                            switch($grade) {
                                case 7:
                                    $sections = ['Narra', 'Dao', 'Mahugani', 'Lawaan'];
                                    break;
                                case 8:
                                    $sections = ['Avocado', 'Guava', 'Duhat', 'Mango'];
                                    break;
                                case 9:
                                    $sections = ['Gold', 'Silver', 'Zinc'];
                                    break;
                                case 10:
                                    $sections = ['Galileo', 'Edison', 'Newton'];
                                    break;
                            }
                        @endphp

                        @foreach($sections as $section)
                            @php
                                $sectionStudents = $students[$grade]->where('section', $section);
                                $sectionCount = $sectionStudents->count();
                            @endphp
                            <div class="section-group">
                                <div class="section-header collapsed" onclick="toggleSection('section-{{ $grade }}-{{ $section }}')">
                                    <div>
                                        <span class="section-name">{{ $section }}</span>
                                        <div class="section-stats">
                                            <div class="stat-badge">
                                               
                                                {{ $sectionCount }} {{ $sectionCount == 1 ? 'Student' : 'Students' }}
                                            </div>
                                            @if($sectionCount > 0)
                                                @php
                                                    $maleCount = $sectionStudents->where('gender', 'Male')->count();
                                                    $femaleCount = $sectionStudents->where('gender', 'Female')->count();
                                                @endphp
                                                <div class="stat-badge">
                                                    <span style="color: #4FC3F7;">Male</span> {{ $maleCount }}
                                                    <span style="color: #F48FB1; margin-left: 0.3rem;">Female</span> {{ $femaleCount }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div id="section-{{ $grade }}-{{ $section }}" class="section-content">
                                    <div class="student-table-scroll">
                                        <table class="student-table">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Student Information</th>
                                                    <th>Gender</th>
                                                    <th>Test Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students[$grade]->where('section', $section)->sortBy('last_name') as $index => $student)
                                                    <tr>
                                                        <td style="font-weight: 600; color: var(--primary);">{{ $student->student_number }}</td>
                                                        <td class="student-name-cell">
                                                            <div>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</div>
                                                        </td>
                                                        <td>
                                                            <span class="gender-badge {{ strtolower($student->gender) }}">
                                                                <i class="fas fa-{{ $student->gender == 'Male' ? 'mars' : 'venus' }}"></i>
                                                                {{ $student->gender }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $status = $student->test_status ?? 'not_started';
                                                                $statusClass = '';
                                                                $statusText = '';
                                                                $statusIcon = '';
                                                                
                                                                switch($status) {
                                                                    case 'completed':
                                                                        $statusClass = 'status-completed';
                                                                        $statusText = 'Completed';
                                                                        $statusIcon = 'fa-check-circle';
                                                                        break;
                                                                    case 'in_progress':
                                                                        $statusClass = 'status-in-progress';
                                                                        $statusText = 'In Progress';
                                                                        $statusIcon = 'fa-clock';
                                                                        break;
                                                                    default:
                                                                        $statusClass = 'status-not-started';
                                                                        $statusText = 'Not Started';
                                                                        $statusIcon = 'fa-circle';
                                                                        break;
                                                                }
                                                            @endphp
                                                            <span class="status-badge {{ $statusClass }}">
                                                                <i class="fas {{ $statusIcon }} status-icon"></i>
                                                                {{ $statusText }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <button class="edit-btn" onclick="openEditModal('{{ $student->id }}', '{{ $student->last_name }}', '{{ $student->first_name }}', '{{ $student->middle_name }}', '{{ $student->gender }}', '{{ $student->grade_level }}', '{{ $student->section }}', '{{ $status }}')">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="delete-btn" onclick="confirmDelete('{{ $student->id }}', '{{ $student->last_name }}, {{ $student->first_name }}')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="padding: 1rem; color: var(--text-light);">No students in this grade.</div>
                    @endif
                </div>
            </div>
            @endforeach
        </section>

        <!-- Add Student Modal -->
        <div id="addStudentModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="closeModal('addStudentModal')">&times;</span>
                    <h2>Add New Student</h2>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="last_name" required placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="first_name" required placeholder="Enter first name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middle_name" placeholder="Enter middle name">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="gradeLevel">Grade Level</label>
                            <select id="gradeLevel" name="grade_level" required onchange="updateSections()">
                                <option value="">Select Grade Level</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="section">Section</label>
                            <select id="section" name="section" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="testStatus">Test Status</label>
                            <select id="testStatus" name="test_status" required>
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                        <div class="button-group">
                            <button type="button" class="clear-btn" onclick="clearForm()">Clear Form</button>
                            <button type="button" class="cancel-btn" onclick="closeModal('addStudentModal')">Cancel</button>
                            <button type="submit" class="save-btn">Save Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close-modal" onclick="closeModal('editModal')">&times;</span>
                    <h2>Edit Student Record</h2>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-student-id" name="student_id">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-lastName">Last Name</label>
                            <input type="text" id="edit-lastName" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-firstName">First Name</label>
                            <input type="text" id="edit-firstName" name="first_name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-middleName">Middle Name</label>
                            <input type="text" id="edit-middleName" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="edit-gender">Gender</label>
                            <select id="edit-gender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-gradeLevel">Grade Level</label>
                            <select id="edit-gradeLevel" name="grade_level" required onchange="updateEditSections()">
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-section">Section</label>
                            <select id="edit-section" name="section" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-testStatus">Test Status</label>
                            <select id="edit-testStatus" name="test_status" required>
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                        <div class="button-group">
                            <button type="button" class="cancel-btn" onclick="closeModal('editModal')">Cancel</button>
                            <button type="submit" class="save-btn">Update Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Confirmation Modal -->
        <div id="confirmationModal" class="confirmation-modal">
            <div class="confirmation-content">
                <h3>Confirm Delete</h3>
                <p>Are you sure you want to delete this student?</p>
                <p id="studentToDelete" style="font-weight: 500; margin: 1rem 0;"></p>
                <div class="confirmation-buttons">
                    <button class="cancel-delete" onclick="closeConfirmationModal()">Cancel</button>
                    <button class="confirm-delete" onclick="deleteStudent()">Delete</button>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script>
        // Toggle grade sections
        function toggleGrade(gradeId) {
            const gradeElement = document.getElementById(gradeId);
            const gradeHeader = gradeElement.previousElementSibling;

            gradeElement.classList.toggle('active');
            gradeHeader.classList.toggle('collapsed');

            // If closing the grade, also close all its sections
            if (!gradeElement.classList.contains('active')) {
                const sections = gradeElement.querySelectorAll('.section-content');
                const headers = gradeElement.querySelectorAll('.section-header');
                sections.forEach(section => section.classList.remove('active'));
                headers.forEach(header => header.classList.add('collapsed'));
            }
        }

        // Toggle section
        function toggleSection(sectionId) {
            const sectionElement = document.getElementById(sectionId);
            const sectionHeader = sectionElement.previousElementSibling;

            sectionElement.classList.toggle('active');
            sectionHeader.classList.toggle('collapsed');
        }

        // Expand all grades and sections
        function expandAll() {
            // Expand all grades
            document.querySelectorAll('.student-list').forEach(gradeList => {
                gradeList.classList.add('active');
            });
            document.querySelectorAll('.grade-header').forEach(header => {
                header.classList.remove('collapsed');
            });

            // Expand all sections
            document.querySelectorAll('.section-content').forEach(sectionContent => {
                sectionContent.classList.add('active');
            });
            document.querySelectorAll('.section-header').forEach(header => {
                header.classList.remove('collapsed');
            });
        }

        // Collapse all grades and sections
        function collapseAll() {
            // Collapse all sections first
            document.querySelectorAll('.section-content').forEach(sectionContent => {
                sectionContent.classList.remove('active');
            });
            document.querySelectorAll('.section-header').forEach(header => {
                header.classList.add('collapsed');
            });

            // Collapse all grades
            document.querySelectorAll('.student-list').forEach(gradeList => {
                gradeList.classList.remove('active');
            });
            document.querySelectorAll('.grade-header').forEach(header => {
                header.classList.add('collapsed');
            });
        }

        // Define sections for each grade level
        const gradeSections = {
            7: ['Narra', 'Dao', 'Mahugani', 'Lawaan'],
            8: ['Avocado', 'Guava', 'Duhat', 'Mango'],
            9: ['Gold', 'Silver', 'Zinc'],
            10: ['Galileo', 'Edison', 'Newton']
        };

        // Function to update sections based on selected grade
        function updateSections() {
            const gradeLevel = document.getElementById('gradeLevel').value;
            const sectionSelect = document.getElementById('section');
            
            // Clear existing options
            sectionSelect.innerHTML = '<option value="">Select Section</option>';
            
            // Add new options based on grade level
            if (gradeLevel && gradeSections[gradeLevel]) {
                gradeSections[gradeLevel].forEach(section => {
                    const option = document.createElement('option');
                    option.value = section;
                    option.textContent = section;
                    sectionSelect.appendChild(option);
                });
            }
        }

        // Modal functions
        function openAddStudentModal() {
            document.getElementById('addStudentModal').style.display = 'block';
            updateSections(); // Initialize sections for the default grade level
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function clearForm() {
            document.getElementById('addStudentForm').reset();
        }

        // Search functionality
        function searchStudents() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            
            // Get all student rows from all tables
            const allRows = document.querySelectorAll('.student-table tbody tr');
            
            // Hide all grade sections first
            document.querySelectorAll('.grade-section').forEach(gradeSection => {
                gradeSection.style.display = 'none';
            });
            
            // If search is empty, show all sections and return
            if (!query) {
                document.querySelectorAll('.grade-section').forEach(gradeSection => {
                    gradeSection.style.display = 'block';
                });
                return;
            }
            
            // Track which grade sections have matching students
            const matchingGrades = new Set();
            
            // Search through all rows
            allRows.forEach(row => {
                const nameCell = row.querySelector('.student-name-cell');
                const fullName = nameCell.textContent.toLowerCase();
                const studentNumber = row.querySelector('.student-number') ? row.querySelector('.student-number').textContent.toLowerCase() : '';

                // Check if name or student number contains the search query
                if (fullName.includes(query) || studentNumber.includes(query)) {
                    // Show the row
                    row.style.display = '';
                    
                    // Find the parent grade section and show it
                    const gradeSection = row.closest('.grade-section');
                    if (gradeSection) {
                        gradeSection.style.display = 'block';
                        matchingGrades.add(gradeSection);
                        
                        // Expand the grade section
                        const gradeHeader = gradeSection.querySelector('.grade-header');
                        const studentList = gradeSection.querySelector('.student-list');
                        if (gradeHeader && studentList) {
                            gradeHeader.classList.remove('collapsed');
                            studentList.classList.add('active');
                        }
                        
                        // Find and expand the section containing the student
                        const sectionGroup = row.closest('.section-group');
                        if (sectionGroup) {
                            const sectionHeader = sectionGroup.querySelector('.section-header');
                            const sectionContent = sectionGroup.querySelector('.section-content');
                            if (sectionHeader && sectionContent) {
                                sectionHeader.classList.remove('collapsed');
                                sectionContent.classList.add('active');
                            }
                        }
                    }
                } else {
                    // Hide the row if it doesn't match
                    row.style.display = 'none';
                }
            });
            
            // Hide grade sections that have no matching students
            document.querySelectorAll('.grade-section').forEach(gradeSection => {
                if (!matchingGrades.has(gradeSection)) {
                    gradeSection.style.display = 'none';
                }
            });
        }

        // Add event listener for search input
        document.getElementById('searchInput').addEventListener('input', function() {
            searchStudents();
        });

        // Form submission
        document.getElementById('addStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const formValues = Object.fromEntries(formData);
            
            // Display all form values in console
            console.log('Form Input Values:');
            console.log('First Name:', formValues.first_name);
            console.log('Last Name:', formValues.last_name);
            console.log('Middle Name:', formValues.middle_name);
            console.log('Gender:', formValues.gender);
            console.log('Grade Level:', formValues.grade_level);
            console.log('Section:', formValues.section);
            console.log('Test Status:', formValues.test_status);
            
            fetch('/admin/students', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // Get the grade level of the new student
                const gradeLevel = data.student.grade_level;
                
                // Find the grade section
                const gradeElement = document.getElementById(`grade${gradeLevel}`);
                
                if (gradeElement) {
                    // Create new student item HTML with status
                    const status = data.student.test_status || 'not_started';
                    const statusClass = getStatusClass(status);
                    const statusText = getStatusText(status);
                    const statusIcon = getStatusIcon(status);
                    
                    const newStudentHtml = `
                        <div class="student-item">
                            <img src="placeholder-profile.png" alt="Profile" class="student-profile">
                            <div class="student-info">
                                <span>${data.student.student_number}</span>
                                <span>${data.student.last_name}</span>
                                <span>${data.student.first_name}</span>
                                <span>${data.student.middle_name || ''}</span>
                                <span>${data.student.gender}</span>
                                <span class="status-badge ${statusClass}">
                                    <i class="fas ${statusIcon} status-icon"></i>
                                    ${statusText}
                                </span>
                            </div>
                        </div>
                    `;
                    
                    // Add the new student to the grade section
                    gradeElement.insertAdjacentHTML('beforeend', newStudentHtml);
                    
                    // Show success message
                    alert('Student added successfully!');
                    
                    // Close the modal and clear the form
                    closeModal('addStudentModal');
                    clearForm();
                } else {
                    alert('Error: Could not find grade section');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors) {
                    // Display validation errors
                    let errorMessage = 'Please fix the following errors:\n';
                    Object.entries(error.errors).forEach(([field, messages]) => {
                        errorMessage += `\n${field}: ${messages.join(', ')}`;
                    });
                    alert(errorMessage);
                } else {
                    alert('An error occurred while saving the student. Please try again.');
                }
            });
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                closeModal();
            }
        }

        // Add sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const header = document.querySelector('header');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Add these functions to your existing JavaScript
        let studentToDeleteId = null;

        function confirmDelete(id, name) {
            studentToDeleteId = id;
            document.getElementById('studentToDelete').textContent = name;
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'none';
            studentToDeleteId = null;
        }

        function deleteStudent() {
            if (!studentToDeleteId) return;

            fetch(`/admin/students/${studentToDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                closeConfirmationModal();
                // Remove the student row from the table
                const row = document.querySelector(`tr[data-student-id="${studentToDeleteId}"]`);
                if (row) {
                    row.remove();
                }
                // Show success message
                alert('Student deleted successfully');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete student. Please try again.');
            });
        }

        // Close confirmation modal when clicking outside
        window.onclick = function(event) {
            const confirmationModal = document.getElementById('confirmationModal');
            if (event.target == confirmationModal) {
                closeConfirmationModal();
            }
        }

        // Add these functions to your existing JavaScript
        function openEditModal(id, lastName, firstName, middleName, gender, gradeLevel, section, status) {
            const modal = document.getElementById('editModal');
            modal.style.display = 'block';
            
            // Set form values
            document.getElementById('edit-student-id').value = id;
            document.getElementById('edit-lastName').value = lastName;
            document.getElementById('edit-firstName').value = firstName;
            document.getElementById('edit-middleName').value = middleName || '';
            document.getElementById('edit-gender').value = gender;
            document.getElementById('edit-gradeLevel').value = gradeLevel;
            document.getElementById('edit-testStatus').value = status;
            
            // Update sections based on grade level
            updateEditSections();
            
            // Set the section value after sections are populated
            setTimeout(() => {
                document.getElementById('edit-section').value = section;
            }, 100);
        }

        function updateEditSections() {
            const gradeLevel = document.getElementById('edit-gradeLevel').value;
            const sectionSelect = document.getElementById('edit-section');
            
            // Clear existing options
            sectionSelect.innerHTML = '<option value="">Select Section</option>';
            
            // Add new options based on grade level
            if (gradeLevel && gradeSections[gradeLevel]) {
                gradeSections[gradeLevel].forEach(section => {
                    const option = document.createElement('option');
                    option.value = section;
                    option.textContent = section;
                    sectionSelect.appendChild(option);
                });
            }
        }

        // Add event listener for edit form submission
        document.getElementById('editStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const studentId = document.getElementById('edit-student-id').value;
            
            fetch(`/admin/students/${studentId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update the table row with new data
                const row = document.querySelector(`tr[data-student-id="${studentId}"]`);
                if (row) {
                    row.querySelector('td:nth-child(1)').textContent = `${formData.get('last_name')}, ${formData.get('first_name')} ${formData.get('middle_name')}`;
                    row.querySelector('td:nth-child(2)').textContent = formData.get('gender');
                    row.querySelector('td:nth-child(3)').textContent = `Grade ${formData.get('grade_level')}`;
                    
                    // Update status badge
                    const status = formData.get('test_status');
                    const statusClass = getStatusClass(status);
                    const statusText = getStatusText(status);
                    const statusIcon = getStatusIcon(status);
                    
                    const statusCell = row.querySelector('td:nth-child(4)');
                    statusCell.innerHTML = `
                        <span class="status-badge ${statusClass}">
                            <i class="fas ${statusIcon} status-icon"></i>
                            ${statusText}
                        </span>
                    `;
                }
                
                // Close modal and show success message
                closeModal('editModal');
                alert('Student record updated successfully!');
                
                // Refresh the page to show updated data
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the student record. Please try again.');
            });
        });

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Update window click handler
        window.onclick = function(event) {
            const addModal = document.getElementById('addStudentModal');
            const editModal = document.getElementById('editModal');
            const confirmationModal = document.getElementById('confirmationModal');
            
            if (event.target === addModal) {
                closeModal('addStudentModal');
            }
            if (event.target === editModal) {
                closeModal('editModal');
            }
            if (event.target === confirmationModal) {
                closeConfirmationModal();
            }
        }

        // Helper functions for status
        function getStatusClass(status) {
            switch(status) {
                case 'completed': return 'status-completed';
                case 'in_progress': return 'status-in-progress';
                default: return 'status-not-started';
            }
        }

        function getStatusText(status) {
            switch(status) {
                case 'completed': return 'Completed';
                case 'in_progress': return 'In Progress';
                default: return 'Not Started';
            }
        }

        function getStatusIcon(status) {
            switch(status) {
                case 'completed': return 'fa-check-circle';
                case 'in_progress': return 'fa-clock';
                default: return 'fa-circle';
            }
        }

        // Add this function to your existing JavaScript
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const header = section.previousElementSibling;
            
            section.classList.toggle('active');
            header.classList.toggle('collapsed');
        }
    </script>
<!-- </body>
</html> -->
@endsection
