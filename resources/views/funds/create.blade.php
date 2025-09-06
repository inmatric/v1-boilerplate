@extends('components.layouts.main-layout')
@section('title', 'Create Fund')
@section('content')
<div class="mx-auto p-6 bg-white rounded shadow">
    <a href="/funds">
        <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
            Kembali
        </button>
    </a> 

    <form action="{{ route('funds.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nama Perusahaan</label>
            <input type="text" name="cooperation_id" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Tanggal</label>
            <input type="date" name="date" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Dana Yang Diterima</label>
            <input 
                type="number" 
                name="fund_received" 
                class="w-full px-3 py-2 border rounded" 
                inputmode="numeric" 
                pattern="[0-9]*" 
                step="0.01"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Jenis Pembayaran</label>
            <select name="payment" class="w-full px-3 py-2 border rounded" required>
                <option value="">Pilih Jenis Pembayaran</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="Kartu Kredit">Kartu Kredit</option>
                <option value="Debit Bank">Debit Bank</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Bukti Terima (Upload Foto)</label>
            <input type="file" name="receipt" accept="image/*" class="w-full px-3 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Keterangan</label>
            <textarea name="description" class="w-full px-3 py-2 border rounded" required></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
