@extends('components.layouts.main-layout')
@section('title', 'Edit Task')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Task</h1>

        <form action="{{ route('processing_wd.update', $processing_wd->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Task Name -->
                <div>
                    <label for="work_id" class="block text-sm font-medium text-gray-700">Task</label>
                    <select id="work_id" name="work_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select Task --</option>
                        @foreach ($works as $work)
                            <option value="{{ $work->id }}"
                                {{ old('work_id', $processing_wd->work_id) == $work->id ? 'selected' : '' }}>
                                {{ $work->task }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Employee -->
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
                    <select id="employee_id" name="employee_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select Employee --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ old('employee_id', $processing_wd->employee_id) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending" {{ $processing_wd->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="inprogress" {{ $processing_wd->status == 'inprogress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="completed" {{ $processing_wd->status == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                </select>
            </div>

            <!-- Photo Before -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Before Photo</label>
                @if ($processing_wd->photo_before_path)
                    <div class="mt-2">
                        <img src="{{ $processing_wd->photo_before_url }}" alt="Before photo preview"
                            class="w-full h-48 object-cover rounded-lg">
                    </div>
                @else
                    <div class="mt-2 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <p class="text-gray-500">No photo available</p>
                    </div>
                @endif
                {{-- <input type="file" name="photo_before" id="photo_before" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"> --}}
            </div>

            <!-- Photo After -->
            <div>
                <label class="block text-sm font-medium text-gray-700">After Photo</label>
                @if ($processing_wd->photo_after_path)
                    <div class="mt-2">
                        <img src="{{ $processing_wd->photo_after_url }}" alt="After photo preview"
                            class="w-full h-48 object-cover rounded-lg">
                    </div>
                @else
                    <div class="mt-2 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <p class="text-gray-500">No photo available</p>
                    </div>
                @endif
                {{-- <input type="file" name="photo_after" id="photo_after" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"> --}}
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes', $processing_wd->notes) }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex items-center space-x-3">
                <a href="{{ route('processing_wd.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-md transition-colors">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition-colors">
                    Update Task
                </button>
            </div>
        </form>
    </div>
@endsection
