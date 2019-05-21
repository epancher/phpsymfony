<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementsRepository;
use App\Entity\Evenements;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Entity\Contact;
use App\Notification\ContactNotification;

class EvenementsController extends AbstractController{


 /**
 * @var EvenementsRepository
 */
private $repository;

 /**
  * @var ObjectManager
  */
private $em;
    
    public function __construct(EvenementsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
 

/**
 * @Route("/evenements", name="evenements")
 * @return Response
 */

    public function index(PaginatorInterface $paginator, Request $request) : Response
    {
        
        /*$evenement = new Evenements();
        $evenement->setTitreEvnmt('Festival de la Groseille')
                  ->setTxtEvnmt('Venez nombreux assister aux évènements internationaux liés à la groseille')
                  ->setDateEvnmt(new \DateTime('now'))
                  ->setHeureEvnmt(null);
        $em = $this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();*/
        
        /*$repository = $this->getDoctrine()->getRepository(Evenements::class);
        dump($repository);*/

        /*
        $evenement = $this->repository->findAllVisible();
        $evenement[0]->setTitreEvnmt('Lolilol');
        $this->em->flush();
        dump($evenement);*/
        
        $evenements = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1), 12
        );
        return $this->render('pages/evenements.html.twig', [
            'evenements' => $evenements,
            'current_menu' => 'properties'
        ]);
    }

 /**
 * @Route("/evenements/{slug}-{id}", name="show", requirements={"slug": "[a-z0-9\-]*"})
 * @param Evenements $evenement
 * @return Response
 */
    public function show(Evenements $evenement, string $slug, Request $request, ContactNotification $notification): Response
    {
        if($evenement->getSlug() !== $slug){
           return  $this->redirectToRoute('show', [
                'id' => $evenement->getId(),
                'slug' => $evenement->getSlug()
            ], 301);
        }

        $contact = new Contact();
        $contact->setEvenement($evenement);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('show', [
                'id' => $evenement->getId(),
                'slug' => $evenement->getSlug()
            ]);
        }

        return $this->render('pages/show.html.twig', [
            'evenement' => $evenement,
            'current_menu' => 'evenement',
            'form' => $form->createView()
        ]);
    }

}