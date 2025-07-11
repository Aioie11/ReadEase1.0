@extends('layouts.head-ad')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: var(--neutral-light);
    }

    /* Main Content - Clean Stud-Dash Style */
    .main-content {
        margin-top: 60px;
        padding: 50px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    /* Dashboard Container - Clean Organization */
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding-top: 1rem;
    }

    /* Dashboard Header - Clean Stud-Dash Style */
    .dashboard-header {
        text-align: center;
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        text-align: center;
        color: #00B8A9;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }


    .dashboard-header p {
        color: #7f8c8d;
        font-size: 1.1rem;
        margin: 0;
        line-height: 0. 9rem;

    }

    /* Dashboard Metrics - Clean Stud-Dash Style */
    .dashboard-metrics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .metric-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .metric-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .metric-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .metric-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: #00B8A9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white !important;
        font-size: 1.3rem;
    }

    .metric-icon.tests {
        background: #3498db;
    }

    .metric-icon.students {
        background: #00B8A9;
    }

    .metric-icon.active {
        background: #f39c12;
    }

    .metric-icon i {
        color: white !important;
        font-size: 1.3rem;
        display: block;
    }

    .metric-card h2 {
        color: #2c3e50;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .metric-value {
        color: #00B8A9;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }



    /* Quick Actions Section - Clean Stud-Dash Style */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        color: #2c3e50;
    }

    .action-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        color: #2c3e50;
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: #00B8A9;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white !important;
        font-size: 1.5rem;
    }

    .action-icon i {
        color: white !important;
        font-size: 1.5rem;
        display: block;
    }

    .action-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
        color: #2c3e50;
    }

    .action-description {
        font-size: 0.9rem;
        color: #7f8c8d;
        line-height: 1.4;
    }

    /* Recent Tests Table - Clean Stud-Dash Style */
    .recent-tests {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .recent-tests-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
    }

    .recent-tests h2 {
        color: #2c3e50;
        font-size: 1.3rem;
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .recent-tests h2 i {
        color: #00B8A9;
    }



    /* Table Styles - Beautiful Student Management Style */
    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
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

    /* Table Row Styling - Beautiful Student Management Style */
    tbody tr:not(:last-child) {
        border-bottom: 1px solid #e9ecef;
    }

    tbody tr:hover {
        background-color: rgba(0, 184, 169, 0.05);
    }

    .delete-btn {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .delete-btn:hover {
        background: #c0392b;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
    }

    /* Test type badges - Beautiful Student Management Style */
    .test-type-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .test-type-english {
        background: #dbeafe;
        color: #1e40af;
    }

    .test-type-filipino {
        background: #fce7f3;
        color: #be185d;
    }

    .test-type-reading {
        background: #dcfce7;
        color: #166534;
    }

    /* Status badges - Beautiful Student Management Style */
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

    .status-reading-only {
        background: #fef3c7;
        color: #92400e;
    }

    .status-fully-complete {
        background: #d1fae5;
        color: #065f46;
    }

    /* Assessment Level badges - Matching student reports colors */
    .level-independent {
        background: #00B8A9;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .level-instructional {
        background: #F39C12;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .level-frustration {
        background: #E74C3C;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }



    /* Responsive Design - Clean Stud-Dash Style */
    @media (max-width: 1200px) {
        .dashboard-metrics {
            grid-template-columns: repeat(2, 1fr);
        }

        .quick-actions {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 15px;
        }

        .dashboard-container {
            padding-top: 0;
        }

        .dashboard-header {
            padding: 1.5rem;
        }

        .dashboard-header h1 {
            font-size: 1.5rem;
        }

        .dashboard-metrics {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .quick-actions {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .metric-card,
        .action-card {
            padding: 1.5rem;
        }

        .search-input {
            width: 200px;
        }

        .recent-tests {
            padding: 1.5rem;
        }
    }
</style>

    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-container">
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <h1>Admin Dashboard</h1>
                    <p>Select a grade level below to view sections and manage your students' reading assessments. Track progress, view reports, and support your students' reading journey.</p>
            </div>

            <!-- Dashboard Metrics -->
            <div class="dashboard-metrics">
                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon tests">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <h2>Total Tests</h2>
                    <p class="metric-value">{{ $totalTests }}</p>

                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon students">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <h2>Total Students</h2>
                    <p class="metric-value">{{ $totalStudents }}</p>

                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon active">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h2>Active Students</h2>
                    <p class="metric-value">{{ $topListeners }}</p>

                </div>
            </div>
            

            <!-- Recent Tests -->
            <div class="recent-tests">
                <div class="recent-tests-header">
                    <h2>
                        <i class="fas fa-clock"></i>
                        Recent Test Activity
                    </h2>
                </div>

                <div class="table-container">
                    <table id="recentTestsTable">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar"></i> Date</th>
                                <th><i class="fas fa-user"></i> Student</th>
                                <th><i class="fas fa-file-alt"></i> Test Type</th>
                                <th><i class="fas fa-percentage"></i> Score</th>
                                <th><i class="fas fa-chart-line"></i> Assessment Level</th>
                                <th><i class="fas fa-check-circle"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($recentTests) > 0)
                                @foreach($recentTests as $test)
                                    <tr>
                                        <td>{{ $test->created_at->format('M d, Y') }}</td>
                                        <td>{{ $test->student_name }}</td>
                                        <td>{{ $test->test_type }}</td>
                                        <td style="text-align: center;">{{ $test->score }}%</td>
                                        <td style="text-align: center;">
                                            @php
                                                $levelClass = '';
                                                if ($test->assessment_level === 'Independent') {
                                                    $levelClass = 'level-independent';
                                                } elseif ($test->assessment_level === 'Instructional') {
                                                    $levelClass = 'level-instructional';
                                                } else {
                                                    $levelClass = 'level-frustration';
                                                }
                                            @endphp
                                            <span class="{{ $levelClass }}">{{ $test->assessment_level }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = 'status-badge ';
                                                if ($test->status === 'Completed') {
                                                    $statusClass .= 'status-completed';
                                                } elseif ($test->status === 'Reading Only') {
                                                    $statusClass .= 'status-reading-only';
                                                } elseif ($test->status === 'Fully Complete') {
                                                    $statusClass .= 'status-fully-complete';
                                                } else {
                                                    $statusClass .= 'status-completed';
                                                }
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $test->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center; color: #888; padding: 3rem;">
                                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                                        <br>
                                        <strong>No recent tests found.</strong>
                                        <br>
                                        <span style="font-size: 0.9rem;">Tests will appear here once students start taking assessments.</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </main>

    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {




            // Add smooth scrolling to action cards
            document.querySelectorAll('.action-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Add a subtle animation on click
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });
    </script>
<!-- </body>
</html> -->
@endsection



