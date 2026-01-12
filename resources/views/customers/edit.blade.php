<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Edit Customer" subtitle="Update customer details." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('customers.update', $customer) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input name="name" value="{{ old('name', $customer->name) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Contact</label>
                    <input name="contact" value="{{ old('contact', $customer->contact) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                </div>

                <div>
                    <label class="text-sm font-semibold">Address</label>
                    <textarea name="address" rows="3"
                        class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal">{{ old('address', $customer->address) }}</textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $customer->is_active))
                           class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                    <span class="text-sm font-semibold">Active</span>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Update</x-phoenix-button>
                    <x-phoenix-button href="{{ route('customers.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
    