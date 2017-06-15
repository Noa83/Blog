<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContactModel
 */
class ContactModel
{
    /**
     * @Assert\Length(min=3, minMessage="Le nom doit faire au minimum {{ limit }} caractères.")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffres.")
     */
    public $name;

    /**
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\Length(min=25, minMessage="Le message doit faire au moins {{ limit }} caractères.")
     */
    public $message;
}