<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 11:47
 */

namespace App\Entity\Image\Type;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Carousel
 *
 * @package App\Entity\Image
 */
class Carousel
{
    /**
     * @Assert\NotBlank(message="Please supply a file.")
     * @Assert\Image(maxWidth=1110,minWidth=1110,maxHeight=955,minHeight=955)
     */
    private $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     *
     * @return Carousel
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


}
