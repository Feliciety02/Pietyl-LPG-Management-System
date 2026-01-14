<aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-30 lg:flex lg:w-64 lg:flex-col bg-white border-r border-slate-200">

    <!-- Logo / Brand -->
    <div class="h-16 px-6 flex items-center gap-3 border-b border-slate-200">
        <div class="h-9 w-9 rounded-xl bg-teal-600 flex items-center justify-center text-white font-extrabold">
            P
        </div>
        <div>
            <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
            <div class="text-xs text-slate-500 leading-tight">Operations Platform</div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        <a href="{{ route('home') }}"
           class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
            Dashboard
        </a>

        @role('Owner Admin')
            <div class="mt-4 mb-1 px-3 text-xs font-bold uppercase tracking-wide text-slate-400">
                Admin
            </div>

            <a href="{{ route('admin.employees.index') }}"
               class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Employees
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Users
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Settings
            </a>
        @endrole

        @role('Owner Admin|Inventory Stock Custodian')
            <div class="mt-4 mb-1 px-3 text-xs font-bold uppercase tracking-wide text-slate-400">
                Inventory
            </div>

            <a href="{{ route('items.index') }}"
               class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Items
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Suppliers
            </a>
        @endrole

        @role('Owner Admin|Sales Cashier|Accountant Bookkeeper')
            <div class="mt-4 mb-1 px-3 text-xs font-bold uppercase tracking-wide text-slate-400">
                Sales
            </div>

            <a href="{{ route('customers.index') }}"
               class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                Customers
            </a>
        @endrole
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-slate-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition text-left">
                Log out
            </button>
        </form>
    </div>
</aside>
