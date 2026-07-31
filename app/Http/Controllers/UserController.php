<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Farm;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        $reassign_from = $request->query('reassign_from');
        return view('users/create', compact('roles', 'reassign_from'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['nullable', 'exists:roles,id'],
        ]);

        $user = new User;

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->role_id = $validated['role_id'] ?? 1;
        $user->save();

        // Si viene de reasignación
        if($request->reassign_from) {
            $oldUser = User::withTrashed()->find($request->reassign_from);
            if($oldUser && $oldUser->farms->count() > 0) {
                Farm::where('user_id', $oldUser->id)->update(['user_id' => $user->id]);
                $oldUser->delete(); // soft delete
                return redirect()->route('users.index')->with('success', 'Usuario creado. Fincas reasignadas correctamente.');
            }
        }

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('users/edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Si viene de reasignación (select de usuario existente)
        if($request->reassign_from) {
            $oldUser = User::withTrashed()->find($request->reassign_from);
            if($oldUser && $oldUser->farms->count() > 0) {
                Farm::where('user_id', $oldUser->id)->update(['user_id' => $id]);
                $oldUser->delete(); // soft delete
                return redirect()->route('users.index')->with('success', 'Fincas reasignadas correctamente. Usuario eliminado.');
            }
        }

        // Actualización normal de usuario
        $user = User::find($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role_id' => ['nullable', 'exists:roles,id'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role_id'] ?? 1;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Si tiene farms, mostrar vista de reasignación
        if($user->farms->count() > 0) {
            $farms = $user->farms;
            $existingUsers = User::where('id', '!=', $id)->get();
            return view('users/reassign', compact('user', 'farms', 'existingUsers'));
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
