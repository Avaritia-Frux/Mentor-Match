<x-app-layout :title="$title">
    <x-slot name="header">
        {{-- Menambahkan pt-16 --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __('All Creator Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end space-x-2">
                @if (session('status'))
                    <div class="mb-4 alert alert-success alert-dismissible bg-green-600 dark:bg-green-800 bg-opacity-50 text-white p-2 rounded-md text-sm"
                        role="alert" style="max-width: 300px;">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h3>
                    </div>

                    {{-- Formulir Pencarian --}}
                    <div class="mb-4">
                        <input type="text" id="search" placeholder="Search posts..."
                            class="border border-gray-300 rounded-md px-4 py-2 w-full">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="posts-container">
                        @foreach ($posts as $post)
                            <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-lg post-item"
                                data-title="{{ $post->title }}" data-creator="{{ $post->creator->name }}"
                                data-category="{{ $post->category->name }}" data-company="{{ $post->company->name }}">
                                @if ($post->post_image_path)
                                    <a href="{{ route('creator.all-posts.show', $post) }}">
                                        <img src="{{ asset('storage/' . $post->post_image_path) }}"
                                            alt="{{ $post->title }}"
                                            class="w-full h-48 object-cover hover-zoom hover:opacity-75">
                                    </a>
                                @else
                                    <a href="{{ route('creator.all-posts.show', $post) }}">
                                        <img src="https://via.placeholder.com/300x200" alt="{{ $post->title }}"
                                            class="w-full h-48 object-cover hover-zoom hover:opacity-75">
                                    </a>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                        {{ $post->title }}</h3>
                                    <div class="flex justify-start items-center">

                                        <a href="{{ route('creator.all-posts.show.creator', $post->creator->username) }}"
                                            class="mr-2 bg-violet-500 hover:bg-violet-600 text-white p-2 text-sm rounded-md">
                                            {{ $post->creator->name }}</a>

                                        <a href="{{ route('creator.all-posts.show.category', $post->category->slug) }}"
                                            class="mr-2 bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-md text-sm">
                                            {{ $post->category->name }}</a>

                                        <a href="{{ route('creator.all-posts.show.company', $post->company->slug) }}"
                                            class="mr-2 bg-green-500 hover:bg-green-600 text-white text-sm p-2 rounded-md">
                                            {{ $post->company->name }}</a>

                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                                        {{ Str::limit($post->body, 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
