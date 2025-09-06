@extends('components.layouts.main-layout')
@section('title', 'Add Complaint')
@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

    <h2 class="text-2xl font-bold mb-6">Create Visitor Complaint</h2>

    @if(session('success'))
    <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Visitor Name -->
        <div class="mb-4">
            <label for="visitor_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visitor Name</label>
            <input type="text" name="visitor_name" id="visitor_name" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="customer_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer Phone</label>
            <input type="text" name="customer_phone" id="customer_phone" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
            <select name="location_id" id="location_id"
                class="block w-full p-2.5 text-sm text-black bg-white border border-blue-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option disabled selected>Pilih lokasi</option>
                @foreach ($locations as $location)
                <option value="{{ $location->id }}" style="color: black;">{{ $location->location }}</option>
                @endforeach
            </select>
        </div>

        <!-- Auto-filled Employee -->
        <div class="mb-4">
            <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penanggung Jawab</label>
            <select name="employee_id" id="employee_id" required class="block w-full p-2.5 text-sm text-gray-900 bg-gray-100 border border-blue-300 rounded-lg">
                <option selected disabled>Pilih lokasi terlebih dahulu</option>
            </select>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea name="description" id="description" rows="4" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"></textarea>
        </div>

        <!-- Proof Image -->
        <div class="mb-4">
            <label for="proof_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proof Image</label>

            @if(isset($complaint) && $complaint->proof_image)
            <div class="mb-2">
                @if(\Illuminate\Support\Str::endsWith($complaint->proof_image, ['.mp4']))
                <video controls class="w-full max-w-xs rounded-lg border border-gray-300">
                    <source src="{{ asset('storage/' . $complaint->proof_image) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @else
                <img src="{{ asset('storage/' . $complaint->proof_image) }}" alt="Proof" class="w-full max-w-xs rounded-lg border border-gray-300">
                @endif
            </div>
            @endif

            <input type="file" name="proof_image" id="proof_image"
                accept="image/*,video/*"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" />
        </div>

        <!-- Submit -->
        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Submit Complaint
        </button>
    </form>
</div>

<!-- Script: Auto-fill employee -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const locationSelect = document.getElementById('location_id');
        const employeeSelect = document.getElementById('employee_id');

        locationSelect.addEventListener('change', function() {
            const locationId = this.value;

            fetch(`/get-employee-by-location/${locationId}`)
                .then(response => response.json())
                .then(data => {
                    employeeSelect.innerHTML = '';

                    if (data.length === 0) {
                        employeeSelect.innerHTML = `<option disabled selected>Tidak ada penanggung jawab</option>`;
                    } else {
                        data.forEach(emp => {
                            const option = document.createElement('option');
                            option.value = emp.id;
                            option.textContent = emp.name;
                            employeeSelect.appendChild(option);
                        });
                    }
                });
        });
    });
</script>
@endsection
