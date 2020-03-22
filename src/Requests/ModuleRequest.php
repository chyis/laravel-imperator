<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Module;
use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
        $module = new Module();
        $attributes = $module->attributeNames;

        return $attributes;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:20',
            'page_id' => 'required|integer',
            'type' => 'required',
            'content' => 'required',
            'length' => 'required|integer'
        ];
    }

    public function messages()
    {
        $messages = [
            'title.required'=>':attribute 不能为空',
            'title.max'=>':attribute 长度不能大于100个字',
            'title.min'=>':attribute 长度不能小于10个字',
            'type.required'=>':attribute 必须有',
            'page_id.required'=>':attribute 必须有',
            'page_id.digit'=>':attribute 必须是个数字',
            'length.required'=>':attribute 必须有',
            'length.digit'=>':attribute 必须是个数字'
        ];

        return $messages;
    }

}
