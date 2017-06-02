<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Commentaire
{
    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="commentaires")
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
     * @ORM\Column(name="auteur", type="text")
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_date", type="date")
     */
    private $publishedDate;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_comment", nullable=true, type="integer")
     */
    private $parentCommentId;

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
//        $this->setModerated(new \DateTime());
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
     * @param string $auteur
     *
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
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
    public function getParentCommentId()
    {
        return $this->parentCommentId;
    }

    /**
     * @param mixed $parentCommentId
     */
    public function setParentCommentId($parentCommentId)
    {
        $this->parentCommentId = $parentCommentId;
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
