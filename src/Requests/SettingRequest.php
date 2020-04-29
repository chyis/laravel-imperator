<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $setting = new Setting();
        $attributes = $setting->attributeNames;

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
            $rules['title'] = 'required|max:20|min:2|unique:setting,title';
            $rules['group_id'] = 'required|integer';
            $rules['type'] = 'required|alpha';
            $rules['code'] = 'required|alpha|max:20|min:2|unique:setting,code';
            $rules['default_value'] = 'required';
            $rules['order'] = 'required|integer';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|max:20';
        } elseif (Request::isMethod('put')) {
            //$rules['id'] = 'required|max:20|unique:dictionary,var_name';
            $rules['title'] = 'required|max:20|min:2';
            $rules['group_id'] = 'required|integer';
            $rules['type'] = 'required|alpha';
            $rules['code'] = 'required|alpha|max:20|min:2';
            $rules['default_value'] = 'required';
            $rules['order'] = 'required|integer';
        } else {
            $rules['attr_name'] = 'required|max:20|unique:dictionary,cate_name';
            $rules['type_id'] = 'required|integer';
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
