<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funds = Fund::all();
        return view('funds.index', compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('funds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cooperation_id' => 'required|string|min:0',
            'date' => 'required|date',
            'fund_received' => 'required|numeric|min:0',
            'payment' => 'required|string|min:0',
            'receipt' => 'required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|string|min:0', 
        ]);
        
        $randomNumber = rand(1000, 9999);
        $extension = $request->file('receipt')->getClientOriginalExtension();
        $fileName = 'receipt_' . $randomNumber . '.' . $extension;
        $imagePath = $request->file('receipt')->storeAs('receipts', $fileName, 'public');
        $validated['receipt'] = $imagePath;
        
        Fund::create($validated);
    
        return redirect()->route('funds.index')
            ->with('success', 'Fund berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fund $fund)
    {
        return view('funds.edit', compact('fund'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fund $fund)
    {
        $validated = $request->validate([
            'cooperation_id' => 'required|string|min:0',
            'date' => 'required|date',
            'fund_received' => 'required|numeric|min:0',
            'payment' => 'required|string|min:0',
            'description' => 'required|string|min:0',
            'receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        \Log::info('Update Fund - Validated data:', $validated);
        \Log::info('File received:', ['receipt' => $request->file('receipt')]);
    
        if ($request->hasFile('receipt')) {
            if ($fund->receipt && Storage::disk('public')->exists($fund->receipt)) {
                Storage::disk('public')->delete($fund->receipt);
            }
            
            $randomNumber = rand(1000, 9999);
            $extension = $request->file('receipt')->getClientOriginalExtension();
            $fileName = 'receipt_' . $randomNumber . '.' . $extension;
            $imagePath = $request->file('receipt')->storeAs('receipts', $fileName, 'public');
            \Log::info('New image path:', ['path' => $imagePath]);
            $validated['receipt'] = $imagePath;
        }
    
        $fund->update($validated);
    
        return redirect()->route('funds.index')->with('success', 'Fund berhasil diperbarui');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fund $fund)
    {
        // Hapus file gambar jika ada
        if ($fund->receipt && \Storage::disk('public')->exists($fund->receipt)) {
            \Storage::disk('public')->delete($fund->receipt);
        }
    
        // Hapus data dari database
        $fund->delete();
    
        return redirect()->route('funds.index')
            ->with('success', 'Fund berhasil dihapus');
    }
    
}
