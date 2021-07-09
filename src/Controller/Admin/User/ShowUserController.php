<?php 

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowUserController extends AbstractController
{
    /**
     * @Route("admin/user/show/{id}", name="admin_user_show")
     */
    public function show(int $id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        $comments = $user->getComments();

        $posts = $user->getPosts();
    
        return $this->render('admin/user/show.html.twig',[
            'user' => $user,
            'comments' => $comments,
            'posts' => $posts
        ]);
    }
}