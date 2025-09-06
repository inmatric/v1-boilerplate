<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Offence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class OffenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        $offences = Offence::all();
        return view('offence.index', compact('offences', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('offence.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'offence_category' => 'required|string|max:100',
            'offence_description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        // Simpan gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('offence_images', 'public');
            $validated['image'] = $imagePath;
        }

        Offence::create($validated); // Ganti dengan model yang sesuai
        return redirect()->route('offence.index')
            ->with('success', 'Offence berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
{
   
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $employees = Employee::all();
    $offence = Offence::findOrFail($id);
    return view('offence.edit', compact('offence', 'employees'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'employee_id'     => 'required|exists:employees,id',
        'date' => 'required|date',
        'offence_category' => 'required|string|max:255',
        'offence_description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Ambil data berdasarkan ID
    $offence = Offence::findOrFail($id);

    $offence->employee_id = $request->employee_id;
    $offence->date = $request->date;
    $offence->offence_category = $request->offence_category;
    $offence->offence_description = $request->offence_description;

    if ($request->hasFile('image')) {
        if ($offence->image) {
            Storage::delete('public/' . $offence->image);
        }

        $path = $request->file('image')->store('offence_images', 'public');
        $offence->image = $path;
    } else {
        $offence->image = $request->existing_image;
    }

    $offence->save();

    return redirect()->route('offence.index')->with('success', 'Offence updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $offence = Offence::findOrFail($id);

    if ($offence->image) {
        Storage::delete('public/' . $offence->image);
    }

    $offence->delete();

    return redirect()->route('offence.index')->with('success', 'Offence berhasil dihapus.');
}

public function search(Request $request)
{
    $search = $request->search;

    $offences = Offence::where('employee_id', 'like', "%{$search}%")
                ->orWhere('offence_category', 'like', "%{$search}%")
                ->orWhere('offence_description', 'like', "%{$search}%")
                ->latest()
                ->get();

    return view('offence.index', compact('offences'));
}
}
