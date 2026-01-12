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

            <aside class="w-72 bg-white border-r border-slate-200 hidden md:flex md:flex-col">
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-2xl bg-phoenix-teal flex items-center justify-center text-white font-black">
                            P
                        </div>
                        <div>
                            <div class="text-base font-bold leading-tight">Phoenix LPG Ops</div>
                            <div class="text-xs text-slate-500 leading-tight">Pietyl Management System</div>
                        </div>
                    </div>
                </div>

                <nav class="px-4 py-4 space-y-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <div class="pt-4">
                        <div class="px-3 text-xs font-bold tracking-wide text-slate-500 uppercase">
                            Master Data
                        </div>
                    </div>

                    @role('Owner Admin')
                        <x-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.*')">
                            Employees
                        </x-nav-link>
                    @endrole

                    @role('Owner Admin|Inventory Stock Custodian')
                        <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')">
                            Items
                        </x-nav-link>

                        <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                            Suppliers
                        </x-nav-link>
                    @endrole

                    @role('Owner Admin|Sales Cashier|Accountant Bookkeeper')
                        <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')">
                            Customers
                        </x-nav-link>
                    @endrole

                    <div class="pt-4">
                        <div class="px-3 text-xs font-bold tracking-wide text-slate-500 uppercase">
                            Account
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                            Logout
                        </button>
                    </form>
                </nav>

                <div class="mt-auto px-6 py-5 border-t border-slate-200">
                    <div class="text-sm font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-slate-500">
                        {{ auth()->user()->getRoleNames()->first() ?? 'No role' }}
                    </div>
                </div>
            </aside>

            <main class="flex-1 min-w-0">
                <div class="md:hidden bg-white border-b border-slate-200 px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-2xl bg-phoenix-teal flex items-center justify-center text-white font-black">
                            P
                        </div>
                        <div class="font-bold">Phoenix LPG Ops</div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-slate-700">
                            Logout
                        </button>
                    </form>
                </div>

                <div class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </body>
</html>
