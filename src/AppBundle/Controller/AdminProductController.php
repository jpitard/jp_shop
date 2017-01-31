<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminProductController extends Controller
{
    /**
     * @Route("/products", name="admin.products")
     */
    public function indexAdminAction(Request $request)
    {
        $em =  $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:Product')->findAll();

        return $this->render('Admin/Product/index.html.twig',[
            'produits' => $produits
        ]);
    }

}
