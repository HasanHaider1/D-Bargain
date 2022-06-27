<?php
declare(strict_types=1);

namespace productbargain\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class BargainIterations
{


    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_iteration", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * Max Iterations
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $bargain_id;

    /**
     * Max Iterations
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $iteration_num;

    /**
     * Max Iterations
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $price;

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
    public function getIteration(): int
    {
        return $this->iteration_num;
    }

    /**
     * Set iterations
     *
     * @param int $iterations iterations
     */
    public function setIteration(int $iterations): void
    {
        $this->iteration_num = $iterations;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * Set product id
     *
     * @param string $color color
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }


    /**
     * @return string
     */
    public function getBargain(): string
    {
        return $this->bargain_id;
    }

    /**
     * Set product id
     *
     * @param string $color color
     */
    public function setBargain(string $bargain): void
    {
        $this->bargain_id = $bargain;
    }


    public function toArray(){
        return [
            'price'=>$this->getPrice(),
            'iteration_num'=>$this->getIteration(),
            'id'=>$this->getId(),
            'bargain_id'=>$this->getBargain()
        ];
    }

}
