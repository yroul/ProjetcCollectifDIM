<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\ProductRepository")
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
    
     public function __construct()
    {
        $this->marks = new ArrayCollection();
    }
    /**
     * @ORM\ManyToOne(targetEntity="Acme\DemoBundle\Entity\Category", inversedBy="products")
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="Acme\DemoBundle\Entity\Mark",mappedBy="product",cascade={"all"}))
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
     * @ORM\OneToMany(targetEntity="Acme\DemoBundle\Entity\Comment",mappedBy="product",cascade={"all"}))
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
}
