<?php

namespace App\Http\Requests\Admin\Products;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can(config('user-permissions.products.publish'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [
            'title' => ['required', 'string', 'min:2', 'max:255', Rule::unique('products', 'title')->ignore($productId)],
            'description' => ['nullable', 'string'],
            'SKU' => ['required', 'string', 'min:1', 'max:35', Rule::unique('products', 'SKU')->ignore($productId)],
            'price' => ['required', 'numeric', 'min:1'],
            'discount' => ['required', 'numeric', 'min:0', 'max:99'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'categories.*' => ['nullable', 'numeric', 'exists:App\Models\Category,id'],
            'thumbnail' => ['nullable', 'image:jpeg,png', 'max:5120'],
            'images.*' => ['image:jpeg,png', 'max:5120'],
        ];
    }
}
