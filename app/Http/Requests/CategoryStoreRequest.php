<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean']
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->filled('color')) {
            $this->merge([
                'color' => 'emerald'
            ]);
        }

        if (!$this->has('is_active')) {
            $this->merge([
                'is_active' => true
            ]);
        }
    }
}
