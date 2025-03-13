<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [    
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'contact_no' => 'required|digits:10|numeric|unique:user_details,contact_no',
            'alt_contact_no' => 'nullable|digits:10|numeric',
            'address' => 'required|string|max:500',
            'designation' => 'required|exists:designations,id',
            'status' => 'required|in:0,1',
        ];
    }
}
