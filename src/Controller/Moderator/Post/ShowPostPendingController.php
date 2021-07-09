<?php 

namespace App\Controller\Moderator\Post;

use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowPostPendingController extends AbstractController
{
    /**
     * @Route("moderator/post/pending/show/{id}", name="moderator_post_pending_show")
     */
    public function show( int $id,PostRepository $postRepository)
    {
        $post = $postRepository->find($id);
    
        return $this->render('moderator/post/pending/show_pending.html.twig',[
            'post' => $post,
        ]);
    }
}