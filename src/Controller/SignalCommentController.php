<?php 

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SignalCommentController extends AbstractController
{

    /**
     * @Route("/signal/comment/{id}", name="signal_comment" )
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour signaler un commentaire.")
     */
    public function signal(int $id,CommentRepository $commentRepository, EntityManagerInterface $em)
    {
        $comment = $commentRepository->find($id);

        if(!$comment)
        {
            $this->addFlash('danger','Ce commentaire n\'existe pas.');

            return $this->redirectToRoute('public_home');
        }

        $post = $comment->getPost();

        $comment->setStatus(Comment::PENDING);

        $em->flush();

        $this->addFlash('success','Le commentaire a bien été signalé');

        return $this->redirectToRoute('public_show_post', ['id' => $post->getId()]);
        
    }
}