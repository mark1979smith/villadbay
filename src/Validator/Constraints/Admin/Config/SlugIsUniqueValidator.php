<?php

namespace App\Validator\Constraints\Admin\Config;


use App\Entity\Config;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class SlugIsUniqueValidator
 *
 * @package App\Validator\Constraints\Admin\Config
 */
class SlugIsUniqueValidator extends ConstraintValidator
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof SlugIsUnique) {
            throw new UnexpectedTypeException($constraint, SlugIsUnique::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $results = $this->em->getRepository(Config::class)
            ->findOneBySlug($value);

        if (!is_null($results)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ slug }}', $value)
                ->addViolation();
        }
    }
}
