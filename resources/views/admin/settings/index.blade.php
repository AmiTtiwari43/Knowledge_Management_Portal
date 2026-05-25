<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Site Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        @method('PATCH')

                        @foreach($settings as $group => $items)
                            <div class="mb-8">
                                <h3 class="text-lg font-bold mb-4 border-b pb-2 uppercase text-indigo-600 dark:text-indigo-400">
                                    {{ $group }} Settings
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($items as $setting)
                                        <div>
                                            <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                            </label>
                                            
                                            @if($setting->type === 'textarea')
                                                <textarea id="{{ $setting->key }}" name="{{ $setting->key }}" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ $setting->value }}</textarea>
                                            @else
                                                <input id="{{ $setting->key }}" type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Settings') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
