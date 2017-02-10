<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 03/02/2017
 * Time: 15:19
 */

namespace AppBundle\Service\Utils;


class ArrayNameService
{


    public function generateArrayNameComposer($tabName = ['home','large','medium', 'small'],$paterm='_default'){

//        $tabComposer = [];
//        //créer le dossier produit et un sous dossier avec l'id du produit concerner
//        //$dosProduct = 'product/'.$idProduct.'/';
//
//        //créer un dossier pour chaque image dans le sous dossier de id du produit
//        //foreach ($images as $item) {
//
//            //$dosProduct .= $item->getId().'/';
//
//        foreach ($tabName as $item) {
//            $tabComposer[]=$item.$paterm;
//        }
//        return $tabComposer;
//
//        //}
    }
    public function generateUniqId(){
        $result = bin2hex(openssl_random_pseudo_bytes(16));
        return $result;
    }

}