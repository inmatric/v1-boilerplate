@extends('components.layouts.main-layout')

@section('title', 'Tambah Divisi Lokasi')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Divisi Lokasi Baru</h2>

        <form action="{{ route('location-division.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Nama Pegawai -->
            <div class="mb-4">
                <label for="employee_id" class="block text-sm font-medium text-gray-800">Nama Pegawai</label>
                <select name="employee_id" id="employee_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Pilih Pegawai --</option>
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
                <label for="cooperation_id" class="block text-sm font-medium text-gray-800">Nama Perusahaan</label>
                <select name="cooperation_id" id="cooperation_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Pilih Perusahaan --</option>
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
                <label for="location_id" class="block text-sm font-medium text-gray-800">Lokasi</label>
                <select name="location_id" id="location_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Pilih Lokasi --</option>
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
                <label for="work_id" class="block text-sm font-medium text-gray-800">Jenis Pekerjaan</label>
                <select name="work_id" id="work_id"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Pilih Jenis Pekerjaan --</option>
                    @foreach ($works as $work)
                        <option value="{{ $work->id }}" {{ old('work_id') == $work->id ? 'selected' : '' }}>
                            {{ $work->task_type }}
                        </option>
                    @endforeach
                </select>
                @error('work_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai dan Tanggal Selesai -->
            <div class="mb-4">
                <div class="flex gap-4">
                    <!-- Tanggal Mulai -->
                    <div class="w-1/2">
                        <label for="start_date" class="block text-sm font-medium text-gray-800 mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('start_datei')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="w-1/2">
                        <label for="end_date" class="block text-sm font-medium text-gray-800 mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ old('end_date') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Detail Pekerjaan -->
            <div class="mb-4">
                <label for="detail_work" class="block text-sm font-medium text-gray-800">Detail Pekerjaan</label>
                <textarea name="detail_work" id="detail_work" rows="4"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>{{ old('detail_work') }}</textarea>
                @error('detail_work')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end mt-6">
                <!-- Tombol Batal -->
                <a href="{{ route('location-division.index') }}"
                    class="mr-4 px-4 py-2 bg-gray-600 hover:bg-gray-400 text-white rounded-lg">
                    Batal
                </a>
                <!-- Tombol Simpan -->
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
