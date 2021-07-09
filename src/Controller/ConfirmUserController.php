<?php 

namespace App\Controller;

use App\Security\UserConfirmationSecurity;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConfirmUserController extends AbstractController
{
    /**
     * @Route("public/confirm-user/{confirmationAccountToken}", name="app_confirm_token")
     */
    public function confirmEmailUser(string $confirmationAccountToken,UserConfirmationSecurity $userConfirmationSecurity)
    {
        $userConfirmationSecurity->confirmUser($confirmationAccountToken);

        return $this->redirectToRoute('app_login');
    }
}