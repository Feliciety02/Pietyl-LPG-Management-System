<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Add Item" subtitle="Create a new LPG or accessory item." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('items.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-semibold">SKU</label>
                    <input name="sku" value="{{ old('sku') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('sku') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input name="name" value="{{ old('name') }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Category</label>
                        <select name="category"
                            class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal">
                            <option value="LPG" @selected(old('category') === 'LPG')>LPG</option>
                            <option value="Accessory" @selected(old('category') === 'Accessory')>Accessory</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Unit</label>
                        <input name="unit" value="{{ old('unit') }}" placeholder="tank, pc, set"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                        @error('unit') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Selling Price</label>
                        <input name="selling_price" type="number" step="0.01" value="{{ old('selling_price', 0) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                        @error('selling_price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Minimum Stock</label>
                        <input name="minimum_stock" type="number" value="{{ old('minimum_stock', 0) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Reorder Quantity</label>
                        <input name="reorder_quantity" type="number" value="{{ old('reorder_quantity', 0) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>

                    <div class="flex items-center gap-2 pt-7">
                        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', true))
                               class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                        <span class="text-sm font-semibold">Active</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Save</x-phoenix-button>
                    <x-phoenix-button href="{{ route('items.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
