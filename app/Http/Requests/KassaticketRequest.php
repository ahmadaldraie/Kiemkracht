<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KassaticketRequest extends FormRequest
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
            'voornaam'    => 'required|string|max:255|min:1',
            'achternaam'  => 'required|string|max:255|min:1',
            'email'       => 'required|email',
            'kassaticket' => 'required|mimes:jpg,jpeg,png,pdf',
        ];
    }
}
