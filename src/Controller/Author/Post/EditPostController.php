<?php

namespace App\Controller\Author\Post;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\MesServices\ImageServices\ImageService;
use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditPostController extends AbstractController
{
    /**
     * @Route("author/edit/{id}", name="author_edit")
     */
    public function create(int $id,Request $request, EntityManagerInterface $em,ImageService $imageService, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);

        $user = $this->getUser();

        //VERSION SIMPLE DE GESTION DES AUTORISATIONS
        if($post->getAuthor() !== $user)
        {
            $this->addFlash('danger','Seul l\'auteur de l\'article peut le modifier. ');
            return $this->redirectToRoute('author_home');
        }

        //VERSION AVEC VOTER
        // $this->denyAccessUnlessGranted('POST_EDIT', $post, 'Seul l\'auteur de l\'article peut le modifier.');

        $oldImage = $post->getImageUrl();

        $form = $this->createForm(PostType::class,$post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Post $post */
            $post = $form->getData();

            $image = $form->get('imageUrl')->getData();

            $imageService->edit($image,$post,$oldImage);

            $em->flush();

            $this->addFlash('success','Le post a bien été modifié.');

            return $this->redirectToRoute('author_home');
        }

        return $this->render('author/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
}