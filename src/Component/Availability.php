<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 01/01/2018
 * Time: 14:02
 */

namespace App\Component;

use Symfony\Component\Intl\Intl;

class Availability
{

    /** @var bool */
    protected $available;

    /** @var \DateTimeImmutable */
    protected $dateStart;

    /** @var \DateTimeImmutable */
    protected $dateEnd;

    /** @var string */
    protected $days;

    /** @var string */
    protected $currencySymbol;

    /** @var float */
    protected $price;

    /**
     * @return \DateTimeImmutable
     */
    public function getDateStart(): \DateTimeImmutable
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTimeImmutable $dateStart
     *
     * @return Availability
     */
    public function setDateStart(\DateTimeImmutable $dateStart): Availability
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateEnd(): \DateTimeImmutable
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateEnd
     *
     * @return Availability
     */
    public function setDateEnd(\DateTimeImmutable $dateEnd): Availability
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return string
     */
    public function getDays(): ?string
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
    public function getPrice(): ?string
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

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @param bool $available
     *
     * @return Availability
     */
    public function setAvailable(bool $available): Availability
    {
        $this->available = $available;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        return $this->currencySymbol;
    }

    /**
     * @param string $currencySymbol
     *
     * @return Availability
     */
    public function setCurrencySymbol(string $currencySymbol): Availability
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }



    public static function search(Search $search)
    {

        $availability = new self;
        $availability->dateStart = $search->getDateStart();
        $availability->dateEnd = $search->getDateEnd();
        $availability->available = self::calcIsAvailable($availability);

        if ($availability->available) {
            $availability->days = $availability->dateStart->diff($availability->dateEnd)->format('%R%a');

            $villaPrice = ($availability->days * 89);
            $childPrice = ($search->getChildCount() > 0 ? ($availability->days * 10) : 0);
            $cleaningFee = 30;

            $symbol = Intl::getCurrencyBundle()->getCurrencySymbol('AUD');
            $fractionDigits = Intl::getCurrencyBundle()->getFractionDigits('AUD');

            $availability->currencySymbol = $symbol;
            $availability->price = number_format(($villaPrice + $childPrice) + $cleaningFee, $fractionDigits);
        }

        return $availability;
    }


    protected static function calcIsAvailable(self $dates): bool
    {
        return (mt_rand(0, 1) == 1);
    }
}
