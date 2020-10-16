<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::get();
        return view('permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$this->authorize('create',permission::class);
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$this->authorize('create',permission::class);
        $permissionForm = $request->only('name','guard_name');
        Permission::create($permissionForm);
        return redirect()->route('permission.index')->with('success','Create is success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission,$id)
    {
        //
        //$this->authorize('update',$permission);
        $permission = Permission::where('id',$id)->first();
        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission,$id)
    {
        //
        //$this->authorize('update',$permission);
        $permissionForm = $request->only('name','guard_name');
        Permission::where('id',$id)->update($permissionForm);
        return redirect()->route('permission.index')->with('success','Update is success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission,$id)
    {
        //
        //$this->authorize('update',$permission);
        Permission::destroy($id);
        return redirect()->route('permission.index')->with('success','Delete is success');
    }
}
