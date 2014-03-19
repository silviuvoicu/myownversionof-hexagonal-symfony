<?php

namespace SensioLabs\CeremonyTrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CeremonyTrackerBundle:Default:index.html.twig', array('name' => $name));
    }
}
