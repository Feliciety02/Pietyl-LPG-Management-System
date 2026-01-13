<aside class="hidden lg:flex lg:flex-col lg:w-64 lg:shrink-0">
    <div class="h-full rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-teal-600 flex items-center justify-center text-white font-extrabold">
                    P
                </div>
                <div>
                    <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
                    <div class="text-xs text-slate-500 leading-tight">Management System</div>
                </div>
            </div>
        </div>

        <nav class="p-3 space-y-1">
            <a href="{{ route('home') }}"
               class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                Dashboard
            </a>

            @role('Owner Admin')
                <div class="pt-3 pb-1 px-3 text-xs font-bold uppercase tracking-wide text-slate-400">
                    Admin
                </div>

                <a href="{{ route('admin.employees.index') }}"
                   class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Employees
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Users
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Settings
                </a>
            @endrole

            @role('Owner Admin|Inventory Stock Custodian')
                <div class="pt-3 pb-1 px-3 text-xs font-bold uppercase tracking-wide text-slate-400">
                    Inventory
                </div>

                <a href="{{ route('items.index') }}"
                   class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Items
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Suppliers
                </a>
            @endrole

            @role('Owner Admin|Sales Cashier|Accountant Bookkeeper')
                <div class="pt-3 pb-1 px-3 text-xs font-bold uppercase tracking-wide text-slate-400">
                    Sales
                </div>

                <a href="{{ route('customers.index') }}"
                   class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Customers
                </a>
            @endrole

            <div class="pt-4">
                <form method="POST" action="{{ route('logout') }}" class="px-3">
                    @csrf
                    <button type="submit"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition text-left">
                        Log out
                    </button>
                </form>
            </div>
        </nav>
    </div>
</aside>
