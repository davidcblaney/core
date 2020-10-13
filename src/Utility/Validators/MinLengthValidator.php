<?php
namespace TypeRocket\Utility\Validators;

use TypeRocket\Utility\Validator;

class MinLengthValidator extends ValidatorRule
{
    public CONST KEY = 'min';

    public function validate(): bool
    {
        /**
         * @var $option3
         * @var $option
         * @var $option2
         * @var $full_name
         * @var $field_name
         * @var $value
         * @var $type
         * @var Validator $validator
         */
        extract($this->args);

        $option = (int) $option;

        if( mb_strlen($value) < $option ) {
            $this->error =  "must be at least $option characters.";
        }

        return !$this->error;
    }
}