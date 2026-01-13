<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto">
        <x-page-header title="Users" subtitle="Create accounts and assign roles.">
            <x-slot:actions>
                <x-phoenix-button href="{{ route('admin.users.create') }}">Add User</x-phoenix-button>
            </x-slot:actions>
        </x-page-header>

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="text-left p-3">Name</th>
                        <th class="text-left p-3">Email</th>
                        <th class="text-left p-3">Role</th>
                        <th class="text-left p-3">Status</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->getRoleNames()->first() ?? 'No role' }}</td>
                            <td class="p-3">
                                @if($user->is_active)
                                    <span class="px-2 py-1 rounded-lg text-xs bg-emerald-50 text-emerald-700">Active</span>
                                @else
                                    <span class="px-2 py-1 rounded-lg text-xs bg-slate-100 text-slate-700">Inactive</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <a class="text-phoenix-deep font-semibold hover:underline"
                                   href="{{ route('admin.users.edit', $user) }}">Edit</a>

                                <form class="inline" method="POST" action="{{ route('admin.users.toggle_active', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="ml-3 text-slate-700 font-semibold hover:underline" type="submit">
                                        Toggle
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
