<?php

namespace App\Repository;

use App\Http\Requests\StoreDepartmentRequest;
use App\Department;
use Illuminate\Http\Request;

class DepartmentRepository
{

    public function all()
    {
        return Department::query();
    }

    public function show(Department $department)
    {
        return $department;
    }

    public function store(StoreDepartmentRequest $request)
    {
        $auth_id=auth()->user()->id;
         $department=new Department;
         $department->name=$request->name;
         $department->slogen=$request->slogen;
         $department->user_id=$auth_id;
        
         $department->save();
         return $department;
    }

    public function update(Request $request, Department $department)
    {
        $department->name = $request->name;
        $department->save();
    }

    public function delete(Department $department)
    {
        $department->delete();
        return true;
    }
}

?>