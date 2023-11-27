<?php

namespace App\Http\Requests\Category;

use App\Dto\Category\CategoryCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'category' => ['required', 'max:255'],
            'description' => ['max:1000'],
            'thumbnail' => ['required', 'max:255'],
        ];
    }

    /**
     * @return CategoryCreateDto
     */
    public function getDto(): CategoryCreateDto
    {
        return new CategoryCreateDto(
            $this->get('category'),
            $this->get('description'),
            $this->get('thumbnail'),
        );
    }
}
