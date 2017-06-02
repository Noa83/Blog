<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('Contact/contact.html.twig');
    }
}
