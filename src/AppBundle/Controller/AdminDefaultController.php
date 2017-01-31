<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminDefaultController extends Controller
{
    /**
     * @Route("/", name="admin.homepage")
     */
    public function indexAdminAction(Request $request)
    {
        return $this->render('Admin/Default/index.html.twig');
    }

}
