<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CommentModel
 */
class CommentModel
{
    /**
     * @Assert\NotBlank(message = "Vous devez renseigner votre nom ou votre pseudo")
     */
    private $author;

    /**
     * @Assert\NotBlank(message = "Votre commentaire ne peut être vide")
     */
    private $content;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
