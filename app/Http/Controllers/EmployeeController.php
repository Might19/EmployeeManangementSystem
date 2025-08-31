<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Show list of employees
    public function index()
    {
       
        $employees = Employee::with('department')->get();
        return view('employees.index', compact('employees'));
    }

 public function create()
{
    // You might want to pass departments for dropdown selection
    $departments = Department::all();

    return view('employees.create', compact('departments'));
}

public function store(Request $request)
{
    $request->validate([
    
        'email' => 'required|email|unique:employees,email',
        'department_id' => 'required|exists:departments,id',
    ]);

    Employee::create($request->all());

    return redirect()->route('employees.index')
                     ->with('success', 'Employee added successfully.');
}

public function update(Request $request, Employee $employee)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:employees,email,' . $employee->id,
    ]);

    $employee->update($validated);

    return redirect()->route('employees.index')
                     ->with('success', 'Employee updated successfully.');
}

}

