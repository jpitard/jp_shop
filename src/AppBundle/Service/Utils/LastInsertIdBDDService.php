<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 03/02/2017
 * Time: 15:19
 */

namespace AppBundle\Service\Utils;


use Doctrine\ORM\EntityManager;

class LastInsertIdBDDService
{
    private $em;

    /**
     * LastInsertIdBDDService constructor.
     */
//    public function __construct(EntityManager $entityManager)
//    {
//        $this->em = $entityManager;
//    }

//    public function getLastID(){
//        die(dump($this->em));
//        //Recuperer l'id du dernier produit en base de données
//        //$em = $args->getEntityManager();
//        $rep = $this->em->getRepository($repository);
//        $result =$rep->findBy(array(), array('id' => 'desc'),1,0);
//    }
}