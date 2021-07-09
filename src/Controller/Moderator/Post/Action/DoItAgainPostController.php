<?php 

namespace App\Controller\Moderator\Post\Action;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\MesServices\ImageServices\ImageService;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\EmailServices\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoItAgainPostController extends AbstractController
{
    /**
     * @Route("/moderator/doitagain/post/{id}", name="moderator_doitagain_post")
     */
    public function publish(int $id, PostRepository $postRepository, EntityManagerInterface $em,
                            ImageService $imageService, SendEmailService $sendEmailService)
    {
        $post = $postRepository->find($id);

        if (!$post)
        {
            $this->addFlash('danger','Cet article n\'existe pas.');
            return $this->redirectToRoute('moderator_post_unpublish_list');
        }

        $sendEmailService->sendDoItAgainEmail($post);

        $this->addFlash('success','Le mail informatif a bien été envoyé.');
        return $this->redirectToRoute('moderator_post_unpublish_list');
    }
}