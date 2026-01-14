<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $employees = Employee::query()
            ->when($q, function ($query) use ($q) {
                $query->where('full_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('role_name', 'like', "%{$q}%");
            })
            ->orderBy('full_name')
            ->paginate(10)
            ->withQueryString();

        $totalEmployees = Employee::where('is_active', true)->count();

        return view('admin.employee', compact('employees', 'q', 'totalEmployees'));
    }

    public function create()
    {
        $roles = [
            'Owner Admin',
            'Accountant Bookkeeper',
            'Sales Cashier',
            'Inventory Stock Custodian',
            'Delivery Rider Driver',
        ];

        return view('admin.employees.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = [
            'Owner Admin',
            'Accountant Bookkeeper',
            'Sales Cashier',
            'Inventory Stock Custodian',
            'Delivery Rider Driver',
        ];

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:150', 'unique:employees,email'],
            'role_name' => ['required', Rule::in($roles)],
            'pin' => ['required', 'digits:4'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Employee::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'] ?? null,
            'role_name' => $validated['role_name'],
            'pin_hash' => Hash::make($validated['pin']),
            'is_active' => (bool)($validated['is_active'] ?? true),
        ]);

return redirect()
    ->route('admin.employees.index')
    ->with('status', 'Employee added.');
    }

    public function edit(Employee $employee)
    {
        $roles = [
            'Owner Admin',
            'Accountant Bookkeeper',
            'Sales Cashier',
            'Inventory Stock Custodian',
            'Delivery Rider Driver',
        ];

        return view('admin.employees.edit', compact('employee', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $roles = [
            'Owner Admin',
            'Accountant Bookkeeper',
            'Sales Cashier',
            'Inventory Stock Custodian',
            'Delivery Rider Driver',
        ];

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:150', Rule::unique('employees', 'email')->ignore($employee->id)],
            'role_name' => ['required', Rule::in($roles)],
            'pin' => ['nullable', 'digits:4'], // optional on edit
            'is_active' => ['nullable', 'boolean'],
        ]);

        $employee->full_name = $validated['full_name'];
        $employee->email = $validated['email'] ?? null;
        $employee->role_name = $validated['role_name'];
        $employee->is_active = (bool)($validated['is_active'] ?? true);

        if (!empty($validated['pin'])) {
            $employee->pin_hash = Hash::make($validated['pin']);
        }

        $employee->save();

        return redirect()->route('employees.index')->with('status', 'Employee updated.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('status', 'Employee deleted.');
    }
}
