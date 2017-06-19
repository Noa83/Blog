<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Model\ContactModel;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ContactType;


class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request)
    {
        $contactModel = new ContactModel();
        $form = $this->get('form.factory')->create(ContactType::class, $contactModel);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->get('mail')->sendContactMail($contactModel);
                $this->addFlash('info', 'Votre message a bien été envoyé.');
                return $this->redirectToRoute('contact');
        }
        return $this->render('Contact/contact.html.twig', array('contactForm' => $form->createView()));
    }
}
