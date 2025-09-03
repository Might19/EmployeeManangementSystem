{{-- resources/views/employees/index.blade.php --}}
@extends('dashboard')

@section('content')
<div class="container">
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
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>
                        <button type="button" 
                                class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#viewEmployeeModal" 
                                onclick="showEmployeeDetails({{ $employee->id }})">
                            View
                        </button>
                        <button class="btn btn-success btn-sm">Edit</button>
                        <button class="btn btn-warning btn-sm">Salary</button>
                        <button class="btn btn-danger btn-sm">Leave</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- View Employee Modal -->
    <div class="modal fade" id="viewEmployeeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Employee Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>First Name:</strong> <span id="view-first-name"></span></p>
                            <p><strong>Last Name:</strong> <span id="view-last-name"></span></p>
                            <p><strong>Email:</strong> <span id="view-email"></span></p>
                            <p><strong>Phone:</strong> <span id="view-phone"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Position:</strong> <span id="view-position"></span></p>
                            <p><strong>Department:</strong> <span id="view-department"></span></p>
                            <p><strong>Salary:</strong> <span id="view-salary"></span></p>
                            <p><strong>Joined Date:</strong> <span id="view-created-at"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showEmployeeDetails(employeeId) {
    fetch(`/employees/${employeeId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('view-first-name').textContent = data.first_name;
        document.getElementById('view-last-name').textContent = data.last_name;
        document.getElementById('view-email').textContent = data.email;
        document.getElementById('view-phone').textContent = data.phone || 'N/A';
        document.getElementById('view-position').textContent = data.position || 'N/A';
        document.getElementById('view-department').textContent = data.department.name;
        document.getElementById('view-salary').textContent = data.salary ? `$${data.salary}` : 'N/A';
        document.getElementById('view-created-at').textContent = new Date(data.created_at).toLocaleDateString();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading employee details');
    });
}
</script>
@endpush
@endsection
