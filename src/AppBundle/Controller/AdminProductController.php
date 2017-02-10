<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
        $locale = $request->getLocale();
        $em =  $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:Product')->findProductByLocale($locale);

        return $this->render('Admin/Product/index.html.twig',[
            'produits' => $produits
        ]);
    }

    /**
     * Create a new entity
     *
     * @Route("/products/new", name="admin.product.new")
     */
    public function newAction(Request $request)
    {

        $serviceUtils=$this->get('app.service.utils.arrayname');

        //die(dump($serviceUtils->generateArrayNameComposer()));

        $product = new Product();
        $formProduct = $this->createForm(ProductType::class, $product);

        //die(dump($formProduct->getData()));

        $formProduct->handleRequest($request);
        //die(dump($formProduct->getData()));
        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            // sauvegarde du produit
            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();
            $this->addFlash('success', 'Votre produit a bien été ajouté');
            return $this->redirectToRoute('admin.product.new');
        }
        return $this->render('Admin/Product/new.html.twig',
            [
                'formProduct' => $formProduct->createView()
            ]
        );
    }

    /**
     * @Route("/products/{id}/delete", name="admin.product.delete")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function removeAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$product) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }
        $em->remove($product);
        $em->flush();

        $this->addFlash('success', 'Le produit a bien été supprimé');
        return $this->redirectToRoute('admin.products');
    }

    /**
     * @Route("/products/{id}/show", name="admin.product.show")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function showAction(Product $product, Request $request)
    {
        $locale = $request->getLocale();
        $em =  $this->getDoctrine()->getManager();

        $uniqueProduct = $em->getRepository('AppBundle:Product')->findProductByLocaleId($product->getId(),$locale);

        return $this->render('Admin/Product/show.html.twig', [
            'product' => $uniqueProduct
        ]);
    }

    /**
     * @Route("/products/{id}/edit", name="admin.product.edit")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function editAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();

        // Vérification si le produit est bien en BDD
        if (!$product) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }
        // Création du formulaire ProductType permettant de créer un produit
        // Je lie le formulaire à mon objet $product
        $formProduct = $this->createForm(ProductType::class, $product);
        // Je lie la requête ($_POST) à mon formulaire donc à mon objet $product
        $formProduct->handleRequest($request);
        // Je valide mon formulaire
        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            // La ligne ci-dessous n'est pas obligatoire car doctrine est au courant de l'existance de $product
            // $em->persist($product);
            $em->flush();
            $this->addFlash('success', 'Votre produit a été mis à jour');
            return $this->redirectToRoute('admin.product.show', ['id' => $product->getId()]);
        }
        return $this->render('Admin/Product/edit.html.twig', ['formProduct' => $formProduct->createView(), 'product' => $product]);
    }



}
