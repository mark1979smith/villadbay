<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 19/04/2018
 * Time: 13:38
 */

namespace App\Component;


use App\Entity\Image\Type;

trait ImageTypes
{

    /**
     * @return array
     */
    protected function getImageTypes()
    {
        return [
            'Background' => Type::TYPE_BACKGROUND,
            'Carousel'   => Type::TYPE_CAROUSEL,
            'Panoramic'  => Type::TYPE_PANORAMIC
        ];
    }

    /**
     * @param string $imageType
     *
     * @return bool|false|int|string
     */
    protected function getImageTypeLabel($imageType)
    {
        $data = $this->getImageTypes();

        if (($label = array_search($imageType, $data))) {
            return $label;
        }

        return false;
    }
}
