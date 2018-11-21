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
 * Class Panoramic
 *
 * @package App\Component\Image
 */
class Panoramic
{
    /**
     * @Assert\NotBlank(message="Please supply a file.")
     * @Assert\Image(allowSquare=false,allowPortrait=false,minWidth=1200)
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
