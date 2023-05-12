<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'logo' =>  'required_without:id|mimes:jpg,jpeg,png',
            'category_id' => 'required|exists:main_categories,id',
            'mobile' => 'required|max:100|unique:vendors,mobile,'.$this -> id,  //to ignore this id (to editable)
            'email' => 'required|nullable|email|unique:vendors,email,' .$this -> id,
            'address' => 'required|string|max:500',
            'password' => 'required_without:id',
        ];
    }

    public function messages(): array
    {
        return [

            'required' => 'هذا الحقل مطلوب',
            'max' => 'هذا الحقل طويل',
            'category_id.exists' => 'القسم غير موجود',
            'email' => 'البريد الالكتروني غير موجود',
            'password' => 'كلمه المرور مطلوبه',
            'address.string' => 'العنوان الحقل يجب ان يكون حروف',
            'name.string' => 'الاسم الحقل يجب ان يكون حروف',
            'logo.required' => 'الصوره مطلوبه',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل ' ,
            'mobile.unique' => 'هذا الرقم مستخدم من قبل' ,
        ];
    }
}
