<?php

namespace App\Http\Requests\Admin\Categories;

use App\Models\Category;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can(config('users-permissions.categories.edit'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:' . Category::class . ',name,' . $categoryId],
            'description' => ['nullable', 'string', 'min:2', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:' . Category::class . ',id'],
            'image' => ['image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],
        ];
    }
}
