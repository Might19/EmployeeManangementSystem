<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Add New Employee</h4>
        </div>
        <div class="card-body">

            {{-- Show validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('employees.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <input type="text" name="position" class="form-control" value="{{ old('position') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Salary</label>
                    <input type="number" name="salary" step="0.01" class="form-control" value="{{ old('salary') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
