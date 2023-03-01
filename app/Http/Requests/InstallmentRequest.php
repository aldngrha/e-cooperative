<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallmentRequest extends FormRequest
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
            "loans_id" => "integer|exists:loans,id",
            "installment_number" => "integer",
            "amount_installment" => "integer",
            "interest_rate" => "integer",
            "remaining" => "integer",
            "description" => "required"
        ];
    }
}
