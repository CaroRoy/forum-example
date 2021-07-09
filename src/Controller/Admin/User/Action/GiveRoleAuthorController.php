<?php

namespace App\Controller\Admin\User\Action;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GiveRoleAuthorController extends AbstractController
{
    /**
     * @Route("admin/user/role/author/{id}", name="admin_user_role_author")
     */
    public function roleAuthor(int $id, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $user = $userRepository->find($id);

        if(!$user)
        {
            $this->addFlash('danger','Cet utilisateur n\'existe pas.');
            return $this->redirectToRoute('admin_user_list');
        }

        $user->setRoles([]);

        $user->setRoles(["ROLE_AUTHOR"]);

        $em->flush();

        $this->addFlash('success','L\'utilisateur a bien le rôle : Auteur');

        return $this->redirectToRoute('admin_user_show',[ 'id' => $id]);
    }
}