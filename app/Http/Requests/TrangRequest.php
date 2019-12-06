<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrangRequest extends FormRequest
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
              'title' => 'required|min:2|max:255|unique:trang,title,'.$this->id,
              'content' => 'required',
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
              'title' => 'Tiêu đề',
              'content' => 'Nội dung',
              // 'image' => 'Hình ảnh',
          ];
      }
}