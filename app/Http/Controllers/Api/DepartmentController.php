<?php

namespace App\Http\Controllers\Api;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\DepartmentRepository;
use App\Http\Resources\DepartmentResource;
use App\Http\Requests\StoreDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

      protected $repodepart;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repodepart=$repository;
    }

    public function index()
    {
         return DepartmentResource::collection($this->repodepart->all()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
       $department= $this->repodepart->store($request);
         //return new UserResource($topic);
         return response($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
     public function update(StoreDepartmentRequest $request, Department $department)
    {
        if ($department->user_id !== auth()->user()->id) return response()->json([
            'message'=>'no'
        ],401);

        if(!is_null($request->name) && $request->name != $department->name){
           $this->repodepart->update($request,$department);
        }

        return response()->json([
            'data'=>$department
        ],200);
       
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->repodepart->delete($department);
        return  response()->json(['success'=>"delete successfully"]);
    }
}
