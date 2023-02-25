<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapitalRequest extends FormRequest
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
            "surplus_id" => "integer",
            "amount_capital" => "required|integer",
            "description" => "required"
        ];
    }
}
