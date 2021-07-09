<?php 

namespace App\Controller\Moderator\Post\Action;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\MesServices\ImageServices\ImageService;
use Symfony\Component\Routing\Annotation\Route;
use App\MesServices\EmailServices\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

class DeletePostController extends AbstractController
{
    /**
     * @Route("/moderator/delete/post/{id}", name="moderator_delete_post")
     */
    public function delete(int $id, PostRepository $postRepository, EntityManagerInterface $em,
                            ImageService $imageService,SendEmailService $sendEmailService)
    {
       
        $post = $postRepository->find($id);

        if (!$post)
        {
            $this->addFlash('danger','Cet article n\'existe pas.');
            return $this->redirectToRoute('moderator_post_unpublish_list');
        }

        $imageService->deleteImage($post->getImageUrl());

        $em->remove($post);

        $em->flush();

         //TODO Envoyer un mail
         $sendEmailService->sendNotificationDeleteEmail($post);

        $this->addFlash('success','Cet article a bien été supprimé.');
        return $this->redirectToRoute('moderator_post_unpublish_list');
    }
}