<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <h1 class="text-2xl font-extrabold text-slate-900">Add Employee</h1>
        <p class="mt-1 text-sm text-slate-600">
            Create a new staff record.
        </p>

        <form
            method="POST"
            action="{{ route('admin.employees.store') }}"
            class="mt-6 phoenix-card p-6 space-y-4"
        >
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700">
                    Full name
                </label>
                <input
                    type="text"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"
                >
                @error('full_name')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"
                >
                @error('email')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">
                    Role
                </label>
                <select
                    name="role_name"
                    class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"
                >
                    @foreach ($roles as $role)
                        <option
                            value="{{ $role }}"
                            @selected(old('role_name') === $role)
                        >
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
                @error('role_name')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">
                    PIN (4 digits)
                </label>
                <input
                    type="password"
                    name="pin"
                    value="{{ old('pin') }}"
                    inputmode="numeric"
                    maxlength="4"
                    class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"
                >
                @error('pin')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    class="rounded border-slate-300"
                    {{ old('is_active', true) ? 'checked' : '' }}
                >
                <span class="text-sm text-slate-700">
                    Active
                </span>
            </div>

            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('admin.employees.index') }}"
                    class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-teal-600 px-4 py-2 text-sm font-semibold text-white"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
