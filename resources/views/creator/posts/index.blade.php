<x-app-layout :title="$title">
    <x-slot name="header">
        {{-- Menambahkan pt-16 --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __( Auth::user()->name . '`s Posts') }}
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
                        <a href="{{ route('creator.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            <i class="fa-solid fa-plus"></i>{{ __('Add') }}
                        </a>
                    </div>

                    {{-- Formulir Pencarian --}}
                    <div class="mb-4 relative">
                        <input type="text" id="search" placeholder="Search posts..."
                            class="border border-gray-300 rounded-md px-4 py-2 w-full pl-10">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    @if ($posts->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="posts-container">
                        @foreach ($posts as $post)
                            <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-lg post-item"
                                data-title="{{ $post->title }}"
                                data-creator="{{ $post->creator->name }}"
                                data-category="{{ $post->category->name }}"
                                data-company="{{ $post->company->name }}">
                                @if ($post->post_image_path)
                                    <a href="{{ route('creator.posts.show', $post) }}">
                                        <img src="{{ asset('storage/' . $post->post_image_path) }}" alt="{{ $post->title }}"
                                             class="w-full h-48 object-cover hover-zoom hover:opacity-75">
                                    </a>
                                @else
                                    <a href="{{ route('creator.posts.show', $post) }}">
                                        <img src="https://via.placeholder.com/300x200" alt="{{ $post->title }}"
                                             class="w-full h-48 object-cover hover-zoom hover:opacity-75">
                                    </a>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                        {{ $loop->iteration }}. {{ $post->title }}</h3>
                                    <div class="mt-2 flex justify-start items-center">
                                        <a href="{{ route('creator.posts.show.category', $post->category->slug) }}"
                                            class="mr-1 bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-md text-sm">
                                            <i class="fa-solid fa-briefcase"></i> {{ $post->category->name }}</a>

                                        <a href="{{ route('creator.posts.show.company', $post->company->slug) }}"
                                            class="mr-1 bg-green-500 hover:bg-green-600 text-white text-sm p-2 rounded-md">
                                            <i class="fa-solid fa-building"></i> {{ $post->company->name }}</a>
                                    </div>
                                    <div class="flex justify-start items-center mt-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400 ">
                                            {{ $post->created_at->format('F d, Y') }} {{ _('| Updated :') }}
                                            {{ $post->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">{{ Str::limit($post->body, 100) }}</p>
                                    <div class="flex justify-end space-x-2 mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('creator.posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                                            <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('creator.posts.destroy', $post) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete {{ $post->title }} ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                                                <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center mt-20">
                        <p class="text-gray-500 dark:text-gray-400 text-2xl">{{ $title }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">{{ _('Try To Add One !') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
