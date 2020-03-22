<?php

namespace Chyis\Imperator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Chyis\Imperator\Models\Link;

class LinkRequest extends FormRequest
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
        $link = new Link();
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
            $rules['title'] = 'required|max:20|min:2|unique:menu';
            $rules['cate_id'] = 'required|integer';
            $rules['uri'] = 'required|url';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|max:20|unique:menu,id';
        } elseif (Request::isMethod('put')) {
            //$rules['id'] = 'required|max:20|unique:dictionary,var_name';
            $rules['title'] = 'required|max:20|min:2';
            $rules['cate_id'] = 'required|integer';
            $rules['uri'] = 'required|url';
        } else {
            $rules['title'] = 'required|max:20|unique:dictionary,var_name';
            $rules['cate_id'] = 'required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'title.required'=>':attribute 不能为空',
            'title.max'=>':attribute 长度不能大于20个字',
            'title.min'=>':attribute 长度不能小于10个字',
            'title.unique'=>':attribute 已经存在请勿重复添加',
            'cate_id.required'=>':attribute 选项必须有',
            'cate_id.integer'=>':attribute 选择错误',
            'uri.required'=>':attribute 必须有',
        ];
        return $message;
    }
}
