<?php

namespace AppBundle\Services;

use AppBundle\Entity\Comment;
use AppBundle\Model\CommentModel;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Article;

class CommentsManager
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function addComment(CommentModel $commentModel, Article $article, Comment $parentComment = null)
    {
        $comment = new Comment();
        $comment->setAuthor($commentModel->getAuthor());
        $comment->setContent($commentModel->getContent());
        $comment->setArticle($article);
        $comment->setParent($parentComment);
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
