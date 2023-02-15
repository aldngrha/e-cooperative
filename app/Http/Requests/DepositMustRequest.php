<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositMustRequest extends FormRequest
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
            "users_id" => "integer",
            "amount_deposit" => "integer",
            "description" => "required"
        ];
    }
}
