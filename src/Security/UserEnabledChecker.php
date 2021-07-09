<?php 

namespace App\Security;

use App\Entity\User;
use App\Exception\MyDisabledException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;

class UserEnabledChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if(!$user instanceof User)
        {
            return;
        }

        if(!$user->getEnabled())
        {
            $exception = new MyDisabledException();
            return $exception->getMessageKey();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {

    }
}