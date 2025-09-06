<?php

namespace App\Http\Controllers;

use App\Models\LocationDivision;
use App\Models\Cooperation;
use App\Models\Employee;
use App\Models\Work;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $locationDivision = LocationDivision::with(['cooperation', 'location', 'employee', 'work'])
            ->when($search, function ($query, $search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('cooperation', function ($q) use ($search) {
                        $q->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('location', function ($q) use ($search) {
                        $q->where('location', 'like', "%{$search}%");
                    })
                    ->orWhereHas('work', function ($q) use ($search) {
                        $q->where('work_type', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);

        return view('location-division.index', compact('locationDivision'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $cooperations = Cooperation::all();
        $locations = Location::all();
        $works = Work::all();

        return view('location-division.create', compact('employees', 'cooperations', 'locations', 'works'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'cooperation_id' => 'required|exists:cooperations,id',
            'location_id' => 'required|exists:locations,id',
            'work_id' => 'required|exists:works,id',
            'detail_work' => 'nullable|string',
            'status' => 'nullable|in:in_progress,completed',
        ]);

        $validated['status'] = $validated['status'] ?? 'in_progress';

        LocationDivision::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('location-division.index')
            ->with('success', 'Pembagian lokasi kerja berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $locationDivision = LocationDivision::findOrFail($id);
        $employees = Employee::all();
        $cooperations = Cooperation::all();
        $locations = Location::all();
        $works = Work::all();

        return view('location-division.edit', compact(
            'locationDivision',
            'employees',
            'cooperations',
            'locations',
            'works'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locationDivision = LocationDivision::findOrFail($id);

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'cooperation_id' => 'required|exists:cooperations,id',
            'location_id' => 'required|exists:locations,id',
            'work_id' => 'required|exists:works,id',
            'detail_work' => 'nullable|string',
            'status' => 'nullable|in:completed,in_progress',
        ]);
        $validated['status'] = $validated['status'] ?? 'in_progress';

        $locationDivision->update($validated);

        return redirect()->route('location-division.index')
            ->with('success', 'Pembagian lokasi kerja berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $locationDivision = LocationDivision::findOrFail($id);
        $locationDivision->delete();

        return redirect()->route('location-division.index')
            ->with('success', 'Pembagian lokasi kerja berhasil dihapus');
    }

    public function indexPetugas()
    {
        $data = LocationDivision::with(['employee', 'cooperation', 'location', 'work']) 
            ->where('status', 'in_progress')
            ->paginate(10);

        return view('location-division.index-petugas', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = LocationDivision::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:in_progress,completed',
        ]);

        $data->status = $request->input('status');
        $data->save();

        return redirect()->route('location-division.index-petugas')->with('success', 'Status pekerjaan berhasil diperbarui.');
    }
}