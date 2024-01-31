<?php

namespace App\Http\Controllers;

use App\Enum\Active;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'departmentNameKh' => 'bail|required|max:100',
            'description' => 'max:255'
        ], [
            'departmentNameKh.required' => 'សូមបញ្ចូលនូវឈ្មោះនាយកដ្ឋាន',
            'departmentNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'description.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ'
        ]);
        $department = new Department();
        $department->departmentNameKh = $request->input('departmentNameKh');
        $department->description = $request->input('description');
        $department->active = Active::ACTIVE;
        $department->save();

        return redirect('/departments');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $departmentId)
    {
        $department = Department::findOrFail($departmentId);
        return view('admin.department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $departmentId)
    {
        $department = Department::findOrFail($departmentId);
        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $departmentId)
    {
        $request->validate([
            'departmentNameKh' => 'bail|required|max:100',
            'description' => 'max:255'
        ], [
            'departmentNameKh.required' => 'សូមបញ្ចូលនូវឈ្មោះនាយកដ្ឋាន',
            'departmentNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
            'description.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ'
        ]);
        $department = Department::find($departmentId);
        $department->departmentNameKh = $request->input('departmentNameKh');
        $department->description = $request->input('description');
        $department->active = $request->input('active');
        $department->save();

        return redirect('/departments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $departmentId)
    {
        // $department = Department::findOrFail($departmentId);
        // $department->delete();
        return redirect('/departments');
    }
}
