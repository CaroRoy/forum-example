<?php

namespace App\Controller\Admin\User\Action;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteRoleController extends AbstractController
{
    /**
     * @Route("admin/user/role/delete/{id}", name="admin_user_role_delete")
     */
    public function deleteRole(int $id, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $user = $userRepository->find($id);

        if(!$user)
        {
            $this->addFlash('danger','Cet utilisateur n\'existe pas.');
            return $this->redirectToRoute('admin_user_list');
        }

        $user->setRoles([]);

        $em->flush();

        $this->addFlash('success','L\'utilisateur est redevenu un simple : User');

        return $this->redirectToRoute('admin_user_show',[ 'id' => $id]);
    }
}