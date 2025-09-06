<?php

namespace App\Http\Controllers;

use App\Models\Cooperation;
use App\Models\Location;
use App\Models\LocationType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query search, status, dan perPage
        $search = $request->input('search');
        $status = $request->input('status');
        $perPage = $request->input('perPage', 5);
        $typePerPage = $request->input('typePerPage', 5);

        // Query untuk tabel Location
        $locationQuery = Location::query();

        if ($search) {
            $locationQuery->where(function ($q) use ($search) {
                $q->where('location', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('location_type', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $locationQuery->where('status', $status);
        }

        $locations = $locationQuery->paginate($perPage)->appends($request->query());

        // Query untuk tabel LocationType
        $locationTypeQuery = LocationType::query();

        if ($search) {
            $locationTypeQuery->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('location_type', 'like', "%{$search}%");
            });
        }

        $locationTypes = $locationTypeQuery->paginate($typePerPage)->appends($request->query());

        return view('location.index', compact('locations', 'locationTypes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cooperations = Cooperation::all();
        $locationTypes = LocationType::all();

        return view('location.create', compact('cooperations', 'locationTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {

        $request->validate([
            'company_id' => 'required|exists:cooperations,id',
            'location' => 'required|string|max:255',
            'information' => 'nullable|string',
            'location_type' => 'nullable|array',
        ]);

        try {
            $cooperation = Cooperation::findOrFail($request->company_id);

            do {
                $code = strtoupper(substr($cooperation->company_name, 0, 1)) . rand(100, 999);
            } while (Location::where('location_code', $code)->exists());

            $locationTypeString = $request->location_type
                ? implode(',', $request->location_type)
                : null;



            Location::create([
                'company_id' => $cooperation->id,
                'company' => $cooperation->company_name,
                'location' => $request->location,
                'information' => $request->information,
                'location_code' => $code,
                'location_type' => $locationTypeString,
                'status' => $cooperation->status,
            ]);

            return redirect()->route('location.index')->with('success', 'Data lokasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Location store error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }







    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $cooperations = Cooperation::all();
        $locationTypes = LocationType::all();
        $selectedTypes = $location->location_type ? explode(',', $location->location_type) : [];

        return view('location.edit', compact('location', 'cooperations', 'locationTypes', 'selectedTypes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required|exists:cooperations,id',
            'location' => 'required|string|max:255',
            'information' => 'nullable|string',
            'location_type' => 'nullable|array',
        ]);

        try {
            $location = Location::findOrFail($id);
            $cooperation = Cooperation::findOrFail($request->company_id);

            $locationTypeString = $request->location_type
                ? implode(',', $request->location_type)
                : null;

            $location->update([
                'company_id' => $cooperation->id,
                'company' => $cooperation->company_name,
                'location' => $request->location,
                'information' => $request->information,
                'location_type' => $locationTypeString,
                'status' => $cooperation->status,
            ]);

            return redirect()->route('location.index')->with('success', 'Data lokasi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Location update error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan saat memperbarui data.']);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('location.index')->with('success', 'Data lokasi berhasil dihapus.');
    }
    public function downloadPDF(Request $request)
    {
        $query = Location::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('location', 'like', '%' . $request->search . '%')
                    ->orWhere('company', 'like', '%' . $request->search . '%')
                    ->orWhere('location_type', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $locations = $query->get();

        // Generate PDF
        $pdf = Pdf::loadView('location.pdf', compact('locations'));
        return $pdf->download('daftar_lokasi.pdf');
    }
}
