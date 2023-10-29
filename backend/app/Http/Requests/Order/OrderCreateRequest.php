<?php

namespace App\Http\Requests\Order;

use App\Dto\Order\OrderCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
     * @return OrderCreateDto
     */
    public function getDto(): OrderCreateDto
    {
        return new OrderCreateDto(
            $this->get('product_id'),
            $this->get('type_order_id'),
            $this->get('user_id'),
            $this->get('status_order_id')
        );
    }
}
