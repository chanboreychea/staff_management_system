<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateInforRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can add authorization logic here if needed
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
            'firstNameKh' => ['required', 'string', 'max:100'],
            'lastNameKh' => ['required', 'string', 'max:100'],
            'idCard' => ['required', 'string'], // Assuming idCard is a string
            'referent' => ['required', 'string'], // Assuming referent is a string
            'codeEconomy' => ['required', 'string'], // Assuming codeEconomy is a string
            'engName' => ['required', 'string'], // Assuming engName is a string
            // Add more rules as needed
        ];
    }
}
