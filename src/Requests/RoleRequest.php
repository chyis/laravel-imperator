<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleRequest extends FormRequest
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
        $cate = new Role();
        $attributes = $cate->attributeNames;

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
            $rules['role_name'] = 'required|max:20|min:2|unique:roles,name';
            $rules['role_code'] = 'required|alpha_num|unique:roles,code';
        } elseif (Request::isMethod('get')) {

        } elseif (Request::isMethod('put')) {
            $rules['role_name'] = 'required|max:20|min:2';
            $rules['role_code'] = 'required|alpha_num';
        } else {
            $rules['role_name'] = 'required|max:20|unique:roles,name';
            $rules['role_code'] = 'required|alpha_num';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'role_name.required'=>':attribute 不能为空',
            'role_name.max'=>':attribute 长度不能大于20个字',
            'role_name.min'=>':attribute 长度不能小于10个字',
            'role_name.unique'=>':attribute 已经存在请勿重复添加',
            'role_code.required'=>':attribute 选项必须填写',
            'role_code.alpha_num'=>':attribute 只能是字符和数字',
            'role_code.unique'=>':attribute 已经存在请勿重复添加',
        ];
        return $message;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw (new HttpResponseException(response()->json([
            'code'=>422,
            'msg'=>$errors->first(),
            'data'=>null
        ],422)));
    }
}
