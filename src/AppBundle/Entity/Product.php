<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\EntityListeners("AppBundle\Listener\ProductListener")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titleFR", type="string", length=255)
     */
    private $titleFR;
    /**
     * @var string
     *
     * @ORM\Column(name="titleEN", type="string", length=255)
     */
    private $titleEN;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFR", type="text")
     */
    private $descriptionFR;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEN", type="text")
     */
    private $descriptionEN;

    /**
     * @var float
     *
     * @ORM\Column(name="priceHT", type="float", nullable=true)
     */
    private $priceHT;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * One Product has Many Images.
     * @ORM\OneToMany(targetEntity="Image", mappedBy="product", cascade={"persist"})
     */
    protected $images;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titleFR
     *
     * @param string $titleFR
     *
     * @return Product
     */
    public function setTitleFR($titleFR)
    {
        $this->titleFR = $titleFR;

        return $this;
    }

    /**
     * Get titleFR
     *
     * @return string
     */
    public function getTitleFR()
    {
        return $this->titleFR;
    }

    /**
     * Set titleEN
     *
     * @param string $titleEN
     *
     * @return Product
     */
    public function setTitleEN($titleEN)
    {
        $this->titleEN = $titleEN;

        return $this;
    }

    /**
     * Get titleEN
     *
     * @return string
     */
    public function getTitleEN()
    {
        return $this->titleEN;
    }

    /**
     * Set descriptionFR
     *
     * @param string $descriptionFR
     *
     * @return Product
     */
    public function setDescriptionFR($descriptionFR)
    {
        $this->descriptionFR = $descriptionFR;

        return $this;
    }

    /**
     * Get descriptionFR
     *
     * @return string
     */
    public function getDescriptionFR()
    {
        return $this->descriptionFR;
    }

    /**
     * Set descriptionEN
     *
     * @param string $descriptionEN
     *
     * @return Product
     */
    public function setDescriptionEN($descriptionEN)
    {
        $this->descriptionEN = $descriptionEN;

        return $this;
    }

    /**
     * Get descriptionEN
     *
     * @return string
     */
    public function getDescriptionEN()
    {
        return $this->descriptionEN;
    }

    /**
     * Set priceHT
     *
     * @param float $priceHT
     *
     * @return Product
     */
    public function setPriceHT($priceHT)
    {
        $this->priceHT = $priceHT;

        return $this;
    }

    /**
     * Get priceHT
     *
     * @return float
     */
    public function getPriceHT()
    {
        return $this->priceHT;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Product
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
