<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id ?? $this->route('id');
        $category = $this->route('category');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($categoryId)
            ],
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

    protected function prepareForValidation(): void
    {
        if (!$this->filled('slug') && $this->filled('name')) {
            $this->merge([
                'slug' => Str::slug($this->name)
            ]);
        }
    }
}
