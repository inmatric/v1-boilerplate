@extends('components.layouts.main-layout')
@section('title', 'Employee')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Complaint/Submission Resolution</h1>

    <form action="{{ route('complaint_resolution.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Tanggal Tindak Lanjut -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="datetime-local" id="date" name="date" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Petugas Penindak -->
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700">Enforcement Officer</label>
                <select id="employee_id" name="employee_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Officer --</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Pengaduan -->
            <div>
                <label for="complaint_id" class="block text-sm font-medium text-gray-700">Complaint Title</label>
                <select id="complaint_id" name="complaint_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Complaint --</option>
                    @foreach($complaints as $complaint)
                    <option value="{{ $complaint->id }}">{{ $complaint->description }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tindakan yang Dilakukan -->
            <div>
                <label for="doings" class="block text-sm font-medium text-gray-700">Doings</label>
                <textarea id="doings" name="doings" rows="4" required
                    class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Lokasi -->
            <div>
                <label for="location_id" class="block text-sm font-medium text-gray-700">Location</label>
                <select id="location_id" name="location_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Location --</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Catatan Tambahan -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="4"
                    class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
        </div>

        <!-- Status -->
        <select name="status" class="form-input" required>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processed" {{ old('status') == 'processed' ? 'selected' : '' }}>Processed</option>
            <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>


        <!-- Upload Bukti -->
        <div>
            <label for="photo_evidence" class="block text-sm font-medium text-gray-700">Upload Image</label>
            <input type="file" id="photo_evidence" name="photo_evidence" accept="image/*"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex items-center space-x-3">
            <a href="{{ url('/complaint_resolution') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-md transition-colors">
                Back
            </a>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition-colors">
                Save Task
            </button>
        </div>
    </form>
</div>

@endsection