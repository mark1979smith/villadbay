<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 13:18
 */

namespace App\Component\Image;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }


}
