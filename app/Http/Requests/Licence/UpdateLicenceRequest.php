<?php

namespace App\Http\Requests\Licence;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLicenceRequest extends FormRequest
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
            'licence_type_id' => 'required|exists:licence_types,id',
            'notification_id' => 'required|exists:notifications,id',
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'provider' => 'required|string',
            'amount' => 'required',
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
            'licence_type_id.required' => 'Jenis lisensi wajib diisi.',
            'licence_type_id.exists' => 'Jenis lisensi yang dipilih tidak ditemukan.',
            'notification_id.required' => 'Tipe durasi wajib diisi.',
            'notification_id.exists' => 'Tipe durasi yang dipilih tidak ditemukan.',
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa string.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.required' => 'Tanggal akhir wajib diisi.',
            'end_date.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            'end_date.after' => 'Tanggal akhir harus setelah tanggal mulai.',
            'provider.required' => 'Penyedia wajib diisi.',
            'provider.string' => 'Penyedia harus berupa string.',
            'amount.required' => 'Jumlah wajib diisi.',
        ];
    }
}
