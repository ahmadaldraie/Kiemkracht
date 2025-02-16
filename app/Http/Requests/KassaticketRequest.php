<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KassaticketRequest extends FormRequest
{
    /**
     * Haal de validatieregels op die van toepassing zijn op het verzoek van een kassaticket formulier.
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
