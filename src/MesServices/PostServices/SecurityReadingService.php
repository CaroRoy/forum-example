<?php 

namespace App\MesServices\PostServices;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SecurityReadingService
{
    protected $flashbag;


    public function __construct(FlashBagInterface $flashbag)
    {
        $this->flashbag = $flashbag;
    }


    public function isReadable(Post $post) : bool
    {

        if($post->getStatus() === Post::PENDING)
        {

            $message = 'Cet article n\'est pas encore publié.';
            
            $this->flashbag->add('warning',$message);

            return false;
        }

        return true;
    }
}