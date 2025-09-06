@extends('components.layouts.main-layout')
@section('title', 'Employee')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Complaint/Submission Resolution</h1>
    <a href="{{ route('complaint_resolution.create')}}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
        + Add New
    </a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th scope="col" class="px-6 py-3">Enforcement Officer</th>
                <th scope="col" class="px-6 py-3">Complaint Title</th>
                <th scope="col" class="px-6 py-3">Doings</th>
                <th scope="col" class="px-6 py-3">Photo</th>
                <th scope="col" class="px-6 py-3">Location</th>
                <th scope="col" class="px-6 py-3">Notes</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resolutions as $key => $item)
            <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }} border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">{{ $key + 1 }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                <td class="px-6 py-4">{{ $item->employee?->name ?? 'Not assigned' }}</td>
                <td class="px-6 py-4">{{ $item->complaint->description }}</td>
                <td class="px-6 py-4">{{ $item->doings }}</td>
                <td class="px-6 py-4">
                    @if($item->photo_evidence)
                    <img src="{{ asset('storage/' . $item->photo_evidence) }}" alt="Evidence"
                        class="h-16 rounded shadow cursor-pointer"
                        onclick="showImageModal('{{ asset('storage/' . $item->photo_evidence) }}')">
                    @else
                    <span class="text-gray-400 italic">No image</span>
                    @endif
                </td>
                <td class="px-6 py-4">{{ $item->location->location }}</td>
                <td class="px-6 py-4">{{ $item->notes }}</td>
                <td class="px-6 py-4">
                    <span class="
                        px-2 py-1 rounded-full text-xs font-semibold
                        {{ 
                            $item->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                            ($item->status == 'processed' ? 'bg-blue-100 text-blue-800' : 
                            ($item->status == 'resolved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'))
                        }}
                    ">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex space-x-2">
                        <form action="{{ route('complaint_resolution.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                <!-- Trash Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                </svg>
                            </button>
                        </form>
                        <a href="{{ route('complaint_resolution.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                            <!-- Pencil Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Image Preview -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 hidden justify-center items-center z-50">
        <div class="relative bg-white p-4 rounded-lg max-w-3xl w-full">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
            <img id="modalImage" src="" alt="Preview" class="w-full rounded-lg">
        </div>
    </div>
</div>

<script>
    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.remove('flex');
        document.getElementById('imageModal').classList.add('hidden');
        document.getElementById('modalImage').src = '';
    }
</script>

@endsection