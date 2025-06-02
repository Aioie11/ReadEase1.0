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
            padding: 2rem 5% 2rem;
            transition: var(--transition);
        }

        /* Dashboard Metrics */
        .dashboard-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .metric-card {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .metric-card:hover {
            transform: translateY(-5px);
        }

        .metric-card h2 {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .metric-card p {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 600;
        }

        /* Chart Section */
        .chart-section {
            background: var(--neutral-light);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2.5rem;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
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

        th, td {
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
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .dashboard-metrics {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
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

        <div class="recent-tests">
            <h2>Recent Tests</h2>
            <table>
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
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>