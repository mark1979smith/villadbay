<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 11:47
 */

namespace App\Component\Image\Type;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Carousel
 *
 * @package App\Component\Image
 */
class Carousel
{
    /**
     * @Assert\NotBlank(message="Please supply a file.")
     * @Assert\Image(maxWidth=1110,minWidth=1110,maxHeight=955,minHeight=955)
     */
    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        $this->file = $file;

        return $this;
    }


}
