<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = $this->guard()->user();
            return $next($request);
        });
    }
    public function index(){
        if( is_null($this->user) || !$this->user->can('dashboard.view') ){
            abort(403, 'Unauthonticated Access');
        }
        return view("backend.pages.dashboard.index");
        // return view('backend.layouts.master');
    }
}
