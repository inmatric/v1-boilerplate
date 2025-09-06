@extends('components.layouts.main-layout')
@section('title', 'Attendance')
@section('content')

    <p class="max-w-lg text-3xl font-semibold leading-loose text-gray-900 dark:text-white">Attendance Table</p>
    <div class="flex items-center space-x-4 w-full">



        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="text-white bg-cyan-500 hover:bg-cyan-500 focus:ring-4 focus:outline-none focus:ring-cyan-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-cyan-500 dark:hover:bg-cyan-500 dark:focus:ring-cyan-500"
            type="button">Add <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{ route('attendances.create', ['type' => 'start']) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Start Time
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendances.creates', ['type' => 'end']) }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        End Time
                    </a>
                </li>

            </ul>
        </div>

    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Name
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Date
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Start Time
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            End Time
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <!-- <th scope="col" class="px-6 py-3">
                                                                    <div class="flex items-center">
                                                                        start photo
                                                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor" viewBox="0 0 24 24">
                                                                                <path
                                                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                                            </svg></a>
                                                                    </div>
                                                                </th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    <div class="flex items-center">
                                                                        end photo
                                                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor" viewBox="0 0 24 24">
                                                                                <path
                                                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                                            </svg></a>
                                                                    </div>
                                                                </th> -->
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Notes
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Status
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Action
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            {{ $attendance->employee->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($attendance->start_time)
                                @php
                                    $startTime = \Carbon\Carbon::parse($attendance->start_time);
                                    $earliestStartTime = \Carbon\Carbon::parse('07:00:00');
                                    $latestStartTime = \Carbon\Carbon::parse('09:00:00');
                                    $isLateStart = $startTime->gt($latestStartTime);
                                    $backgroundColorStart = $isLateStart ? 'bg-red-200' : 'bg-green-200';
                                @endphp
                                <span class="{{ $backgroundColorStart }} px-2 py-1 rounded">
                                    {{ $startTime->format('H:i:s') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($attendance->end_time)
                                @php
                                    $endTime = \Carbon\Carbon::parse($attendance->end_time);
                                    $earliestEndTime = \Carbon\Carbon::parse('13:00:00');
                                    $latestEndTime = \Carbon\Carbon::parse('20:00:00');
                                    $isInvalidEnd = $endTime->lt($earliestEndTime) || $endTime->gt($latestEndTime);
                                    $backgroundColorEnd = $isInvalidEnd ? 'bg-red-200' : 'bg-green-200';
                                @endphp
                                <span class="{{ $backgroundColorEnd }} px-2 py-1 rounded">
                                    {{ $endTime->format('H:i:s') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <!-- <td class="px-6 py-4">
                                                                                                                                                    @if ($attendance->photo)
                                                                                                                                                        <a href="{{ asset('storage/' . $attendance->photo) }}" target="_blank">
                                                                                                                                                            <img src="{{ asset('storage/' . $attendance->photo) }}" alt="Photo"
                                                                                                                                                                class="w-12 h-12 rounded-md object-cover">
                                                                                                                                                        </a>
                                                                                                                                                    @else
                                                                                                                                                        -
                                                                                                                                                    @endif
                                                                                                                                                </td>
                                                                                                                                                <td class="px-6 py-4">
                                                                                                                                                    @if ($attendance->end_photo)
                                                                                                                                                        <a href="{{ asset('storage/' . $attendance->end_photo) }}" target="_blank">
                                                                                                                                                            <img src="{{ asset('storage/' . $attendance->end_photo) }}" alt="Photo"
                                                                                                                                                                class="w-12 h-12 rounded-md object-cover">
                                                                                                                                                        </a>
                                                                                                                                                    @else
                                                                                                                                                        -
                                                                                                                                                    @endif
                                                                                                                                                </td> -->
                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                            @if ($attendance->start_time && $attendance->end_time)
                                <span class="bg-blue-200 text-green-800 px-2 py-1 rounded">Hadir</span>
                            @else
                                <span class="bg-yellow-200 text-red-800 px-2 py-1 rounded">Tidak Hadir</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded text-white text-xs
                                                                                                                {{ $attendance->status === 'completed' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right flex space-x-4">
                            <button data-modal-target="attendance-modal-{{ $attendance->id }}"
                                data-modal-toggle="attendance-modal-{{ $attendance->id }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Detail
                            </button>

                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">No data available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Main modal for each attendance item -->
    <div id="attendance-modal-{{ $attendance->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Attendance Details
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="attendance-modal-{{ $attendance->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p><strong>Employee ID:</strong> {{ $attendance->employee_id }}</p>
                    <p><strong>Date:</strong> {{ $attendance->date }}</p>
                    <p><strong>Start Time:</strong> {{ $attendance->start_time }}</p>
                    <p><strong>End Time:</strong> {{ $attendance->end_time }}</p>

                    <div>
                        <strong>Start Photo:</strong><br>
                        <img src="{{ asset('storage/' . $attendance->photo) }}" alt="Start Photo"
                            class="w-32 h-32 object-cover rounded-md">
                    </div>

                    <div>
                        <strong>End Photo:</strong><br>
                        <img src="{{ asset('storage/' . $attendance->end_photo) }}" alt="End Photo"
                            class="w-32 h-32 object-cover rounded-md">
                    </div>


                    <p><strong>Notes:</strong> {{ $attendance->notes }}</p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="attendance-modal-{{ $attendance->id }}" type="button"
                        class="text-white bg-cyan-500 hover:bg-cyan-500 focus:ring-4 focus:outline-none focus:ring-cyan-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-cyan-500 dark:hover:bg-cyan-500 dark:focus:ring-cyan-500">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection