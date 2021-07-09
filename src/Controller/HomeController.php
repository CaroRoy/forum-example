<?php 

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="public_home")
     */
    public function home(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findBy([
            'status' => Post::PUBLISH
        ]);


        return $this->render("public/home.html.twig",[
            'posts' => $posts
        ]);
    }
}