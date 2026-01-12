<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <x-page-header title="Edit Item" subtitle="Update item details and reorder levels." />

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
            <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-semibold">SKU</label>
                    <input name="sku" value="{{ old('sku', $item->sku) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('sku') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Name</label>
                    <input name="name" value="{{ old('name', $item->name) }}"
                           class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Category</label>
                        <select name="category"
                            class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal">
                            <option value="LPG" @selected(old('category', $item->category) === 'LPG')>LPG</option>
                            <option value="Accessory" @selected(old('category', $item->category) === 'Accessory')>Accessory</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Unit</label>
                        <input name="unit" value="{{ old('unit', $item->unit) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Selling Price</label>
                        <input name="selling_price" type="number" step="0.01" value="{{ old('selling_price', $item->selling_price) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold">Minimum Stock</label>
                        <input name="minimum_stock" type="number" value="{{ old('minimum_stock', $item->minimum_stock) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Reorder Quantity</label>
                        <input name="reorder_quantity" type="number" value="{{ old('reorder_quantity', $item->reorder_quantity) }}"
                               class="mt-1 w-full rounded-xl border-slate-300 focus:border-phoenix-teal focus:ring-phoenix-teal" />
                    </div>

                    <div class="flex items-center gap-2 pt-7">
                        <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $item->is_active))
                               class="rounded border-slate-300 text-phoenix-teal focus:ring-phoenix-teal" />
                        <span class="text-sm font-semibold">Active</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <x-phoenix-button type="submit">Update</x-phoenix-button>
                    <x-phoenix-button href="{{ route('items.index') }}" variant="secondary">Cancel</x-phoenix-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>