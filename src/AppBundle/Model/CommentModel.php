<?php

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentModel
 *
 * @ORM\MappedSuperClass
 *
 */
class CommentModel
{
    private $author;

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
    private $content;



}