@extends('layouts.head-tech')

@section('title', 'Reading Assessment')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <style>
            :root {
                --primary: #00B8A9;
                --primary-dark: #00B8A9;
                --primary-light: #00B8A9;
                --accent: #00B8A9;
                --neutral-dark: #2D3748;
                --neutral: #4A5568;
                --neutral-light: #E2E8F0;
                --background: #F7FAFC;
                --card-bg: #FFFFFF;
                --success: #00B8A9;
                --warning: #00B8A9;
                --danger: #E53E3E;
                --text-dark: #1A202C;
                --text: #4A5568;
                --text-light: #718096;
                --secondary: #00B8A9;
                --shadow-sm: 0 1px 3px rgba(0, 184, 169, 0.12), 0 1px 2px rgba(0, 184, 169, 0.08);
                --shadow-md: 0 4px 6px rgba(0, 184, 169, 0.1), 0 2px 4px rgba(0, 184, 169, 0.06);
                --transition: all 0.3s ease;
                --radius: 12px;
            }

            .dashboard-wrapper {
                padding: 60px;
                background-color: var(--background);
                min-height: calc(100vh - 60px);
            }

            .main {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0;
            }

            .dashboard-header {
                background: white;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                margin-bottom: 30px;
                border: 1px solid #e9ecef;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .dashboard-header:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .header-content h1 {
                color: #00B8A9;
                font-size: 1.8rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .header-content p {
                color: #718096;
                margin: 0;
                font-size: 1rem;
            }

            .card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                padding: 30px;
                margin-bottom: 30px;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .section-title {
                color: #00B8A9;
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .passage {
                color: #4A5568;
                font-size: 1.1rem;
                margin-bottom: 1rem;
                line-height: 1.7;
                background: #F7FAFC;
                padding: 25px;
                border-radius: 8px;
            }

            .word-count-display {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
                padding: 12px 16px;
                background: #00B8A9;
                color: white;
                border-radius: 8px;
                font-weight: 600;
                box-shadow: 0 2px 8px rgba(0, 184, 169, 0.2);
            }

            .word-count-label {
                font-size: 0.95rem;
            }

            .word-count-number {
                font-weight: 700;
                font-size: 1.1rem;
                background: rgba(255, 255, 255, 0.2);
                padding: 4px 12px;
                border-radius: 4px;
                min-width: 40px;
                text-align: center;
            }

            .student-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                padding: 30px;
                margin-bottom: 30px;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .student-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .student-header {
                font-weight: 700;
                font-size: 1.3rem;
                color: #00B8A9;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .student-meta {
                color: #718096;
                font-size: 1rem;
                margin-bottom: 1rem;
                padding: 12px 16px;
                background: #F7FAFC;
                border-radius: 8px;
            }

            .assessment-group {
                margin-bottom: 1.5rem;
            }

            .assessment-group label {
                display: block;
                font-weight: 600;
                color: #2D3748;
                margin-bottom: 0.8rem;
                font-size: 1rem;
            }

            .assessment-select {
                width: 100%;
                padding: 12px 16px;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                background: #F7FAFC;
                cursor: pointer;
                transition: all 0.3s ease;
                font-family: inherit;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .assessment-select:focus {
                outline: none;
                background: white;
                box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
                transform: translateY(-1px);
            }

            .assessment-select:hover {
                background: white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .assessment-layout {
                display: flex;
                gap: 2rem;
                margin-bottom: 1.5rem;
                align-items: flex-start;
            }

            .left-controls {
                flex: 1;
                min-width: 200px;
            }

            .right-controls {
                flex: 2;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .assessment-controls {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .control-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .control-group label {
                font-weight: 600;
                color: var(--text);
                font-size: 0.9rem;
            }

            .assessment-input {
                padding: 0.6rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 1rem;
                width: 100%;
            }

            .assessment-input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 2px rgba(14, 97, 186, 0.1);
            }

            .input-note {
                font-size: 0.8rem;
                color: var(--text-light);
                margin-top: 0.3rem;
                font-style: italic;
            }

            .timer-controls {
                display: flex;
                align-items: flex-end;
                gap: 1rem;
                padding: 25px;
                background: white;
                border-radius: 12px;
                flex-wrap: wrap;
                justify-content: flex-start;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                margin-bottom: 20px;
            }

            .timer-controls .control-group {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-right: 0;
                gap: 0.5rem;
                min-width: 80px;
            }

            .timer-controls .control-group label {
                font-size: 0.85rem;
                font-weight: 600;
                color: #2D3748;
                margin-bottom: 0;
                white-space: nowrap;
                text-align: center;
            }

            .timer-buttons-section {
                display: flex;
                align-items: flex-end;
                gap: 0.75rem;
                flex-wrap: wrap;
            }

            .timer-buttons {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
                align-items: flex-end;
            }

            .save-controls {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: flex-end;
                margin-top: 1rem;
            }

            .assessment-buttons {
                display: flex;
                gap: 0.5rem;
                align-items: flex-end;
                margin-left: auto;
                height: 36px;
            }

            /* Save Assessment buttons within timer-controls */
            .timer-controls .save-assessment {
                background: var(--secondary);
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
                height: 36px;
                font-size: 0.9rem;
                min-width: 80px;
            }

            .timer-controls .save-assessment:hover {
                background: #4fa13a;
                transform: translateY(-2px);
            }

            .timer-controls .clear-assessment {
                background: #F56565 !important;
                color: white !important;
                border: none !important;
                padding: 8px 16px;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                height: 36px;
                font-size: 0.9rem;
                min-width: 80px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .timer-controls .clear-assessment:hover {
                background: #E53E3E !important;
                color: white !important;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(245, 101, 101, 0.3);
            }

            /* Legacy save-assessment styles for other contexts */
            .save-assessment {
                background: var(--secondary);
                color: white;
                border: none;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
            }

            .save-assessment:hover {
                background: #4fa13a;
                transform: translateY(-2px);
            }

            .clear-assessment {
                background: var(--neutral);
                color: var(--text);
                border: 1px solid #ddd;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
            }

            .clear-assessment:hover {
                background: #e5e5e5;
            }

            .miscues-input {
                padding: 0.4rem 0.7rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 1rem;
                width: 80px;
                max-width: 80px;
                height: 40px;
                box-sizing: border-box;
            }

            .timer {
                font-family: 'Poppins', monospace;
                font-size: 0.9rem;
                margin: 0;
                font-weight: 700;
                color: #00B8A9;
                height: 36px;
                display: flex;
                align-items: center;
                padding: 8px 16px;
                background: #F7FAFC;
                border-radius: 6px;
                width: 100px;
                min-width: 100px;
                justify-content: center;
                letter-spacing: 1px;
                box-sizing: border-box;
                align-self: flex-end;
            }

            /* Unified Button Height System */
            .btn,
            .save-assessment,
            .clear-assessment,
            .btn-save,
            .btn-cancel,
            .clear-btn,
            .btn-send,
            .back-btn {
                border: none;
                outline: none;
                padding: 8px 16px;
                border-radius: 6px;
                font-size: 0.9rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-right: 0.5rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.4rem;
                text-decoration: none;
                min-height: 36px;
                height: 36px;
                min-width: 80px;
                box-sizing: border-box;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .btn:active {
                transform: translateY(0);
            }

            .btn.start {
                background: #00B8A9;
                color: white;
            }

            .btn.start:hover {
                background: #009688;
            }

            .btn.stop {
                background: #E53E3E;
                color: white;
            }

            .btn.stop:hover {
                background: #C62828;
            }

            .btn.reset {
                background: #718096;
                color: white;
            }

            .btn.reset:hover {
                background: #4A5568;
            }

            .header-controls {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                gap: 1rem;
                padding: 25px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            }

            .back-btn {
                background: #F7FAFC;
                color: #00B8A9;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .back-btn:hover {
                background: #00B8A9;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 184, 169, 0.3);
            }

            .card-header-row {
                display: flex;
                justify-content: flex-end;
                align-items: center;
                margin-bottom: 1rem;
            }

            .dropdown {
                position: relative;
            }

            .dropdown>a {
                font-weight: 600;
                color: #00B8A9;
                background: #F7FAFC;
                border-radius: 8px;
                padding: 12px 24px;
                text-decoration: none;
                transition: all 0.3s ease;
                border: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                min-height: 44px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .dropdown>a:hover {
                background: #00B8A9;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 184, 169, 0.3);
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background: white;
                color: #4A5568;
                min-width: 180px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                border-radius: 8px;
                top: 3rem;
                right: 0;
                left: auto;
                z-index: 10;
                overflow: hidden;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropdown-content a {
                color: #4A5568;
                padding: 12px 16px;
                display: block;
                text-decoration: none;
                transition: all 0.3s ease;
                border-bottom: 1px solid #f1f1f1;
            }

            .dropdown-content a:last-child {
                border-bottom: none;
            }

            .dropdown-content a:hover {
                background: #F7FAFC;
                color: #00B8A9;
                padding-left: 20px;
            }

            .dropdown-content a.selected {
                background: #00B8A9;
                color: white;
            }

            /* Passage Header and Word Count Styles */
            .passage-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid var(--neutral-light);
            }

            .word-count-display {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                background: var(--primary);
                color: var(--text-white);
                padding: 0.5rem 1rem;
                border-radius: 8px;
                font-size: 0.9rem;
                font-weight: 500;
                box-shadow: var(--shadow-sm);
            }

            .word-count-display i {
                font-size: 1rem;
                color: var(--text-white);
            }

            .word-count-display strong {
                font-weight: 700;
                font-size: 1rem;
            }

            .input-note {
                color: var(--text-light);
                font-size: 0.8rem;
                margin-top: 0.25rem;
                font-style: italic;
            }

            #totalWords {
                background-color: var(--neutral-light);
                cursor: not-allowed;
            }

            /* Feedback Section Styles */
            .feedback-section {
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                padding: 30px;
                margin-top: 30px;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .feedback-section:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .feedback-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 2px solid #F7FAFC;
            }

            .feedback-header h3 {
                color: #00B8A9;
                font-size: 1.4rem;
                font-weight: 700;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .feedback-form {
                display: grid;
                gap: 1.5rem;
            }

            .feedback-group {
                display: grid;
                gap: 0.5rem;
            }

            .feedback-group label {
                color: var(--text);
                font-weight: 500;
            }

            .feedback-input {
                width: 100%;
                padding: 16px;
                border: none;
                border-radius: 8px;
                font-family: inherit;
                font-size: 1rem;
                transition: all 0.3s ease;
                resize: vertical;
                min-height: 120px;
                background: #F7FAFC;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .feedback-input:focus {
                outline: none;
                background: white;
                box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
                transform: translateY(-1px);
            }

            .feedback-input:hover {
                background: white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .miscues-input,
            .assessment-input {
                padding: 8px 16px;
                border: none;
                border-radius: 6px;
                font-size: 0.9rem;
                transition: all 0.3s ease;
                background: #F7FAFC;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                text-align: center;
                font-weight: 600;
                color: #2D3748;
                height: 36px;
                width: 80px;
                min-width: 80px;
                box-sizing: border-box;
            }

            .miscues-input:focus,
            .assessment-input:focus {
                outline: none;
                background: white;
                box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
                transform: translateY(-1px);
            }

            .miscues-input:hover,
            .assessment-input:hover {
                background: white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }



            .feedback-actions {
                display: flex;
                gap: 1rem;
                justify-content: flex-end;
                margin-top: 1rem;
            }

            .btn-save,
            .save-assessment {
                background: #00B8A9;
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                min-height: 44px;
            }

            .btn-save:hover,
            .save-assessment:hover {
                background: #009688;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 184, 169, 0.3);
            }

            .btn-cancel,
            .clear-assessment {
                background: #F7FAFC;
                color: #718096;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                min-height: 44px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                text-decoration: none;
                font-size: 0.95rem;
            }

            .btn-cancel:hover,
            .clear-assessment:hover {
                background: #E2E8F0;
                color: #4A5568;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-decoration: none;
            }

            .clear-btn {
                background: #F56565;
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                min-height: 44px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                text-decoration: none;
                font-size: 0.95rem;
            }

            .clear-btn:hover {
                background: #E53E3E;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(245, 101, 101, 0.3);
                text-decoration: none;
                color: white;
            }

            .feedback-history {
                margin-top: 2rem;
            }

            .feedback-history h4 {
                color: #2D3748;
                margin-bottom: 1.5rem;
                font-size: 1.2rem;
                font-weight: 600;
            }

            .feedback-item {
                background: white;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 20px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .feedback-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .feedback-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                color: #718096;
                font-size: 0.9rem;
                margin-bottom: 15px;
                padding: 12px 16px;
                background: #F7FAFC;
                border-radius: 8px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .feedback-meta span {
                font-weight: 500;
            }

            .feedback-content {
                color: #4A5568;
                line-height: 1.6;
                margin-bottom: 20px;
            }

            .feedback-content p {
                margin-bottom: 12px;
                padding: 8px 0;
            }

            .feedback-content strong {
                color: #2D3748;
                font-weight: 600;
            }

            .feedback-rating {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-top: 0.5rem;
            }

            .feedback-rating i {
                color: #FFD700;
                /* Golden Yellow */
            }

            .feedback-rating .far {
                color: #ddd;
            }

            .feedback-actions-history {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px solid #E2E8F0;
            }

            .btn-send {
                background: #00B8A9;
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 0.9rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .btn-send:hover {
                background: #009688;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 184, 169, 0.3);
            }

            .btn-send:disabled {
                background: #CBD5E0 !important;
                color: #718096 !important;
                cursor: not-allowed !important;
                transform: none !important;
                box-shadow: none !important;
            }

            .btn-send.sent {
                background: #CBD5E0 !important;
                color: #718096 !important;
                cursor: not-allowed !important;
                transform: none !important;
                box-shadow: none !important;
            }

            .send-status {
                font-size: 0.85rem;
                padding: 8px 16px;
                border-radius: 20px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .send-status.sent {
                background: #D4EDDA;
                color: #155724;
            }

            .send-status.pending {
                background: #FFF3CD;
                color: #856404;
            }

            .send-status.not-sent {
                background: #F8D7DA;
                color: #721C24;
            }

            .empty-state {
                text-align: center;
                padding: 40px 20px;
                color: #718096;
                background: #F7FAFC;
                border-radius: 12px;
                margin-top: 20px;
            }

            .empty-state i {
                font-size: 3rem;
                margin-bottom: 15px;
                color: #CBD5E0;
            }

            .empty-state p {
                font-size: 1rem;
                margin: 0;
                font-weight: 500;
            }

            @media (max-width: 768px) {
                .dashboard-wrapper {
                    padding: 20px;
                }

                .main {
                    padding: 0;
                }

                .header-controls {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 1rem;
                    padding: 15px;
                }

                .card,
                .student-card,
                .feedback-section {
                    padding: 20px;
                    margin-bottom: 20px;
                }

                .dashboard-header {
                    padding: 20px;
                    margin-bottom: 20px;
                }

                .timer-controls {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 1rem;
                    padding: 15px;
                }

                .timer-controls .control-group {
                    align-items: stretch;
                    text-align: center;
                }

                .timer {
                    margin: 0;
                    width: 100%;
                }

                .btn {
                    width: 100%;
                    margin-right: 0;
                    margin-bottom: 0.5rem;
                }

                .assessment-buttons {
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .dropdown-content {
                    position: fixed;
                    top: auto;
                    right: 10px;
                    left: 10px;
                    width: auto;
                }
            }

            /* Floating controls styles */
            .floating-controls {
                position: sticky;
                bottom: 0;
                z-index: 100;
                background: var(--neutral-light);
                box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.07);
                border-radius: var(--radius);
                margin-top: 1.5rem;
                transition: box-shadow 0.2s;
            }

            .reading-sticky-container {
                max-height: 500px;
                overflow-y: auto;
                position: relative;
                margin-bottom: 2rem;
            }

            @media (max-width: 700px) {
                .floating-controls {
                    position: static;
                    box-shadow: none;
                }

                .reading-sticky-container {
                    max-height: none;
                    overflow-y: visible;
                }
            }

            /* Searchable Select Styles */
            .searchable-select-container {
                position: relative;
                width: 100%;
            }

            .searchable-select {
                position: relative;
                width: 100%;
            }

            .searchable-input {
                width: 100%;
                padding: 12px 45px 12px 16px;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                background: #F7FAFC;
                cursor: text;
                transition: all 0.3s ease;
                font-family: inherit;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                color: #2D3748;
            }

            .searchable-input:focus {
                outline: none;
                background: white;
                box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
                transform: translateY(-1px);
            }

            .searchable-input:hover {
                background: white;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .searchable-input::placeholder {
                color: #A0AEC0;
                font-style: italic;
            }

            .search-clear-btn {
                position: absolute;
                right: 45px;
                top: 50%;
                transform: translateY(-50%);
                color: #A0AEC0;
                cursor: pointer;
                padding: 4px;
                border-radius: 50%;
                transition: all 0.3s ease;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.8rem;
            }

            .search-clear-btn:hover {
                color: #E53E3E;
                background: #FED7D7;
            }

            .search-dropdown-arrow {
                position: absolute;
                right: 16px;
                top: 50%;
                transform: translateY(-50%);
                color: #718096;
                pointer-events: none;
                transition: all 0.3s ease;
            }

            .searchable-select.active .search-dropdown-arrow {
                transform: translateY(-50%) rotate(180deg);
                color: #00B8A9;
            }

            .searchable-dropdown {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border-radius: 8px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                z-index: 1000;
                margin-top: 4px;
                max-height: 300px;
                overflow-y: auto;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: all 0.3s ease;
                border: 1px solid #E2E8F0;
            }

            .searchable-dropdown.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .dropdown-options {
                padding: 8px 0;
            }

            .dropdown-option {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 16px;
                cursor: pointer;
                transition: all 0.3s ease;
                color: #4A5568;
                border-bottom: 1px solid #F7FAFC;
            }

            .dropdown-option:last-child {
                border-bottom: none;
            }

            .dropdown-option:hover {
                background: #F7FAFC;
                color: #00B8A9;
                padding-left: 20px;
            }

            .dropdown-option.selected {
                background: #00B8A9;
                color: white;
            }

            .dropdown-option.selected:hover {
                background: #009688;
                padding-left: 16px;
            }

            .dropdown-option.highlighted {
                background: #E6FFFA;
                color: #00B8A9;
                padding-left: 20px;
            }

            .dropdown-option.highlighted.selected {
                background: #009688;
                color: white;
                padding-left: 16px;
            }

            .dropdown-option i {
                color: #00B8A9;
                font-size: 0.9rem;
                width: 16px;
                text-align: center;
            }

            .dropdown-option.selected i {
                color: white;
            }

            .no-results {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 20px;
                color: #A0AEC0;
                font-style: italic;
            }

            .no-results i {
                font-size: 1.2rem;
            }

            /* Scrollbar styling for dropdown */
            .searchable-dropdown::-webkit-scrollbar {
                width: 6px;
            }

            .searchable-dropdown::-webkit-scrollbar-track {
                background: #F7FAFC;
                border-radius: 3px;
            }

            .searchable-dropdown::-webkit-scrollbar-thumb {
                background: #CBD5E0;
                border-radius: 3px;
            }

            .searchable-dropdown::-webkit-scrollbar-thumb:hover {
                background: #A0AEC0;
            }
        </style>

        <div class="dashboard-wrapper">
            <div class="main">
                <!-- Dashboard Header -->
                <div class="dashboard-header">
                    <div class="header-content">
                        <h1>Reading Assessment</h1>
                        <p>Conduct comprehensive reading assessments with timer controls and feedback system</p>
                    </div>
                </div>

                <div class="header-controls">
                    <button class="btn back-btn" onclick="window.history.back()">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                    <div class="dropdown">
                        <a href="#">Reading Languages <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="#" id="lang-english">English</a>
                            <a href="#" id="lang-filipino">Filipino</a>
                        </div>
                    </div>
                </div>

                <!-- Sticky Reading Container -->
                <div class="reading-sticky-container"
                    style="max-height: 500px; overflow-y: auto; position: relative; margin-bottom: 2rem;">
                    <div class="card">
                        <div class="passage-header">
                            <div class="section-title" id="passage-title">READING PASSAGE</div>
                        </div>
                        <div class="passage" id="passage-text">
                            @if(isset($readingMaterial))
                                <h3>{{ $readingMaterial->title }}</h3>
                                <div class="reading-content">
                                    <p>{{ $readingMaterial->content }}</p>
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-book"></i>
                                    <p>No reading material has been published for this grade level and subject yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="timer-controls floating-controls">
                        <!-- Reading Miscues -->
                        <div class="control-group">
                            <label for="miscues">Miscues</label>
                            <input type="number" id="miscues" class="miscues-input" min="0" value="0"
                                style="text-align: center;">
                        </div>
                        <!-- Total Words -->
                        <div class="control-group">
                            <label for="totalWords">Total Words</label>
                            <input type="number" id="totalWords" class="miscues-input" readonly
                                style="text-align: center; background-color: var(--neutral-light); cursor: not-allowed;">
                        </div>
                        <span class="timer" id="timer">00:00:00</span>
                        <div class="timer-buttons-section">
                            <button class="btn start" onclick="startTimer()">Start Time</button>
                            <button class="btn stop" onclick="stopTimer()">Stop Time</button>
                            <button class="btn reset" onclick="resetTimer()">Reset Time</button>
                        </div>
                        <!-- Save Assessment Buttons -->
                        <div class="assessment-buttons">
                            <button class="btn save-assessment" onclick="saveAssessment()">Save</button>
                            <button class="btn clear-assessment" onclick="clearAssessment()">Clear All</button>
                        </div>
                    </div>
                </div>

                <!-- Student Reading Assessment positioned below the reading passage box -->
                <div class="student-card">
                    <div class="student-header">
                        <i class="fas fa-user-graduate"></i>
                        Student Reading Assessment
                    </div>
                    <div class="student-meta">Section: {{ ucfirst($section ?? 'Narra') }} &nbsp; | &nbsp; Grade Level:
                        {{ str_replace('grade', '', $grade ?? 'grade7') }}
                    </div>
                    <!-- Student Selection -->
                    <div class="assessment-group">
                        <label for="studentSelect">Select Student:</label>
                        <div class="searchable-select-container">
                            <div class="searchable-select" id="searchableSelect">
                                <input type="text"
                                       id="studentSearchInput"
                                       class="searchable-input"
                                       placeholder="Search and select a student..."
                                       autocomplete="off">
                                <div class="search-clear-btn" id="searchClearBtn" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="search-dropdown-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="searchable-dropdown" id="studentDropdown">
                                    <div class="dropdown-options">
                                        @if(request('student_number'))
                                            @foreach($students as $student)
                                                @if($student->student_number == request('student_number'))
                                                    <div class="dropdown-option selected"
                                                         data-value="{{ $student->student_number }}"
                                                         data-text="{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}">
                                                        <i class="fas fa-user-graduate"></i>
                                                        {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($students as $student)
                                                @if($student->grade_level == str_replace('grade', '', $grade) && $student->section == ucfirst($section))
                                                    <div class="dropdown-option"
                                                         data-value="{{ $student->student_number }}"
                                                         data-text="{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}">
                                                        <i class="fas fa-user-graduate"></i>
                                                        {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="no-results" id="noResults" style="display: none;">
                                        <i class="fas fa-search"></i>
                                        <span>No students found</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden input to store the selected value -->
                            <input type="hidden" id="studentSelect" name="student_number" value="{{ request('student_number') ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Section -->
            <div class="feedback-section">
                <div class="feedback-header">
                    <h3>
                        <i class="fas fa-comments"></i>
                        Student Reading Assessment Feedback
                    </h3>
                </div>
                <form class="feedback-form" id="feedbackForm">
                    <div class="feedback-group">
                        <label for="strengths">Reading Strengths:</label>
                        <textarea id="strengths" class="feedback-input"
                            placeholder="What did the student do well in their reading?"></textarea>
                    </div>

                    <div class="feedback-group">
                        <label for="areasForImprovement">Areas for Improvement:</label>
                        <textarea id="areasForImprovement" class="feedback-input"
                            placeholder="What areas need more practice?"></textarea>
                    </div>

                    <div class="feedback-group">
                        <label for="recommendations">Recommendations:</label>
                        <textarea id="recommendations" class="feedback-input"
                            placeholder="Specific recommendations for improvement..."></textarea>
                    </div>

                    <div class="feedback-actions">
                        <button type="button" class="btn-cancel" onclick="resetFeedback()">Clear</button>
                        <button type="submit" class="btn-save">Save Feedback</button>
                    </div>
                </form>
                <div class="feedback-history">
                    <h4>Teacher Feedback</h4>
                    <div id="feedbackHistory"></div>
                    <div class="empty-state" id="noFeedbackMessage" style="display: none;">
                        <i class="fas fa-comment-slash"></i>
                        <p>No previous feedback available.</p>
                    </div>
                </div>

                <!-- <div class="feedback-history">
                                                                                        <h4>Previous Feedback</h4>
                                                                                        <div class="feedback-item">
                                                                                            <div class="feedback-meta">
                                                                                                <span>Date: 12/15/2024</span>
                                                                                                <span>Reading Level: Grade 7</span>
                                                                                            </div>
                                                                                            <div class="feedback-content">
                                                                                                <p><strong>Strengths:</strong> Good pronunciation and clear voice projection</p>
                                                                                                <p><strong>Areas for Improvement:</strong> Reading speed and comprehension</p>
                                                                                                <p><strong>Recommendations:</strong> Practice with shorter passages first</p>
                                                                                            </div>

                                                                                            <div class="feedback-actions-history">
                                                                                                <button class="btn-send" onclick="sendFeedbackToStudent(this, 'sample-feedback-1')">
                                                                                                    <i class="fas fa-paper-plane"></i> Send to Student
                                                                                                </button>
                                                                                                <span class="send-status sent">✓ Sent</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
            </div>
        </div>
    </div>

    <script>
        // Timer functionality
        let startTime = null;
        let timerInterval = null;
        let isRunning = false;

        function startTimer() {
            if (!isRunning) {
                startTime = new Date().getTime();
                isRunning = true;
                timerInterval = setInterval(updateTimer, 1000);

                // Update button states
                document.querySelector('.btn.start').disabled = true;
                document.querySelector('.btn.stop').disabled = false;
                document.querySelector('.btn.reset').disabled = false;
            }
        }

        function stopTimer() {
            if (isRunning) {
                clearInterval(timerInterval);
                isRunning = false;

                // Update button states
                document.querySelector('.btn.start').disabled = false;
                document.querySelector('.btn.stop').disabled = true;
            }
        }

        function resetTimer() {
            clearInterval(timerInterval);
            isRunning = false;
            startTime = null;
            document.getElementById('timer').textContent = '00:00:00';

            // Reset button states
            document.querySelector('.btn.start').disabled = false;
            document.querySelector('.btn.stop').disabled = true;
            document.querySelector('.btn.reset').disabled = true;
        }

        function updateTimer() {
            if (startTime) {
                const currentTime = new Date().getTime();
                const elapsedTime = currentTime - startTime;

                const hours = Math.floor(elapsedTime / (1000 * 60 * 60));
                const minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                const formattedTime =
                    String(hours).padStart(2, '0') + ':' +
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');

                document.getElementById('timer').textContent = formattedTime;
            }
        }

        // Language switching functionality - passages will be loaded from database

        // Language switching event listeners
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('lang-english').addEventListener('click', function (e) {
                e.preventDefault();
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('language', 'english');
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            document.getElementById('lang-filipino').addEventListener('click', function (e) {
                e.preventDefault();
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('language', 'filipino');
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            });

            // Initialize button states
            document.querySelector('.btn.stop').disabled = true;
            document.querySelector('.btn.reset').disabled = true;

            // Set default language selection based on current language
            const urlParams = new URLSearchParams(window.location.search);
            const currentLanguage = urlParams.get('language') || 'english';
            document.getElementById('lang-' + currentLanguage).classList.add('selected');

            // Initialize word count on page load
            updateWordCount();

            // Set up observer to watch for passage content changes
            const passageText = document.getElementById('passage-text');
            if (passageText) {
                const observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.type === 'childList' || mutation.type === 'characterData') {
                            updateWordCount();
                        }
                    });
                });

                observer.observe(passageText, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });
            }

            // Initialize searchable dropdown
            initializeSearchableDropdown();

            // Add event listener for student selection change to load feedback history
            const studentSelect = document.getElementById('studentSelect');
            if (studentSelect) {
                // Create a custom event listener for the hidden input
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                            const selectedStudentId = studentSelect.value;
                            console.log('Student selection changed to:', selectedStudentId);

                            if (selectedStudentId) {
                                loadFeedbackHistory(selectedStudentId);
                            } else {
                                clearFeedbackHistory();
                            }
                        }
                    });
                });

                observer.observe(studentSelect, { attributes: true });

                // Load feedback history if a student is already selected (from URL parameter)
                if (studentSelect.value) {
                    console.log('Loading feedback for pre-selected student:', studentSelect.value);
                    loadFeedbackHistory(studentSelect.value);
                }
            }
        });

        // Searchable Dropdown Functionality
        function initializeSearchableDropdown() {
            const searchInput = document.getElementById('studentSearchInput');
            const dropdown = document.getElementById('studentDropdown');
            const searchableSelect = document.getElementById('searchableSelect');
            const hiddenInput = document.getElementById('studentSelect');
            const noResults = document.getElementById('noResults');
            const clearBtn = document.getElementById('searchClearBtn');

            if (!searchInput || !dropdown || !searchableSelect || !hiddenInput) {
                console.error('Searchable dropdown elements not found');
                return;
            }

            let allOptions = Array.from(dropdown.querySelectorAll('.dropdown-option'));
            let isOpen = false;

            // Set initial value if student is pre-selected
            const preSelectedOption = dropdown.querySelector('.dropdown-option.selected');
            if (preSelectedOption) {
                searchInput.value = preSelectedOption.getAttribute('data-text');
                hiddenInput.value = preSelectedOption.getAttribute('data-value');

                // Show clear button if there's a pre-selected value
                if (clearBtn && searchInput.value) {
                    clearBtn.style.display = 'flex';
                }
            }

            // Toggle dropdown on input click
            searchInput.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleDropdown();
            });

            // Filter options as user types
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                filterOptions(searchTerm);

                // Show/hide clear button
                if (clearBtn) {
                    clearBtn.style.display = this.value ? 'flex' : 'none';
                }

                if (!isOpen) {
                    showDropdown();
                }
            });

            // Clear button functionality
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    clearSelection();
                });
            }

            // Handle option selection
            dropdown.addEventListener('click', function(e) {
                const option = e.target.closest('.dropdown-option');
                if (option) {
                    selectOption(option);
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchableSelect.contains(e.target)) {
                    hideDropdown();
                }
            });

            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                const visibleOptions = dropdown.querySelectorAll('.dropdown-option:not([style*="display: none"])');
                const currentHighlighted = dropdown.querySelector('.dropdown-option.highlighted');

                switch(e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        if (!isOpen) {
                            showDropdown();
                        } else {
                            highlightNext(visibleOptions, currentHighlighted);
                        }
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        highlightPrevious(visibleOptions, currentHighlighted);
                        break;
                    case 'Enter':
                        e.preventDefault();
                        if (currentHighlighted) {
                            selectOption(currentHighlighted);
                        }
                        break;
                    case 'Escape':
                        hideDropdown();
                        break;
                }
            });

            function toggleDropdown() {
                if (isOpen) {
                    hideDropdown();
                } else {
                    showDropdown();
                }
            }

            function showDropdown() {
                dropdown.classList.add('show');
                searchableSelect.classList.add('active');
                isOpen = true;
                filterOptions(searchInput.value.toLowerCase());
            }

            function hideDropdown() {
                dropdown.classList.remove('show');
                searchableSelect.classList.remove('active');
                isOpen = false;
                clearHighlights();
            }

            function filterOptions(searchTerm) {
                let hasVisibleOptions = false;

                allOptions.forEach(option => {
                    const text = option.getAttribute('data-text').toLowerCase();
                    const matches = text.includes(searchTerm);

                    option.style.display = matches ? 'flex' : 'none';
                    if (matches) {
                        hasVisibleOptions = true;
                    }
                });

                noResults.style.display = hasVisibleOptions ? 'none' : 'flex';
            }

            function selectOption(option) {
                const value = option.getAttribute('data-value');
                const text = option.getAttribute('data-text');

                // Update input and hidden field
                searchInput.value = text;
                hiddenInput.value = value;

                // Update selected state
                allOptions.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');

                // Trigger change event for feedback loading
                const changeEvent = new Event('change', { bubbles: true });
                hiddenInput.dispatchEvent(changeEvent);

                // Update hidden input value attribute for MutationObserver
                hiddenInput.setAttribute('value', value);

                hideDropdown();
            }

            function highlightNext(visibleOptions, current) {
                clearHighlights();
                let nextIndex = 0;

                if (current) {
                    const currentIndex = Array.from(visibleOptions).indexOf(current);
                    nextIndex = (currentIndex + 1) % visibleOptions.length;
                }

                if (visibleOptions[nextIndex]) {
                    visibleOptions[nextIndex].classList.add('highlighted');
                }
            }

            function highlightPrevious(visibleOptions, current) {
                clearHighlights();
                let prevIndex = visibleOptions.length - 1;

                if (current) {
                    const currentIndex = Array.from(visibleOptions).indexOf(current);
                    prevIndex = currentIndex > 0 ? currentIndex - 1 : visibleOptions.length - 1;
                }

                if (visibleOptions[prevIndex]) {
                    visibleOptions[prevIndex].classList.add('highlighted');
                }
            }

            function clearHighlights() {
                allOptions.forEach(option => option.classList.remove('highlighted'));
            }

            function clearSelection() {
                searchInput.value = '';
                hiddenInput.value = '';

                // Remove selected state from all options
                allOptions.forEach(opt => opt.classList.remove('selected'));

                // Hide clear button
                if (clearBtn) {
                    clearBtn.style.display = 'none';
                }

                // Trigger change event
                const changeEvent = new Event('change', { bubbles: true });
                hiddenInput.dispatchEvent(changeEvent);

                // Update hidden input value attribute for MutationObserver
                hiddenInput.setAttribute('value', '');

                // Reset filter
                filterOptions('');
                hideDropdown();
            }
        }

        function switchLanguage(language) {
            const passage = passages[language];
            document.getElementById('passage-title').textContent = passage.title;
            document.getElementById('passage-text').textContent = passage.text;

            // Update selected state
            document.querySelectorAll('.dropdown-content a').forEach(link => {
                link.classList.remove('selected');
            });
            document.getElementById('lang-' + language).classList.add('selected');

            // Update word count when language changes
            updateWordCount();
        }

        // Word counting functionality
        function countWords(text) {
            // Remove extra whitespace and split by spaces
            // Also remove common punctuation and normalize text
            const cleanText = text.replace(/[^\w\s]/g, ' ').replace(/\s+/g, ' ').trim();
            return cleanText.split(/\s+/).filter(word => word.length > 0).length;
        }

        function updateWordCount() {
            const passageElement = document.getElementById('passage-text');
            let passageText = '';

            // Check if there's content from database or use default passages
            const readingContent = passageElement.querySelector('.reading-content p');
            const emptyState = passageElement.querySelector('.empty-state');

            if (readingContent && !emptyState) {
                // Use database content
                passageText = readingContent.textContent || readingContent.innerText || '';
            } else if (!emptyState) {
                // Use default passage content (when language switching)
                passageText = passageElement.textContent || passageElement.innerText || '';
            } else {
                // No content available
                passageText = '';
            }

            const wordCount = countWords(passageText);

            // Update the word count display
            const wordCountElement = document.getElementById('passageWordCount');
            if (wordCountElement) {
                wordCountElement.textContent = wordCount;
            }

            // Auto-update the Total Words input field
            const totalWordsInput = document.getElementById('totalWords');
            if (totalWordsInput) {
                totalWordsInput.value = wordCount;
            }

            // Log for debugging
            console.log('Word count updated:', wordCount, 'from text:', passageText.substring(0, 50) + '...');
        }

        // Feedback Form Functionality
        const feedbackForm = document.getElementById('feedbackForm');

        // Form Submission
        feedbackForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const studentSelect = document.getElementById('studentSelect');
            const studentId = studentSelect.value;

            if (!studentId) {
                alert('Please select a student first!');
                return;
            }

            // Get current page parameters
            const urlParams = new URLSearchParams(window.location.search);
            const grade = urlParams.get('grade') || 'grade7';
            const section = urlParams.get('section') || 'narra';
            const language = urlParams.get('language') || 'english';

            const feedback = {
                student_id: studentId,
                language: language,
                grade_level: parseInt(grade.replace('grade', '')),
                section: section,
                strengths: document.getElementById('strengths').value,
                areas_for_improvement: document.getElementById('areasForImprovement').value,
                recommendations: document.getElementById('recommendations').value
            };

            // Show loading state
            const saveButton = feedbackForm.querySelector('.btn-save');
            const originalText = saveButton.textContent;
            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            // Send to backend
            fetch('/teacher/save-feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(feedback)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Feedback saved successfully!');

                        // Reload feedback history to show the updated/new feedback
                        const studentSelect = document.getElementById('studentSelect');
                        const studentId = studentSelect.value;
                        if (studentId) {
                            loadFeedbackHistory(studentId);
                        }

                        // Reset form
                        resetFeedback();
                    } else {
                        alert('Error saving feedback: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving feedback. Please try again.');
                })
                .finally(() => {
                    saveButton.disabled = false;
                    saveButton.textContent = originalText;
                });
        });

        function resetFeedback() {
            feedbackForm.reset();
        }

        function addFeedbackToHistory(feedback) {
            const feedbackHistoryDiv = document.getElementById('feedbackHistory');
            const feedbackItem = document.createElement('div');
            feedbackItem.className = 'feedback-item';

            // Use the feedback ID from the backend
            const feedbackId = feedback.id;
            const feedbackDate = new Date(feedback.created_at).toLocaleDateString();

            feedbackItem.innerHTML = `
                                                                                            <div class="feedback-meta">
                                                                                                <span>Date: ${feedbackDate}</span>
                                                                                                <span>Reading Level: Grade ${feedback.grade_level}</span>
                                                                                                <span>Language: ${feedback.language.charAt(0).toUpperCase() + feedback.language.slice(1)}</span>
                                                                                                ${feedback.reading_material && feedback.reading_material.title ?
                                                                                                    `<span>Reading Material: ${feedback.reading_material.title}</span>` :
                                                                                                    '<span>Reading Material: Not specified</span>'}
                                                                                            </div>
                                                                                            <div class="feedback-content">
                                                                                                <p><strong>Strengths:</strong> ${feedback.strengths || 'Not specified'}</p>
                                                                                                <p><strong>Areas for Improvement:</strong> ${feedback.areas_for_improvement || 'Not specified'}</p>
                                                                                                <p><strong>Recommendations:</strong> ${feedback.recommendations || 'Not specified'}</p>
                                                                                            </div>

                                                                                        <div class="feedback-actions-history">
                                                                                            <button class="btn-send ${feedback.is_sent ? 'sent' : ''}"
                                                                                                    onclick="sendFeedbackToStudent(this, ${feedbackId})"
                                                                                                    ${feedback.is_sent ? 'disabled' : ''}
                                                                                                    ${feedback.is_sent ? 'style="background: #CBD5E0; color: #718096; cursor: not-allowed; transform: none; box-shadow: none;"' : ''}>
                                                                                                <i class="fas fa-${feedback.is_sent ? 'check' : 'paper-plane'}"></i>
                                                                                                ${feedback.is_sent ? 'Sent' : 'Send to Student'}
                                                                                            </button>
                                                                                            <span class="send-status ${feedback.is_sent ? 'sent' : 'not-sent'}">
                                                                                                ${feedback.is_sent ? '✓ Sent' : 'Not Sent'}
                                                                                            </span>
                                                                                        </div>
                                                                                    `;

            // Store feedback data for sending
            feedbackItem.dataset.feedbackData = JSON.stringify(feedback);
            feedbackItem.dataset.feedbackId = feedbackId;

            // Insert at the beginning of feedback history
            const existingItems = feedbackHistoryDiv.querySelectorAll('.feedback-item');
            if (existingItems.length > 0) {
                feedbackHistoryDiv.insertBefore(feedbackItem, existingItems[0]);
            } else {
                feedbackHistoryDiv.appendChild(feedbackItem);
            }
        }

        // Send feedback to student function
        function sendFeedbackToStudent(button, feedbackId) {
            const feedbackItem = button.closest('.feedback-item');
            const statusSpan = feedbackItem.querySelector('.send-status');
            const feedbackData = JSON.parse(feedbackItem.dataset.feedbackData || '{}');

            // Get current student ID
            const studentSelect = document.getElementById('studentSelect');
            const studentId = studentSelect.value;

            if (!studentId) {
                alert('Please select a student first!');
                return;
            }

            // Update button and status to show sending
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            statusSpan.className = 'send-status pending';
            statusSpan.textContent = 'Sending...';

            // Send to backend
            fetch('/teacher/send-feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    feedback_id: feedbackId,
                    student_id: studentId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI to show sent status
                        button.innerHTML = '<i class="fas fa-check"></i> Sent';
                        button.disabled = true;
                        button.style.background = '#CBD5E0';
                        button.style.color = '#718096';
                        button.style.cursor = 'not-allowed';
                        button.style.transform = 'none';
                        button.style.boxShadow = 'none';
                        statusSpan.className = 'send-status sent';
                        statusSpan.textContent = '✓ Sent';

                        // Show success message
                        alert(data.message);
                    } else {
                        // Reset button on error
                        button.disabled = false;
                        button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Student';
                        statusSpan.className = 'send-status not-sent';
                        statusSpan.textContent = 'Not Sent';

                        alert('Error sending feedback: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Reset button on error
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Student';
                    statusSpan.className = 'send-status not-sent';
                    statusSpan.textContent = 'Not Sent';

                    alert('Error sending feedback. Please try again.');
                });
        }

        // Load feedback history for selected student
        function loadFeedbackHistory(studentId) {
            console.log('Loading feedback history for student:', studentId);

            if (!studentId) {
                clearFeedbackHistory();
                return;
            }

            const urlParams = new URLSearchParams(window.location.search);
            const currentLanguage = urlParams.get('language') || 'english';

            console.log('Current language:', currentLanguage);

            // Show loading state
            const feedbackHistoryDiv = document.getElementById('feedbackHistory');
            const noFeedbackMessage = document.getElementById('noFeedbackMessage');

            feedbackHistoryDiv.innerHTML = '<div class="empty-state"><i class="fas fa-spinner fa-spin"></i><p>Loading feedback history...</p></div>';
            noFeedbackMessage.style.display = 'none';

            // Fetch feedback history from backend
            const url = `/teacher/feedback-history?student_id=${studentId}&language=${currentLanguage}`;
            console.log('Fetching from URL:', url);

            fetch(url)
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Feedback history data:', data);

                    if (data.success && data.feedback && data.feedback.length > 0) {
                        // Clear loading state
                        feedbackHistoryDiv.innerHTML = '';
                        noFeedbackMessage.style.display = 'none';

                        // Add each feedback item to history
                        data.feedback.forEach(feedback => {
                            addFeedbackToHistory(feedback);
                        });

                        console.log('Added', data.feedback.length, 'feedback items to history');
                    } else {
                        // No feedback found
                        console.log('No feedback found for student');
                        clearFeedbackHistory();
                    }
                })
                .catch(error => {
                    console.error('Error loading feedback history:', error);
                    feedbackHistoryDiv.innerHTML = '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><p>Error loading feedback history.</p></div>';
                    noFeedbackMessage.style.display = 'none';
                });
        }

        // Clear feedback history display
        function clearFeedbackHistory() {
            const feedbackHistoryDiv = document.getElementById('feedbackHistory');
            const noFeedbackMessage = document.getElementById('noFeedbackMessage');

            feedbackHistoryDiv.innerHTML = '';
            noFeedbackMessage.style.display = 'block';
        }

        // Assessment saving functionality
        function saveAssessment() {
            const studentSelect = document.getElementById('studentSelect');
            const studentId = studentSelect.value; // Student ID is in the value attribute
            const studentSearchInput = document.getElementById('studentSearchInput');
            const studentName = studentSearchInput.value.trim(); // Get the display name from search input

            const miscues = parseInt(document.getElementById('miscues').value) || 0;
            const totalWords = parseInt(document.getElementById('totalWords').value) || 0;

            // Set default comprehension values (will be handled on student side)
            const correctAnswers = 0;
            const totalQuestions = 0;

            // Get timer data
            const timerElement = document.getElementById('timer');
            const timeText = timerElement.textContent;
            const timeParts = timeText.split(':');
            const totalSeconds = (parseInt(timeParts[0]) * 3600) + (parseInt(timeParts[1]) * 60) + parseInt(timeParts[2]);

            // Calculate reading speed (WPM) - allow 0 minutes
            const readingTimeMinutes = totalSeconds / 60; // Allow any time including 0
            const readingSpeed = readingTimeMinutes > 0 ? Math.round(totalWords / readingTimeMinutes) : 0;

            // Calculate comprehension percentage
            const comprehension = totalQuestions > 0 ? Math.round((correctAnswers / totalQuestions) * 100) : 0;

            // Calculate correct reading percentage (words read correctly)
            const correctReading = totalWords > 0 ? Math.round(((totalWords - miscues) / totalWords) * 100) : 0;

            // Get current page parameters
            const urlParams = new URLSearchParams(window.location.search);
            const grade = urlParams.get('grade') || 'grade7';
            const section = urlParams.get('section') || 'narra';
            const language = urlParams.get('language') || 'english';

            // Validation
            if (!studentId) {
                alert('Please select a student first!');
                return;
            }

            if (!studentName) {
                alert('Student name is missing. Please select a student again!');
                return;
            }

            if (totalWords <= 0) {
                alert('Please enter the total number of words!');
                return;
            }

            // Show confirmation dialog
            const confirmMessage = `Save assessment for ${studentName}?\n\nReading Speed: ${readingSpeed} wpm\nCorrect Reading: ${correctReading}%\nTime: ${timeText}`;

            if (!confirm(confirmMessage)) {
                return; // User cancelled
            }

            // Prepare assessment data
            const assessmentData = {
                student_id: studentId,
                student_name: studentName,
                reading_material_id: {{ $readingMaterial ? $readingMaterial->id : 'null' }}, // Include the reading material ID
                reading_time: totalSeconds,
                miscues: miscues,
                total_words: totalWords,
                correct_answers: correctAnswers,
                total_questions: totalQuestions,
                reading_speed: readingSpeed,
                comprehension: comprehension,
                correct_reading: correctReading,
                section: section,
                language: language,
                grade: grade.replace('grade', ''),
                assessment_date: new Date().toISOString()
            };

            // Debug log the assessment data
            console.log('Assessment data to be sent:', assessmentData);

            // Show loading state
            const saveButton = document.querySelector('.save-assessment');
            const originalText = saveButton.textContent;
            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            // Check CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                alert('CSRF token not found. Please refresh the page and try again.');
                saveButton.disabled = false;
                saveButton.textContent = originalText;
                return;
            }

            // Send to backend
            fetch('/teacher/save-reading-assessment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: JSON.stringify(assessmentData)
            })
                .then(async response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);

                    let data;
                    try {
                        data = await response.json();
                        console.log('Response data:', data);
                    } catch (e) {
                        console.error('Failed to parse JSON response:', e);
                        throw new Error('Invalid JSON response');
                    }
                    if (response.ok && data.success) {
                        alert(`Assessment saved successfully!\n\nStudent: ${studentName}\nReading Speed: ${readingSpeed} WPM\nCorrect Reading: ${correctReading}%\nNote: Comprehension will be assessed on student side`);
                        // Refresh charts with new data
                        refreshStudentCharts(studentId);
                        clearAssessment();
                    } else if (response.status === 422 && data.errors) {
                        // Show all validation errors
                        let errorMsg = 'Validation failed:';
                        for (const [field, messages] of Object.entries(data.errors)) {
                            errorMsg += `\n- ${field}: ${messages.join(', ')}`;
                        }
                        alert(errorMsg);
                    } else {
                        alert('Error saving assessment: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving assessment. Please try again. ' + (error.message || ''));
                })
                .finally(() => {
                    saveButton.disabled = false;
                    saveButton.textContent = originalText;
                });
        }

        function clearAssessment() {
            // Reset all form fields
            document.getElementById('studentSelect').value = '';
            document.getElementById('studentSearchInput').value = '';
            document.getElementById('miscues').value = '0';

            // Reset timer
            resetTimer();

            // Recalculate word count from current passage
            updateWordCount();

            // Clear any selected student in dropdown
            const allOptions = document.querySelectorAll('.dropdown-option');
            allOptions.forEach(opt => opt.classList.remove('selected'));

            // Show confirmation
            console.log('Assessment form cleared');
        }

        // Function to refresh student charts after assessment saving
        function refreshStudentCharts(studentId) {
            if (!studentId) {
                console.log('No student ID provided for chart refresh');
                return;
            }

            console.log('Assessment saved for student ID:', studentId);

            // Just log the success - don't open any new windows or redirect
            console.log('Assessment data has been saved to the student record');


        }
    </script>
@endsection