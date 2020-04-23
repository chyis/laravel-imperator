<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Attributes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AttributesRequest extends FormRequest
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
        $attribute = new Attributes();
        $attributes = $attribute->attributeNames;

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
            $rules['attr_name'] = 'required|max:20|min:2|unique:attributes,attr_name';
            $rules['attr_code'] = 'required|max:20|min:2|unique:attributes,attr_code';
            $rules['type_id'] = 'required|integer';
        } elseif (Request::isMethod('get')) {
            $rules['id'] = 'required|max:20';
        } elseif (Request::isMethod('put')) {
            //$rules['id'] = 'required|max:20|unique:dictionary,var_name';
            $rules['attr_name'] = 'required|max:20|min:2';
            $rules['attr_code'] = 'required|max:20|min:2';
            $rules['type_id'] = 'required|integer';
        } else {
            $rules['attr_name'] = 'required|max:20|unique:dictionary,cate_name';
            $rules['type_id'] = 'required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        $message = [
            'attr_name.required'=>':attribute 不能为空',
            'attr_name.max'=>':attribute 长度不能大于20个字',
            'attr_name.min'=>':attribute 长度不能小于10个字',
            'attr_name.unique'=>':attribute 已经存在请勿重复添加',
            'attr_code.required'=>':attribute 不能为空',
            'attr_code.max'=>':attribute 长度不能大于20个字',
            'attr_code.min'=>':attribute 长度不能小于10个字',
            'attr_code.unique'=>':attribute 已经存在请勿重复添加',
            'type_id.required'=>':attribute 选项必须有',
            'type_id.integer'=>':attribute 选择错误',
        ];
        return $message;
    }
}
