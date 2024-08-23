<?php

namespace App\Http\Requests\Notification;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateNotificationRequest extends FormRequest
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
            'duration_type' => 'required|string|in:monthly,yearly',
            'notification_days' => 'required|array',
            'notification_days.*' => 'integer|distinct',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400)
        );
    }

    public function messages()
    {
        return [
            'duration_type.required' => 'Tipe durasi wajib diisi.',
            'duration_type.string' => 'Tipe durasi harus berupa string.',
            'duration_type.in' => 'Tipe durasi harus salah satu dari: monthly, yearly.',
            'notification_days.required' => 'Hari notifikasi wajib diisi.',
            'notification_days.array' => 'Hari notifikasi harus berupa array.',
            'notification_days.*.integer' => 'Setiap hari notifikasi harus berupa angka.',
            'notification_days.*.distinct' => 'Hari notifikasi tidak boleh duplikat.',
        ];
    }
}
