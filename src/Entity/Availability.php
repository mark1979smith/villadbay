<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 01/01/2018
 * Time: 14:02
 */

namespace App\Entity;

use Symfony\Component\Intl\Intl;

class Availability
{
    /** @var \DateTime */
    protected $dateStart;

    /** @var \DateTime */
    protected $dateEnd;

    /** @var string */
    protected $days;

    /** @var string */
    protected $price;

    /**
     * @return \DateTime
     */
    public function getDateStart(): \DateTime
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTime $dateStart
     *
     * @return Availability
     */
    public function setDateStart(\DateTime $dateStart): Availability
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd(): \DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateEnd
     *
     * @return Availability
     */
    public function setDateEnd(\DateTime $dateEnd): Availability
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return string
     */
    public function getDays(): string
    {
        return $this->days;
    }

    /**
     * @param string $days
     *
     * @return Availability
     */
    public function setDays(string $days): Availability
    {
        $this->days = $days;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     *
     * @return Availability
     */
    public function setPrice(float $price): Availability
    {
        $this->price = $price;

        return $this;
    }



    public static function search(Search $search)
    {

        $availability = new self;
        $availability->dateStart = $search->getDateStart();
        $availability->dateEnd = $search->getDateEnd();

        $availability->days = $availability->dateStart->diff($availability->dateEnd)->format('%R%a');

        $villaPrice = ($availability->days * 89);
        $childPrice = ($search->getChildCount() > 0 ? ($availability->days * 10) : 0);
        $cleaningFee = 30;

        $symbol = Intl::getCurrencyBundle()->getCurrencySymbol('AUD');
        $fractionDigits = Intl::getCurrencyBundle()->getFractionDigits('INR');


        $availability->price = $symbol . number_format(($villaPrice + $childPrice) + $cleaningFee, $fractionDigits);

        return $availability;
    }
}
