<?php

namespace Chyis\Imperator\Controllers;

use App\Http\Controllers\Controller;
use Chyis\Imperator\Imperator;
use Chyis\Imperator\Requests\LoginRequest;
use Illuminate\Http\Request;
use Chyis\Imperator\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('Imperator::login')
            ->with('pageName', '管理登录');
    }

    public function signin (LoginRequest $request)
    {
        $credentials = $request->only('user_name', 'password');

        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')->attempt($credentials)){


            return redirect('/admin/index');
            return response()->json(['code' => 200, 'msg' => '登录成功']);
        }else{

            $validator->errors()->add('username', '用户不存在');

            return redirect('/admin/login')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function setLogin($user)
    {
        Request()->session()->put("user",$user);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Imperator::guard();
    }

    public function username()
    {
        return Imperator::username();
    }
}
