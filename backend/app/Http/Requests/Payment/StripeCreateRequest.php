<?php

namespace App\Http\Requests\Payment;

use App\Dto\Payment\StripeCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class StripeCreateRequest extends FormRequest
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
            'product.id.*' => ['required', 'integer'],
            'product.name.*' => ['required', 'max:255'],
            'product.price.*' => ['required', 'numeric'],
            'product.quantity.*' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'type_order_id' => ['required', 'integer'],
            'success_url' => ['required', 'max:255'],
            'cancel_url' => ['required', 'max:255'],
        ];
    }

    /**
     * @return StripeCreateDto
     */
    public function getDto(): StripeCreateDto
    {
        return new StripeCreateDto(
            $this->get('product'),
            $this->get('user_id'),
            $this->get('type_order_id'),
            $this->get('success_url'),
            $this->get('cancel_url'),
        );
    }
}
