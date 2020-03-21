<?php

namespace App\Http\Requests;

use App\Models\Privilege;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PrivilegeRequest extends FormRequest
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
        $priv = new Privilege();
        $attributes = $priv->attributeNames;

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
            $rules['name'] = 'required|max:20|min:2|unique:privilege';
            $rules['code'] = 'required|max:20|min:2|unique:privilege,code';
            $rules['group_id'] = 'required|integer';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|integer';
        } elseif (Request::isMethod('put')) {
            //$rules['id'] = 'required|max:20|unique:dictionary,var_name';
            $rules['name'] = 'required|max:20|min:2';
            $rules['code'] = 'required|max:20|min:2';
            $rules['group_id'] = 'required|integer';
        } else {
            $rules['name'] = 'required|max:20|unique:privilege';
            $rules['code'] = 'required|max:20|min:2';
            $rules['group_id'] = 'required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'name.required'=>':attribute 不能为空',
            'name.max'=>':attribute 长度不能大于20个字',
            'name.min'=>':attribute 长度不能小于10个字',
            'name.unique'=>':attribute 已经存在请勿重复添加',
            'code.required'=>':attribute 不能为空',
            'code.max'=>':attribute 长度不能大于20个字',
            'code.min'=>':attribute 长度不能小于10个字',
            'code.unique'=>':attribute 已经存在请勿重复添加',
            'group_id.required'=>':attribute 选项必须有',
            'group_id.integer'=>':attribute 选择错误',
        ];
        return $message;
    }
}
