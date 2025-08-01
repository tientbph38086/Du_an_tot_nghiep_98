<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'id_number' => ['nullable', 'string', 'max:50'],
            'id_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'birth_date' => ['nullable', 'date'],
            'country' => ['nullable', 'string', 'max:100'],
            'gender' => ['nullable', 'in:male,female'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Validate ảnh
        ];
    }
}
