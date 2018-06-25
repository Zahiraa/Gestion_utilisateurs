<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AdminFixtures implements FixtureInterface, ContainerAwareInterface 
{
  
 public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function load(ObjectManager $manager)
    {
       
        $userManager = $this->container->get('fos_user.user_manager');

       
        $user = $userManager->createUser();
        $user->setUsername('benjamin');
        $user->setEmail('benjamin@domain.com');
        $user->setPlainPassword('benjamin');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));

        // Update the user
        $userManager->updateUser($user, true);
    }
}

?>