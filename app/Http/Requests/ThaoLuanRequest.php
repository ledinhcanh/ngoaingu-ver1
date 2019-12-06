<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThaoLuanRequest extends FormRequest
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
            
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3',
            // 'image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 255 kí tự',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
        ];
    }
}
