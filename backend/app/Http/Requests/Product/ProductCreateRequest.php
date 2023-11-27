<?php

namespace App\Http\Requests\Product;

use App\Dto\Product\ProductCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:10000'],
            'price' => ['required', 'numeric'],
            'thumbnail' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
        ];
    }

    /**
     * @return ProductCreateDto
     */
    public function getDto(): ProductCreateDto
    {
        return new ProductCreateDto(
            $this->get('name'),
            $this->get('description'),
            $this->get('price'),
            $this->get('thumbnail'),
            $this->get('category_id'),
        );
    }
}
