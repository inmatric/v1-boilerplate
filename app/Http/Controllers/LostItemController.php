<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\ItemFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{
    /**
     * Display a listing of the lost items.
     */

    public function index(Request $request)
    {
        $searchLost = $request->input('search_lost');
        $searchFound = $request->input('search_found');

        // Filter dan paginasi data barang hilang
        $lostItems = LostItem::when($searchLost, function ($query, $searchLost) {
            return $query->where('item_name', 'like', '%' . $searchLost . '%');
        })->paginate(5)->withQueryString();

        // Filter dan paginasi data barang ditemukan
        $foundItems = ItemFound::when($searchFound, function ($query, $searchFound) {
            return $query->where('item_name', 'like', '%' . $searchFound . '%');
        })->paginate(5)->withQueryString();

        return view('lostitem.index', compact('lostItems', 'foundItems'));
    }
    //public function index()
    //{
    //  $lostItems = LostItem::all();
    //return view('lostitem.index', compact('lostItems'));
    //}

    /**
     * Show the form for creating a new lost item.
     */
    public function create()
    {
        return view('lostitem.create');
    }

    /**
     * Store a newly created lost item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lost_name' => 'required|max:50',
            'item_name' => 'required|max:100',
            'lost_location' => 'required|max:50',
            'lost_date' => 'nullable|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:hilang,ditemukan',
            'description' => 'required',
        ]);

        $photoPath = $request->file('photo')->store('lost_photos', 'public');

        LostItem::create([
            'lost_name' => $request->lost_name,
            'item_name' => $request->item_name,
            'lost_location' => $request->lost_location,
            'lost_date' => $request->lost_date,
            'photo' => $photoPath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('lostitem.index')->with('success', 'Data kehilangan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified lost item.
     */
    public function edit($id)
    {
        $lostItem = LostItem::findOrFail($id);
        return view('lostitem.edit', compact('lostItem'));
    }

    /**
     * Update the specified lost item in storage.
     */
    public function update(Request $request, $id)
    {
        $lostItem = LostItem::findOrFail($id);

        $request->validate([
            'lost_name' => 'required|max:50',
            'item_name' => 'required|max:100',
            'lost_location' => 'required|max:50',
            'lost_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:hilang,ditemukan',
            'description' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($lostItem->photo && Storage::disk('public')->exists($lostItem->photo)) {
                Storage::disk('public')->delete($lostItem->photo);
            }
            $photoPath = $request->file('photo')->store('lost_photos', 'public');
        } else {
            $photoPath = $lostItem->photo;
        }

        $lostItem->update([
            'lost_name' => $request->lost_name,
            'item_name' => $request->item_name,
            'lost_location' => $request->lost_location,
            'lost_date' => $request->lost_date,
            'photo' => $photoPath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('lostitem.index')->with('success', 'Data kehilangan berhasil diperbarui.');
    }

    /**
     * Remove the specified lost item from storage.
     */
    public function destroy($id)
    {
        $lostItem = LostItem::findOrFail($id);

        if ($lostItem->photo && Storage::disk('public')->exists($lostItem->photo)) {
            Storage::disk('public')->delete($lostItem->photo);
        }

        $lostItem->delete();

        return redirect()->route('lostitem.index')->with('success', 'Data kehilangan berhasil dihapus.');
    }
}
