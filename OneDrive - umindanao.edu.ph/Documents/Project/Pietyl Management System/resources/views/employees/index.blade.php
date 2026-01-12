<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto">
        <x-page-header title="Employees" subtitle="Staff list with role and attendance PIN.">
            <x-slot:actions>
                <x-phoenix-button href="{{ route('employees.create') }}">Add Employee</x-phoenix-button>
            </x-slot:actions>
        </x-page-header>

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="text-left p-3">Name</th>
                        <th class="text-left p-3">Role</th>
                        <th class="text-left p-3">Status</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $employee->full_name }}</td>
                            <td class="p-3">{{ $employee->role_name }}</td>
                            <td class="p-3">
                                @if($employee->is_active)
                                    <span class="px-2 py-1 rounded-lg text-xs bg-emerald-50 text-emerald-700">Active</span>
                                @else
                                    <span class="px-2 py-1 rounded-lg text-xs bg-slate-100 text-slate-700">Inactive</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <a class="text-phoenix-deep font-semibold hover:underline"
                                   href="{{ route('employees.edit', $employee) }}">Edit</a>

                                <form class="inline"
                                      method="POST"
                                      action="{{ route('employees.destroy', $employee) }}"
                                      onsubmit="return confirm('Delete this employee?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ml-3 text-red-600 font-semibold hover:underline" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
