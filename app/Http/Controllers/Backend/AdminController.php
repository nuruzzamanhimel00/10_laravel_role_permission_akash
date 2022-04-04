<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = $this->guard()->user();
            return $next($request);
        });
    }

    protected function guard(){
        return Auth::guard('admin');
    }

    public function index()
    {
        if( is_null($this->user) || !$this->user->can('admin.view') ){
            abort(403, 'Unauthonticated Access');
        }

        $admins = Admin::get();
        return view('backend.pages.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $roles = Role::all();
        return view("backend.pages.admin.create",compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( is_null($this->user) || !$this->user->can('admin.approve') ){
            abort(403, 'Unauthonticated Access');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:admins|string',
            'username' => 'required|unique:admins|string',
            'password' => 'required|min:6',
            'roles' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($admin){
            // if have assign role
            if(count($request->roles) > 0){
                $admin->assignRole($request->roles);
            }

            return redirect()->back()->with(['success' => 'Admin Created Successfully']);
        }

        // return $request->all();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( is_null($this->user) || !$this->user->can('admin.edit') ){
            abort(403, 'Unauthonticated Access');
        }
        $admin = Admin::find($id);
        $roles = Role::all();
        return view("backend.pages.admin.edit",compact('roles','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( is_null($this->user) || !$this->user->can('admin.update') ){
            abort(403, 'Unauthonticated Access');
        }
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:admins,email,'.$id,
            'username' => 'required|string|unique:admins,username,'.$id,
            // 'password' => 'required|min:4',
        ]);
        $admin = Admin::find($id);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;

        if(isset($request->password)){
            $admin->password  = Hash::make($request->password);
        }
        if($admin->save()){
            if(isset($request->roles)){
                //remove admin roles
                // foreach(Role::all() as $role){
                //      $admin->removeRole($role->name);
                // }
                    // OR
                // All current roles will be removed from the user
                $admin->roles()->detach();
                // assign admin roles
                $admin->assignRole($request->roles);
            }
            return redirect()->back()->with(['success' => 'Admin Update Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( is_null($this->user) || !$this->user->can('admin.delete') ){
            abort(403, 'Unauthonticated Access');
        }
        $admin = Admin::find($id);
         //remove admin roles
        // foreach($admin->getRoleNames()as $role_name){
        //     $admin->removeRole($role_name);
        // }
        // or
        $admin->roles()->detach();

        if($admin->delete()){
            return redirect()->back()->with(['success' => 'Admin Deleted Successfully']);
        }

    }
}
