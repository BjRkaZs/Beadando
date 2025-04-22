<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"=> "required|string|min:3|max:20|unique:users",
            "email"=> "required|email|unique:users",
            "password"=> [
                "required",
                "min:8",
                "regex:/[a-z]/",
                "regex:/[A-Z]/",
                "regex:/[0-9]/" ],
            "confirm_password"=> "required|same:password"
        ];
    }

    public function messages(): array
{
    return [
        "name.required" => "Név megadása kötelező",
        "name.unique" => "Ez a név már foglalt.",
        "name.min" => "A név minimum 3 karakter hosszú kell legyen",
        "name.max" => "A név maximum 20 karakter hosszú lehet",
        "email.required" => "E-mail cím megadása kötelező",
        "email.email" => "Érvényes e-mail címet kell megadni.",
        "email.unique" => "Ez az e-mail cím már foglalt.",
        "password.required" => "Jelszó megadása kötelező",
        "password.min" => "A jelszó minimum 8 karakter hosszú kell legyen",
        "password.regex" => "A jelszónak tartalmaznia kell legalább egy kisbetűt, egy nagybetűt és egy számot",
        "confirm_password.required" => "A két jelszó nem egyezik",
        "confirm_password.same" => "A két jelszó nem egyezik",
    ];
}

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => "Beviteli hiba",
            "data" => $validator->errors() 
        ]));
    }
}
