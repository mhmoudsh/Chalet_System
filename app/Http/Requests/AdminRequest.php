<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required',
//            'status'=>'required',
            'password'=>'nullable|confirmed',
            'roles_name'=>'required',
        ];
    }
    public function messages()
    {
        return [

            'name.required'=>'الاسم  مطلوب',
            'email.required'=>' الإيميل مطلوب',
            'phone.required'=>'رقم الجوال مطلوب',
            'status.required'=>' حالة التفعيل مطلوبة',
            'password.required'=>'كلمة السر مطلوبة',
            'password.confirmed'=>'تأكيد كلمة السر مطلوبة',
            'roles_name.required'=>'اسم الصلاحية مطلوب',
        ];
    }
}
