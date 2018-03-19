<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 13:18
 */

namespace App\Entity\Image;

use Symfony\Component\Validator\Constraints as Assert;

class Type
{
    /**
     * @Assert\NotBlank(message="Please select the type of image.")
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Type
     */
    public function setValue(string $value): Type
    {
        $this->value = $value;

        return $this;
    }


}
