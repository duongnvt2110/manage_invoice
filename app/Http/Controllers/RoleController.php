<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny',User::class);
        $roles = Role::with('permissions')->get();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create',Role::class);
        $permissions = Permission::get();
        return view('role.create',compact('permissions'));
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
        $this->authorize('create',Role::class);
        $roleForm = $request->only('name','guard_name','permissions');
        DB::transaction(function () use ($roleForm) {
            $role = Role::create([
                'name' => $roleForm['name'],
                'guard_name' => $roleForm['guard_name']
            ]);
            if(!empty($roleForm['permissions'])){
                $role->syncPermissions($roleForm['permissions']);
            }else{
                $role->syncPermissions([]);
            }
        });
        return redirect()->route('role.index')->with('success','Create is success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role,$id)
    {
        //
        $this->authorize('update',Role::class);
        $role = Role::where('id',$id)->first();
        $permissions = Permission::get();
        return view('role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role,$id)
    {
        //
        $this->authorize('update',Role::class);
        $roleForm = $request->only('name','guard_name','permissions');
        DB::transaction(function () use ($id,$roleForm) {
            $role = tap(Role::where('id',$id)->first())->update([
                'name'=>$roleForm['name'],
                'guard_name'=>$roleForm['guard_name']
            ]);
            if(!empty($roleForm['permissions'])){
                $role->syncPermissions($roleForm['permissions']);
            }else{
                $role->syncPermissions([]);
            }
        });
        return redirect()->route('role.index')->with('success','Update is success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role,$id)
    {
        //
        $this->authorize('delete',$role);
        Role::destroy($id);
        return redirect()->route('role.index')->with('success','Delete is success');
    }
}
