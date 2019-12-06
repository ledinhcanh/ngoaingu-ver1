<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SinhVienRequest extends FormRequest
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
             'masv' => 'required|min:2|max:255|unique:sinhvien,masv,'.$this->id,
             'fullname' => 'required|min:3|max:255',
             'birthday' => 'required',
             'idlop' => 'required',
             // 'image' => 'required|image',
         ];
     }
 
     public function messages()
     {
         return [
             'required' => ':attribute không được bỏ trống',
             'min' => ':attribute tối thiểu 2 kí tự',
             'max' => ':attribute tối đa 255 kí tự',
             // 'image' => ':attribute không phải là hình ảnh',
             'unique' => ':attribute đã tồn tại',
         ];
     }
 
     public function attributes()
     {
         return [
             'masv' => 'Mã sinh viên',
             'fullname' => 'Họ tên',
             'birthday' => 'Ngày sinh',
             'idlop' => 'Lớp',
             // 'image' => 'Hình ảnh',
         ];
     }
}
