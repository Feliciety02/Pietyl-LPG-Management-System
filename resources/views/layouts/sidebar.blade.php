<aside
    x-data="{ openAdmin: true, openInventory: true, openSales: true }"
    class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-30 lg:flex lg:w-64 lg:flex-col bg-white border-r border-slate-200"
>

    {{-- BRAND --}}
    <div class="h-16 px-6 flex items-center gap-3 border-b border-slate-200">
        <div class="h-9 w-9 rounded-xl bg-teal-600 flex items-center justify-center text-white font-extrabold">
            P
        </div>
        <div>
            <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
            <div class="text-xs text-slate-500 leading-tight">Operations Platform</div>
        </div>
    </div>

    {{-- NAV --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        {{-- DASHBOARD --}}
        <a href="{{ route('home') }}"
           class="group relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition
           {{ request()->routeIs('home') ? 'bg-teal-50 text-teal-800' : 'text-slate-700 hover:bg-slate-100' }}">
            
            <span class="absolute left-0 h-5 w-1 rounded-r bg-teal-600 {{ request()->routeIs('home') ? 'opacity-100' : 'opacity-0 group-hover:opacity-40' }}"></span>

            {{-- icon --}}
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10"/>
            </svg>

            Dashboard
        </a>

        {{-- ADMIN --}}
        @role('Owner Admin')
        <div class="mt-4">
            <button @click="openAdmin = !openAdmin"
                    class="flex w-full items-center justify-between px-3 py-2 text-xs font-extrabold uppercase tracking-wide text-slate-400 hover:text-slate-600 transition">
                Admin
                <svg class="h-4 w-4 transform transition" :class="openAdmin && 'rotate-180'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </button>

            <div x-show="openAdmin" x-collapse class="mt-1 space-y-1">
                @include('layouts.sidebar-link', [
                    'route' => 'admin.employees.*',
                    'url' => route('admin.employees.index'),
                    'label' => 'Employees',
                    'icon' => 'users'
                ])

                @include('layouts.sidebar-link', [
                    'route' => 'admin.users.*',
                    'url' => route('admin.users.index'),
                    'label' => 'Users',
                    'icon' => 'user-circle'
                ])

                @include('layouts.sidebar-link', [
                    'route' => 'admin.settings.*',
                    'url' => route('admin.settings.index'),
                    'label' => 'Settings',
                    'icon' => 'cog'
                ])
            </div>
        </div>
        @endrole

        {{-- INVENTORY --}}
        @role('Owner Admin|Inventory Stock Custodian')
        <div class="mt-4">
            <button @click="openInventory = !openInventory"
                    class="flex w-full items-center justify-between px-3 py-2 text-xs font-extrabold uppercase tracking-wide text-slate-400 hover:text-slate-600 transition">
                Inventory
                <svg class="h-4 w-4 transform transition" :class="openInventory && 'rotate-180'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </button>

            <div x-show="openInventory" x-collapse class="mt-1 space-y-1">
                @include('layouts.sidebar-link', [
                    'route' => 'items.*',
                    'url' => route('items.index'),
                    'label' => 'Items',
                    'icon' => 'archive'
                ])

                @include('layouts.sidebar-link', [
                    'route' => 'suppliers.*',
                    'url' => route('suppliers.index'),
                    'label' => 'Suppliers',
                    'icon' => 'truck'
                ])
            </div>
        </div>
        @endrole

        {{-- SALES --}}
        @role('Owner Admin|Sales Cashier|Accountant Bookkeeper')
        <div class="mt-4">
            <button @click="openSales = !openSales"
                    class="flex w-full items-center justify-between px-3 py-2 text-xs font-extrabold uppercase tracking-wide text-slate-400 hover:text-slate-600 transition">
                Sales
                <svg class="h-4 w-4 transform transition" :class="openSales && 'rotate-180'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </button>

            <div x-show="openSales" x-collapse class="mt-1 space-y-1">
                @include('layouts.sidebar-link', [
                    'route' => 'customers.*',
                    'url' => route('customers.index'),
                    'label' => 'Customers',
                    'icon' => 'user'
                ])
            </div>
        </div>
        @endrole

    </nav>

    {{-- LOGOUT --}}
    <div class="p-4 border-t border-slate-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                <svg class="h-5 w-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <path d="M16 17l5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>
                Log out
            </button>
        </form>
    </div>
</aside>
