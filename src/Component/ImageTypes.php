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

    protected function getImageTypesSettings($type)
    {
        switch ($type) {
            case Type::TYPE_PANORAMIC:
                return [
                    'lg' => [
                        'width'   => 1199,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'md' => [
                        'width'   => 991,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'sm' => [
                        'width'   => 767,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'xs' => [
                        'width'   => 575,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                ];
                break;
            case Type::TYPE_BACKGROUND:
                return [
                    'lg' => [
                        'width'   => 1199,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'md' => [
                        'width'   => 991,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'sm' => [
                        'width'   => 767,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'xs' => [
                        'width'   => 575,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                ];
                break;

            case Type::TYPE_CAROUSEL:
                return [
                    'lg' => [
                        'width'   => 930,
                        'rows'    => 800,
                        'bestfit' => false,
                    ],
                    'md' => [
                        'width'   => 690,
                        'rows'    => 594,
                        'bestfit' => false,
                    ],
                    'sm' => [
                        'width'   => 510,
                        'rows'    => 439,
                        'bestfit' => false,
                    ],
                    'xs' => [
                        'width'   => 290,
                        'rows'    => 249,
                        'bestfit' => false,
                    ],
                ];
                break;
        }

    }

    protected function getImageTypeDirectory($type)
    {
        switch ($type) {
            case Type::TYPE_PANORAMIC:
                return 'pano';
                break;

            case Type::TYPE_BACKGROUND:
                return 'backgrounds';
                break;

            case Type::TYPE_CAROUSEL:
                return 'carousel';
                break;
        }

        throw new \LogicException('Image Type "' . $type . '" cannot be mapped to a directory');
    }
}
