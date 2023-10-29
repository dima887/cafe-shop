<?php

namespace App\Http\Requests\Review;

use App\Dto\Review\ReviewCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
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
            //
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

        ];
    }


    /**
     * @return ReviewCreateDto
     */
    public function getDto(): ReviewCreateDto
    {
        return new ReviewCreateDto(
            $this->get('review'),
            $this->get('user_id'),
            $this->get('product_id')
        );
    }
}
