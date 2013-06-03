<?php

namespace HGR\EntityBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function __construct() {
        
        $this->products = new ArrayCollection();
    }
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="HGR\EntityBundle\Entity\Product", mappedBy="category")
     */
    private $products;
    

    /**
     * @var string
     *
     * @ORM\Column(name="imageURL", nullable=true,type="string", length=255)
     */
    private $imageURL;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    
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
     * @return Category
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

    

    /**
     * Set imageURL
     *
     * @param string $imageURL
     * @return Category
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;
    
        
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
    public function __toString() {
        return $this->getName();
    }
    
     public function getAbsolutePath()
    {
        return null === $this->imageURL ? null : $this->getUploadRootDir().'/'.$this->imageURL;
    }

    public function getWebPath()
    {
        return null === $this->imageURL ? null : $this->getUploadDir().'/'.$this->imageURL;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/images';
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            try{
                $ext = $this->file->guessExtension();
            } catch (Exception $e) {
                $expl = explode('.', $this->file->getName());
                
                if (is_array($expl) && count($expl) > 0)
                    $ext  = $expl[count($expl)];
                else
                    $ext = 'txt';
            }
            $this->imageURL = sha1(uniqid(mt_rand(), true)).'.'.$ext;  
        }
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->imageURL);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
}
