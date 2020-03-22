<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Users;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $link = new Users();
        $attributes = $link->attributeNames;

        return $attributes;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if (Request::isMethod('post'))
        {
            $rules['username'] = 'required|max:20|min:2|unique:users,user_name';
            $rules['pwd'] = 'required|max:20|min:6';
            $rules['confirmpwd'] = 'required|max:20|min:6|same:pwd';
            $rules['nickname'] = 'required';
            $rules['role_id'] = 'required|integer';
            $rules['phone'] = ['required', 'regex:/^1[345789][0-9]{9}$/'];
            $rules['email'] = 'required|email';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|max:20|unique:menu,id';
        } elseif (Request::isMethod('put')) {
            $rules['username'] = 'required|max:20|min:2';
            $rules['nickname'] = 'required';
            $rules['role_id'] = 'required|integer';
            $rules['phone'] = ['required', 'regex:/^1[345789][0-9]{9}$/'];
            $rules['email'] = 'required|email';
        } else {
            $rules['username'] = 'required|max:20|unique:users';
            $rules['nickname'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            "username.required"=>':attribute 不能是空',
            "username.unique"=>':attribute 已经存在',
            'username.max'=>':attribute 长度不能大于20个字',
            'username.min'=>':attribute 长度不能小于10个字',
            "nickname.required"=>':attribute 不能是空',
            "pwd.required"=>':attribute 不能是空',
            "pwd.min"=>":attribute 不能小于6位",
            "pwd.max"=>":attribute 不能大于20位",
            "confirmpwd.required"=>':attribute 不能是空',
            "confirmpwd.min"=>":attribute 不能小于6位",
            "confirmpwd.max"=>":attribute 不能大于20位",
            "confirmpwd.same"=>":attribute 与密码不匹配",
            "role_id.required"=>":attribute 必须选择",
            "role_id.integer"=>":attribute 选择错误",
            "phone.required"=>":attribute 必须填写",
            "phone.regex"=>":attribute 格式错误",
            "email.required"=>":attribute 必须填写",
            "email.email"=>":attribute 格式错误",
        ];
        return $message;
    }
}
