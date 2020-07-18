<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::find($this->route('user'));
        return (Auth::user()->isAdmin() || Auth::id() === $user->id) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:150',
            'role_id'=>'numeric|min:1|max:4',
            'email'=>'required|email',
            'address'=>'max:255',
            'phone'=>'max:255',
            'birth_date'=>'date_format:Y-m-d',
            'note'=>'max:2000',
        ];
    }
}
