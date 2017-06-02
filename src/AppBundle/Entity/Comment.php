<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     *
     * @ORM\JoinColumn(name="idArticle", referencedColumnName="id")
     */
    private $article;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="text")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_date", type="date")
     */
    private $publishedDate;

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="moderated", nullable=true, type="date")
     */
    private $moderated;

    /**
     * @var bool
     *
     * @ORM\Column(name="signaled", type="boolean")
     */
    private $signaled;

    public function __construct()
    {
        $this->setPublishedDate(new \DateTime());
        $this->setSignaled(false);
        $this->children = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set auteur
     *
     * @param string $author
     *
     * @return Commentaire
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set contenu
     *
     * @param string $content
     *
     * @return Commentaire
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * Set publishedDate
     *
     * @param \DateTime $publishedDate
     *
     * @return Commentaire
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }

    /**
     * Get publishedDate
     *
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * @return mixed
     */
    public function getModerated()
    {
        return $this->moderated;
    }

    /**
     * @param mixed $moderated
     */
    public function setModerated($moderated)
    {
        $this->moderated = $moderated;
    }

    /**
     * @return mixed
     */
    public function getSignaled()
    {
        return $this->signaled;
    }

    /**
     * @param mixed $signaled
     */
    public function setSignaled($signaled)
    {
        $this->signaled = $signaled;
    }
}