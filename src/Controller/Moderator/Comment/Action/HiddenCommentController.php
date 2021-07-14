<?php

namespace App\Controller\Moderator\Comment\Action;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HiddenCommentController extends AbstractController
{
    /**
     * @Route("moderator/comment/hidden/{id}", name="moderator_comment_hidden")
     */
    public function hidden(int $id, CommentRepository $commentRepository, EntityManagerInterface $em)
    {
        $comment = $commentRepository->find($id);

        if(!$comment)
        {
            $this->addFlash('danger','Ce commentaire n\'existe pas.');
            return $this->redirectToRoute('moderator_comment_signal_list');
        }

        $comment->setStatus(Comment::HIDDEN);

        $em->flush();

        $this->addFlash('success','Ce commentaire est définitivement caché.');
        return $this->redirectToRoute('moderator_comment_signal_list');
    }
}