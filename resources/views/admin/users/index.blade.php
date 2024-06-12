<x-app-layout :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Search Input --}}
            <div class="-mt-8 mb-4 ml-4 mr-4">
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for names.."
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            {{-- Create Button --}}
            <div class="flex justify-between items-center mb-4">
                <div class="flex justify-start items-cente ml-4">
                    <a href="{{ route('admin.users.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-plus"></i> {{ __('Add') }}
                        </a>
                </div>
                @if (session('status'))
                    <div class="mr-4 alert alert-success alert-dismissible bg-green-600 dark:bg-green-800 bg-opacity-50 text-white py-1 px-2 rounded-md text-sm"
                        role="alert" style="max-width: 300px;">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mr-4 alert alert-success alert-dismissible bg-red-600 dark:bg-red-800 bg-opacity-50 text-white py-1 px-2 rounded-md text-sm"
                        role="alert" style="max-width: 300px;">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $title }}</h3>

                    {{-- Admins Section --}}
                    @if ($admins->count() == 0)
                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('No Admins') }}</h4>
                    @else
                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            <i class="fa-solid fa-circle-user"></i> {{ __('Admin :') }}
                            {{ $admins->count() }}</h4>
                    @endif

                    <div class="overflow-x-auto table-wrapper">
                        <table id="admins-table" class="min-w-full bg-white dark:bg-gray-800 mb-8">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('admins-table', 0)">{{ __('Profile Photo') }}</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('admins-table', 1)">{{ __('Name') }}</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('admins-table', 2)">{{ __('Email') }}</th>
                                    <th
                                        class="py-2 px-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            <img src="{{ $admin->profile_photo_url }}" alt="admin-profile-photo"
                                                class="w-8 h-8 rounded-full object-cover">
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $admin->name }}
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $admin->email }}
                                        </td>
                                        @if ($admin->id == 1)
                                            <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300 text-center italic font-bold">
                                                {{ _('Super Admin') }}
                                            </td>
                                        @else
                                            <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300 text-center">
                                                <form action="{{ route('admin.users.destroy', $admin->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure delete {{ $admin->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                        <i class="fa-solid fa-trash"></i> {{ _('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Creators Section --}}
                    @if ($creators->count() == 0)
                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('No Creators') }}</h4>
                    @else
                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            <i class="fa-solid fa-circle-user"></i> {{ __('Creator :') }}
                            {{ $creators->count() }}</h4>
                    @endif
                    <div class="overflow-x-auto table-wrapper">
                        <table id="creators-table" class="min-w-full bg-white dark:bg-gray-800 mb-8">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('creators-table', 0)">{{ __('Profile Photo')  }}</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('creators-table', 1)">{{ __('Name') }}</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('creators-table', 2)">{{ __('Email') }}</th>
                                    <th
                                        class="py-2 px-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($creators as $creator)
                                    <tr>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            <img src="{{ $creator->profile_photo_url }}" alt="creator-profile-photo"
                                                class="w-8 h-8 rounded-full object-cover">
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $creator->name }}
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $creator->email }}</td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300 text-center">
                                            <form action="{{ route('admin.users.destroy', $creator->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure delete {{ $creator->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                    <i class="fa-solid fa-trash"></i> {{ _('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Publics Section --}}
                    @if ($publics->count() == 0)
                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('No Publics') }}</h4>
                    @else
                        <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            <i class="fa-solid fa-circle-user"></i> {{ __('Public :') }}
                            {{ $publics->count() }}</h4>
                    @endif
                    <div class="overflow-x-auto table-wrapper">
                        <table id="publics-table" class="min-w-full bg-white dark:bg-gray-800">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('publics-table', 0)">{{ __('Profile Photo') }}</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('publics-table', 1)">{{ __('Name') }}</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer"
                                        onclick="sortTable('publics-table', 2)">{{ __('Email') }}</th>
                                    <th
                                        class="py-2 px-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($publics as $public)
                                    <tr>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            <img src="{{ $public->profile_photo_url }}" alt="public-profile-photo"
                                                class="w-8 h-8 rounded-full object-cover">
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $public->name }}
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300">
                                            {{ $public->email }}
                                        </td>
                                        <td class="py-2 px-4 text-sm text-gray-500 dark:text-gray-300 text-center">
                                            <form action="{{ route('admin.users.destroy', $public->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure delete {{ $public->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                    <i class="fa-solid fa-trash"></i> {{ _('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
