<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Add User" subtitle="Create a staff login account." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input name="name" value="{{ old('name') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input name="email" value="{{ old('email') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Password</label>
                    <input type="password" name="password"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Role</label>
                    <select name="role"
                        class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input name="is_active" type="checkbox" value="1" checked
                           class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                    <span class="text-sm font-semibold">Active</span>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Save</x-phoenix-button>
                    <x-phoenix-button href="{{ route('admin.users.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
