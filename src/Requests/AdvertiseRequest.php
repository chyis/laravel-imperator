<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Advertise;
use Illuminate\Foundation\Http\FormRequest;

class AdvertiseRequest extends FormRequest
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
        $article = new Advertise();
        $attributes = $article->attributeNames;

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
            'type' => 'required',
            'text' => 'required',
            'url' => 'required',
//            'file' => 'required'
        ];
    }

    public function messages()
    {
        $message = [
            'title.required'=>':attribute 不能为空',
            'title.max'=>':attribute 长度不能大于100个字',
            'title.min'=>':attribute 长度不能小于10个字',
            'type.required'=>':attribute 必须有',
            'text.required'=>':attribute 必须有',
            'url.required'=>':attribute 必须有',
//            'file.required'=>':attribute 必须有'
        ];
        return $message;
    }

}
