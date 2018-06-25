<?php
namespace GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GestionBundle\Entity\utilisateurs;

class utilisateursFixture extends AbstractFixture implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new utilisateurs();
        $user1->setNom('Catelain');
        $user1->setPrenom('Benjamin');
        $user1->setEmail('76600@exemple.com');
        $user1->setDateNaissance(new \DateTime('06/04/1990'));
        $user1->setTelephone('0600000000');
        $manager->persist($user1);
        
        $user2 = new utilisateurs();
        $user2->setNom('Catelain');
        $user2->setPrenom('Nicol');
        $user2->setEmail('1200@exemple.com');
        $user2->setDateNaissance(new \DateTime('06/04/1999'));
        $user2->setTelephone('0600000000');
        $manager->persist($user2);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}