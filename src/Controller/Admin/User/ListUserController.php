<?php 

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListUserController extends AbstractController
{
    /**
     * @Route("admin/user/list", name="admin_user_list")
     */
    public function list( UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
    
        return $this->render('admin/user/list.html.twig',[
            'users' => $users,
        ]);
    }
}