@extends('components.layouts.main-layout')

@section('title', 'Divisi Lokasi')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Divisi Lokasi Saya</h2>

        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200 mb-4">
            <table class="table-auto w-full text-sm text-gray-700">
                <thead class="bg-gray-200 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Perusahaan</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Lokasi</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Jenis Tugas</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Detail Pekerjaan</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Tanggal Mulai</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap">Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($data as $item)
                        <tr class="odd:bg-white even:bg-gray-50 text-center hover:bg-gray-100">
                            <td class="px-4 py-2 text-left">{{ $item->cooperation->company_name }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->location->location }}</td>
                            <td class="px-4 py-2">{{ $item->work->task_type }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->detail_work }}</td>
                            <td class="px-4 py-2 text-center">
                                {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->translatedFormat('d M Y') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-sm">
                                Tidak ada data divisi lokasi yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
@endsection
