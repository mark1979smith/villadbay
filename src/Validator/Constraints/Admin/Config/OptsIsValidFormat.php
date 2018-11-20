<?php

namespace App\Validator\Constraints\Admin\Config;


use Symfony\Component\Validator\Constraint;

/**
 * Class OptsIsValidFormat
 *
 * @Annotation
 * @package App\Validator\Constraints\Admin\Config
 */
class OptsIsValidFormat extends Constraint
{
    public $message = 'The text {{ val }} has a syntax error.';

}
