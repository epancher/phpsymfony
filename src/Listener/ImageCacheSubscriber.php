<?php
namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ImageCacheSubscriber implements EventSubscriber
{
    /**
     * @var CacheManager
     */
    private $cacheManager;

    /**
     * @var UploaderHelper;
     */
    private $uploaderHelper;



    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }


    // Méthode qui permet d'écouter les éléments qu'on retourne à l'intérieur de cette méthode
    public function getSubscribedEvents()
    {
        return[
            'preRemove',
            'preUpdate'
        ];
    }


    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // on ne veut pas vider le cache pour autre chose qu'un nouvel évènement:
        if (!$entity instanceof Evenements){
            return;
        }
        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
    }


    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        // on ne veut pas vider le cache pour autre chose qu'un nouvel évènement:
        if (!$entity instanceof Evenements){
            return;
        }

        // on vide le cache pour un update d'image:
        if ($entity->getImageFile() instanceof UploadedFile){
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }
    }
}