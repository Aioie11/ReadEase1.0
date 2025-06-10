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

    /* Main Content */
    .main-content {
        margin-top: 50px;
        margin-left: 280px;
        padding: 6rem 5% 2rem;
        transition: var(--transition);
        background: var(--neutral);
    }

    /* Dashboard Header */
    .dashboard-header {
        margin-bottom: 2rem;
        padding: 1.5rem 0;
    }

    .dashboard-header h1 {
        color: var(--primary);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .dashboard-header p {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-left: 3.5rem;
    }

    /* Dashboard Grid Layout */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: auto auto auto;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    /* Dashboard Metrics */
    .dashboard-metrics {
        grid-column: 1 / -1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .metric-card {
        background: linear-gradient(135deg, var(--neutral-light) 0%, #ffffff 100%);
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 184, 169, 0.1);
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 184, 169, 0.15);
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
    }

    .metric-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .metric-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .metric-card h2 {
        color: var(--text-light);
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .metric-value {
        color: var(--primary);
        font-size: 2.8rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }

    .metric-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.85rem;
    }

    .trend-up {
        color: #10b981;
    }

    .trend-down {
        color: #ef4444;
    }

    /* Quick Actions Section */
    .quick-actions {
        grid-column: 1 / -1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: var(--neutral-light);
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        color: var(--text);
        border: 1px solid rgba(0, 184, 169, 0.1);
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(0, 184, 169, 0.15);
        background: var(--primary);
        color: white;
        text-decoration: none;
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.8rem;
        transition: all 0.3s ease;
    }

    .action-card:hover .action-icon {
        background: white;
        color: var(--primary);
        transform: scale(1.1);
    }

    .action-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .action-description {
        font-size: 0.85rem;
        opacity: 0.8;
        line-height: 1.4;
    }

    /* Chart Section */
    .chart-section {
        background: linear-gradient(135deg, var(--neutral-light) 0%, #ffffff 100%);
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        border: 1px solid rgba(0, 184, 169, 0.1);
    }

    .chart-section h2 {
        color: var(--primary);
        font-size: 1.4rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Recent Tests Table */
    .recent-tests {
        grid-column: 1 / -1;
        background: linear-gradient(135deg, var(--neutral-light) 0%, #ffffff 100%);
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 184, 169, 0.1);
    }

    .recent-tests-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--neutral);
    }

    .recent-tests h2 {
        color: var(--primary);
        font-size: 1.4rem;
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .search-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .search-input {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 2px solid var(--neutral);
        width: 280px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.1);
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    th,
    td {
        padding: 1.2rem 1rem;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }

    th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: var(--text);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--primary);
    }

    /* Adjust column widths for better display */
    th:nth-child(1), td:nth-child(1) { /* Student */
        width: 20%;
    }
    th:nth-child(2), td:nth-child(2) { /* Test Type */
        width: 25%;
        word-wrap: break-word;
    }
    th:nth-child(3), td:nth-child(3) { /* Score */
        width: 10%;
        text-align: center;
    }
    th:nth-child(4), td:nth-child(4) { /* Date */
        width: 15%;
    }
    th:nth-child(5), td:nth-child(5) { /* Status */
        width: 15%;
    }
    th:nth-child(6), td:nth-child(6) { /* Action */
        width: 15%;
        text-align: center;
    }

    tbody tr {
        transition: all 0.3s ease;
    }

    tbody tr:hover {
        background: linear-gradient(135deg, #f0fdfa 0%, #f7fafc 100%);
        transform: scale(1.01);
    }

    .delete-btn {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    /* Test type badges */
    .test-type-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .test-type-english {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border: 1px solid #3b82f6;
    }

    .test-type-filipino {
        background: linear-gradient(135deg, #fce7f3 0%, #f9a8d4 100%);
        color: #be185d;
        border: 1px solid #ec4899;
    }

    .test-type-reading {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
        border: 1px solid #22c55e;
    }

    /* Status badges */
    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-completed {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #166534;
        border: 1px solid #22c55e;
    }

    .status-reading-only {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid #f59e0b;
    }

    .status-fully-complete {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #10b981;
    }

    /* Pagination Styles */
    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.75rem 1rem;
        border: 2px solid var(--neutral);
        background: white;
        color: var(--text);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .pagination-btn:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .pagination-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* System Status Section */
    .system-status {
        background: linear-gradient(135deg, var(--neutral-light) 0%, #ffffff 100%);
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 184, 169, 0.1);
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid var(--neutral);
    }

    .status-item:last-child {
        border-bottom: none;
    }

    .status-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }

    .status-online {
        background: #10b981;
    }

    .status-warning {
        background: #f59e0b;
    }

    .status-offline {
        background: #ef4444;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .dashboard-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-metrics {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: repeat(2, 1fr);
        }

        .main-content {
            margin-left: 0;
            padding: 6rem 3% 2rem;
        }
    }

    @media (max-width: 600px) {
        .quick-actions {
            grid-template-columns: 1fr;
        }

        .search-input {
            width: 200px;
        }
    }
</style>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>
                <i class="fas fa-tachometer-alt"></i>
                Admin Dashboard
            </h1>
            <p>Welcome back! Here's what's happening with ReadEase today.</p>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Dashboard Metrics -->
            <div class="dashboard-metrics">
                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon">
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
                        <div class="metric-icon">
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
                        <div class="metric-icon">
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

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ route('admin.student-records') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-title">Manage Students</div>
                    <div class="action-description">Add, edit, or view student records</div>
                </a>

                <a href="{{ route('admin.test-management') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="action-title">Test Management</div>
                    <div class="action-description">Create and manage assessments</div>
                </a>

                <a href="{{ route('admin.reports') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-title">View Reports</div>
                    <div class="action-description">Analyze performance data</div>
                </a>

                <a href="{{ route('admin.user-management') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="action-title">User Management</div>
                    <div class="action-description">Manage system users</div>
                </a>
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



