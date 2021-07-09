<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * DisabledException is thrown when the user account is disabled.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Alexander <iam.asm89@gmail.com>
 */
class MyDisabledException extends AccountStatusException
{
    /**
     *  @return string
     */
    public function getMessageKey()
    {
        throw new AuthenticationException("Votre compte n'est pas actif, vous devez activer votre compte a l'aide du mail d'activation envoyé lors de votre inscription.");
    }
}