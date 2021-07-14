<?php

namespace App\Controller\Moderator\Comment\Action;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidCommentController extends AbstractController
{
    /**
     * @Route("moderator/comment/valid/{id}", name="moderator_comment_valid")
     */
    public function valid(int $id, CommentRepository $commentRepository, EntityManagerInterface $em)
    {
        $comment = $commentRepository->find($id);

        if(!$comment)
        {
            $this->addFlash('danger','Ce commentaire n\'existe pas.');
            return $this->redirectToRoute('moderator_comment_signal_list');
        }

        $comment->setStatus(Comment::PUBLISH);

        $em->flush();

        $this->addFlash('success','Ce commentaire est republié.');
        return $this->redirectToRoute('moderator_comment_signal_list');
    }
}