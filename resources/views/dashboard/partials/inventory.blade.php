<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="rounded-2xl bg-white border border-slate-200 p-5">
        <div class="text-xs font-extrabold uppercase tracking-wider text-slate-500">Inventory</div>
        <div class="text-lg font-extrabold mt-2">Items</div>
        <div class="text-sm text-slate-500 mt-1">Maintain item list, reorder levels, and pricing visibility.</div>
        <div class="mt-4">
            <a class="rounded-xl px-4 py-2 text-sm font-bold bg-slate-900 text-white hover:opacity-95"
               href="{{ route('items.index') }}">
                Open Items
            </a>
        </div>
    </div>

    <div class="rounded-2xl bg-white border border-slate-200 p-5">
        <div class="text-xs font-extrabold uppercase tracking-wider text-slate-500">Suppliers</div>
        <div class="text-lg font-extrabold mt-2">Supplier Directory</div>
        <div class="text-sm text-slate-500 mt-1">Maintain suppliers for receiving and restocking.</div>
        <div class="mt-4">
            <a class="rounded-xl px-4 py-2 text-sm font-bold bg-white border border-slate-300 text-slate-700 hover:bg-slate-50"
               href="{{ route('suppliers.index') }}">
                Open Suppliers
            </a>
        </div>
    </div>
</div>
