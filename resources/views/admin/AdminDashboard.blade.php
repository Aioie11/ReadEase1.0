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
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        text-align: left;
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
        text-align: left;
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

    .metric-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #7f8c8d;
    }

    .trend-up {
        color: #27ae60;
    }

    .trend-down {
        color: #e74c3c;
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

    .search-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .search-input {
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        width: 280px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        outline: none;
        border-color: #00B8A9;
        box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
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

    /* Pagination Styles - Clean Stud-Dash Style */
    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.75rem 1rem;
        border: 1px solid #e9ecef;
        background: white;
        color: #2c3e50;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .pagination-btn:hover {
        background: #f8f9fa;
        border-color: #2c3e50;
    }

    .pagination-btn.active {
        background: #2c3e50;
        color: white;
        border-color: #2c3e50;
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
                    <div class="metric-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+12% from last month</span>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon students">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <h2>Total Students</h2>
                    <p class="metric-value">{{ $totalStudents }}</p>
                    <div class="metric-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+8% from last month</span>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon active">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h2>Active Students</h2>
                    <p class="metric-value">{{ $topListeners }}</p>
                    <div class="metric-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>+15% from last month</span>
                    </div>
                </div>
            </div>
            

            <!-- Recent Tests -->
            <div class="recent-tests">
                <div class="recent-tests-header">
                    <h2>
                        <i class="fas fa-clock"></i>
                        Recent Test Activity
                    </h2>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Search by student or test type...">
                    </div>
                </div>

                <div class="table-container">
                    <table id="recentTestsTable">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user"></i> Student</th>
                                <th><i class="fas fa-file-alt"></i> Test Type</th>
                                <th><i class="fas fa-percentage"></i> Score</th>
                                <th><i class="fas fa-calendar"></i> Date</th>
                                <th><i class="fas fa-check-circle"></i> Status</th>
                                <th><i class="fas fa-cog"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($recentTests) > 0)
                                @foreach($recentTests as $test)
                                    <tr>
                                        <td><strong>{{ $test->student_name }}</strong></td>
                                        <td>
                                            @php
                                                $badgeClass = 'test-type-badge ';
                                                if (str_contains($test->test_type, 'English')) {
                                                    $badgeClass .= 'test-type-english';
                                                } elseif (str_contains($test->test_type, 'Filipino')) {
                                                    $badgeClass .= 'test-type-filipino';
                                                } else {
                                                    $badgeClass .= 'test-type-reading';
                                                }
                                            @endphp
                                            <span class="{{ $badgeClass }}">{{ $test->test_type }}</span>
                                        </td>
                                        <td style="text-align: center;"><strong>{{ $test->score }}%</strong></td>
                                        <td>{{ $test->created_at->format('M d, Y') }}</td>
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
                                        <td style="text-align: center;">
                                            <form action="{{ route('admin.delete.test', $test->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this test?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
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

                <!-- Pagination Controls -->
                <div id="pagination" class="pagination-container"></div>
            </div>
        </div>
    </main>

    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality with enhanced UX
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    let filter = this.value.toLowerCase();
                    let rows = document.querySelectorAll('#recentTestsTable tbody tr');
                    let visibleRows = 0;

                    rows.forEach(row => {
                        // Skip the "no data" row
                        if (row.children.length === 1 && row.children[0].getAttribute('colspan')) {
                            return;
                        }

                        let student = row.children[0].textContent.toLowerCase();
                        let testType = row.children[1].textContent.toLowerCase();

                        if (student.includes(filter) || testType.includes(filter)) {
                            row.style.display = '';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Reset to first page when searching
                    currentPage = 1;
                    paginateTable();
                });
            }

            // Enhanced pagination functionality
            const rowsPerPage = 8;
            let currentPage = 1;

            function paginateTable() {
                let rows = Array.from(document.querySelectorAll('#recentTestsTable tbody tr')).filter(row => {
                    // Filter out hidden rows and "no data" rows
                    return row.style.display !== 'none' &&
                           !(row.children.length === 1 && row.children[0].getAttribute('colspan'));
                });

                let totalRows = rows.length;
                let totalPages = Math.ceil(totalRows / rowsPerPage);
                let pagination = document.getElementById('pagination');

                if (pagination) {
                    pagination.innerHTML = '';

                    if (totalPages <= 1) {
                        showPage(rows);
                        return;
                    }

                    // Previous button
                    if (currentPage > 1) {
                        let prevBtn = createPaginationButton('‹ Previous', currentPage - 1);
                        pagination.appendChild(prevBtn);
                    }

                    // Page numbers
                    let startPage = Math.max(1, currentPage - 2);
                    let endPage = Math.min(totalPages, currentPage + 2);

                    if (startPage > 1) {
                        pagination.appendChild(createPaginationButton('1', 1));
                        if (startPage > 2) {
                            let ellipsis = document.createElement('span');
                            ellipsis.textContent = '...';
                            ellipsis.className = 'pagination-ellipsis';
                            ellipsis.style.padding = '0.75rem';
                            ellipsis.style.color = '#666';
                            pagination.appendChild(ellipsis);
                        }
                    }

                    for (let i = startPage; i <= endPage; i++) {
                        let btn = createPaginationButton(i.toString(), i);
                        if (i === currentPage) {
                            btn.classList.add('active');
                        }
                        pagination.appendChild(btn);
                    }

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) {
                            let ellipsis = document.createElement('span');
                            ellipsis.textContent = '...';
                            ellipsis.className = 'pagination-ellipsis';
                            ellipsis.style.padding = '0.75rem';
                            ellipsis.style.color = '#666';
                            pagination.appendChild(ellipsis);
                        }
                        pagination.appendChild(createPaginationButton(totalPages.toString(), totalPages));
                    }

                    // Next button
                    if (currentPage < totalPages) {
                        let nextBtn = createPaginationButton('Next ›', currentPage + 1);
                        pagination.appendChild(nextBtn);
                    }

                    showPage(rows);
                }
            }

            function createPaginationButton(text, page) {
                let btn = document.createElement('button');
                btn.textContent = text;
                btn.className = 'pagination-btn';
                btn.onclick = function() {
                    currentPage = page;
                    paginateTable();
                };
                return btn;
            }

            function showPage(rows = null) {
                if (!rows) {
                    rows = Array.from(document.querySelectorAll('#recentTestsTable tbody tr')).filter(row => {
                        return row.style.display !== 'none' &&
                               !(row.children.length === 1 && row.children[0].getAttribute('colspan'));
                    });
                }

                rows.forEach((row, idx) => {
                    let shouldShow = (idx >= (currentPage - 1) * rowsPerPage && idx < currentPage * rowsPerPage);
                    row.style.display = shouldShow ? '' : 'none';
                });
            }

            // Initial pagination
            paginateTable();

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



