<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('GestionBundle:Utilisateurs')->findAll();
       return $this->render('utilisateurs/index.html.twig', array(
            'utilisateurs' => $utilisateurs,
        ));
    }
}
