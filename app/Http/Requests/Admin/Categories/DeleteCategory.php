<?php

namespace App\Http\Requests\Admin\Categories;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class DeleteCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can(config('users-permissions.categories.delete'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->category->products()->exists()) {
                    $validator->errors()->add('category', "Can not delete category \"{$this->category->name}\" because it has products!");
                }
            }
        ];
    }
}
