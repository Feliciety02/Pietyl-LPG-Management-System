<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Pietyl') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-slate-50 text-slate-900">
        <div class="min-h-screen flex">

            {{-- Desktop sidebar --}}
            <aside class="w-72 bg-white border-r border-slate-200 hidden md:flex md:flex-col">
                {{-- Brand --}}
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="h-11 w-11 rounded-2xl bg-phoenix-teal flex items-center justify-center text-white font-black shadow-sm">
                            P
                        </div>
                        <div class="min-w-0">
                            <div class="text-base font-extrabold leading-tight truncate">Phoenix LPG Ops</div>
                            <div class="text-xs text-slate-500 leading-tight truncate">Pietyl Management System</div>
                        </div>
                    </div>
                </div>

                {{-- Menu --}}
                <nav class="px-3 py-4 space-y-2 overflow-y-auto">
                    @php
                        $sectionTitle = "px-3 pt-3 pb-2 text-[11px] font-extrabold tracking-wider text-slate-500 uppercase";
                        $divider = "mx-3 my-3 border-t border-slate-200";
                        $itemBase = "group flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition";
                        $itemInactive = "text-slate-700 hover:bg-slate-100";
                        $itemActive = "bg-phoenix-teal text-white shadow-sm";
                        $dot = "h-2 w-2 rounded-full";
                    @endphp

                    {{-- Dashboard --}}
                    @if(\Illuminate\Support\Facades\Route::has('dashboard'))
                        @php $active = request()->routeIs('dashboard'); @endphp
                        <a href="{{ route('dashboard') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                            <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                            <span class="truncate">Dashboard</span>
                        </a>
                    @endif

                    {{-- Admin --}}
                    @role('Owner Admin')
                        <div class="{{ $divider }}"></div>
                        <div class="{{ $sectionTitle }}">Admin</div>

                        @if(\Illuminate\Support\Facades\Route::has('admin.dashboard'))
                            @php $active = request()->routeIs('admin.dashboard'); @endphp
                            <a href="{{ route('admin.dashboard') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Admin Panel</span>
                            </a>
                        @endif

                        @if(\Illuminate\Support\Facades\Route::has('admin.users.index'))
                            @php $active = request()->routeIs('admin.users.*'); @endphp
                            <a href="{{ route('admin.users.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">User Accounts</span>
                            </a>
                        @endif
                    @endrole

                    {{-- Master Data --}}
                    @hasanyrole('Owner Admin|Accountant Bookkeeper|Sales Cashier|Inventory Stock Custodian')
                        <div class="{{ $divider }}"></div>
                        <div class="{{ $sectionTitle }}">Master Data</div>
                    @endhasanyrole

                    @role('Owner Admin')
                        @if(\Illuminate\Support\Facades\Route::has('employees.index'))
                            @php $active = request()->routeIs('employees.*'); @endphp
                            <a href="{{ route('employees.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Employees</span>
                            </a>
                        @endif
                    @endrole

                    @hasanyrole('Owner Admin|Inventory Stock Custodian')
                        @if(\Illuminate\Support\Facades\Route::has('items.index'))
                            @php $active = request()->routeIs('items.*'); @endphp
                            <a href="{{ route('items.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Items</span>
                            </a>
                        @endif

                        @if(\Illuminate\Support\Facades\Route::has('suppliers.index'))
                            @php $active = request()->routeIs('suppliers.*'); @endphp
                            <a href="{{ route('suppliers.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Suppliers</span>
                            </a>
                        @endif
                    @endhasanyrole

                    @hasanyrole('Owner Admin|Sales Cashier|Accountant Bookkeeper')
                        @if(\Illuminate\Support\Facades\Route::has('customers.index'))
                            @php $active = request()->routeIs('customers.*'); @endphp
                            <a href="{{ route('customers.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Customers</span>
                            </a>
                        @endif
                    @endhasanyrole

                    {{-- Operations placeholders (safe, only show if routes exist) --}}
                    @php
                        $showOps =
                            \Illuminate\Support\Facades\Route::has('pos.index')
                            || \Illuminate\Support\Facades\Route::has('inventory.index')
                            || \Illuminate\Support\Facades\Route::has('alerts.low-stock')
                            || \Illuminate\Support\Facades\Route::has('deliveries.my')
                            || \Illuminate\Support\Facades\Route::has('deliveries.index')
                            || \Illuminate\Support\Facades\Route::has('expenses.index')
                            || \Illuminate\Support\Facades\Route::has('payroll.index');
                    @endphp

                    @if($showOps)
                        <div class="{{ $divider }}"></div>
                        <div class="{{ $sectionTitle }}">Operations</div>
                    @endif

                    @hasanyrole('Owner Admin|Sales Cashier')
                        @if(\Illuminate\Support\Facades\Route::has('pos.index'))
                            @php $active = request()->routeIs('pos.*'); @endphp
                            <a href="{{ route('pos.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">POS</span>
                                <span class="ml-auto text-[10px] font-bold px-2 py-1 rounded-full bg-slate-100 text-slate-700 group-hover:bg-white">
                                    Sales
                                </span>
                            </a>
                        @endif
                    @endhasanyrole

                    @hasanyrole('Owner Admin|Inventory Stock Custodian')
                        @if(\Illuminate\Support\Facades\Route::has('inventory.index'))
                            @php $active = request()->routeIs('inventory.*'); @endphp
                            <a href="{{ route('inventory.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Inventory Movements</span>
                            </a>
                        @endif

                        @if(\Illuminate\Support\Facades\Route::has('alerts.low-stock'))
                            @php $active = request()->routeIs('alerts.*'); @endphp
                            <a href="{{ route('alerts.low-stock') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Low Stock Alerts</span>
                            </a>
                        @endif
                    @endhasanyrole

                    @hasanyrole('Owner Admin|Delivery Rider Driver')
                        @role('Delivery Rider Driver')
                            @if(\Illuminate\Support\Facades\Route::has('deliveries.my'))
                                @php $active = request()->routeIs('deliveries.my'); @endphp
                                <a href="{{ route('deliveries.my') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                    <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                    <span class="truncate">My Deliveries</span>
                                </a>
                            @endif
                        @endrole

                        @role('Owner Admin')
                            @if(\Illuminate\Support\Facades\Route::has('deliveries.index'))
                                @php $active = request()->routeIs('deliveries.*'); @endphp
                                <a href="{{ route('deliveries.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                    <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                    <span class="truncate">Delivery Tracking</span>
                                </a>
                            @endif
                        @endrole
                    @endhasanyrole

                    @hasanyrole('Owner Admin|Accountant Bookkeeper')
                        @if(\Illuminate\Support\Facades\Route::has('expenses.index'))
                            @php $active = request()->routeIs('expenses.*'); @endphp
                            <a href="{{ route('expenses.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Expenses</span>
                            </a>
                        @endif

                        @if(\Illuminate\Support\Facades\Route::has('payroll.index'))
                            @php $active = request()->routeIs('payroll.*'); @endphp
                            <a href="{{ route('payroll.index') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                                <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                                <span class="truncate">Payroll</span>
                            </a>
                        @endif
                    @endhasanyrole

                    {{-- Account --}}
                    <div class="{{ $divider }}"></div>
                    <div class="{{ $sectionTitle }}">Account</div>

                    @if(\Illuminate\Support\Facades\Route::has('profile.edit'))
                        @php $active = request()->routeIs('profile.*'); @endphp
                        <a href="{{ route('profile.edit') }}" class="{{ $itemBase }} {{ $active ? $itemActive : $itemInactive }}">
                            <span class="{{ $dot }} {{ $active ? 'bg-white/90' : 'bg-phoenix-teal' }}"></span>
                            <span class="truncate">Profile</span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="pt-1">
                        @csrf
                        <button type="submit" class="{{ $itemBase }} {{ $itemInactive }} w-full">
                            <span class="{{ $dot }} bg-red-500"></span>
                            <span class="truncate">Logout</span>
                        </button>
                    </form>
                </nav>

                {{-- User card --}}
                <div class="mt-auto p-4 border-t border-slate-200">
                    <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-2xl bg-white border border-slate-200 flex items-center justify-center font-black text-slate-700">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-sm font-extrabold truncate">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-500">
                                Role
                            </span>
                            <span class="text-[11px] font-extrabold px-2 py-1 rounded-full bg-white border border-slate-200 text-slate-700">
                                {{ auth()->user()->getRoleNames()->first() ?? 'None' }}
                            </span>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Mobile top bar --}}
            <div class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-slate-200 z-50">
                <div class="px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-2xl bg-phoenix-teal flex items-center justify-center text-white font-black shadow-sm">
                            P
                        </div>
                        <div class="font-extrabold text-sm">Phoenix LPG Ops</div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm font-bold text-slate-700">Logout</button>
                    </form>
                </div>
            </div>

            {{-- Main content --}}
            <main class="flex-1 min-w-0">
                <div class="md:hidden h-14"></div>
                <div class="px-4 sm:px-6 lg:px-8 py-6">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </body>
</html>
