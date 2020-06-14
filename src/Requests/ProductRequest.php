<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $article = new Product();
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
            'title' => 'required|min:10|max:100',
            'cate_id' => 'required|integer',
            'description' => 'required',
            'content' => 'required',
            'price' => 'required',
            'org_price' => 'required',
            'on_sale' => 'required'
        ];
    }

    public function messages()
    {
        $message = [
            'title.required'=>':attribute 不能为空',
            'title.max'=>':attribute 长度不能大于100个字',
            'title.min'=>':attribute 长度不能小于10个字',
            'cate_id.required'=>':attribute 必须有',
            'cate_id.integer'=>':attribute 选择错误',
            'content.required'=>':attribute 必须有',
            'price.required' => '价格必须填写',
            'org_price.required' => '市场价格必须填写',
            'on_sale.required' => '商品状态错误'
        ];
        return $message;
    }

}
