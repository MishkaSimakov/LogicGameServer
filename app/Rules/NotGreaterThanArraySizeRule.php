<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class NotGreaterThanArraySizeRule implements Rule, DataAwareRule
{
    protected $data = [];
    protected string $array_name;

    public function __construct(string $array_name)
    {
        $this->array_name = $array_name;
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data): static
    {
        $this->data = $data;

        return $this;
    }


    public function passes($attribute, $value): bool
    {
        if (!Arr::exists($this->data, $this->array_name))
            return false;

        return $value <= count($this->data[$this->array_name]);
    }

    public function message(): string
    {
        return trans('validation.not_greater_than_array_size', [
            'other' => trans("validation.attributes.{$this->array_name}")
        ]);
    }
}
