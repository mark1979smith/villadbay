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
    const TYPE_BACKGROUND = 'background';
    const TYPE_CAROUSEL = 'carousel';
    const TYPE_PANORAMIC = 'pano';

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
