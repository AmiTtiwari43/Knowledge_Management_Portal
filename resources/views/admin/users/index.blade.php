<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Users</p>
                    <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Instructors</p>
                    <p class="text-3xl font-black text-blue-600">{{ $stats['instructors'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Students</p>
                    <p class="text-3xl font-black text-emerald-600">{{ $stats['students'] }}</p>
                </div>
            </div>

            <!-- User List -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900/50">
                    <div class="flex gap-4">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-bold {{ !request('role') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">All</a>
                        <a href="{{ route('admin.users.index', ['role' => 'instructor']) }}" class="text-sm font-bold {{ request('role') === 'instructor' ? 'text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">Instructors</a>
                        <a href="{{ route('admin.users.index', ['role' => 'student']) }}" class="text-sm font-bold {{ request('role') === 'student' ? 'text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">Students</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900/80 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">
                            <tr>
                                <th class="px-6 py-4 w-16">#</th>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Joined</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($users as $index => $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors">
                                    <td class="px-6 py-4 text-sm font-bold text-gray-500">
                                        {{ $users->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center font-bold text-gray-400">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'instructor' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This will also delete all their courses and data.')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-gray-100 dark:border-gray-700">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
