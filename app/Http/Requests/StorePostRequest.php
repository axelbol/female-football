<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'player_name' => 'nullable|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'hero_image' => 'nullable|string|max:255',
            'middle_image' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'read_time' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_data' => 'nullable|array',
        ];
    }
}
