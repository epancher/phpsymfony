<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\EvenementsRepository;
use App\Entity\Evenements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EvenementsType;
use Doctrine\Common\Persistence\ObjectManager;

class AdminEvenementController extends AbstractController
{
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
     * @Route("/admin", name="admin.evenement.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EvenementsRepository $repository)
    {
        $evenements =  $repository->findAll();
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/admin/evenement/create", name="admin.evenement.new")
     */
    public function new(Request $request)
    {
        $evenement = new Evenements();
        $form = $this->createForm(EvenementsType::class, $evenement);   
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) // est-ce que le formulaire a été envoyé? Et est-ce qu'il est valide?
        {
            $this->em->persist($evenement);
            $this->em->flush();
            $this->addFlash('success', 'Création d\'un évènement effectuée avec succès');
            return $this->redirectToRoute('admin.evenement.index');
        }
        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView() // pour envoyer le formulaire à la vue, il faut passer par un createView pour créer un objet de type vue
        ]);
    }

    /**
     * @Route("/admin/evenement/{id}", name="admin.evenement.edit", methods="GET|POST")
     * @param Evenements $evenement
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Evenements $evenement, Request $request)
    {
        // le second paramètre de createForm correspond aux données, ce peut être un tableau ou, ici, un objet
        $form = $this->createForm(EvenementsType::class, $evenement);
        $form->handleRequest($request);    // pour gérer la requête

        if ($form->isSubmitted() && $form->isValid()) // est-ce que le formulaire a été envoyé? Et est-ce qu'il est valide?
            {
                $this->em->flush();
                $this->addFlash('success', 'Modification effectuée avec succès');
                return $this->redirectToRoute('admin.evenement.index');
            }
        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView() // pour envoyer le formulaire à la vue, il faut passer par un createView pour créer un objet de type vue
        ]);
    }

    /**
     * @Route("/admin/evenement/{id}", name="admin.evenement.delete", methods="DELETE")
     * @param Evenements $evenement
     * return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Evenements $evenement, Request $request){
        if ($this->isCsrfTokenValid('delete' . $evenement->getId(), $request->get('_token'))){
            $this->em->remove($evenement);
            $this->em->flush();
            $this->addFlash('success', 'Suppression effectuée avec succès');
        }
        return $this->redirectToRoute('admin.evenement.index');
    }
}
