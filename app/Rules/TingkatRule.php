<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TingkatRule implements Rule
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
        $tingkat = ['VII', 'VIII', 'IX'];
        return $value = array_search($value, $tingkat) !== false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nama Tingkat harus VII / VIII / IX';
    }
}
