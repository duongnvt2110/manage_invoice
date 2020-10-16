<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.guard')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$this->authorize('create',user::class);
        $roles = Role::get();
        $permissions = Permission::get();
        return view('user.create',compact('roles','permissions'));
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
        //$this->authorize('create',user::class);
        $userForm = $request->only('name','email','password','roles','permissions');
        $user = User::create([
            'name'=>$userForm['name'],
            'email'=> $userForm['email'],
            'password'=>bcrypt($userForm['password'])
        ]);
        if($user){
            $user->syncRoles($userForm['roles']);
            $user->givePermissionTo($userForm['permissions']);
        }
        return redirect()->route('user.index')->with('success','Create is success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user,$id)
    {
        //
        //$this->authorize('update',$user);
        $user = User::where('id',$id)->first();
        $roles = Role::get();
        $permissions = Permission::get();
        return view('user.edit',compact('user','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user,$id)
    {
        //
        //$this->authorize('update',$user);

        $userForm = $request->only('roles','permissions');
        $user = User::where('id',$id)->first();
        if($user){
            $user->syncRoles($userForm['roles']);
            if(!empty($userForm['permissions'])){
                $user->syncPermissions($userForm['permissions']);
            }else{
                $user->revokePermissionTo(Permission::get());
            }
        }
        return redirect()->route('user.index')->with('success','Update is success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user,$id)
    {
        //
        //$this->authorize('update',$user);
        User::destroy($id);
        return redirect()->route('user.index')->with('success','Delete is success');
    }
}
