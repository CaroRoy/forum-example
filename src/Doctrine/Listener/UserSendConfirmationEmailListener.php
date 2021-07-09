<?php

namespace App\Doctrine\Listener;


use App\Entity\User;
use App\Security\TokenGenerator;
use App\MesServices\EmailServices\SendEmailService;

class UserSendConfirmationEmailListener
{
    private $tokenGenerator;
    private $sendEmailService;

    public function __construct(TokenGenerator $tokenGenerator,
                                SendEmailService $sendEmailService)
    {
        $this->tokenGenerator = $tokenGenerator;
        $this->sendEmailService = $sendEmailService;
    }

    public function prePersist(User $entity)
    {
        if($entity->getConfirmationAccountToken() === null && $entity->getEnabled() === false)
        {
            $token = $this->tokenGenerator->getRandomSecureToken();

            $entity->setConfirmationAccountToken($token);

            $this->sendEmailService->sendConfirmationEmail($entity);
        }
    }
}