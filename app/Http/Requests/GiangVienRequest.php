<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiangVienRequest extends FormRequest
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
             'magv' => 'required|min:2|max:255|unique:giangvien,magv,'.$this->id,
             'fullname' => 'required|min:3|max:255',
             'birthday' => 'required',
             'address' => 'required',
             'idbomon' => 'required',
             'idtthn' => 'required',
             'ngaycongtac' => 'required',
             'tdchuyenmon' => 'required',
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
             'idbomon' => 'Bộ môn',
             'address' => 'Địa chỉ',
             'idtthn' => 'Tình trạng hôn nhân',
             'ngaycongtac' => 'Ngày công tác',
             'tdchuyenmon' => 'Trình độ chuyên môn',
             // 'image' => 'Hình ảnh',
         ];
     }
}
