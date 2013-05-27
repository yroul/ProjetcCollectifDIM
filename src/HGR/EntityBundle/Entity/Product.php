<?php

namespace HGR\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function __construct($name,$price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->marks = new ArrayCollection();
    }
    /**
     * @ORM\ManyToOne(targetEntity="HGR\EntityBundle\Entity\Category", inversedBy="products",cascade={"all"})
     */
    protected $category;
    
    /**
     * @var Float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        if(price < 0){
            throw new InvalidArgumentException("Price cannot be < 0");
        }
        else{
            
        $this->price = $price;
        }
    }

        /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="HGR\EntityBundle\Entity\Mark",mappedBy="product",cascade={"all"}))
     * @var type Mark
     */
    private $marks;

    public function addMark($mark){
        $mark->setProduct($this);
        $this->marks[]= $mark;
    }
    public function getMarks(){
        return $this->marks;
    }
    /**
     * @ORM\OneToMany(targetEntity="HGR\EntityBundle\Entity\Comment",mappedBy="product",cascade={"all"}))
     * @var type Comment
     */
    private $comments;
    public function addComment($comment){
        $comment->setProduct($this);
        $this->comments[] = $comment;
    }
    public function getComment(){
        return $this->getComment();
    }
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
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }


}
