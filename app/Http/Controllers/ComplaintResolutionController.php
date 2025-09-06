<?php

namespace App\Http\Controllers;

use App\Models\ComplaintResolution;
use App\Models\Employee;
use App\Models\Complaint;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ComplaintResolutionController extends Controller
{
    public function index()
    {
        $resolutions = ComplaintResolution::with(['employee', 'complaint', 'location'])->get();
        return view('complaint_resolution.index', compact('resolutions'));
    }

    public function create()
    {
        $employees = Employee::all();
        $complaints = Complaint::all();
        $locations = Location::all();

        return view('complaint_resolution.create', compact('employees', 'complaints', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'complaint_id' => 'required|exists:complaints,id',
            'doings' => 'nullable|string|max:255',
            'photo_evidence' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location_id' => 'required|exists:locations,id',
            'notes' => 'nullable|string|max:255',
            'status' => 'required|in:pending,processed,resolved,rejected',  // Add validation for status
        ]);

        if ($request->hasFile('photo_evidence')) {
            $file = $request->file('photo_evidence');
            $path = $file->store('photo_evidences', 'public');
            $validated['photo_evidence'] = $path;
        }

        // Add status to validated data
        $validated['status'] = $request->status;

        ComplaintResolution::create($validated);

        return redirect()->route('complaint_resolution.index')->with('success', 'Penyelesaian keluhan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $resolution = ComplaintResolution::findOrFail($id);
        $employees = Employee::all();
        $complaints = Complaint::all();
        $locations = Location::all();
        $statuses = ['pending', 'processed', 'resolved'];
        return view('complaint_resolution.edit', compact('resolution', 'employees', 'complaints', 'locations', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $resolution = ComplaintResolution::findOrFail($id);
        $resolution->status = $request->input('status');

        $validated = $request->validate([
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'complaint_id' => 'required|exists:complaints,id',
            'doings' => 'nullable|string|max:255',
            'photo_evidence' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location_id' => 'required|exists:locations,id',
            'notes' => 'nullable|string|max:255',
            'status' => 'required|in:pending,processed,resolved',  // Add validation for status
        ]);

        // Handle photo update
        if ($request->hasFile('photo_evidence')) {
            // Hapus foto lama jika ada
            if ($resolution->photo_evidence && \Storage::disk('public')->exists($resolution->photo_evidence)) {
                \Storage::disk('public')->delete($resolution->photo_evidence);
            }

            // Simpan foto baru
            $file = $request->file('photo_evidence');
            $path = $file->store('photo_evidences', 'public');
            $validated['photo_evidence'] = $path;
        }

        // Add status to validated data
        // $validated['status'] = $request->status;

        $resolution->update($validated);

        return redirect()->route('complaint_resolution.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        ComplaintResolution::destroy($id);
        return redirect()->route('complaint_resolution.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        $resolution = ComplaintResolution::with(['employee', 'complaint', 'location'])->findOrFail($id);
        return view('complaint_resolution.show', compact('resolution'));
    }
}
