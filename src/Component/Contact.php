<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 22/12/2017
 * Time: 14:08
 */

namespace App\Component;

class Contact
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $email;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $message;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Contact
     */
    public function setName(string $name): Contact
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Contact
     */
    public function setSubject(string $subject): Contact
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage(string $message): Contact
    {
        $this->message = $message;

        return $this;
    }

}
