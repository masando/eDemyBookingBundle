<?php

namespace eDemy\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use eDemy\MainBundle\Entity\BaseEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;


/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="eDemy\BookingBundle\Entity\BookingRepository")
 */
class Booking extends BaseEntity
{
    public function __construct($em = null)
    {
        parent::__construct($em);
    }

    /**
     * @ORM\Column(name="phone", type="string", length=255)
     */
    protected $phone;

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function showPhoneInPanel()
    {
        return true;
    }

    public function showPhoneInForm()
    {
        return true;
    }

    /**
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    protected $mail;

    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function showMailInPanel()
    {
        return true;
    }

    public function showMailInForm()
    {
        return true;
    }

    /**
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getIntro()
    {
        return $this->content;
    }

    public function showContentInPanel()
    {
        return true;
    }
}
