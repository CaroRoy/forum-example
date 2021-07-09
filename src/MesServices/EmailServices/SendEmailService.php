<?php 

namespace App\MesServices\EmailServices;

use App\Entity\Post;
use App\Entity\User;
use Twig\Environment;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendEmailService
{
    protected $mailer;
    protected $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }
    
    public function sendConfirmationEmail(User $user)
    {
        $email = (new TemplatedEmail())
        ->from('support@forum_etudiant_symfony.fr')
        ->to($user->getEmail())
        ->subject('Confirmez votre compte.')
        ->htmlTemplate('email/send_confirmation.html.twig')
        ->context([
            'user' => $user
        ]);

    $this->mailer->send($email);
    }

    public function sendDoItAgainEmail(Post $post)
    {
        $email = (new TemplatedEmail())
            ->from('support@forum_etudiant_symfony.fr')
            ->to($post->getAuthor()->getEmail())
            ->subject('Article à améliorer')
            ->htmlTemplate('email/doitagain.html.twig')
            ->context([
                'post' => $post
            ]);

        $this->mailer->send($email);
    }

    public function sendNotificationPublishEmail(Post $post)
    {
        $email = (new TemplatedEmail())
            ->from('support@forum_etudiant_symfony.fr')
            ->to($post->getAuthor()->getEmail())
            ->subject('Article publié')
            ->htmlTemplate('email/postpublish.html.twig')
            ->context([
                'post' => $post
            ]);

        $this->mailer->send($email);
    }

    public function sendNotificationDeleteEmail(Post $post)
    {
        $email = (new TemplatedEmail())
            ->from('support@forum_etudiant_symfony.fr')
            ->to($post->getAuthor()->getEmail())
            ->subject('Article supprimé !')
            ->htmlTemplate('email/postdelete.html.twig')
            ->context([
                'post' => $post
            ]);

        $this->mailer->send($email);
    }


}