<?php 

namespace App\MesServices\ImageServices;


use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ImageService
{
    protected $containerBag;

    public function __construct(ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
    }

    public function save(object $image, object $entity)
    {
        if($image !== null)
        {
            $this->handleMoveImage($image,$entity);
        }
    }

    public function edit(object $image, object $entity,string $imageOriginal)
    {
        if($image !== null)
        {
            $this->handleMoveImage($image,$entity);

            //Processus de supression de l'image précédente
            $this->deleteImage($imageOriginal);
        }
    }

    public function deleteImage(string $imageUrl)
    {
        //Processus de supression de l'image précédente
        if($imageUrl !== null)
        {
            $fileImageOriginal = $this->containerBag->get('app_images_directory') . '/..' . $imageUrl;

            if(file_exists($fileImageOriginal))
            {
                unlink($fileImageOriginal);
            }
        }
    }

    public function handleMoveImage(object $image,object $entity)
    { 
        $file = md5(uniqid()) . '.' . $image->guessExtension();

        $image->move(
            $this->containerBag->get('app_images_directory'),
            $file
        );

        $entity->setImageUrl('/uploads/'. $file);
    }
}