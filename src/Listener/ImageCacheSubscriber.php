<?php
namespace App\Listener;
use App\Entity\Product;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber{

    // Pensez a charger la class dans le services.yaml

    // je fais appel au cache manager du bundle Lipp_imagine
    // et du UploaderHelper du bundle vichUploader
    /**
     * @var CacheManager
     */
    private $manager;
    /**
     * @var UploaderHelper
     */
    private $helper;

    public function __construct(CacheManager $manager, UploaderHelper $helper)
    {
        $this->manager = $manager;
        $this->helper = $helper;
    }

    public function getSubscribedEvents()
    {
        // on retourne les events que l'on va ecouter
        // preRemove -> quand une entity est supprimer
        // preUpdate -> quand une entity est editer
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    // je créé mes deux fonction " preRemove et preUpdate "
    // pour les argument cf "doctrine-project.org/projects/doctrine-orm/en/4.3/reference/events.html#preremove"
    // Par contre il n'existe pas de PreRemove donc on importe le parent de preRemove qui est LifecycleEventArgs
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        //si args n'est pas une entity de product
        if (!$entity instanceof Product){
            return;
        }
        $this->manager->remove($this->helper->asset($entity,'imageFile'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        //dump($args->getEntity());
        //dump($args->getObject());

        $entity = $args->getEntity();
        //si args n'est pas une entity de product on retourne
        if (!$entity instanceof Product){
            return;
        }
        // si oui et que je sais que je vais avoir un imageFile
        if ($entity->getImageFile() instanceof UploadedFile){
            // on supprime un fichier qui a été mis en cache en lui passant le chemin de l'image
            // grace au helper (UploaderHelper du bundle vichUploader)
            $this->manager->remove($this->helper->asset($entity,'imageFile'));
        }
    }


}