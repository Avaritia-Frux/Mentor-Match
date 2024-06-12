<x-app-layout :title="$title">
    <x-slot name="header">
        {{-- Menambahkan pt-16 --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16 text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="mt-16">
                <x-application-logo class="mx-auto w-48 h-48 mb-8"/>
                <h1 class="text-3xl font-bold text-black dark:text-white mb-4"></h1>
                @if (auth()->user()->role_id == 1)
                    <h1 class="text-3xl font-bold text-black dark:text-white mb-4">{{ __('Welcome to Mentor Match, '.auth()->user()->name. ' !')  }}</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Manage your users here.</p>
                @elseif (auth()->user()->role_id == 2)
                <h1 class="text-3xl font-bold text-black dark:text-white mb-4">{{ __('Welcome to Mentor Match, '.auth()->user()->name. ' !')  }}</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Manage your posts here.</p>
                @elseif (auth()->user()->role_id == 3)
                <h1 class="text-3xl font-bold text-black dark:text-white mb-4">{{ __('Welcome to Mentor Match, '.auth()->user()->name. ' !') }}</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Browse all of our programs.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
