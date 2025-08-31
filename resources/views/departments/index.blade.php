<!DOCTYPE html>
<html>
<head>
    <title>Departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container">
    <h1 class="mb-4">Departments</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add Department</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Department Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No departments found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
