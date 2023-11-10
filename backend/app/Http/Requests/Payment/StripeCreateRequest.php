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
