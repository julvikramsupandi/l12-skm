<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user.view')->only(['index', 'show']);
        $this->middleware('permission:user.create')->only(['create', 'store']);
        $this->middleware('permission:user.edit')->only(['edit', 'update']);
        $this->middleware('permission:user.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        // dd($users);
        $roles = Role::orderBy('name')->get();
        return view('admin.user.index', compact('users', 'roles'));
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
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => ['required'],
                'role' => 'required|exists:roles,name',
            ]);

            $user =   User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($validated['role']);
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validated =   $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class . ',email,' . $user->id,
                'role' => 'required|exists:roles,name',
            ]);

            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }


            $user->update($data);

            $user->syncRoles($validated['role']);
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
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil dihapus',
            ]);
    }
}
