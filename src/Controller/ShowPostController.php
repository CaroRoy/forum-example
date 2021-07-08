<?php 

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowPostController extends AbstractController
{
    /**
     * @Route("/public/article/show/{id}", name="public_show_post")
     */
    public function home(int $id, Request $request, PostRepository $postRepository,EntityManagerInterface $em, CommentRepository $commentRepository): Response
    {
        $post = $postRepository->find($id);

        $comments = $commentRepository->findBy([
            'post' => $post,
            'status' => Comment::PUBLISH
        ]);

        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Post $post */
            $comment = $form->getData();

            $comment->setPost($post);

            $em->persist($comment);

            $em->flush();

            $this->addFlash('success','Le commentaire a bien été créé.');

            return $this->redirectToRoute('public_show_post',['id' => $id]);
        }

        return $this->render("public/show_post.html.twig",[
            'post' => $post,
            'comments' => $comments,
            'form' => $form->createView() 
        ]);
    }
}