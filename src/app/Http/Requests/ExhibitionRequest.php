<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['integer', 'exists:categories,id'],
            'condition' => ['required', 'string'],
            'name' => ['required', 'string'],
            'brand_name' => ['nullable', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像を選択してください',
            'image.image' => '商品画像は画像ファイルを選択してください',
            'image.mimes' => '商品画像はjpegもしくはpng形式でアップロードしてください',

            'category_ids.required' => '商品のカテゴリーを選択してください',
            'condition.required' => '商品の状態を選択してください',

            'name.required' => '商品名を入力してください',

            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',

            'price.required' => '商品価格を入力してください',
            'price.integer' => '商品価格は数値で入力してください',
            'price.min' => '商品価格は0円以上で入力してください',
        ];
    }
}