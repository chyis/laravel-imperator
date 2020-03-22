<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
        $cate = new Category();
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
            $rules['cate_name'] = 'required|max:20|min:2|unique:cate_name';
            $rules['parent_id'] = 'required|integer';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|max:20|unique:dictionary,var_name';
        } elseif (Request::isMethod('put')) {
            //$rules['id'] = 'required|max:20|unique:dictionary,var_name';
            $rules['cate_name'] = 'required|max:20|min:2';
            $rules['parent_id'] = 'required|integer';
        } else {
            $rules['cate_name'] = 'required|max:20|unique:dictionary,cate_name';
            $rules['parent_id'] = 'required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'cate_name.required'=>':attribute 不能为空',
            'cate_name.max'=>':attribute 长度不能大于20个字',
            'cate_name.min'=>':attribute 长度不能小于10个字',
            'cate_name.unique'=>':attribute 已经存在请勿重复添加',
            'parent_id.required'=>':attribute 选项必须有',
            'parent_id.integer'=>':attribute 选择错误',
        ];
        return $message;
    }
}
