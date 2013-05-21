<?php 
namespace Acme\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HelloBundle\Entity\User;
use \Doctrine\Common\DataFixtures\AbstractFixture as AbstractFixture;
class LoadUserData extends AbstractFixture implements \Doctrine\Common\DataFixtures\OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //do some logic
        //ajouter cet objet en objet global
       // $this->addReference("le nom de mon objet", $object);
        //recuperer objet global
        //$objet = $this->getReference("le nom de mon objet");
    }

    public function getOrder() {
        return 1;
    }
}