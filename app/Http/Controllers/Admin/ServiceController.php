<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Skm;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Skm $skm)
    {
        $services = $skm->services;
        return view('admin.service.index', compact('services', 'skm'));
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
    public function store(Request $request, Skm $skm)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
            ]);

            Service::create([
                'user_id' => 0,
                'skm_id' => $skm->id,
                'name' => $request->name,
                'description' => $request->description,
                'service_channel' => $request->service_channel,
                'is_active' => $request->is_active,
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
    public function show(Service $service, Skm $skm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skm $skm, Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skm $skm, Service $service)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
            ]);


            $service->update([
                'name' => $request->name,
                'description' => $request->description,
                'service_channel' => $request->service_channel,
                'is_active' => $request->is_active,
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
    public function destroy(Skm $skm, Service $service)
    {
        $service->delete();

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil dihapus',
            ]);
    }
}
