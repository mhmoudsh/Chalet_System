<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserReservationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            'name'=>'required_if:type_user,==,1',
            'phone'=>'required_if:type_user,==,1',
            'verification_id'=>'required_if:type_user,==,1',
            'address'=>'required_if:type_user,==,1',
            'user_id'=>'required_if:type_user,==,2',
            'date'=>'required',
            'interval_id'=>'required',
            'start_custom_time'=>'required_if:interval_id,==,spacial',
            'end_custom_time'=>'required_if:interval_id,==,spacial',
            'basic_price'=>'required|numeric',
            'manual_price'=>'required|numeric',
            'amount_paid'=>'required|numeric',


        ];
    }
}
