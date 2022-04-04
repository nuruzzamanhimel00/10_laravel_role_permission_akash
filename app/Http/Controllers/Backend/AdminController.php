<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:admins|string',
            'password' => 'required|min:6',
            'roles' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:admins,email,'.$id,
            // 'password' => 'required|min:4',
        ]);
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if(isset($request->password)){
            $admin->password  = Hash::make($request->password);
        }
        if($admin->save()){
            if(isset($request->roles)){
                //remove admin roles
                foreach(Role::all() as $role){
                     $admin->removeRole($role->name);
                }
                // $admin->removeRole(Role::all());
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
        $admin = Admin::find($id);
         //remove admin roles
        foreach($admin->getRoleNames()as $role_name){
            $admin->removeRole($role_name);
        }
        if($admin->delete()){
            return redirect()->back()->with(['success' => 'Admin Deleted Successfully']);
        }

    }
}
