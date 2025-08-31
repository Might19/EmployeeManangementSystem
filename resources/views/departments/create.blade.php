<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container">
    <h1 class="mb-4">Add Department</h1>

    <form method="POST" action="{{ route('departments.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
