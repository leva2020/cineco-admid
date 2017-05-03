<?php

namespace PqrsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/home-pqrs", name="home_pqrs")
     */
    public function indexAction($name)
    {
        return $this->render('PqrsBundle:views:Default:index.html.twig', array('name' => $name));
    }
}
