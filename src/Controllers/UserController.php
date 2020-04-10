<?php

namespace Chyis\Imperator\Controllers;


use Chyis\Imperator\Models\Users;
use Illuminate\Http\Request;

class UserController extends AdminController
{

    public function password()
    {
        return view('Imperator::profile.pwd');
    }

    public function setPass(Request $request)
    {
        $rules = [
            'password' => 'required|min:6',
            'new_pwd' => 'required|max:20|min:6',
            'confirmpwd' => 'required|max:20|min:6|same:new_pwd',
        ];
        $validationErrorMessages = [
            "password.required"=>':attribute 不能是空',
            "password.min"=>":attribute 不能小于6位",
            "new_pwd.required"=>':attribute 不能是空',
            "new_pwd.min"=>":attribute 不能小于6位",
            "new_pwd.max"=>":attribute 不能大于20位",
            "confirmpwd.required"=>':attribute 不能是空',
            "confirmpwd.min"=>":attribute 不能小于6位",
            "confirmpwd.max"=>":attribute 不能大于20位",
            "confirmpwd.same"=>":attribute 与密码不匹配",
        ];
        $request->validate($rules, $validationErrorMessages);

        $userData = auth()->guard('admin')->user();
        $userID = $userData->id;
        if ($userData['password'] != bcrypt($request->input('pwd')))
        {
            $this->error('原密码不正确，修改失败');
        }
        $data = [];
        $user = Users::find($userID);
        $data['password'] = bcrypt($request->input('new_pwd'));
        $user->update($data);

        return $this->success('修改成功');
    }

    public function edit()
    {
        return view('Imperator::profile.infor');
    }

    public function update(Request $request)
    {
        $rules = [];
        $rules['nickname'] = 'required';
        $rules['phone'] = ['required', 'regex:/^1[345789][0-9]{9}$/'];
        $rules['email'] = 'required|email';

        $validationErrorMessages = [
            "nickname.required"=>':attribute 不能是空',
            "phone.required"=>":attribute 必须填写",
            "phone.regex"=>":attribute 格式错误",
            "email.required"=>":attribute 必须填写",
            "email.email"=>":attribute 格式错误",
        ];
        $request->validate($rules, $validationErrorMessages);
        $userData = auth()->guard('admin')->user();
        $userID = $userData->id;
        $user = Users::find($userID);

        $data['nick_name'] = $request->input('nickname');
        $data['phone'] = $request->input('phone');
        $data['email'] = $request->input('email');
        $data['description'] = $request->input('description') ?? '';

        $user->update($data);

        return $this->success('修改成功');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect(route('admin.login'));
    }
}
