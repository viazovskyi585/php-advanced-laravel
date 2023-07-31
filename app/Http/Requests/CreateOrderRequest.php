<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Redirect;

class CreateOrderRequest extends FormRequest
{
    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', new PhoneNumber()],
            'city' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:100'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $view = view('pages.checkout.checkout-page')->with('errors', $validator->errors())->fragment('form');
        throw new HttpResponseException(response($view, 422));
    }
}
