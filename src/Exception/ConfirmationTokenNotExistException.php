<?php


namespace App\Exception;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ConfirmationTokenNotExistException extends NotFoundHttpException
{

    /**
     * @param string     $message  The internal exception message
     * @param \Throwable $previous The previous exception
     * @param int        $code     The internal exception code
     */
    public function __construct(string $message = "Votre token de confirmation n'existe pas. Veuillez contacter le support.", \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct ($message, $previous, $code, []);
    }



}