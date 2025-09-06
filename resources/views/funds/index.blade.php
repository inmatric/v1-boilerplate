@extends('components.layouts.main-layout')
@section('title', 'Fund')
@section('content')
    <div class="space-y-4">
        

<div class="relative overflow-x-auto shadow-md sm">
{{-- Card Atas untuk Judul + Tombol + Search --}}
<div class="bg-white dark:bg-gray-800 p-4 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <!-- KIRI: Judul -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Fund Management</h2>
        </div>
    
        <!-- KANAN: Search + Tombol Tambah -->
        <div class="flex items-center gap-3 flex-wrap">
            <a href="/funds/create">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> + Tambah </button>
            </a>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>
    </div>
</div>

    
    <table id="fundTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Perusahaan
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal
                </th>
                <th scope="col" class="px-6 py-3">
                    Dana Yang Diterima
                </th>
                <th scope="col" class="px-6 py-3">
                    Jenis Pembayaran
                </th>
                <th scope="col" class="px-6 py-3">
                    Bukti Terima
                </th>
                <th scope="col" class="px-6 py-3">
                    Keterangan
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($funds as $fund)
                <tr class="fund-row bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4"></td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $fund->cooperation_id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($fund->date)->format('d-m-Y') }}
                    </td>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($fund->fund_received, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $fund->payment }}
                    </td>
                    <td class="px-6 py-4">
                        @if($fund->receipt)
                            <a href="{{ asset('storage/' . $fund->receipt) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $fund->description }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('funds.edit', $fund->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('funds.destroy', $fund->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">Data belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('table-search');
            const rows = document.querySelectorAll('.fund-row');
    
            searchInput.addEventListener('keyup', function () {
                const keyword = this.value.toLowerCase();
    
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(keyword) ? '' : 'none';
                });
            });
        });
    </script>
    
@endsection
