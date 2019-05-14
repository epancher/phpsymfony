<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementsRepository;
use App\Entity\Evenements;
use Doctrine\Common\Persistence\ObjectManager;

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

    public function index(EvenementsRepository $repository) : Response
    {
        
        /*$evenement = new Evenements();
        $evenement->setTitreEvnmt('Johnny Halliday Tribute Festival')
                  ->setTxtEvnmt('texte')
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
        
        $evenements = $repository->findAll();
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
    public function show(Evenements $evenement, string $slug): Response
    {
        if($evenement->getSlug() !== $slug){
           return  $this->redirectToRoute('show', [
                'id' => $evenement->getId(),
                'slug' => $evenement->getSlug()
            ], 301);
        }
        return $this->render('pages/show.html.twig', [
            'evenement' => $evenement,
            'current_menu' => 'evenement'
        ]);
    }

}