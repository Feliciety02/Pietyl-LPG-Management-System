<x-app-layout>
    {{-- PAGE HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Admin Dashboard</h1>
        <p class="mt-1 text-sm text-slate-600">
            Business overview and daily operations control.
        </p>
    </div>

    {{-- KEY BUSINESS METRICS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5 border-t-4 border-teal-600">
            <div class="text-sm text-slate-500">Sales Today</div>
            <div class="mt-2 text-2xl font-extrabold text-slate-900">₱ 0.00</div>
            <div class="mt-2 text-xs text-slate-500">Confirmed transactions</div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5 border-t-4 border-emerald-600">
            <div class="text-sm text-slate-500">Cash on Hand</div>
            <div class="mt-2 text-2xl font-extrabold text-slate-900">₱ 0.00</div>
            <div class="mt-2 text-xs text-slate-500">Available physical cash</div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5 border-t-4 border-cyan-600">
            <div class="text-sm text-slate-500">Pending Deliveries</div>
            <div class="mt-2 text-2xl font-extrabold text-slate-900">0</div>
            <div class="mt-2 text-xs text-slate-500">For dispatch or confirmation</div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5 border-t-4 border-amber-500">
            <div class="text-sm text-slate-500">Low Stock Alerts</div>
            <div class="mt-2 text-2xl font-extrabold text-slate-900">0</div>
            <div class="mt-2 text-xs text-slate-500">Items near reorder level</div>
        </div>
    </div>

    {{-- INVENTORY & DELIVERY STATUS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8">
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-sm font-extrabold text-slate-900">Inventory Status</div>
                    <div class="mt-1 text-sm text-slate-600">Stock levels and reorder monitoring</div>
                </div>

                <a href="{{ route('items.index') }}"
                   class="text-sm font-semibold text-teal-700 hover:text-teal-800 transition">
                    View Items
                </a>
            </div>

            <div class="mt-5 rounded-xl bg-teal-50 border border-teal-100 p-4">
                <div class="text-sm font-semibold text-teal-900">No critical alerts</div>
                <div class="mt-1 text-sm text-teal-900/70">All tracked items are above minimum stock.</div>
            </div>

            <div class="mt-4 text-xs text-slate-500">
                Tip: define minimum stock per LPG size to prevent shortages.
            </div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
            <div>
                <div class="text-sm font-extrabold text-slate-900">Delivery & COD Overview</div>
                <div class="mt-1 text-sm text-slate-600">Track deliveries and cash collection</div>
            </div>

            <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="rounded-xl border border-slate-200 p-4 bg-white">
                    <div class="text-xs text-slate-500">In Transit</div>
                    <div class="mt-2 text-xl font-extrabold text-slate-900">0</div>
                </div>
                <div class="rounded-xl border border-slate-200 p-4 bg-white">
                    <div class="text-xs text-slate-500">Delivered Today</div>
                    <div class="mt-2 text-xl font-extrabold text-slate-900">0</div>
                </div>
                <div class="rounded-xl border border-slate-200 p-4 bg-white">
                    <div class="text-xs text-slate-500">Unremitted COD</div>
                    <div class="mt-2 text-xl font-extrabold text-slate-900">₱ 0.00</div>
                </div>
            </div>

            <div class="mt-4 text-xs text-slate-500">
                Tip: COD reconciliation ensures accurate daily cash totals.
            </div>
        </div>
    </div>

    {{-- ADMIN CONTROL & MASTER DATA --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
            <div class="text-xs font-extrabold tracking-wide text-slate-500 uppercase">Administration</div>
            <div class="mt-2 text-lg font-extrabold text-slate-900">Users & Staff</div>
            <div class="mt-1 text-sm text-slate-600">Manage accounts, roles, and staff access.</div>

            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ route('admin.users.index') }}"
                   class="rounded-xl bg-teal-600 text-white px-4 py-2 text-sm font-semibold hover:bg-teal-700 transition">
                    Users
                </a>
                <a href="{{ route('admin.employees.index') }}"
                   class="rounded-xl bg-slate-100 text-slate-900 px-4 py-2 text-sm font-semibold hover:bg-slate-200 transition">
                    Employees
                </a>
            </div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
            <div class="text-xs font-extrabold tracking-wide text-slate-500 uppercase">Master Data</div>
            <div class="mt-2 text-lg font-extrabold text-slate-900">Core Business Records</div>
            <div class="mt-1 text-sm text-slate-600">Maintain essential operational lists.</div>

            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ route('items.index') }}"
                   class="rounded-xl bg-teal-600 text-white px-4 py-2 text-sm font-semibold hover:bg-teal-700 transition">
                    Items
                </a>
                <a href="{{ route('suppliers.index') }}"
                   class="rounded-xl bg-teal-600 text-white px-4 py-2 text-sm font-semibold hover:bg-teal-700 transition">
                    Suppliers
                </a>
                <a href="{{ route('customers.index') }}"
                   class="rounded-xl bg-teal-600 text-white px-4 py-2 text-sm font-semibold hover:bg-teal-700 transition">
                    Customers
                </a>
            </div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-6">
            <div class="text-xs font-extrabold tracking-wide text-slate-500 uppercase">Operations</div>
            <div class="mt-2 text-lg font-extrabold text-slate-900">Daily Focus</div>
            <div class="mt-1 text-sm text-slate-600">
                Ensure stock availability, accurate cash, and completed deliveries.
            </div>

            <div class="mt-4 rounded-xl bg-slate-50 border border-slate-200 p-4">
                <div class="text-sm font-semibold text-slate-800">Recommended routine</div>
                <div class="mt-1 text-sm text-slate-600">
                    Review low stock, verify COD, and confirm end of day sales.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
