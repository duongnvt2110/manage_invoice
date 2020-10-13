<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'user_name' => 'required|string|min:4',
            'user_email' => 'required|email|unique:users,user_email',
            'user_password' => 'required|min:8|same:password_confirmation',
        ];
    }

    public function messages()
    {
        return [
            'user_email.required' => 'A email is required',
            'user_email.email' => 'A email is not correct format',
            'user_email.unique' => 'A email is existed',
            'user_password.same' => 'A password is not correct with confirm password',
            'user_password.required' => 'A password is required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            //
        });
        return;
    }

    public function getUserAuth(){
        return app(User::class);
    }
}
