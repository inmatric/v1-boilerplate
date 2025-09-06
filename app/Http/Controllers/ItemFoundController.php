<?php

namespace App\Http\Controllers;

use App\Models\ItemFound;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemFoundController extends Controller
{
    /**
     * Display a listing of the found items.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $foundItems = ItemFound::when($search, function ($query, $search) {
        return $query->where('item_name', 'like', '%' . $search . '%');
    })->get();

    return view('itemfound.index', compact('foundItems'));
}

    

    /**
     * Show the form for creating a new found item.
     */
    public function create()
    {
        return view('itemfound.create');
    }

    /**
     * Store a newly created found item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'find_name' => 'required|max:50',
            'item_name' => 'required|max:100',
            'find_location' => 'required|max:50',
            'find_date' => 'nullable|date',
            'telephone' => 'required|max:15',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:diambil,belum_diambil',
            'description' => 'required',
        ]);

        $photoPath = $request->file('photo')->store('found_photos', 'public');

        ItemFound::create([
            'find_name' => $request->find_name,
            'item_name' => $request->item_name,
            'find_location' => $request->find_location,
            'find_date' => $request->find_date,
            'telephone' => $request->telephone,
            'photo' => $photoPath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

return redirect()->route('lostitem.index')->with('success', 'Data penemuan berhasil ditambahkan.');    }

    /**
     * Show the form for editing the specified found item.
     */
    public function edit($id)
{
    $itemFound = ItemFound::findOrFail($id);
    return view('itemfound.edit', compact('itemFound'));
}

    /**
     * Update the specified found item in storage.
     */
    public function update(Request $request, $id)
    {
        $foundItem = ItemFound::findOrFail($id);

        $request->validate([
            'find_name' => 'required|max:50',
            'item_name' => 'required|max:100',
            'find_location' => 'required|max:50',
            'find_date' => 'nullable|date',
            'telephone' => 'required|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:diambil,belum_diambil',
            'description' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            if ($foundItem->photo && Storage::disk('public')->exists($foundItem->photo)) {
                Storage::disk('public')->delete($foundItem->photo);
            }
            $photoPath = $request->file('photo')->store('found_photos', 'public');
        } else {
            $photoPath = $foundItem->photo;
        }

        $foundItem->update([
            'find_name' => $request->find_name,
            'item_name' => $request->item_name,
            'find_location' => $request->find_location,
            'find_date' => $request->find_date,
            'telephone' => $request->telephone,
            'photo' => $photoPath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('lostitem.index')->with('success', 'Data penemuan berhasil diperbarui.');
    }

    /**
     * Remove the specified found item from storage.
     */
    public function destroy($id)
    {
        $foundItem = ItemFound::findOrFail($id);

        if ($foundItem->photo && Storage::disk('public')->exists($foundItem->photo)) {
            Storage::disk('public')->delete($foundItem->photo);
        }

        $foundItem->delete();

        return redirect()->route('lostitem.index')->with('success', 'Data penemuan berhasil dihapus.');
    }
}
