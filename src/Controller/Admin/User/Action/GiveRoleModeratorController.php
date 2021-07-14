<?php

namespace App\Controller\Admin\User\Action;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GiveRoleModeratorController extends AbstractController
{
    /**
     * @Route("admin/user/role/moderator/{id}", name="admin_user_role_moderator")
     */
    public function roleModerator(int $id, UserRepository $userRepository, EntityManagerInterface $em) : RedirectResponse
    {
        $user = $userRepository->find($id);

        if(!$user)
        {
            $this->addFlash('danger','Cet utilisateur n\'existe pas.');
            return $this->redirectToRoute('admin_user_list');
        }

        $user->setRoles([]);

        $user->setRoles(["ROLE_MODERATOR"]);

        $em->flush();

        $this->addFlash('success','L\'utilisateur a bien le rôle Modérateur');

        return $this->redirectToRoute('admin_user_show',[ 'id' => $id]);
    }
}