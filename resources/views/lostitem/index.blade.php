@extends('components.layouts.main-layout')

@section('title', 'Daftar Barang Hilang & Ditemukan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">

        {{-- === DAFTAR BARANG HILANG === --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold">Daftar Barang Hilang</h2>
            <a href="{{ route('lostitem.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md shadow">+ Tambah</a>
        </div>

        <form action="{{ route('lostitem.index') }}" method="GET"
            class="mb-4 flex flex-col sm:flex-row items-start sm:items-center gap-2">
            <input type="text" name="search_lost" placeholder="Cari barang hilang..." value="{{ request('search_lost') }}"
                class="w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-md text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow">
                Cari
            </button>
        </form>

        <div class="overflow-x-auto shadow-md rounded-lg border border-gray-200 mb-10">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-center bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi
                            Hilang</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Foto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($lostItems as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-left text-gray-700">{{ $item->lost_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-gray-700">{{ $item->item_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-gray-700">{{ $item->lost_location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">{{ $item->lost_date ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">{{ $item->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto Barang"
                                        class="w-16 h-auto mx-auto rounded shadow">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-left text-gray-700">{{ $item->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('lostitem.edit', $item->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Edit</a>
                                    <form action="{{ route('lostitem.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data barang hilang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 px-6 py-3 bg-gray-50 border-t border-gray-200">
                {{ $lostItems->links() }}
            </div>
        </div>

        {{-- === DAFTAR BARANG DITEMUKAN === --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold">Daftar Barang Ditemukan</h2>
            <a href="{{ route('itemfound.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-md shadow">+ Tambah</a>
        </div>

        <form action="{{ route('lostitem.index') }}" method="GET"
            class="mb-4 flex flex-col sm:flex-row items-start sm:items-center gap-2">
            <input type="text" name="search_found" placeholder="Cari barang ditemukan..."
                value="{{ request('search_found') }}"
                class="w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-md text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow">
                Cari
            </button>
        </form>

        <div class="overflow-x-auto shadow-md rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-center bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Penemu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi
                            Temuan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Foto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($foundItems as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-left text-gray-700">{{ $item->find_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-gray-700">{{ $item->item_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-gray-700">{{ $item->find_location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">{{ $item->find_date ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">{{ $item->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700">{{ $item->telephone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto Barang"
                                        class="w-16 h-auto mx-auto rounded shadow">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-left text-gray-700">{{ $item->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('itemfound.edit', $item->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Edit</a>
                                    <form action="{{ route('itemfound.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data barang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
             <div class="mt-4 px-6 py-3 bg-gray-50 border-t border-gray-200">
                {{ $foundItems->links() }}
            </div>
        </div>
    </div>
@endsection
