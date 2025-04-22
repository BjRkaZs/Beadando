<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    public function getDepartments()
    {
        $department = Department::all();
        return response()->json($department);
    }

    public function getDepartmentId($DepartmentId)
    {
        $department = Department::where("department", $DepartmentId)->first();
    
        if (!$department) {
            return response()->json([
                'error' => 'Department not found'
            ], 404);
        }
    
        return $department->id;
    }
}