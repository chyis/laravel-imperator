<?php

namespace Chyis\Imperator\Requests;

use Chyis\Imperator\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $article = new Article();
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
            'summary' => 'required',
            'content' => 'required',
            'status' => 'required',
            'sort' => 'required|integer',
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
            'summary.required'=>':attribute 必须有',
            'content.required'=>':attribute 必须有',
            'sort.required'=>':attribute 权重必须有',
            'sort.integer'=>':attribute 权重必须是整数',
        ];
        return $message;
    }

}
