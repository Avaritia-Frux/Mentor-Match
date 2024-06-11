<x-app-layout :title="$title">
    <x-slot name="header">
        {{-- Menambahkan pt-16 --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __('Post Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $post->title }}</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $post->post_image_path ? asset('storage/' . $post->post_image_path) : 'https://via.placeholder.com/300x200' }}"
                                alt="{{ $post->title }}" class="h-full w-full object-cover rounded-md hover-zoom hover:opacity-75">
                        </div>
                        <div class="space-y-4">
                            {{-- <p class="text-sm text-gray-500 dark:text-gray-400"><strong>Creator:</strong> {{ $post->creator->name }}</p> --}}
                            <p class="text-sm text-gray-500 dark:text-gray-400"><strong>Category:</strong> {{ $post->category->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400"><strong>Company:</strong> {{ $post->company->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">{{ $post->body }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('creator.all-posts.index') }}" class="text-blue-500 hover:underline">Back to Posts List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
