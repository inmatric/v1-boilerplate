@extends('components.layouts.main-layout')
@section('title', 'Edit fund')
@section('content')
<div class="mx-auto p-6 bg-white rounded shadow">
    <a href="/funds">
        <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
            Kembali
        </button>
    </a> 
    <form action="{{ route('funds.update', $fund->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Nama Perusahaan</label>
            <input type="text" name="cooperation_id" value="{{ $fund->cooperation_id }}" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Tanggal</label>
            <input type="date" name="date" value="{{ $fund->date }}" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Dana Yang Diterima</label>
            <input type="number" name="fund_received" value="{{ $fund->fund_received }}" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Jenis Pembayaran</label>
            <select name="payment" class="w-full px-3 py-2 border rounded" required>
                <option value="">Pilih Jenis Pembayaran</option>
                <option value="Transfer Bank" {{ $fund->payment == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="Kartu Kredit" {{ $fund->payment == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="Debit Bank" {{ $fund->payment == 'Debit Bank' ? 'selected' : '' }}>Debit Bank</option>
                <option value="E-Wallet" {{ $fund->payment == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Bukti Terima (Upload Baru jika ingin mengganti)</label>
            <input type="file" name="receipt" accept="image/*" class="w-full px-3 py-2 border rounded">
            @if ($fund->receipt)
                <p class="mt-2 text-sm text-gray-600">File saat ini: <a href="{{ asset('storage/' . $fund->receipt) }}" target="_blank" class="text-blue-500 underline">Lihat Gambar</a></p>
            @endif
        </div>
        @error('receipt')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror


        <textarea name="description" class="w-full px-3 py-2 border rounded" required>{{ old('description', $fund->description) }}</textarea>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection
