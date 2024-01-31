<?php

namespace App\Http\Controllers;

use App\Enum\Active;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'roleNameKh' => 'bail|required|max:100',
            'description' => 'max:255'
        ], [
            'roleNameKh.required' => 'សូមបញ្ចូលនូវឈ្មោះតួរនាទី',
            'roleNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'description.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ'
        ]);
        $role = new Role();
        $role->roleNameKh = $request->input('roleNameKh');
        $role->description = $request->input('description');
        $role->active = Active::ACTIVE;
        $role->save();

        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $roleId)
    {
        $role = Role::find($roleId);
        return view('admin.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $roleId)
    {
        // return 'hello';
        $role = Role::find($roleId);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string  $roleId)
    {
        $request->validate([
            'roleNameKh' => 'bail|required|max:100',
            'description' => 'max:255'
        ], [
            'roleNameKh.required' => 'សូមបញ្ចូលនូវឈ្មោះតួរនាទី',
            'roleNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'description.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ'
        ]);

        $role = Role::find($roleId);
        $role->roleNameKh = $request->input('roleNameKh');
        $role->description = $request->input('description');
        $role->active = $request->input('active');
        $role->save();

        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $roleId)
    {
        Role::find($roleId)->delete();
        return redirect('/roles');
    }
}
