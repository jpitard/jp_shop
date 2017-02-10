<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 03/02/2017
 * Time: 21:31
 */

namespace AppBundle\Service;



class UnlinkService
{
    private $uploadDir;

    public function __construct($uploadDir){
        $this->uploadDir = $uploadDir;
    }
    public function remove($file){
        unlink($this->uploadDir . $file);
    }

}