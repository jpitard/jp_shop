<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 02/02/2017
 * Time: 12:24
 */

namespace AppBundle\Listener;


use AppBundle\Entity\Image;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ImageListener
{
    public function prePersist(Image $image, LifecycleEventArgs $args)
    {
        //$product->setCreatedAt(new \DateTime());

    }

}