@extends('components.layouts.main-layout')

@section('title', 'Add Location Division')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Add New Location Division</h2>

        <form action="{{ route('location-division.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Nama Pegawai -->
            <div class="mb-4">
                <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee Name</label>
                <select name="employee_id" id="employee_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Select Employee --</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Perusahaan -->
            <div class="mb-4">
                <label for="cooperation_id" class="block text-sm font-medium text-gray-700">Company</label>
                <select name="cooperation_id" id="cooperation_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Select Company --</option>
                    @foreach ($cooperations as $cooperation)
                        <option value="{{ $cooperation->id }}"
                            {{ old('cooperation_id') == $cooperation->id ? 'selected' : '' }}>
                            {{ $cooperation->company_name }}
                        </option>
                    @endforeach
                </select>
                @error('cooperation_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label for="location_id" class="block text-sm font-medium text-gray-700">Location</label>
                <select name="location_id" id="location_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Select Location --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->location }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Pekerjaan -->
            <div class="mb-4">
                <label for="work_id" class="block text-sm font-medium text-gray-700">Work Type</label>
                <select name="work_id" id="work_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Select Work Type --</option>
                    @foreach ($works as $work)
                        <option value="{{ $work->id }}" {{ old('work_id') == $work->id ? 'selected' : '' }}>
                            {{ $work->work_type }}
                        </option>
                    @endforeach
                </select>
                @error('work_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Work Detail -->
            <div class="mb-4">
                <label for="detail_work" class="block text-sm font-medium text-gray-700">Work Detail</label>
                <textarea name="detail_work" id="detail_work" rows="4"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>{{ old('detail_work') }}</textarea>
                @error('detail_work')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- Tombol Aksi -->
            <div class="flex justify-end mt-6">
                <!-- Tombol Cancel -->
                <a href="{{ route('location-division.index') }}"
                    class="mr-4 px-4 py-2 bg-gray-600 hover:bg-gray-400 text-white rounded-lg">
                    Cancel
                </a>
                <!-- Tombol Submit -->
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection