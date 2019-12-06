<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaiKhoanRequest extends FormRequest
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
            'name' => 'required|min:3',
            'display_name' => 'required|min:3',
            'email' => 'required|email|unique:taikhoan,email,'.$this->id,
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được dưới 3 kí tự',
            'max' => ':attribute không được trên 32 kí tự',
            'unique' => ':attribute đã tồn tại',
            'same' => ':attribute chưa khớp',
            'email' => ':attribute không đúng định dạng',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên tài khoản',
            'display_name' => 'Tên hiển thị',
            'email' => 'Email',
            'password' => 'Password',
            'passwordAgain' => 'Nhập lại Password',
        ];
    }
}
