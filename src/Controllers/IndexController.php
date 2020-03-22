<?php

namespace Chyis\Imperator\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController
{
    //
    public function index(Request $request)
    {
//        print_r( $request->user('admin'));
//        if (Auth::guard('admin')->check())
//        {
//            print_r( Auth::guard('admin')->user());
//            return 'checked';
//        }
//        return array(Request()->session());
        return view('Imperator::index');
    }
}
