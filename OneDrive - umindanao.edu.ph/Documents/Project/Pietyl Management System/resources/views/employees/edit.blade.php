<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Edit Employee" subtitle="Update details. Leave PIN blank if you do not want to change it." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('employees.update', $employee) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-semibold">Full Name</label>
                    <input name="full_name" value="{{ old('full_name', $employee->full_name) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('full_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Role Name</label>
                    <input name="role_name" value="{{ old('role_name', $employee->role_name) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('role_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold">New PIN (optional)</label>
                        <input name="pin" type="password"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                        @error('pin') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-2 pt-7">
                        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $employee->is_active))
                               class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                        <span class="text-sm font-semibold">Active</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Update</x-phoenix-button>
                    <x-phoenix-button href="{{ route('employees.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
