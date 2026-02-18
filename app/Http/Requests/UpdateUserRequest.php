<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user') instanceof User ? $this->route('user')->id : $this->route('user');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_photo' => ['nullable', 'image', 'max:3072'], // 3MB Max
        ];

        // Only allow admins to change roles
        if (auth()->check() && auth()->user()->isAdmin()) {
            $rules['role'] = ['required', 'string', Rule::in(['admin', 'director', 'team_leader', 'user'])];
        }

        return $rules;
    }
}
