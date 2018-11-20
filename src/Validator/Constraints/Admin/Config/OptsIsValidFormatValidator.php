<?php

namespace App\Validator\Constraints\Admin\Config;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class OptsIsValidFormatValidator
 *
 * @package App\Validator\Constraints\Admin\Config
 */
class OptsIsValidFormatValidator extends ConstraintValidator
{
    /** @var \ArrayIterator|null */
    protected $errorSection = null;

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof OptsIsValidFormat) {
            throw new UnexpectedTypeException($constraint, OptsIsValidFormat::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_array($value)) {
            throw new UnexpectedTypeException($value, 'array');
        }


        if (!$this->isValid($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ val }}', $this->getErrorMessage($this->errorSection))
                ->addViolation();
        }

    }

    public function isValid(array $value): bool
    {
        $allMatches = [];
        foreach ($value as $val) {
            if (strlen($val)) {
                preg_match_all('/^([^,:]*)(:?)([^,:]*)$/i', $val, $matches, PREG_SET_ORDER);
                if (count($matches)) {
                    $allMatches = array_merge($allMatches, $matches);
                }
            }
        }

        if (count($allMatches) === count($value)) {
            return ($this->getIncorrectFormatSection($allMatches) === null ? true : false);
        }

        return false;
    }

    public function getIncorrectFormatSection(array $matches): ?\ArrayIterator
    {
        $incorrectMatches = new \ArrayIterator();
        foreach ($matches as $match) {
            $match = array_filter($match);
            if (count($match) === 3) {
                $incorrectMatches->append($match[0]);
            }
        }

        if ($incorrectMatches->count()) {
            $this->errorSection = $incorrectMatches;

            return $incorrectMatches;
        }

        return null;
    }

    public function getErrorMessage(\ArrayIterator $errors): string
    {
        $array = array_map('trim', iterator_to_array($errors));
        $lastEntry = array_pop($array);

        if (count($array)) {
            return '"' . implode('", "', $array) . '" and "' . $lastEntry . '"';
        }

        return '"' . $lastEntry . '"';
    }

}
