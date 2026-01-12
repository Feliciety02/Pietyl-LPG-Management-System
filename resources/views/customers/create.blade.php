<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Add Customer" subtitle="Basic customer details for sales and delivery." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input name="name" value="{{ old('name') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Contact</label>
                    <input name="contact" value="{{ old('contact') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Address</label>
                    <textarea name="address" rows="3"
                        class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal">{{ old('address') }}</textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', true))
                           class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                    <span class="text-sm font-semibold">Active</span>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Save</x-phoenix-button>
                    <x-phoenix-button href="{{ route('customers.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
