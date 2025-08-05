<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'required|string|max:50',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'customer_type' => 'required|in:Individual,Business,Reseller',
            'tax_id' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive,Prospective',
            'notes' => 'required|string',
            'credit_limit' => 'required|numeric|min:0',
            'total_purchases' => 'required|numeric|min:0',
            'last_purchase_at' => 'required|date_format:Y-m-d\TH:i',
            'registered_at' => 'required|date',
        ];
    }

}
