<?php
namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;
use Swift_Mailer;

class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;
    
    // $mailer permet d'envoyer un email et $renderer (composant twig) permet d'envoyer une vue html
    // ils permettent d'envoyer des mails plus sympas que le mail de base de symfony
    public function __construct(Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }
    
    // méthode qui permet d'envoyer les mails
    public function notify(Contact $contact)
    {
        // on génère un message via Swift_Message avec en sujet "Agence: "
        $message = (new \Swift_Message('Evénement: ' . $contact->getEvenement()->getTitreEvnmt()))
        ->setFrom('noreply@server.com')
        ->setTo('contact@agence.fr')
        ->setReplyTo($contact->getEmail())
        ->setBody($this->renderer->render('emails/contact.html.twig', [
            'contact' => $contact
        ]), 'text/html'); // ce body est au format text/html
        $this->mailer->send($message); 
    }
}