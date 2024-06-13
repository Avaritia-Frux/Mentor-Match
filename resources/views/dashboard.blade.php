<x-app-layout :title="$title">
    <x-slot name="header">
        {{-- Menambahkan pt-16 --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16 text-center relative z-10">
            {{ __($title) }}
        </h2>
    </x-slot>

    <div class="relative min-h-screen flex justify-center items-center">
        <img src="{{ asset('image-assets/background.avif') }}"
        alt="Hero Image" class="fixed inset-0 w-full h-full object-cover opacity-50">
        <div class="relative z-10 max-w-7xl mx-auto sm:px-6 lg:px-8 text-center py-16">
            <div class="mx-2 -mt-40">
                <x-application-logo class="mx-auto w-48 h-48 mb-8"/>
                    @can('admin')
                    <h1 class="text-4xl font-bold text-black dark:text-white">{{ __('Mentor Match') }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Manage All Users Here.') }}</p>
                    @elsecan('creator')
                    <h1 class="text-4xl font-bold text-black dark:text-white">{{ __('Mentor Match') }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Manage Your Posts Here.') }}</p>
                    @elsecan('public')
                    <h1 class="text-4xl font-bold text-black dark:text-white">{{ __('Mentor Match') }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('Browse All Of Our Programs Here.') }}</p>
                    @endcan
            </div>
        </div>
    </div>
</x-app-layout>
