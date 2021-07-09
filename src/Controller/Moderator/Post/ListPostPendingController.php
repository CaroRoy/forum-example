<?php 

namespace App\Controller\Moderator\Post;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListPostPendingController extends AbstractController
{
    /**
     * @Route("moderator/post/pending/list", name="moderator_post_unpublish_list")
     */
    public function list( PostRepository $postRepository)
    {
        $posts = $postRepository->findBy([
            'status' => Post::PENDING
        ]);
    
        return $this->render('moderator/post/pending/list_pending.html.twig',[
            'posts' => $posts,
        ]);
    }
}