<?php

namespace App\Controller\Author\Post;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\MesServices\ImageServices\ImageService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreatePostController extends AbstractController
{
    /**
     * @Route("author/create", name="author_create")
     */
    public function create(Request $request, EntityManagerInterface $em,ImageService $imageService)
    {
        $form = $this->createForm(PostType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Post $post */
            $post = $form->getData();

            $image = $form->get('imageUrl')->getData();

            $imageService->save($image,$post);

            $em->persist($post);

            $em->flush();

            $this->addFlash('success','Le post a bien été créé.');

            return $this->redirectToRoute('author_home');
        }

        return $this->render('author/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
}