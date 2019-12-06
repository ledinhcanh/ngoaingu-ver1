<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LichTuanRequest extends FormRequest
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
            'title' => 'required|min:2|max:255|unique:lichtuan,title,'.$this->id,
            'tuan' => 'required',
            'tungay' => 'required',
            'denngay' => 'required',
            // 'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute tối thiểu 2 kí tự',
            'max' => ':attribute tối đa 255 kí tự',
            'unique' => ':attribute đã tồn tại',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'tuan' => 'Tuần',
            'tungay' => 'Từ ngày',
            'denngay' => 'Đến ngày',
            // 'file' => 'File',
        ];
    }
}
