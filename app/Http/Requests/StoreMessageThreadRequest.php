<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMessageThreadRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        $userExists = is_null($this->user());
        return [
            'title' => ['required','string','max:400','min:3'],
            'body' => ['required','string','max:800'],

            'name' => [Rule::requiredIf(!$userExists),'string','max:100'],
            'phone' => [Rule::requiredIf(!$userExists),'string','regex:/^09\d{9}$/'],
            'email' => [Rule::requiredIf(!$userExists),'string','email','max:255'],
        ];
    }
}
