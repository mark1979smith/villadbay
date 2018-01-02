<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/01/2018
 * Time: 20:15
 */

namespace App\Entity;

class Booking
{
    /** @var string */
    protected $contactName;

    /** @var string */
    protected $contactAddress;

    /** @var string */
    protected $contactNumber;

    /** @var string */
    protected $alternativeContactNumber;

    /** @var string */
    protected $faxNumber;

    /** @var string */
    protected $emailAddress;

    /** @var string */
    protected $timeOfArrival;

    /**
     * @return string
     */
    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    /**
     * @param string $contactName
     *
     * @return Booking
     */
    public function setContactName(string $contactName): Booking
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactAddress(): ?string
    {
        return $this->contactAddress;
    }

    /**
     * @param string $contactAddress
     *
     * @return Booking
     */
    public function setContactAddress(string $contactAddress): Booking
    {
        $this->contactAddress = $contactAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    /**
     * @param string $contactNumber
     *
     * @return Booking
     */
    public function setContactNumber(string $contactNumber): Booking
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlternativeContactNumber(): ?string
    {
        return $this->alternativeContactNumber;
    }

    /**
     * @param string $alternativeContactNumber
     *
     * @return Booking
     */
    public function setAlternativeContactNumber(string $alternativeContactNumber): Booking
    {
        $this->alternativeContactNumber = $alternativeContactNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getFaxNumber(): ?string
    {
        return $this->faxNumber;
    }

    /**
     * @param string $faxNumber
     *
     * @return Booking
     */
    public function setFaxNumber(string $faxNumber): Booking
    {
        $this->faxNumber = $faxNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     *
     * @return Booking
     */
    public function setEmailAddress(string $emailAddress): Booking
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeOfArrival(): ?string
    {
        return $this->timeOfArrival;
    }

    /**
     * @param string $timeOfArrival
     *
     * @return Booking
     */
    public function setTimeOfArrival($timeOfArrival): Booking
    {
        $this->timeOfArrival = $timeOfArrival;

        return $this;
    }


}
