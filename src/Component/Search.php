<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 22/12/2017
 * Time: 20:07
 */

namespace App\Component;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    /**
     * @Assert\Date()
     * @Assert\GreaterThanOrEqual("today")
     * @var \DateTimeImmutable
     */
    protected $dateStart;

    /**
     * @Assert\Date()
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="dateStart",
     *     message="We would all like an infinite holiday, but could you ensure your Check-Out date is after your Check-In date."
     * )
     * @Assert\NotEqualTo(
     *     propertyPath="dateStart",
     *     message="A minimum 1 night stay is required."
     * )
     * @var \DateTimeImmutable
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
     * @return \DateTimeImmutable
     */
    public function getDateStart(): ?\DateTimeImmutable
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTimeImmutable $dateStart
     *
     * @return Search
     */
    public function setDateStart(\DateTimeImmutable $dateStart): Search
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDateEnd(): ?\DateTimeImmutable
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTimeImmutable $dateEnd
     *
     * @return Search
     */
    public function setDateEnd(\DateTimeImmutable $dateEnd): Search
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
