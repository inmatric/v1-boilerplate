@extends('components.layouts.main-layout')
@section('title', 'Complaint Register')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="mb-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Visitor Complaints</h1>
    <!-- Search Form -->
    <form action="{{ route('complaints.index') }}" method="GET" class="mb-6">
        <div class="flex items-center gap-3">
            <input
                type="text"
                name="location"
                value="{{ request('location') }}"
                placeholder="Search by location..."
                class="w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            <button
                type="submit"
                class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow transition">
                Search
            </button>
            @if(request()->has('location'))
            <a
                href="{{ route('complaints.index') }}"
                class="text-sm text-gray-600 underline hover:text-gray-800">
                Reset
            </a>
            @endif
        </div>
    </form>

    <a href="{{ route('complaints.create') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-base px-6 py-3 transition-all duration-300 ease-in-out transform hover:scale-105 shadow-lg">
        Create New Complaint
    </a>

</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-xl border border-gray-200">
    <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-300">
        <thead class="text-xs text-gray-600 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Visitor Name</th>
                <th scope="col" class="px-6 py-3">Phone</th>
                <th scope="col" class="px-6 py-3">Location</th>
                <th scope="col" class="px-6 py-3">Responsible</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Proof</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">{{ $complaint->visitor_name }}</td>
                <td class="px-6 py-4">{{ $complaint->customer_phone }}</td>
                <td class="px-6 py-4">{{ $complaint->location->location }}</td>
                <td class="px-6 py-4">{{ $complaint->employee?->name ?? 'Not assigned' }}</td>
                <td class="px-6 py-4">{{ $complaint->description }}</td>
                <td class="px-6 py-4">
                    @if($complaint->proof_image)
                    @if(\Illuminate\Support\Str::endsWith($complaint->proof_image, ['.mp4']))
                    <video controls class="w-20 h-20 object-cover rounded shadow-md">
                        <source src="{{ asset('storage/' . $complaint->proof_image) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @else
                    <img src="{{ asset('storage/' . $complaint->proof_image) }}" alt="Proof" class="w-20 h-20 object-cover rounded shadow-md" />
                    @endif
                    @else
                    <span class="text-gray-400 italic">No file</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @php
                    $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800 ring-yellow-300',
                    'processed' => 'bg-blue-100 text-blue-800 ring-blue-300',
                    'resolved' => 'bg-green-100 text-green-800 ring-green-300',
                    'rejected' => 'bg-red-100 text-red-800 ring-red-300'
                    ];
                    @endphp
                    <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full shadow-sm ring-1 {{ $statusColors[$complaint->status] }}">
                        {{ ucfirst($complaint->status) }}
                    </span>
                </td>

                <td class="px-6 py-4 text-center align-middle">
                    <div class="flex justify-center items-center space-x-3">
                        <!-- Tombol Edit -->
                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded">
                            <i class="fa fa-edit mr-1"></i> Edit
                        </a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this complaint?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded">
                                <i class="fa fa-trash mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection