<?php

namespace App\Http\Requests\courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class courseServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Common validation rules.
     */
    public function rules(): array
    {
        $rules = [
            'title' => ['string', 'min:3', 'max:255'],
            'description' => ['string', 'min:3', 'max:3000'],
            'start_date' => ['date_format:d-m-Y'],
        ];

        if ($this->isMethod('post')) {
            // Required for store request
            $rules['title'][] = 'required';
            $rules['description'][] = 'required';
            $rules['start_date'][] = 'required';
        } else if ($this->isMethod('put')) {
            // Allow optional fields for update request
            $rules['title'][] = 'sometimes';
            $rules['description'][] = 'sometimes';
            $rules['start_date'][] = 'nullable';
        }

        return $rules;
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'حقل :attribute يجب أن يكون نصًا وليس أي نوع آخر',
            'max' => 'عدد محارف :attribute لا يجب أن يتجاوز max: محرفًا',
            'min' => 'حقل :attribute يجب أن يكون min: محارف على الأقل',
            'date_format' => 'حقل :attribute يجب أن يكون بصيغة تاريخ صحيحة مثل :format',
        ];
    }

    /**
     * Custom attribute names for error messages.
     */
    public function attributes(): array
    {
        return [
            'title' => 'العنوان',
            'description' => 'الوصف',
            'start_date' => 'تاريخ بداية الدورة',
        ];
    }

    /**
     * Prepare data before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => ucwords(strtolower($this->input('title'))),
            'author' => ucwords(strtolower($this->input('description'))),
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'خطأ',
            'message' => 'فشلت عملية التحقق من صحة البيانات.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
