<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $contactName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactAddress;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $contactNumber;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $alternativeContactNumber;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $faxNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $checkIn;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $checkOut;

    /**
     * @ORM\Column(type="time")
     */
    private $timeOfArrival;

    /**
     * @ORM\Column(type="smallint")
     */
    private $adults;

    /**
     * @ORM\Column(type="smallint")
     */
    private $children;

    /**
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @param mixed $contactName
     *
     * @return Booking
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    /**
     * @param mixed $contactAddress
     *
     * @return Booking
     */
    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * @param mixed $contactNumber
     *
     * @return Booking
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlternativeContactNumber()
    {
        return $this->alternativeContactNumber;
    }

    /**
     * @param mixed $alternativeContactNumber
     *
     * @return Booking
     */
    public function setAlternativeContactNumber($alternativeContactNumber)
    {
        $this->alternativeContactNumber = $alternativeContactNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * @param mixed $faxNumber
     *
     * @return Booking
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     *
     * @return Booking
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeOfArrival()
    {
        return $this->timeOfArrival;
    }

    /**
     * @param mixed $timeOfArrival
     *
     * @return Booking
     */
    public function setTimeOfArrival($timeOfArrival)
    {
        $this->timeOfArrival = $timeOfArrival;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * @param mixed $checkIn
     *
     * @return Booking
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheckOut()
    {
        return $this->checkOut;
    }

    /**
     * @param mixed $checkOut
     *
     * @return Booking
     */
    public function setCheckOut($checkOut)
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * @param mixed $adults
     *
     * @return Booking
     */
    public function setAdults($adults)
    {
        $this->adults = $adults;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     *
     * @return Booking
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     *
     * @return Booking
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }



}
