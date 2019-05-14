<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementsRepository;

class HomeController extends AbstractController{

/**
 * @Route("/", name="index")
 * @param EvenementsRepository $repository
 * @return Response
 */
 
    public function index(EvenementsRepository $repository) : Response
    {
        $evenements = $repository->findLatest();
        dump($evenements);
        return $this->render('pages/home.html.twig', [
            'evenements' => $evenements
        ]);
    }
    
}