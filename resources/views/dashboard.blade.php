<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 space-y-6">

        <div>
            <div class="text-2xl font-extrabold">Dashboard</div>
            <div class="text-sm text-slate-500 mt-1">
                Welcome back, {{ auth()->user()->name }}.
            </div>
        </div>

        @php
            $role = auth()->user()->getRoleNames()->first();
        @endphp

        @if($role === 'Owner Admin')
            @include('dashboard.partials.owner-admin')
        @elseif($role === 'Inventory Stock Custodian')
            @include('dashboard.partials.inventory')
        @elseif($role === 'Sales Cashier')
            @include('dashboard.partials.cashier')
        @elseif($role === 'Accountant Bookkeeper')
            @include('dashboard.partials.accountant')
        @elseif($role === 'Delivery Rider Driver')
            @include('dashboard.partials.rider')
        @else
            @include('dashboard.partials.no-role')
        @endif

    </div>
</x-app-layout>
