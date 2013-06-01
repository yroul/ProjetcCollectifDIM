<?php

namespace HGR\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
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
    public function __construct()
    {
        
        $this->marks = new ArrayCollection();
       
        
    }
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="HGR\EntityBundle\Entity\Category", inversedBy="products",cascade={"persist"})
     */
    protected $category;
    /**
     *
     * @var type 
     * @ORM\Column(name="origin", nullable=true, type="string", length=255)
     */
    protected $origin;
    /**
     * @ORM\Column(name="brand", nullable=true, type="string", length=255)
     * @Assert\NotBlank()
     * @var type 
     */
    protected $brand;
    
    /**
     *@ORM\Column(name="tags",nullable=true, type="string", length=255)
     * @var type 
     */
    protected $tags;
    /**
     * @ORM\Column(name="imageURL", nullable=true, type="string", length=255)
     * @var type 
     */
    protected $imageURL;
    /**
     * @ORM\Column(name="attributes",  nullable=true, type="string", length=255)
     */
    protected $attributes;
    /**
     * @var Float
     * @Assert\NotBlank()
     * @ORM\Column(name="price", type="float")
     */
    private $price;
   
    
    public function getPrice() {
        
        return $this->price;
    }

    public function setPrice($price) {
        if($price < 0){
            throw new InvalidArgumentException("Price cannot be < 0");
        }
        else{
            $this->price = $price;
        }
    }

        /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="HGR\EntityBundle\Entity\Mark",mappedBy="product",cascade={"all"}))
     *
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



    /**
     * Set origin
     *
     * @param string $origin
     * @return Product
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set brand
     *
     * @param string $brand
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Product
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        
        return $this->tags;
    }

    /**
     * Set imageURL
     *
     * @param string $imageURL
     * @return Product
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;

        return $this;
    }

    /**
     * Get imageURL
     *
     * @return string 
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * Remove marks
     *
     * @param \HGR\EntityBundle\Entity\Mark $marks
     */
    public function removeMark(\HGR\EntityBundle\Entity\Mark $marks)
    {
        $this->marks->removeElement($marks);
    }

    /**
     * Remove comments
     *
     * @param \HGR\EntityBundle\Entity\Comment $comments
     */
    public function removeComment(\HGR\EntityBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set attributes
     *
     * @param string $attributes
     * @return Product
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get attributes
     *
     * @return string 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
