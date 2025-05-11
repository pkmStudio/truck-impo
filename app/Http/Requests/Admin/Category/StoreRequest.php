<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category.title' => 'required|string|min:3|max:255',
            'category.slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'slug')  // Явно указываем таблицу и поле
                ->where(function ($query) {
                    return $query->where('parent_id', $this->input('category.parent_id'));
                }),
            ],
            'category.parent_id' => 'nullable|integer|exists:categories,id',
            'category.type' => [
                'required',
                Rule::in(['manufacturer', 'model', 'part']),
            ],
            'category.description' => 'nullable|string',
            'category.content' => 'nullable|string',
            'category.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',

            'meta.meta_h1' => 'nullable|string|max:255',
            'meta.meta_title' => 'nullable|string|max:255',
            'meta.meta_description' => 'nullable|string|max:500',
        ];
    }

    public function passedValidation(): void
    {
        $this->merge([
            'category' => [
                ...$this->validated()['category'],
                'image_path' => $this->hasFile('category.image') ?
                    Storage::disk('public')->put('/images', $this->file('category.image')) :
                    null,
            ],

        ]);
    }
}
