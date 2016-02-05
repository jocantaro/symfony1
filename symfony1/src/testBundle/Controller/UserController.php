<?php

namespace testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();


        $users = $em->getRepository('testBundle:Users')->findAll();


        return $this->render('testBundle:Default:userindex.html.twig', array ('users'=>$users));
    }


    public function articlesAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function addAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function editAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function deleteAction ($page){

        return $this->render('testBundle:Default:userarticles.html.twig', array ('page'=>$page) );

    }

    public function viewAction ($id){

        $repository = $this->getDoctrine()->getRepository('testBundle:Users');

        //$user = $repository->find($id);
        $user = $repository->findOneBy(array('id'=>$id));

        return $this->render('testBundle:Default:userview.html.twig', array ('user'=>$user) );

    }

}