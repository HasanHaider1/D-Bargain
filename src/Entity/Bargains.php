<?php
declare(strict_types=1);

namespace productbargain\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Bargains
{


    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_bargain", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * User ID
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    public $user_id;

    /**
     * Product ID
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $product_id;


    /**
     * Iterations
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $iterations;

    /**
     * Final Price
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $final_price;


    /**
     * Product Price
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $product_price;


    /**
     * Status
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $status;




    /*private $product;*/





/*
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }*/



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * Set iterations
     *
     * @param int $iterations iterations
     */
    public function setIterations(int $iterations): void
    {
        $this->iterations = $iterations;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * Set product id
     *
     * @param int $product_id product id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set user id
     *
     * @param int $user_id user id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getFinalPrice(): int
    {
        return $this->final_price;
    }

    /**
     * Set final price
     *
     * @param int $final_price final price
     */
    public function setFinalPrice(int $final_price): void
    {
        $this->final_price = $final_price;
    }


    /**
     * @return int
     */
    public function getProductPrice(): int
    {
        return $this->product_price;
    }

    /**
     * Set product price
     *
     * @param int $product_price product price
     */
    public function setProductPrice(int $product_price): void
    {
        $this->product_price = $product_price;
    }


    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param int $status status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }


    public function toArray(){
        return [
            'bargain_id'=>$this->getId(),
            'product_id'=>$this->getProductId(),
            'user_id'=>$this->getUserId(),
            'status'=>$this->getStatus(),
            'iterations'=>$this->getIterations(),
            'final_price'=>$this->getFinalPrice(),
            'product_price'=>$this->getProductPrice()
        ];
    }

}
