<?php

namespace App\Rules;

use App\Models\MataKuliah;
use Illuminate\Contracts\Validation\Rule;

class AwalSeleksiMataKuliah implements Rule
{
    protected $tanggal_seleksi, $awal_seleksi, $pembukaan;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($awal_seleksi, $tanggal_seleksi, $pembukaan)
    {
        $this->tanggal_seleksi = $tanggal_seleksi;
        $this->awal_seleksi = $awal_seleksi;
        $this->pembukaan = $pembukaan;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan)
            ->where('tanggal_seleksi', $this->tanggal_seleksi)
            ->where('awal_seleksi', $this->awal_seleksi)
            ->count();
        return $count == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tanggal ' . $this->tanggal_seleksi . ' pukul ' . $this->awal_seleksi . ' telah digunakan';
    }
}
