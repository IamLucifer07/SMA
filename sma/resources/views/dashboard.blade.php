<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                </div>
            </div>
        </div>
        {{-- action="{{ route('search-results') }}" --}}
    </div> -->
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" class="flex items-center">
            <input type="text" name="query" placeholder="Search..."
                class="border border-gray-300 rounded-md p-2 w-full sm:w-1/2" required>
            <button type="submit"
                class="ml-2 bg-blue-500 text-black-500 hover:text-gray-700 px-4 py-2 rounded-md hover:bg-blue-600 transition ease-in-out duration-150">Search</button>
        </form>
    </div>
</x-app-layout>