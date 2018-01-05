<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 22/12/2017
 * Time: 20:07
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    /**
     * @Assert\Date()
     * @Assert\GreaterThanOrEqual("today")
     * @var \DateTime
     */
    protected $dateStart;

    /**
     * @Assert\Date()
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="dateStart"
     * )
     * @var \DateTime
     */
    protected $dateEnd;

    /**
     * @var int
     */
    protected $adultCount;

    /**
     * @var int
     */
    protected $childCount;

    /**
     * @return \DateTime
     */
    public function getDateStart(): ?\DateTime
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTime $dateStart
     *
     * @return Search
     */
    public function setDateStart(\DateTime $dateStart): Search
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd(): ?\DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateEnd
     *
     * @return Search
     */
    public function setDateEnd(\DateTime $dateEnd): Search
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return int
     */
    public function getAdultCount(): ?int
    {
        return $this->adultCount;
    }

    /**
     * @param int $adultCount
     *
     * @return Search
     */
    public function setAdultCount(int $adultCount): Search
    {
        $this->adultCount = $adultCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getChildCount(): ?int
    {
        return $this->childCount;
    }

    /**
     * @param int $childCount
     *
     * @return Search
     */
    public function setChildCount(int $childCount): Search
    {
        $this->childCount = $childCount;

        return $this;
    }

}
