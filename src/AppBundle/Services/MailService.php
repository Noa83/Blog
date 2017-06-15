<?php

namespace AppBundle\Services;


use AppBundle\Model\ContactModel;

class MailService
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendContactMail(ContactModel $contactForm)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Demande de Contact')
            ->setFrom($contactForm->email)
            ->setTo('audrey.bc83@gmail.com')
            ->setContentType('text/html')
            ->setBody(
                $this->twig->render('Contact\mail.html.twig', array('contactForm' => $contactForm))
            );
        $this->mailer->send($message);
    }
}
