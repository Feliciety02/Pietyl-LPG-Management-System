<x-app-layout>
    <div
        x-data="{
            showAdd: false,
            showEdit: false,
            showDelete: false
        }"
        class="max-w-6xl mx-auto py-8"
    >

        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Employees
                </h1>
                <p class="mt-1 text-sm text-slate-600">
                    Manage staff accounts, roles, and access permissions. Only the Owner Admin can edit these.
                </p>
            </div>

            <a
                href="{{ route('admin.employees.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                Add Employee
            </a>
        </div>

        <div class="mt-6 grid lg:grid-cols-3 gap-4">
            <div class="phoenix-card p-5">
                <div class="text-xs font-bold text-slate-500">TOTAL EMPLOYEES</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">{{ $totalEmployees ?? 0 }}</div>
                <div class="mt-1 text-sm text-slate-600">Active staff accounts</div>
            </div>

            <div class="phoenix-card p-5">
                <div class="text-xs font-bold text-slate-500">ROLES</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">{{ $rolesCount ?? 5 }}</div>
                <div class="mt-1 text-sm text-slate-600">
                    Owner, cashier, inventory, accountant, delivery
                </div>
            </div>

            <div class="phoenix-card p-5">
                <div class="text-xs font-bold text-slate-500">SECURITY</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">Owner only</div>
                <div class="mt-1 text-sm text-slate-600">
                    Access limited to Owner Admin
                </div>
            </div>
        </div>

        <div class="mt-6 phoenix-card overflow-hidden">
            <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <div class="text-lg font-extrabold text-slate-900">Staff List</div>
                    <div class="mt-1 text-sm text-slate-600">
                        Create accounts, assign roles, and manage status.
                    </div>
                </div>

                <form method="GET" class="w-full sm:w-80">
                    <input
                        type="text"
                        name="q"
                        value="{{ $q ?? '' }}"
                        placeholder="Search name, email, role..."
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30"
                    />
                </form>
            </div>

            @if (session('status'))
                <div class="mx-5 mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full border-t border-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                Name
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                Role
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase">
                                Status
                            </th>
                            <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse(($employees ?? []) as $employee)
                            <tr>
                                <td class="px-5 py-4">
                                    <div class="text-sm font-semibold text-slate-900">
                                        {{ $employee->full_name }}
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        {{ $employee->email ?? 'No email' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-sm text-slate-700">
                                    {{ $employee->role_name }}
                                </td>

                                <td class="px-5 py-4">
                                    @if($employee->is_active)
                                        <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-200 px-2 py-1 text-xs font-semibold text-slate-700">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right space-x-3">
                                    <a
                                        href="{{ route('admin.employees.edit', $employee) }}"
                                        class="text-sm font-semibold text-teal-600 hover:underline">
                                        Edit
                                    </a>

                                    <form
                                        class="inline"
                                        method="POST"
                                        action="{{ route('admin.employees.destroy', $employee) }}"
                                        onsubmit="return confirm('Delete this employee?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-5 py-8 text-sm text-slate-600" colspan="4">
                                    No employees found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                @if(isset($employees) && method_exists($employees, 'links'))
                    {{ $employees->links() }}
                @endif
            </div>

            <div class="p-4 text-xs text-slate-500">
                Tip: Disable accounts instead of deleting for audit safety.
            </div>
        </div>

        {{-- Optional: keep your modals for later UI polish, but they are not wired to backend yet --}}
        <div
            x-show="showAdd"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        >
            <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-lg">
                <div class="text-lg font-extrabold text-slate-900">Add Employee</div>

                <p class="mt-2 text-sm text-slate-600">
                    This modal is not connected to the backend yet. Use the Create page for now.
                </p>

                <div class="mt-6 flex justify-end gap-2">
                    <button @click="showAdd = false" class="rounded-xl border px-4 py-2 text-sm">
                        Close
                    </button>
                    <a href="{{ route('admin.employees.create') }}"
                       class="rounded-xl bg-teal-600 px-4 py-2 text-sm font-semibold text-white">
                        Go to Create
                    </a>
                </div>
            </div>
        </div>

        <div
            x-show="showEdit"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        >
            <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-lg">
                <div class="text-lg font-extrabold text-slate-900">Edit Employee</div>

                <p class="mt-2 text-sm text-slate-600">
                    Editing is handled on the Edit page for now.
                </p>

                <div class="mt-6 flex justify-end gap-2">
                    <button @click="showEdit = false" class="rounded-xl border px-4 py-2 text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>

        <div
            x-show="showDelete"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
        >
            <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-lg">
                <div class="text-lg font-extrabold text-slate-900">Delete Employee</div>

                <p class="mt-2 text-sm text-slate-600">
                    Deleting is handled by the Delete button in the table for now.
                </p>

                <div class="mt-6 flex justify-end gap-2">
                    <button @click="showDelete = false" class="rounded-xl border px-4 py-2 text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
