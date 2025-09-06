@extends('components.layouts.main-layout')
@section('title', 'Location')
@section('content')

<div class="container mx-auto px-4 py-6">

    {{-- Header + Tambah --}}
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold text-gray-800">Daftar Lokasi</h1>
    </div>
    <a href="{{ route('location.create') }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
        <i class="fas fa-plus mr-2"></i>Tambah
    </a>
    <a href="{{ route('location.pdf', request()->query()) }}"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
        <i class="fas fa-file-pdf mr-2"></i>Download PDF
    </a>
    <br>
    <br>
    {{-- Filter & PerPage --}}
    <form method="GET" action="{{ route('location.index') }}" class="mb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <!-- Dropdown Tampilkan entri -->
        <div class="flex items-center gap-2">
            <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg text-sm py-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach([5,10, 25, 50, 100] as $size)
                <option value="{{ $size }}" {{ request('perPage') == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
                @endforeach
            </select>
            <span class="text-sm text-gray-700">entri</span>
        </div>

        <!-- Pencarian -->
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <input type="text" name="search" placeholder="Cari lokasi atau perusahaan..."
                value="{{ request('search') }}"
                class="w-full sm:w-64 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                Cari
            </button>
        </div>
    </form>


    {{-- Tabel Lokasi --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-6 py-3 text-center">Perusahaan</th>
                    <th class="px-6 py-3 text-center">Kode Lokasi</th>
                    <th class="px-6 py-3 text-center">Nama Lokasi</th>
                    <th class="px-6 py-3 text-center">Tipe Lokasi</th>
                    <th class="px-6 py-3 text-center">Informasi</th>
                    <th class="px-6 py-3 text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-center font-medium text-gray-900">{{ $location->company }}</td>
                    <td class="px-6 py-4 text-center">{{ $location->location_code }}</td>
                    <td class="px-6 py-4 text-center">{{ $location->location }}</td>
                    <td class="px-6 py-4 text-center">{{ $location->location_type }}</td>
                    <td class="px-6 py-4 text-center">{{ $location->information }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('location.edit', $location->id) }}"
                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-yellow-500 rounded-md hover:bg-yellow-600 focus:ring-2 focus:outline-none focus:ring-yellow-300">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('location.destroy', $location->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Data lokasi tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $locations->appends(request()->query())->links() }}
    </div>
</div>

{{-- Daftar Tipe Lokasi --}}
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold text-gray-800">Daftar Tipe Lokasi</h1>
        <a href="{{ route('location-type.create') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <i class="fas fa-plus mr-2"></i>Tambah
        </a>
    </div>
    {{-- Filter & PerPage --}}
    <form method="GET" action="{{ route('location.index') }}"
        class="mb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">

        <!-- Dropdown Tampilkan entri -->
        <div class="flex items-center gap-2">
            <label for="typePerPage" class="text-sm text-gray-700">Tampilkan</label>
            <select name="typePerPage" id="typePerPage" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg text-sm py-2  focus:ring-blue-500 focus:border-blue-500">
                @foreach([5,10, 25, 50, 100] as $size)
                <option value="{{ $size }}" {{ request('typePerPage') == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
                @endforeach
            </select>
            <span class="text-sm text-gray-700">entri</span>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <input type="text" name="search" placeholder="Cari lokasi atau perusahaan..."
                value="{{ request('search') }}"
                class="w-full sm:w-64 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                Cari
            </button>
        </div>
    </form>

    </form>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Nama</th>
                    <th scope="col" class="px-6 py-3 text-center">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locationTypes as $type)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-center font-medium text-gray-900">{{ $type->location_type }}</td>
                    <td class="px-6 py-4 text-center">{{ $type->description }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('location-type.edit', $type->id) }}"
                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-yellow-500 rounded-md hover:bg-yellow-600 focus:ring-2 focus:outline-none focus:ring-yellow-300">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('location-type.destroy', $type->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus tipe lokasi ini?')"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Data tipe lokasi tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Font Awesome for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

@endsection