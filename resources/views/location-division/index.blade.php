@extends('components.layouts.main-layout')

@section('title', 'LocationDivision')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Location Division</h2>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <!-- Search form + Back Button -->
            <div class="flex w-full md:w-auto gap-2">
                <form method="GET" action="{{ route('location-division.index') }}" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                        class="w-[400px] border rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 rounded-r-md hover:bg-blue-700">Search</button>
                </form>

                @if (request('search'))
                    <a href="{{ route('location-division.index') }}"
                        class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg text-sm font-semibold text-center">
                        Kembali
                    </a>
                @endif
            </div>

            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <!-- Add Button -->
                <a href="{{ route('location-division.create') }}"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-semibold text-center">
                    + Add Data
                </a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200 mb-4">
            <table class="table-auto w-full text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Employee Name</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Company</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Location</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Work Type</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Detail Work</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($locationDivision as $data)
                        <tr class="odd:bg-white even:bg-gray-50 text-center hover:bg-gray-100">
                            <td class="px-4 py-2 font-medium text-gray-900">{{ $data->employee->name }}</td>
                            <td class="px-4 py-2 text-left">{{ $data->cooperation->company_name }}</td>
                            <td class="px-4 py-2 text-left">{{ $data->location->location }}</td>
                            <td class="px-4 py-2">{{ $data->work->work_type }}</td>
                            <td class="px-4 py-2 text-left">{{ $data->detail_work }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-block px-2 py-1 rounded-full text-white text-xs font-semibold
                                        @if ($data->status == 'in_progress') bg-blue-500
                                        @elseif($data->status == 'completed') bg-green-500
                                        @else bg-gray-400 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $data->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('location-division.edit', $data->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88h272c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24v112c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40h112c13.3 0 24-10.7 24-24S213.3 64 200 64H88z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('location-division.destroy', $data->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded focus:outline-none focus:ring-2 focus:ring-red-500"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 448 512">
                                                <path fill="currentColor"
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32S433.7 96 416 96H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128h384v320c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 text-sm">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
