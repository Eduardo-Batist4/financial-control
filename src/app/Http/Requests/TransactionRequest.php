<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [ 'required', 'string', 'min:3', 'max:255' ],
            'category_id' => [ 'required', 'integer', 'exists:categories,id' ],
            'type' => [ 'required', 'string', 'in:input,output' ],
            'price' => [ 'required', 'numeric', 'min:1', 'max:10000' ],
            'description' => [ 'sometimes', 'string', 'min:3', 'max:255' ],
            'date' => [ 'required', 'date', 'date_format:Y-m-d' ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Data validation error.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
