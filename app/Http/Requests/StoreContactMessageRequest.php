<?php

namespace App\Http\Requests;

use App\Enums\ContactMessageType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => is_string($this->name) ? strip_tags(trim($this->name)) : $this->name,
            'email' => is_string($this->email) ? trim($this->email) : $this->email,
            'subject' => is_string($this->subject) ? strip_tags(trim($this->subject)) : $this->subject,
            'message' => is_string($this->message) ? strip_tags(trim($this->message)) : $this->message,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'website_hp' => ['nullable', 'prohibited'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'type' => ['nullable', Rule::enum(ContactMessageType::class)],
        ];
    }

    /**
     * Custom validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'website_hp.prohibited' => 'Spam bot submission detected.',
        ];
    }
}
