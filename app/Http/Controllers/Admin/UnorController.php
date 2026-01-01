<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unor;
use Illuminate\Http\Request;

class UnorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unors = Unor::all();
        return view('admin.unor.index', compact('unors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
            ]);

            Unor::create([
                'name' => $request->name,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'fax' => $request->fax,
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with('toast', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Data gagal disimpan : ' . $th->getMessage(),
            ]);
        }

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unor $unor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unor $unor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unor $unor)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
            ]);


            $unor->update([
                'name' => $request->name,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'fax' => $request->fax,
            ]);
        } catch (\Throwable $th) {

            return redirect()->back()->with('toast', [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Data gagal diubah : ' . $th->getMessage(),
            ]);
        }

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data berhasil diubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unor $unor)
    {
        $unor->delete();

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil dihapus',
            ]);
    }
}
