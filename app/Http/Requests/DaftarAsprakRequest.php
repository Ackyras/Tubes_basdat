<?php

namespace App\Http\Requests;

use App\Models\PembukaanAsprak;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DaftarAsprakRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $periode = PembukaanAsprak::latest()->first();
        return [
            'nama'          => ['required'],
            'nim'           => ['required', 'regex:/[0-9]+/', 'min:8', 'max:9'],
            'email'         => [
                'required', 'email',
                Rule::unique('calon_aspraks', 'email')->where(function ($q) use ($periode) {
                    return $q->where('periode', $periode->id);
                })
            ],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'prodi'         => ['required'],
            'angkatan'      => ['required', 'regex:/[0-9]+/'],
            'cv'            => ['mimes:pdf,jpeg,png,jpg', 'max:1024', 'required'],
            'khs'           => ['mimes:pdf,jpeg,png,jpg', 'max:1024', 'required'],
            'ktm'           => ['mimes:pdf,jpeg,png,jpg', 'max:1024', 'required'],
            'pilihan'       => ['required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama.required'         => 'Mohon isi field nama',
            'nim.required'          => 'Mohon isi field NIM',
            'nim.regex'             => 'NIM hanya bisa di isi dengan karakter 0-9',
            'nim.min'               => 'NIM minimal 8 karakter',
            'nim.max'               => 'NIM minimal 9 karakter',
            'email.required'        => 'Mohon isi field email',
            'email.email'           => 'Mohon isi field email dengan format email yang tepat',
            'tanggal_lahir.required' => 'Mohon isi field tanggal lahir',
            'tanggal_lahir.date'    => 'Field tanggal lahir hanya bisa di isi dengan tanggal',
            'tanggal_lahir.before'  => 'Tanggal lahir tidak mungkin hari ini atau melebihi hari ini',
            'angkatan.required'     => 'Mohon isi field angkatan',
            'angkatan.regex'        => 'Angkatan hanya bisa di isi dengan karakter 0-9',
            'cv.mimes'              => 'Masukkan file dengan format pdf, jpeg, png atau jpg',
            'cv.max'                => 'Maksimal ukuran file 512KB',
            'cv.required'           => 'Mohon masukkan file cv',
            'khs.mimes'             => 'Masukkan file dengan format pdf, jpeg, png atau jpg',
            'khs.max'               => 'Maksimal ukuran file 512KB',
            'khs.required'          => 'Mohon masukkan file khs',
            'ktm.mimes'             => 'Masukkan file dengan format pdf, jpeg, png atau jpg',
            'ktm.max'               => 'Maksimal ukuran file 512KB',
            'ktm.required'          => 'Mohon masukkan file ktm',
            'pilihan.required'      => 'Pilih mata kuliah minimal 1',
        ];
    }
}
