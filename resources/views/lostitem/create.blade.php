@extends('components.layouts.main-layout')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Tambah Barang Hilang</h2>

        <form action="{{ route('lostitem.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Pelapor</label>
                <input type="text" name="lost_name" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Barang</label>
                <input type="text" name="item_name" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Lokasi Hilang</label>
                <input type="text" name="lost_location" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Tanggal Hilang</label>
                <input type="date" name="lost_date" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Foto Barang</label>
                <input type="file" name="photo" class="w-full border border-gray-300 rounded-xl px-4 py-2 file:bg-gray-100 file:px-3 file:py-2 file:rounded-md file:text-sm file:border-none focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="hilang">Hilang</option>
                    <option value="ditemukan">Ditemukan</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required></textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl font-semibold shadow-md transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
