<!-- resources/views/admin/companies/index.blade.php -->
<x-app-layout :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight pt-16">
            {{ __('Manage Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 mt-2 flex justify-end items-center">
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
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('admin.companies.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Company
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Company Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($companies as $company)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $company->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.companies.edit', $company->slug) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('admin.companies.destroy', $company->slug) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('Are you sure you want to delete {{ $company->name }}?');">Delete</button>
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
</x-app-layout>
