<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|max:255",
            "email" => "required|max:255,unique:users",
            "place_of_birth" => "max:255",
            "date_of_birth" => "date",
            "phone_number" => "max:255",
            "gender" => "max:255",
            "position" => "max:255",
            "family_card" => "image|mimes:jpeg,png,jpg",
            "id_card" => "image|mimes:jpeg,png,jpg",
            "address" => "",
        ];
    }
}
