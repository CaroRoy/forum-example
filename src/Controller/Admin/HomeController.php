<?php 

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("admin/home", name="admin_home")
     */
    public function home(CommentRepository $commentRepository, PostRepository $postRepository)
    {
        $comments = $commentRepository->findBy([
            'status' => Comment::PENDING
        ]);

        $posts = $postRepository->findBy([
            'status' => Post::PENDING
        ]);

        return $this->render('admin/home.html.twig',[
            'comments' => $comments,
            'posts' => $posts
        ]);
    }
}