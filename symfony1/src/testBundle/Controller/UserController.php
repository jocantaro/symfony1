<?php

namespace testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('testBundle:Default:userindex.html.twig');
    }


    public function articlesAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }
}