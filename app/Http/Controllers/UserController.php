<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Services\Utils;
use App\Events\SendMail;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{
    protected $utils;

    public function __construct()
    {
        $this->middleware('jwt.guard')->except('index');
        $this->utils = new Utils();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny',User::class);
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
        $this->authorize('create',User::class);
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
        $this->authorize('create',User::class);
        $userForm = $request->only('user_name','user_email','user_password');
        $roleForm = $request->only('roles','permissions');
        DB::transaction(function () use ($userForm,$roleForm) {
            $user = User::create(array_merge($userForm,$this->utils->getDefaultUserForm($userForm)));
            event(new SendMail($user,$userForm));
            if($user){
                if(empty($roleForm['roles'])){
                    $user->syncRoles([]);
                }else{
                    $user->syncRoles($roleForm['roles']);
                }
            }
        });
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
    public function edit($id)
    {
        //
        $this->authorize('update',User::class);
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
    public function update(Request $request,$id)
    {
        $this->authorize('update',User::class);
        $userForm = $request->only('user_name','user_email','user_password');
        $roleForm = $request->only('roles');
        if(empty($userForm['user_password'])){
            unset($userForm['user_password']);
        }else{
            $userForm = array_merge($userForm,$this->utils->getDefaultUserForm($userForm));
        }
        DB::transaction(function () use ($id,$userForm,$roleForm) {
            $user = tap(User::where('id',$id)->first())->update($userForm);
            if($user){
                if($user->wasChanged('user_password')){
                    event(new SendMail($user,$userForm));
                }
                if(empty($roleForm['roles'])){
                    $user->syncRoles([]);
                }else{
                    $user->syncRoles($roleForm['roles']);
                }
            }
        });
        return redirect()->route('user.index')->with('success','Update is success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('delete',User::class);
        User::destroy($id);
        return redirect()->route('user.index')->with('success','Delete is success');
    }
}
