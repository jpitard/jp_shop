<?php
/**
 * Created by PhpStorm.
 * User: PITARD
 * Date: 25/01/2017
 * Time: 00:53
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Image;
use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    const MAX_NB_PRODUCTS =50;
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $faker = \Faker\Factory::create();

        for ($i=0; $i < self::MAX_NB_PRODUCTS; $i++)
        {
            $product = new Product();
            $product->setTitleFR('Produit-00'.$i);
            $product->setTitleEN('Product-00'.$i);

            $product->setDescriptionFR($faker->text(250));
            $product->setDescriptionEn($faker->text(250));

            $product->setPriceHT($faker->randomFloat(2,100,1000));
            $product->setQuantity($faker->randomDigit);
            $product->setActive(rand(0,1));
            //$product->setCreatedAT($faker->dateTime);
            //$product->setUpdatedAt($faker->dateTime);

            //$product->addImage($faker->imageUrl(800,800,'cats'));
//            for ($i=0; $i<3; $i++){
                $image = new Image();
                $image->setLibelle(new UploadedFile($faker->image('',800,800)));
                if ($i==0){
                    $image->getCover(true);
                }else{
                    $image->getCover(false);
                }
                //$image->getCover();
                $image->setProduct($product);
                $product->addImage($image);
//            }

            $manager->persist($product);
            $this->addReference('product'.$i, $product);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 1;
    }
}