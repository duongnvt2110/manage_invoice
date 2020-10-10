<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Rules\ThrottlesLogins;

class UserLoginRequest extends FormRequest
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
            'user_email' => [
                'required',
                'string',
                'exists:users,user_email',
                new ThrottlesLogins('login',config('cms.throlltes.maxAttempt'), config('cms.throlltes.decayInMinutes'))
            ],
            'user_password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'user_email.required' => 'A email is required',
            'user_email.exists' => 'A email is not correct',
            'user_password.required' => 'A password is required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = $this->getUserAuth()->getUserByEmail($this->user_email);
            if ( !Hash::check($this->user_password, $user->user_password) ) {
                $validator->errors()->add('user_password', 'Your current password is incorrect.');
            }
        });
        return;
    }

    public function getUserAuth(){
        return app(User::class);
    }
}
