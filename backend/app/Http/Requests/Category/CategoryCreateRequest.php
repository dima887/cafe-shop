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
            'category' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'category.required' => 'Enter category',
        ];
    }

    /**
     * @return CategoryCreateDto
     */
    public function getDto(): CategoryCreateDto
    {
        return new CategoryCreateDto(
            $this->get('category')
        );
    }
}
