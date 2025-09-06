@extends('components.layouts.main-layout')
@section('title', 'Input Location')
@section('content')

<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Lokasi</h2>

        <form action="{{ route('location.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="company_id" class="block mb-2 text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <select id="company_id" name="company_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="">-- Pilih Perusahaan --</option>
                    @foreach($cooperations as $cooperation)
                    <option value="{{ $cooperation->id }}"
                        {{ old('company_id') == $cooperation->id ? 'selected' : '' }}>
                        {{ $cooperation->company_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-700">Nama Lokasi</label>
                <input type="text" id="location" name="location"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Tipe Lokasi</label>

                <div class="border rounded-md p-2 max-h-56 overflow-y-auto bg-gray-50">
                    @foreach($locationTypes as $type)
                    <div class="flex items-center mb-1">
                        <input type="checkbox" name="location_type[]" value="{{ $type->location_type }}"
                            class="mr-2 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <label class="text-sm text-gray-800">{{ $type->location_type }}</label>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="mb-4">
                <label for="information" class="block mb-2 text-sm font-medium text-gray-700">Informasi</label>
                <input type="text" id="information" name="information"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
            </div>
         



            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Submit
            </button>
        </form>
    </div>
</div>



@endsection