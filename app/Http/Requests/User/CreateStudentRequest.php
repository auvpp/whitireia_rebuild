<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateStudentRequest
 * @package App\Http\Requests\User
 */
class CreateStudentRequest extends FormRequest
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
            'about'    =>  'nullable|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users',
            'phone_number' => 'required|unique:users',
            'gender' => 'required|string',
            'programme_id' => 'required|numeric',
            'qualification_id' => 'required|numeric',
            'major_id' => 'required|numeric',
            'address'  =>   'nullable|string',
        ];
    }
}
