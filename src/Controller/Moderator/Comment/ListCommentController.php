<?php 

namespace App\Controller\Moderator\Comment;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListCommentController extends AbstractController
{
    /**
     * @Route("moderator/comment/signal/list", name="moderator_comment_signal_list")
     */
    public function list( CommentRepository $commentRepository)
    {
        $comments = $commentRepository->findBy([
            'status' => Comment::PENDING
        ]);
    
        return $this->render('moderator/comment/list.html.twig',[
            'comments' => $comments,
        ]);
    }
}