<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TouchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ig_account' => ['required_without:alternative_contact', 'nullable', 'string', 'max:255'],
            'alternative_contact' => ['required_without:ig_account', 'nullable', 'string', 'max:255'],
            'comments' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'ig_account.required_without' => 'Either Instagram account or alternative contact is required.',
            'ig_account.max' => 'Instagram account must not exceed 255 characters.',
            'alternative_contact.required_without' => 'Either Instagram account or alternative contact is required.',
            'alternative_contact.max' => 'Alternative contact must not exceed 255 characters.',
            'comments.max' => 'Comments must not exceed 2000 characters.',
        ];
    }
}
