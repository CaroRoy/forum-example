<?php 

namespace App\Controller\Author;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/author", name="author_home")
     * 
     */
    public function home(PostRepository $postRepository): Response
    {
        $user = $this->getUser();

        $posts = $postRepository->findBy([
            'author' => $user
        ]);

        return $this->render("author/home.html.twig",[
            'posts' => $posts
        ]);
    }
}