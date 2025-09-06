@extends('components.layouts.main-layout')
@section('title', 'Employee')
@section('content')
<h2 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-2">
    Offence Table
</h2>

<div class="flex items-center mb-4">
    <div class="flex items-center flex-grow max-w-md">
        <form method="GET" action="{{ route('offence.search') }}" class="relative flex-grow">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input
                type="search"
                name="search"
                id="default-search"
                value="{{ request('search') }}"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search employee..."
                required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button>
        </form>

        <a href="{{ route('offence.create') }}" class="ml-2 text-white bg-blue-900 hover:bg-blue-950 focus:ring-4 focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-800 dark:hover:bg-blue-900 focus:outline-none dark:focus:ring-blue-900">
            + Offence
        </a>
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs uppercase bg-cyan-500 text-white dark:bg-cyan-700 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Employee Name</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Offence Category</th>
                <th scope="col" class="px-6 py-3">Offence Description</th>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($offences as $index => $offence)
            <tr class="{{ $index % 2 == 0 ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }} border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ $offence->employee->name }}</td>
                <td class="px-6 py-4">{{ $offence->date }}</td>
                <td class="px-6 py-4">{{ $offence->offence_category }}</td>
                <td class="px-6 py-4">{{ $offence->offence_description }}</td>
                <td class="px-6 py-4">
                    @if ($offence->image)
                    <img src="{{ asset('storage/' . $offence->image) }}" alt="Offence Image" class="w-20 h-auto rounded shadow">
                    @else
                    <span class="text-gray-400 italic">No image</span>
                    @endif
                </td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('offence.edit', $offence->id) }}"
                        class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:focus:ring-yellow-900">
                        Edit
                    </a>

                    <form action="{{ route('offence.destroy', $offence->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this offence?');" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4 text-gray-500 dark:text-gray-400 italic">
                    No offence data found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection