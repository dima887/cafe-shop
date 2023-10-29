<?php

namespace App\Http\Requests\Category;

use App\Dto\Category\CategoryUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
     * @param $id
     * @return CategoryUpdateDto
     */
    public function getDto($id): CategoryUpdateDto
    {
        return new CategoryUpdateDto(
            $id,
            $this->get('category')
        );
    }
}
