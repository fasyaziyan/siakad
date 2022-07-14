<?php

namespace App\Rules;
use App\Models\Kelas;

use Illuminate\Contracts\Validation\Rule;

class TingkatValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $data = Kelas::where('id_tingkat', $value)->get();
        if(count($data) >= 2){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tingkat Sudah Mencapai 2 Kelas';
    }
}
