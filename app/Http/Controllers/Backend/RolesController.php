<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with(['permissions'])->get();
        return view('backend.pages.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();
        // return $permission_groups;
        return view("backend.pages.role.create",compact('permissions','permission_groups'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validaton create
        $request->validate([
            'name' => 'required|unique:roles'
        ]);

        //role permission process start
        $permissions = $request->input('permissions');

        $roleCreate = Role::create(['name'=>$request->name,'guard_name'=>'admin']);

        if($roleCreate){
            if(isset($permissions)){
                $roleCreate->syncPermissions($permissions);
            }
            return redirect()->back()->with(['success' => 'Role Created Successfully']);
            // return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = static::findByIdRole($id,'admin') ;
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroups();
        // return $permission_groups;
        return view("backend.pages.role.edit",compact('permissions','permission_groups','role'));
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
        // dd($request->all() , $id);
          //validaton create
        $request->validate([
            'name' => 'required|unique:roles,name,'.$request->id
        ]);

       //role permission process start
       $permissions = $request->input('permissions');
        // find

        $role = static::findByIdRole($request->id,'admin');

        // role wise multiple parmission update
       if($role &&  $role->update(['name' => $request->name])){
           if(isset($permissions)){
               $role->syncPermissions($permissions);
           }
           return redirect()->route('roles.index');
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
        $role = static::findByIdRole($id,'admin');
        if($role->delete()){
           return redirect()->back()->with(['success' => 'Deleted Successfully']);
        }
        // return $id;
    }


    protected static function findByIdRole($id,$guard = null){
        if(is_null($guard)){
            return Role::findById($id,'admin');
        }
        return Role::findById($id,$guard);
    }
}
