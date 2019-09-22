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
            'code'       => 'required|string|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender'  => 'required|string',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'programme_id' => 'required|integer',
            'qualification_id' => 'required|integer',
            'major_id' => 'required|integer',
            'about' => 'nullable|string',
        ];
    }
}
