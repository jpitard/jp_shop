<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 02/02/2017
 * Time: 12:24
 */

namespace AppBundle\Listener;


use AppBundle\Entity\Image;
use AppBundle\Entity\Product;
use AppBundle\Service\UploadService;
use AppBundle\Service\Utils\LastInsertIdBDDService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;

class ProductListener
{
    private $uploadService;
    private $lastInsertIdBDDService;
    //private $em;
    /**
     * ProductListener constructor.
     */
    public function __construct(UploadService $uploadService, LastInsertIdBDDService $lastInsertIdBDDService)
    {
        $this->uploadService=$uploadService;
        $this->lastInsertIdBDDService=$lastInsertIdBDDService;
        //$this->em = $entityManager;
    }

    public function prePersist(Product $product, LifecycleEventArgs $args)
    {
        $product->setCreatedAt(new \DateTime());
        $product->setUpdatedAt(new \DateTime());

        $rep = 'AppBundle:Product';

        //Recuperer l'id du dernier produit en base de données
        $em = $args->getEntityManager();
        $rep = $em->getRepository('AppBundle:Product');
        $result =$rep->findBy(array(), array('id' => 'desc'),1,0);


        if (count($result)==0){
            $idProduit = 1;
        }else{
            $idProduit = $result[0]->getId()+1;
        }

        $sous_dir = 'products/'.$idProduit.'/';
        $images = $product->getImages();

        //recuperer la tab de
        $tabNameImage = $this->uploadService->upload($sous_dir, $images);

        foreach ($tabNameImage as $key => $item) {
            //die(dump($images[$key]->getCover()));
            //$fistImage = $images[$key];
            //die(dump($images[$key]->getCover));
            $srcImage = new Image();
            $srcImage->setLibelle($item);
            $srcImage->setProduct($product);
            $srcImage->setCover($images[$key]->getCover());

            $product->addImage($srcImage);
        }
    }


}