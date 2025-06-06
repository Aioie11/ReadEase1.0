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
    }

    /* Dashboard Metrics */
    .dashboard-metrics {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: stretch;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .metric-card {
        background: var(--neutral-light);
        flex: 1 1 0;
        min-width: 220px;
        max-width: 320px;
        height: 130px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
    }

    .metric-card h2 {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .metric-card p {
        color: var(--primary);
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }

    /* Chart Section */
    .chart-section {
        background: var(--neutral-light);
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .chart-section h2 {
        color: var(--text);
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    /* Recent Tests Table */
    .recent-tests {
        background: var(--neutral-light);
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .recent-tests h2 {
        color: var(--text);
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--neutral-dark);
    }

    th {
        color: var(--text-light);
        font-weight: 500;
    }

    tr:hover {
        background: var(--neutral);
    }

    .delete-btn {
        background-color: #e53935;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #c62828;
    }

    /* Responsive Design */
    @media (max-width: 900px) {
        .dashboard-metrics {
            flex-direction: column;
            gap: 1.5rem;
        }
        .metric-card {
            max-width: 100%;
            width: 100%;
        }
    }
</style>

    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-metrics">
            <div class="metric-card">
                <h2>Total Tests</h2>
                <p>{{ $totalTests }}</p>
            </div>
            <div class="metric-card">
                <h2>Number of Students</h2>
                <p>{{ $totalStudents }}</p>
            </div>
            <div class="metric-card">
                <h2>Top Listeners</h2>
                <p>{{ $topListeners }}</p>
            </div>
        </div>

        <hr style="margin: 2rem 0; border: none; border-top: 2px solid #e0e0e0;">

        <div class="recent-tests">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h2>Recent Tests</h2>
                <input type="text" id="searchInput" placeholder="Search by student or test type..." style="padding: 0.5rem; border-radius: 4px; border: 1px solid #ccc; width: 250px;">
            </div>
            <table id="recentTestsTable">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Test Type</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($recentTests) > 0)
                        @foreach($recentTests as $test)
                            <tr>
                                <td>{{ $test->student_name }}</td>
                                <td>{{ $test->test_type }}</td>
                                <td>{{ $test->score }}%</td>
                                <td>{{ $test->created_at->format('F d, Y') }}</td>
                                <td>{{ $test->status }}</td>
                                <td>
                                    <form action="{{ route('admin.delete.test', $test->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this test?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="text-align: center; color: #888;">No recent tests found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <!-- Pagination Controls -->
            <div id="pagination" style="margin-top: 1rem; display: flex; justify-content: flex-end; gap: 0.5rem;"></div>
        </div>
    </main>

    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    let filter = this.value.toLowerCase();
                    let rows = document.querySelectorAll('#recentTestsTable tbody tr');
                    rows.forEach(row => {
                        let student = row.children[0].textContent.toLowerCase();
                        let testType = row.children[1].textContent.toLowerCase();
                        if (student.includes(filter) || testType.includes(filter)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    paginateTable();
                });
            }

            // Pagination functionality
            const rowsPerPage = 5;
            let currentPage = 1;

            function paginateTable() {
                let rows = Array.from(document.querySelectorAll('#recentTestsTable tbody tr')).filter(row => row.style.display !== 'none');
                let totalRows = rows.length;
                let totalPages = Math.ceil(totalRows / rowsPerPage);
                let pagination = document.getElementById('pagination');
                if (pagination) {
                    pagination.innerHTML = '';
                    if (totalPages <= 1) return;
                    for (let i = 1; i <= totalPages; i++) {
                        let btn = document.createElement('button');
                        btn.textContent = i;
                        btn.style.padding = '0.5rem 1rem';
                        btn.style.border = '1px solid #ccc';
                        btn.style.background = i === currentPage ? '#00bcd4' : '#fff';
                        btn.style.color = i === currentPage ? '#fff' : '#333';
                        btn.style.cursor = 'pointer';
                        btn.style.borderRadius = '4px';
                        btn.onclick = function() {
                            currentPage = i;
                            showPage();
                        };
                        pagination.appendChild(btn);
                    }
                    showPage();
                }
            }

            function showPage() {
                let rows = Array.from(document.querySelectorAll('#recentTestsTable tbody tr')).filter(row => row.style.display !== 'none');
                rows.forEach((row, idx) => {
                    row.style.display = (idx >= (currentPage - 1) * rowsPerPage && idx < currentPage * rowsPerPage) ? '' : 'none';
                });
            }

            // Initial pagination
            paginateTable();
        });
    </script>
<!-- </body>
</html> -->
@endsection



