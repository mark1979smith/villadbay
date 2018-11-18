<?php

namespace App\Validator\Constraints\Admin\Config;


use Symfony\Component\Validator\Constraint;

/**
 * Class SlugIsUnique
 * @Annotation
 * @package App\Validator\Constraints\Admin\Config
 */
class SlugIsUnique extends Constraint
{
    public $message = 'The slug "{{ slug }}" has already been used and is no longer available.';

}
