<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'max:20',
            'contents' => 'required | max:20',
            'tag_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            "contents.required" => "テキストは必須項目です。",
            "contents.max" => "20文字以内で入力してください",
        ];
    }
}