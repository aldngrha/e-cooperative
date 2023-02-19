<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            "option_id" => "integer",
            "loan_code" => "string",
            "amount_loan" => "integer",
            "due_date" => "date",
            "description" => "string",
            "status" => "string|in:TERTUNDA,TIDAK DISETUJUI,BELUM LUNAS,LUNAS"
        ];
    }
}
