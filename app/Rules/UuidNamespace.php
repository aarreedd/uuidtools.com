<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UuidNamespace implements Rule
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
        if (! is_string($value)) {
            return false;
        }

    	$value = strtolower($value);

        $is_uuid = preg_match('/^[\da-f]{8}-[\da-f]{4}-[\da-f]{4}-[\da-f]{4}-[\da-f]{12}$/iD', $value) > 0;

        if ($is_uuid) {
        	return true;
        }

        return in_array($value, ['ns:url', 'ns:dns', 'ns:oid', 'ns:x500']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid UUID or an identifier for internally pre-defined namespace UUIDs (currently known are "ns:DNS", "ns:URL", "ns:OID", and "ns:X500").';
    }
}
