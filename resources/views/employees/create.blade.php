<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Add Employee" subtitle="Create staff profile for attendance and payroll." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('employees.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-semibold">Full Name</label>
                    <input name="full_name" value="{{ old('full_name') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('full_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Role Name</label>
                    <input name="role_name" value="{{ old('role_name') }}" placeholder="Cashier, Rider, Inventory"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('role_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold">PIN (4 to 6 digits)</label>
                        <input name="pin" type="password" value="{{ old('pin') }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                        @error('pin') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-2 pt-7">
                        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', true))
                               class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                        <span class="text-sm font-semibold">Active</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Save</x-phoenix-button>
                    <x-phoenix-button href="{{ route('employees.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
