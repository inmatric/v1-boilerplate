<?php

namespace App\Http\Controllers;

use App\Models\LocationDivision;
use App\Models\Cooperation;
use App\Models\Employee;
use App\Models\Work;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
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
                        $q->where('task_type', 'like', "%{$search}%");
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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

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
        // Ambil ID pegawai dari user yang login
        $employee = Auth::user()->employee;

        if (!$employee) {
            abort(403, 'Akses ditolak: Pegawai tidak ditemukan.');
        }

        $data = LocationDivision::with(['cooperation', 'location', 'work'])
            ->where('employee_id', $employee->id)
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        return view('location-division.index-petugas', compact('data'));
    }
}
