<x-app-layout :title="$title">
    <x-slot name="header">
        {{-- Menambahkan pt-16 --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __('Program Overview') }}
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
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $post->title }}</h3>
                        @if ($liked)
                            <a href="{{ route('public.favorite-posts.unlike', $post->slug) }}"
                                class="text-red-500 dark:text-red-300 hover:underline">
                                <i class="fa-solid fa-heart"></i> {{ $like }}
                            </a>
                        @else
                            <a href="{{ route('public.favorite-posts.like', $post->slug) }}"
                                class="text-red-500 dark:text-red-300 hover:underline">
                                <i class="fa-regular fa-heart"></i> {{ $like }}
                            </a>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $post->post_image_path ? asset('storage/' . $post->post_image_path) : 'https://via.placeholder.com/300x200' }}"
                                alt="{{ $post->title }}"
                                class="h-full w-full object-cover rounded-md hover-zoom hover:opacity-75">
                        </div>
                        <div class="space-y-4">
                            <div class="mt-2 flex justify-start items-center">
                                <a href="{{ route('public.favorite-posts.show.category', $post->category->slug) }}"
                                    class="mr-1 bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-md text-sm">
                                    <i class="fa-solid fa-briefcase"></i> {{ $post->category->name }}</a>

                                <a href="{{ route('public.favorite-posts.show.company', $post->company->slug) }}"
                                    class="mr-1 bg-green-500 hover:bg-green-600 text-white text-sm p-2 rounded-md">
                                    <i class="fa-solid fa-building"></i> {{ $post->company->name }}</a>
                            </div>
                            <div class="flex justify-start items-center mt-4">
                                <p class="text-sm text-gray-500 dark:text-gray-400 ">
                                    {{ $post->created_at->format('F d, Y') }} {{ _('| Updated :') }}
                                    {{ $post->updated_at->diffForHumans() }}</p>
                            </div>
                            <p class="text-sm text-justify text-gray-500 dark:text-gray-400 mt-4">{{ $post->body }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('public.favorite-posts.index') }}" class="text-blue-500 hover:underline">
                        {{ __('Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
