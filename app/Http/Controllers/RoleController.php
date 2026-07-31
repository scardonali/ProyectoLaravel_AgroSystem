<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $role = new Role;

        $role->name = $validated['name'];
        $role->description = $validated['description'];

        $role->save();
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
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
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if ($role->name != $validated['name']){
            $role->name = $validated['name'];
        }
        
        if ($role->description != $validated['description']){
            $role->description = $validated['description'];
        }
        
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if ($role->id == 1){
            return redirect()->route('roles.index')->with('error', 'El rol basico NO se puede eliminar');
        }
        else{
            User::where('role_id', $role->id)->update(['role_id' => 1]);

            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
        }
    }
}
