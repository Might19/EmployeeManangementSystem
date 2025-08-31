<!DOCTYPE html>
<html>
<head>
    <title>Manage Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fb;
            font-family: "Segoe UI", sans-serif;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .table thead {
            background: #f1f3f6;
        }

        .table th {
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .employee-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .btn-action {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 6px;
        }

        .btn-view {
            background: #3498db;
            color: #fff;
        }

        .btn-edit {
            background: #2ecc71;
            color: #fff;
        }

        .btn-salary {
            background: #f1c40f;
            color: #fff;
        }

        .btn-leave {
            background: #e74c3c;
            color: #fff;
        }

        .search-bar {
            max-width: 280px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 2px 8px;
            margin: 0 2px;
            border-radius: 4px;
            background: #f0f0f0;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3498db !important;
            color: #fff !important;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Manage Employees</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success">+ Add New Employee</a>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" class="form-control search-bar" placeholder="Search By Employee ID">
    </div>

    <!-- Employee Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>S No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ $employee->image_url ?? 'https://via.placeholder.com/40' }}" 
                             class="employee-img" alt="Employee">
                    </td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>
                        <button class="btn btn-action btn-view">View</button>
                        <button class="btn btn-action btn-edit">Edit</button>
                        <button class="btn btn-action btn-salary">Salary</button>
                        <button class="btn btn-action btn-leave">Leave</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
</body>
</html>
