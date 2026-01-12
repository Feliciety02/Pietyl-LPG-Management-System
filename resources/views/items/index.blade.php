<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto">
        <x-page-header title="Items" subtitle="LPG and accessories list with reorder levels.">
            <x-slot:actions>
                <x-phoenix-button href="{{ route('items.create') }}">Add Item</x-phoenix-button>
            </x-slot:actions>
        </x-page-header>

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="text-left p-3">SKU</th>
                        <th class="text-left p-3">Name</th>
                        <th class="text-left p-3">Category</th>
                        <th class="text-left p-3">Unit</th>
                        <th class="text-right p-3">Price</th>
                        <th class="text-right p-3">Min</th>
                        <th class="text-right p-3">Reorder</th>
                        <th class="text-left p-3">Status</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="border-t">
                            <td class="p-3">{{ $item->sku }}</td>
                            <td class="p-3 font-medium">{{ $item->name }}</td>
                            <td class="p-3">{{ $item->category }}</td>
                            <td class="p-3">{{ $item->unit }}</td>
                            <td class="p-3 text-right">{{ number_format($item->selling_price, 2) }}</td>
                            <td class="p-3 text-right">{{ $item->minimum_stock }}</td>
                            <td class="p-3 text-right">{{ $item->reorder_quantity }}</td>
                            <td class="p-3">
                                @if($item->is_active)
                                    <span class="px-2 py-1 rounded-lg text-xs bg-emerald-50 text-emerald-700">Active</span>
                                @else
                                    <span class="px-2 py-1 rounded-lg text-xs bg-slate-100 text-slate-700">Inactive</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <a class="text-phoenix-deep font-semibold hover:underline"
                                   href="{{ route('items.edit', $item) }}">Edit</a>

                                <form class="inline"
                                      method="POST"
                                      action="{{ route('items.destroy', $item) }}"
                                      onsubmit="return confirm('Delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ml-3 text-red-600 font-semibold hover:underline" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
