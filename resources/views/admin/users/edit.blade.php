<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Edit User" subtitle="Update profile, role, status, and reset password." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6 space-y-8">

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input name="name" value="{{ old('name', $user->name) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input name="email" value="{{ old('email', $user->email) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Role</label>
                    <select name="role"
                        class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @selected($currentRole === $role->name)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <input name="is_active" type="checkbox" value="1" @checked($user->is_active)
                           class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                    <span class="text-sm font-semibold">Active</span>
                </div>

                <div class="flex gap-3 pt-2">
                    <x-phoenix-button type="submit">Update</x-phoenix-button>
                    <x-phoenix-button href="{{ route('admin.users.index') }}" variant="secondary">Back</x-phoenix-button>
                </div>
            </form>

            <div class="border-t border-slate-200 pt-6">
                <div class="text-sm font-bold mb-3">Reset password</div>

                <form method="POST" action="{{ route('admin.users.reset_password', $user) }}" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-sm font-semibold">New password</label>
                        <input type="password" name="new_password"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>

                    <x-phoenix-button type="submit">Reset</x-phoenix-button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
