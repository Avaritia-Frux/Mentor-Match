<x-app-layout :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('creator.posts.update', $post->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 dark:text-gray-400">{{ __('Title') }}</label>
                            @error('title')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <input type="text" id="title" name="title" value="{{ old('title', $post['title']) }}"
                                class="border border-gray-300 rounded-md px-4 py-2 w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 dark:text-gray-400">{{ __('Category') }}</label>
                            @error('category_id')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <select id="category_id" name="category_id"
                                class="border border-gray-300 rounded-md px-4 py-2 w-full" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="company_id" class="block text-gray-700 dark:text-gray-400">{{ __('Company') }}</label>
                            @error('company_id')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <select id="company_id" name="company_id"
                                class="border border-gray-300 rounded-md px-4 py-2 w-full" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $post->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="post_image_path" class="block text-gray-700 dark:text-gray-400">{{ __('Post Image') }}</label>
                            @error('post_image_path')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <input type="file" id="post_image_path" name="post_image_path"
                                class="border border-gray-300 rounded-md px-4 py-2 w-full"
                                onchange="previewImage(event)">
                            @if ($post->post_image_path)
                                <img id="image_preview" src="{{ asset('storage/' . $post->post_image_path) }}"
                                    alt="Image Preview"
                                    class="w-60 h-auto rounded-lg mt-2 {{ old('post_image_path', $post['post_image_path']) ?: 'hidden' }}">
                            @elseif ($post->post_image_path == null)
                                <img id="image_preview" src="#" alt="Image Preview"
                                    class="w-60 h-auto rounded-lg mt-2 {{ old('post_image_path', $post['post_image_path']) ?: 'hidden' }}">
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="body" class="block text-gray-700 dark:text-gray-400">{{ __('Body') }}</label>
                            @error('body')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <textarea id="body" name="body" rows="5" class="border border-gray-300 rounded-md px-4 py-2 w-full"
                                required>{{ old('body', $post['body']) }}</textarea>
                        </div>

                        <div class="mb-4 flex justify-between items-center">
                            <a href="{{ route('creator.posts.index') }}"
                                class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">
                                {{ __('Update Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
