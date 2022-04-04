<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionGroups(){
        $getpermission_group = DB::table('permissions')
        ->select(DB::raw('group_name as name'))
        ->groupBy('group_name')->get();
        return $getpermission_group;
    }

    public static function roleWiseSelectPermSrc($role_id,$permissions){
        $roleWisePermison =  DB::table('role_has_permissions')
                        ->where('role_id',$role_id)
                        ->whereIn('permission_id',$permissions)
                        ->pluck('permission_id')->toArray();
        return $roleWisePermison;
    }

    public static function roleWiseAllParm($role_id){
        $roleWiseAllParm =  DB::table('role_has_permissions')
                        ->where('role_id',$role_id)
                        ->get();
        return $roleWiseAllParm;
    }

    public static function adminGuard(){
        return Auth::guard('admin');
    }

}
