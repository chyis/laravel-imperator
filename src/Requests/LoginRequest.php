<?php

namespace App\Http\Requests;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $user = new Users();
        $attributes = $user->attributeNames;

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
            $rules['user_name'] = 'required|alpha_dash|exists:users,user_name,deleted_at,NULL';
            $rules['password'] = 'required|max:20|min:6';
            $rules['captcha'] = 'required|captcha';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'user_name.required'=>':attribute 不能为空',
            'user_name.alpha_num'=>':attribute 只能包含字母和数字以及破折号和下划线',
            'password.required'=>':attribute 不能为空',
            'password.max'=>':attribute 长度不能大于20个字',
            'password.min'=>':attribute 长度不能小于6个字',
            'captcha.required'=>':attribute 选项必须有',
            'captcha.captcha'=>':attribute 只能是数字字母组合'
        ];
        return $message;
    }
}
