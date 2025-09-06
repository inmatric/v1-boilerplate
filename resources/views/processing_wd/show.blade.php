@extends('components.layouts.main-layout')
@section('title', 'Task Details')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Task Details</h1>
            <a href="{{ route('processing_wd.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                Back to List
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 mb-2">Basic Information</h2>
                        <div class="space-y-2">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Task Name:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $processing_wd->work->task ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Employee:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $processing_wd->employee->name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Status:</span>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'inprogress' => 'bg-blue-100 text-blue-800',
                                        'completed' => 'bg-green-100 text-green-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$processing_wd->status] }}">
                                    {{ ucfirst($processing_wd->status) }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Start Time:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $processing_wd->start_time ? $processing_wd->start_time->format('Y-m-d H:i:s') : 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">End Time:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $processing_wd->end_time ? $processing_wd->end_time->format('Y-m-d H:i:s') : 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Duration:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $processing_wd->duration ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg font-medium text-gray-900 mb-2">Documentation</h2>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">Before Photo</h3>
                                @if($processing_wd->photo_before_path)
                                    <img src="{{ $processing_wd->photo_before_url }}" alt="Before photo" class="w-full h-48 object-cover rounded-lg">
                                @else
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                        <p class="text-gray-500">No photo available</p>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-1">After Photo</h3>
                                @if($processing_wd->photo_after_path)
                                    <img src="{{ $processing_wd->photo_after_url }}" alt="After photo" class="w-full h-48 object-cover rounded-lg">
                                @else
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                        <p class="text-gray-500">No photo available</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($processing_wd->notes)
                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-2">Notes</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-700">{{ $processing_wd->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('processing_wd.edit', $processing_wd->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                    Edit
                </a>
                <form action="{{ route('processing_wd.destroy', $processing_wd->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md" onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection