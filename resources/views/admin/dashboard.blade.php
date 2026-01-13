<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
            <p class="mt-1 text-sm text-slate-600">
                Welcome back, {{ auth()->user()->getRoleNames()->first() ?? 'User' }}.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-sm text-slate-500">Today Sales</div>
                <div class="mt-2 text-2xl font-bold text-slate-900">₱ 0.00</div>
                <div class="mt-2 text-xs text-slate-500">Total sales recorded today</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-sm text-slate-500">Cash on Hand</div>
                <div class="mt-2 text-2xl font-bold text-slate-900">₱ 0.00</div>
                <div class="mt-2 text-xs text-slate-500">Cash payments less change out</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-sm text-slate-500">Pending Deliveries</div>
                <div class="mt-2 text-2xl font-bold text-slate-900">0</div>
                <div class="mt-2 text-xs text-slate-500">For dispatch or in transit</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-sm text-slate-500">Low Stock Items</div>
                <div class="mt-2 text-2xl font-bold text-slate-900">0</div>
                <div class="mt-2 text-xs text-slate-500">At or below minimum stock</div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-bold text-slate-900">Low Stock Alerts</div>
                        <div class="mt-1 text-sm text-slate-600">Items that need reorder soon</div>
                    </div>

                    @role('Owner Admin|Inventory Stock Custodian')
                        <a href="{{ route('items.index') }}"
                           class="text-sm font-semibold text-phoenix-deep hover:underline">
                            View Items
                        </a>
                    @endrole
                </div>

                <div class="mt-5 rounded-xl bg-slate-50 border border-slate-200 p-4">
                    <div class="text-sm font-semibold text-slate-800">No alerts yet</div>
                    <div class="mt-1 text-sm text-slate-600">
                        Once inventory is tracked, low stock items will appear here.
                    </div>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    Tip: set minimum stock and reorder quantity in Items.
                </div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-bold text-slate-900">Delivery Overview</div>
                        <div class="mt-1 text-sm text-slate-600">Status and COD follow ups</div>
                    </div>

                    <span class="text-xs font-semibold px-3 py-1 rounded-xl bg-slate-100 text-slate-700">
                        Delivery module coming next
                    </span>
                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="rounded-xl border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">Pending</div>
                        <div class="mt-2 text-xl font-bold text-slate-900">0</div>
                    </div>

                    <div class="rounded-xl border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">Delivered Today</div>
                        <div class="mt-2 text-xl font-bold text-slate-900">0</div>
                    </div>

                    <div class="rounded-xl border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">COD Not Remitted</div>
                        <div class="mt-2 text-xl font-bold text-slate-900">₱ 0.00</div>
                    </div>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    Tip: deliveries will link to COD reconciliation later.
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
                <div class="text-xs font-bold tracking-wide text-slate-500 uppercase">Admin</div>
                <div class="mt-2 text-lg font-bold text-slate-900">User Control</div>
                <div class="mt-1 text-sm text-slate-600">
                    Create accounts, assign roles, manage access.
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <button class="rounded-xl bg-slate-900 text-white px-4 py-2 text-sm font-semibold">
                        Users
                    </button>
                    <button class="rounded-xl bg-slate-100 text-slate-900 px-4 py-2 text-sm font-semibold">
                        Add User
                    </button>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    This can be connected to a user list later.
                </div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
                <div class="text-xs font-bold tracking-wide text-slate-500 uppercase">Master Data</div>
                <div class="mt-2 text-lg font-bold text-slate-900">Maintain core records</div>
                <div class="mt-1 text-sm text-slate-600">
                    Employees, items, suppliers, customers.
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @role('Owner Admin')
                        <a class="rounded-xl bg-phoenix-teal text-white px-4 py-2 text-sm font-semibold hover:bg-phoenix-deep transition"
                           href="{{ route('employees.index') }}">
                            Employees
                        </a>
                    @endrole

                    @role('Owner Admin|Inventory Stock Custodian')
                        <a class="rounded-xl bg-phoenix-teal text-white px-4 py-2 text-sm font-semibold hover:bg-phoenix-deep transition"
                           href="{{ route('items.index') }}">
                            Items
                        </a>

                        <a class="rounded-xl bg-phoenix-teal text-white px-4 py-2 text-sm font-semibold hover:bg-phoenix-deep transition"
                           href="{{ route('suppliers.index') }}">
                            Suppliers
                        </a>
                    @endrole

                    @role('Owner Admin|Sales Cashier|Accountant Bookkeeper')
                        <a class="rounded-xl bg-phoenix-teal text-white px-4 py-2 text-sm font-semibold hover:bg-phoenix-deep transition"
                           href="{{ route('customers.index') }}">
                            Customers
                        </a>
                    @endrole
                </div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
                <div class="text-xs font-bold tracking-wide text-slate-500 uppercase">Next Modules</div>
                <div class="mt-2 text-lg font-bold text-slate-900">Operations V1</div>
                <div class="mt-1 text-sm text-slate-600">
                    Attendance, inventory movements, POS, deliveries, expenses, payroll.
                </div>

                <div class="mt-4">
                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-4">
                        <div class="text-sm font-semibold text-slate-800">Coming after Master Data</div>
                        <div class="mt-1 text-sm text-slate-600">
                            We will activate these once the core lists are complete.
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
