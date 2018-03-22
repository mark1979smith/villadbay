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
 * Class Panoramic
 *
 * @package App\Entity\Image
 */
class Panoramic
{
    /**
     * @Assert\NotBlank(message="Please supply a file.")
     * @Assert\Image(allowSquare=false,allowPortrait=false,minWidth=1200,minHeight=900)
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
     * @return Panoramic
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


}
