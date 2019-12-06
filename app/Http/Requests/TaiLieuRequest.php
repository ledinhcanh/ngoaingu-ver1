<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaiLieuRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:tailieu,name,'.$this->id,
            'description' => 'required|min:3',
            'attached'      => 'mimes:pdf,docx,doc,xlsx,xls,zip,rar',
            // 'iddinhdang' => 'required',
            // 'file' => 'required|file',
            // 'file' => 'mimes:pdf,docx,doc,xlsx,xls',
            'idloaitailieu' => 'required',
            'idnhaxuatban' => 'required',
            'idngonngu' => 'required',
            // 'image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 255 kí tự',
            // 'image' => ':attribute không phải là hình ảnh',
            'unique' => ':attribute đã tồn tại',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên tài liệu',
            'description' => 'Mô tả',
            // 'iddinhdang' => 'Định dạng file',
            'idloaitailieu' => 'Chuyên mục',
            'idnhaxuatban' => 'Nhà xuất bản',
            'idngonngu' => 'Ngôn ngữ',
            // 'image' => 'Hình ảnh',
        ];
    }
}
