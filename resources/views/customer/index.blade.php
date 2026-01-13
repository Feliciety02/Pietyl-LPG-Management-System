<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Customers</h1>
                <p class="mt-1 text-sm text-slate-600">
                    Track customer profiles, purchase history, and contact details.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Add Customer
                </button>

                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Import CSV
                </button>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total customers</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">0</div>
                <div class="mt-1 text-sm text-slate-600">Saved profiles</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Active this month</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">0</div>
                <div class="mt-1 text-sm text-slate-600">With recent transactions</div>
            </div>

            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm p-5">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Notes</div>
                <div class="mt-2 text-2xl font-extrabold text-slate-900">Ready</div>
                <div class="mt-1 text-sm text-slate-600">Delivery address, reminders</div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <div class="text-lg font-extrabold text-slate-900">Customer List</div>
                    <div class="mt-1 text-sm text-slate-600">
                        Search by name, phone, or email. Add notes for delivery instructions.
                    </div>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <div class="w-full md:w-80">
                        <input
                            type="text"
                            placeholder="Search customers..."
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30"
                        />
                    </div>

                    <select
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30">
                        <option>All</option>
                        <option>With notes</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="p-5">
                <div class="rounded-xl bg-slate-50 border border-slate-200 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="text-sm font-semibold text-slate-800">No customers yet</div>
                            <div class="mt-1 text-sm text-slate-600">
                                Add your first customer to start tracking delivery details and purchase history.
                            </div>
                        </div>

                        <span class="hidden sm:inline-flex items-center rounded-xl bg-teal-50 text-teal-700 border border-teal-100 px-3 py-1 text-xs font-semibold">
                            Customer module v1
                        </span>
                    </div>

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        <div class="rounded-xl border border-slate-200 bg-white p-4">
                            <div class="text-xs text-slate-500">Name</div>
                            <div class="mt-1 text-sm font-semibold text-slate-800">Juan Dela Cruz</div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-white p-4">
                            <div class="text-xs text-slate-500">Phone</div>
                            <div class="mt-1 text-sm font-semibold text-slate-800">09xx xxx xxxx</div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-white p-4">
                            <div class="text-xs text-slate-500">Address</div>
                            <div class="mt-1 text-sm font-semibold text-slate-800">Delivery notes</div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-white p-4">
                            <div class="text-xs text-slate-500">Status</div>
                            <div class="mt-1 inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                Sample
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-xs text-slate-500">
                        This is a placeholder layout. Next step is wiring it to the database with create, edit, and transaction history.
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
