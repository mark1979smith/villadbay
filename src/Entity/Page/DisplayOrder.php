<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/01/2018
 * Time: 19:54
 */

namespace App\Entity\Page;


class DisplayOrder
{
    /**
     * @var int
     */
    private $displayOrder;

    /**
     * @return null|int
     */
    public function getDisplayOrder(): ?int
    {
        return $this->displayOrder;
    }

    /**
     * @param int $displayOrder
     *
     * @return DisplayOrder
     */
    public function setDisplayOrder(?int $displayOrder): DisplayOrder
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }
}
