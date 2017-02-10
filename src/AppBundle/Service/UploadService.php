<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 03/02/2017
 * Time: 21:31
 */

namespace AppBundle\Service;


use AppBundle\Service\Utils\ArrayNameService;

class UploadService
{

    private $arrayNameService;
    private $uploadDir;


    //bon endroit pour intégrer un bundle de filigranne sur les images téléchargées.
    public function __construct(ArrayNameService $arrayNameService, $uploadDir){
        $this->arrayNameService = $arrayNameService;
        $this->uploadDir = $uploadDir;
    }

    public function upload($sous_dir,$images){
        $tabNameImage=[];

        foreach ($images as $image) {
            $fileName = $this->arrayNameService->generateUniqId().'.'.$image->getLibelle()->guessExtension();
            $tabNameImage[]=$fileName;
        }

        foreach ($images as $key=>$image) {
            // die(dump($image->getLibelle(),$tabNameImage[$key], $this->getParameter('products_directory')));
            $image->getLibelle()->move(
                $this->uploadDir.'/'.$sous_dir,
                $tabNameImage[$key]
            );
        }

        return $tabNameImage;
    }

}