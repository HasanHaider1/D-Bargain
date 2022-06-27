<?php
declare(strict_types=1);

namespace productbargain\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class BargainSetting
{


    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_setting", type="integer")
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
    public $max_iterations;

    /**
     * Status
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    public $color;
    /**
     * Wait
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $wait;
    /**
     * Chat Display
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    public $chatdisplay;

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
        return $this->max_iterations;
    }

    /**
     * Set iterations
     *
     * @param int $iterations iterations
     */
    public function setIterations(int $iterations): void
    {
        $this->max_iterations = $iterations;
    }


    /**
     * @return int
     */
    public function getChatDisplay(): int
    {
        return $this->chatdisplay;
    }

    /**
     * Set iterations
     *
     * @param int $iterations iterations
     */
    public function setChatDisplay(int $chatdisplay): void
    {
        $this->chatdisplay = $chatdisplay;
    }
    /**
     * @return int
     */
    public function getWait(): int
    {
        return $this->wait;
    }

    /**
     * Set iterations
     *
     * @param int $iterations iterations
     */
    public function setWait(int $wait): void
    {
        $this->wait = $wait;
    }
    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set product id
     *
     * @param string $color color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }


    public function toArray(){
        return [
            'color'=>$this->getColor(),
            'max_iterations'=>$this->getIterations(),
            'chatdisplay'=>$this->getChatDisplay(),
            'wait'=>$this->getWait()
        ];
    }

}
