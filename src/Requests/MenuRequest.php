<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenuRequest extends FormRequest
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
        $menu = new Menu();
        $attributes = $menu->attributeNames;

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
            $rules['title'] = 'required|max:20|min:2';
            $rules['parent_id'] = 'required|integer';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|max:20|unique:menu,id';
        } elseif (Request::isMethod('put')) {
            //$rules['id'] = 'required|max:20|unique:dictionary,var_name';
            $rules['title'] = 'required|max:20|min:2';
            $rules['parent_id'] = 'required|integer';
        } else {
            $rules['title'] = 'required|max:20';
            $rules['parent_id'] = 'required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'title.required'=>':attribute 不能为空',
            'var_name.max'=>':attribute 长度不能大于20个字',
            'var_name.min'=>':attribute 长度不能小于10个字',
            'var_name.unique'=>':attribute 已经存在请勿重复添加',
            'parent_id.required'=>':attribute 选项必须有',
            'parent_id.integer'=>':attribute 选择错误',
        ];
        return $message;
    }
}
