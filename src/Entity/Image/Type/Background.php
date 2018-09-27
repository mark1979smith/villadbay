<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 11:48
 */

namespace App\Entity\Image\Type;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Background
 *
 * @package App\Entity\Image
 */
class Background
{
    /**
     * @Assert\NotBlank(message="Please supply a file.")
     * @Assert\Image(minWidth=1200,minHeight=1200)
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
     * @return Background
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


}
