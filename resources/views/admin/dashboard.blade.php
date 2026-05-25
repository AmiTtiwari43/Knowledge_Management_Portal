<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Administration') }}
        </h2>
    </x-slot>

    <livewire:admin-dashboard />
</x-app-layout>
