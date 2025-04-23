<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category.title' => 'required|string|min:3|max:255|unique:categories,title,' . $this->route('category')->id,
            'category.slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories')->where(fn($query) => $query->where('parent_id', $this->input('category.parent_id')))
                    ->ignore($this->route('category')->id),
            ],
            'category.parent_id' => 'nullable|integer|exists:categories,id',
            'category.type' => [
                'required',
                Rule::in(['manufacturer', 'model', 'part']),
            ],
            'category.description' => 'nullable|string',
            'category.content' => 'nullable|string',
            'category.image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp',

            'meta.meta_h1' => 'nullable|string|max:255',
            'meta.meta_title' => 'nullable|string|max:255',
            'meta.meta_description' => 'nullable|string|max:500',
        ];
    }

    protected function passedValidation(): void
    {
        // Получаем старый путь к изображению, если он есть
        $oldImagePath = $this->route('category')->image_path ?? null;

        // Загружаем новое изображение, если оно есть
        $newImagePath = $this->hasFile('category.image') ?
            Storage::disk('public')->put('/images', $this->file('category.image')) :
            null;

        // Удаляем старое изображение, если новое изображение загружено
        if ($newImagePath && $oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }

        $this->merge([
            'category' => [
                ...$this->validated()['category'],
                'image_path' => $newImagePath ?? $oldImagePath,
            ]
        ]);
    }
}
