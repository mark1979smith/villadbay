<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 22/02/2018
 * Time: 07:48
 */

namespace App\Entity\Admin;


class ApprovePage
{
    /** @var string */
    protected $slug = '';

    /**
     * @return bool
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param bool $slug
     *
     * @return ApprovePage
     */
    public function setSlug(string $slug): ApprovePage
    {
        $this->slug = $slug;

        return $this;
    }




}
