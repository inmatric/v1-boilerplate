<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Complaint;
use App\Models\Location;
use App\Models\LocationDivision;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with(['location', 'employee']);

        if ($request->filled('location')) {
            $query->whereHas('location', function ($q) use ($request) {
                $q->where('location', 'like', '%' . $request->location . '%');
            });
        }

        $complaints = $query->latest()->get();

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('complaints.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'visitor_name' => 'required',
            'customer_phone' => 'required',
            'description' => 'required',
            'location_id' => 'required|exists:locations,id',
            'employee_id' => 'required|exists:employees,id',
            'proof_image' => 'nullable|file|mimes:jpg,png,jpeg,mp4|max:2048'
        ]);

        // Upload file jika ada
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $path = $file->store('proofs', 'public'); // Simpan ke storage/app/public/proofs
            $data['proof_image'] = $path; // Simpan full path ke DB (opsional: bisa basename($path) jika hanya ingin filename)
        }

        // Tambahkan status default
        $data['status'] = 'pending';

        // Simpan data ke database
        Complaint::create($data);

        return redirect()->route('complaints.index')->with('success', 'Complaint submitted!');
    }

    public function getEmployeeByLocation($locationId)
    {
        $divisions = LocationDivision::where('location_id', $locationId)->with('employee')->get();

        // Check if there are employees found
        if ($divisions->isEmpty()) {
            return response()->json([]); // Return an empty array if no employees
        }

        $employees = $divisions->pluck('employee')->unique('id')->map(function ($emp) {
            return ['id' => $emp->id, 'name' => $emp->name];
        });

        return response()->json($employees);
    }

    public function edit(Complaint $complaint)
    {
        $complaint->load('location.locationDivisions.employee');
        $locations = Location::all();

        return view('complaints.edit', compact('complaint', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visitor_name' => 'required',
            'customer_phone' => 'required',
            'description' => 'required',
            'location_id' => 'required|exists:locations,id',
            'employee_id' => 'required|exists:employees,id',
            'proof_image' => 'nullable|file|mimes:jpg,png,jpeg,mp4|max:2048'
        ]);

        $complaint = Complaint::findOrFail($id);

        // If a new proof image is uploaded, store it
        $path = $request->file('proof_image') ? $request->file('proof_image')->store('complaints', 'public') : $complaint->proof_image;

        $complaint->update([
            'visitor_name' => $request->visitor_name,
            'customer_phone' => $request->customer_phone,
            'description' => $request->description,
            'location_id' => $request->location_id,
            'employee_id' => $request->employee_id,
            'status' => $complaint->status, // Keep the status as it is
            'proof_image' => $path
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);

        if ($complaint->proof_image && Storage::disk('public')->exists($complaint->proof_image)) {
            Storage::disk('public')->delete($complaint->proof_image);
        }

        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}
