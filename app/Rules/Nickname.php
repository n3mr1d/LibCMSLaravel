<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Nickname implements ValidationRule
{
    protected string $otherField;
    protected string $otherValue;

    /**
     * @param string $otherField  Nama field pembanding (contoh: "name")
     * @param string $otherValue  Nilai field pembanding
     */
    public function __construct(string $otherField, string $otherValue)
    {
        $this->otherField = $otherField;
        $this->otherValue = $otherValue;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === $this->otherValue) {
            $fail(ucfirst($attribute) . " Must be diffrent with {$this->otherField}.");
        }
    }
}
