<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Employees
                </h1>
                <p class="mt-1 text-sm text-slate-600">
                    Manage staff accounts, roles, and access permissions. Only the Owner Admin can edit these.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Add Employee
                </button>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Back to Dashboard
                </a>
            </div>
        </div>

        <div class="mt-6 grid lg:grid-cols-3 gap-4">
            <div class="phoenix-card p-5">
                <div class="text-xs font-bold text-slate-500">TOTAL EMPLOYEES</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">0</div>
                <div class="mt-1 text-sm text-slate-600">Active staff accounts</div>
            </div>

            <div class="phoenix-card p-5">
                <div class="text-xs font-bold text-slate-500">ROLES</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">5</div>
                <div class="mt-1 text-sm text-slate-600">Owner, cashier, inventory, accountant, delivery</div>
            </div>

            <div class="phoenix-card p-5">
                <div class="text-xs font-bold text-slate-500">SECURITY</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">Owner only</div>
                <div class="mt-1 text-sm text-slate-600">Access limited to Owner Admin</div>
            </div>
        </div>

        <div class="mt-6 phoenix-card overflow-hidden">
            <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <div class="text-lg font-extrabold text-slate-900">Staff List</div>
                    <div class="mt-1 text-sm text-slate-600">Create accounts, assign roles, and manage status.</div>
                </div>

                <div class="w-full sm:w-80">
                    <input
                        type="text"
                        placeholder="Search name or email..."
                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30"
                    />
                </div>
            </div>

            <div class="p-5">
                <div class="rounded-xl border border-slate-200 bg-slate-50 p-6">
                    <div class="text-sm font-semibold text-slate-800">
                        No employees yet
                    </div>
                    <div class="mt-1 text-sm text-slate-600">
                        Add your first staff account to start assigning access to modules.
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                            Add Employee
                        </button>

                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                            Import CSV
                        </button>
                    </div>
                </div>

                <div class="mt-5 text-xs text-slate-500">
                    Tip: Keep roles strict. Cashier should not edit items, and inventory staff should not manage users.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
