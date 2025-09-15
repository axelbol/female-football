<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('category');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean']
        ];

        // Add custom validation for is_active if category has posts
        if ($category && $category->posts()->count() > 0) {
            $rules['is_active'][] = function ($attribute, $value, $fail) use ($category) {
                if (!$value && $category->is_active) {
                    $fail('Cannot deactivate category that has posts assigned to it.');
                }
            };
        }

        return $rules;
    }
}
