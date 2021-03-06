<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 27/07/2020
 * Time: 21:37
 */

namespace App\Http\Requests;


use Pearl\RequestValidate\RequestAbstract;

class UserUpdateRequest extends RequestAbstract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'             => 'required|email|unique:users,email,' . intval($this->id),
            'phone'             => 'required|string|regex:/^[0-9]{2}[0-9]{8}$/',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required'            => 'Email' . trans('messages.validate.required'),
            'email.email'               => 'Email' . trans('messages.validate.email'),
            'email.unique'              => 'Email' . trans('messages.validate.unique'),
            'phone.required'            => trans('messages.validate.phone') . trans('messages.validate.required'),
            'phone.string'              => trans('messages.validate.phone') . trans('messages.validate.string'),
            'phone.regex'               => trans('messages.validate.phone') . trans('messages.validate.regex'),
        ];
    }
}
