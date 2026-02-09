<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
      // register のとき
    if ($this->is('register')) {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    // login のとき
    if ($this->is('login')) {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}

public function messages()
{
     return [
        'name.required' => '名前を入力してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メール形式で入力してください',
        'password.required' => 'パスワードを入力してください',
     ];
}
}