<?php

namespace AppBundle\Services;

use AppBundle\Entity\Comment;
use AppBundle\Model\CommentModel;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Article;

class CommentsManagement
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function addComment(CommentModel $commentModel, Article $article)
    {
        $comment = new Comment();
        $comment->setAuthor($commentModel->getAuthor());
        $comment->setContent($commentModel->getContent());
        $comment->setArticle($article);
        $article->addComment($comment);
        
        return $article;
    }

    public function deleteComment(Comment $comment)
    {
        $em = $this->manager;
        $em->remove($comment);
        $em->flush();
    }

    public function signalComment(Comment $comment)
    {
        $comment->setSignaled(true);
        return $comment;
    }

    public function validateComment(Comment $comment)
    {
        $comment->setSignaled(false);
        return $comment;
    }

    public function executeActionOnComment(Comment $comment)
    {
        $em = $this->manager;
        $em->persist($comment);
        $em->flush();
    }
}
