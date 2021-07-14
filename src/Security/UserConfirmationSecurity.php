<?php 

namespace App\Security;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Exception\ConfirmationTokenNotExistException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class UserConfirmationSecurity
{
    protected $userRepository;
    protected $em;
    protected $flashBag;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em,
        FlashBagInterface $flashBag)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->flashBag = $flashBag;
    }

    public function confirmUser(string $confirmationAccountToken)
    {
        $user = $this->userRepository->findOneBy([
            'confirmationAccountToken' => $confirmationAccountToken
        ]);

        if(!$user)
        {
            $exception = new ConfirmationTokenNotExistException();
            $message = $exception->getMessage();
            $this->flashBag->add('danger', $message);
        }

        if($user)
        {
            $user->setEnabled(true);
            $this->em->flush();
            $message = 'Merci pour la confirmation. Tu peux maintenant te connecter.';
            $this->flashBag->add('success', $message);
        }
    }
}