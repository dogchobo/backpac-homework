<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => 'required|alpha|max:20',
            'nickname' => 'required|regex:/^[a-z]+$/|max:30',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:10',
            'phone_number' => 'required|regex:/^[.*\d]+$/|max:20',
            'email' => 'required|email:rfc|unique:App\Models\User|max:100',
            'gender' => 'in:M,F'
        ];
    }

    // 너무 많아요..ㅠ
    /*public function attributes()
    {
        return [
            'name' => '이름',
            'nickname' => '닉네임',
            'password' => '비밀번호',
            'phone_number' => '전화번호',
            'email' => '이메일',
            'gender' => '성별'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute이 입력되지 않은 거 같아요. 다시 확인해 주세요.',
            'password.required' => '비밀번호가 입력되지 않은 거 같아요. 다시 확인해 주세요.',
            'phone_number.required' => '전화번호가 입력되지 않은 거 같아요. 다시 확인해 주세요.',
            'name.alpha' => '이름은 문자만 입력이 가능해요. 다시 확인해 주세요.',
            'max' => ':attribute은 최대 :max자까지만 가능해요. 다시 확인해 주세요.',
            'phone_number.max' => ':attribute은 최대 :max자리까지 가능해요. 다시 확인해 주세요.',
        ];
    }*/
}
