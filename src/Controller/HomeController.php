<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementsRepository;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/setlocale/{language}", name="setlocale")
     */
    public function setLocaleAction(Request $request, $language = null) // cette fonction vient de https://openclassrooms.com/forum/sujet/symfony-setlocale-langue?page=1
    {                                                                   // c'est le listener de notre traduction
        if($language != null)
        {$this->get('session')->set('_locale', $language);}
    
        $url = $request->headers->get('referer');   

        if(empty($url))
        {$url = $this->container->get('router')->generate('index');}

        return $this->redirect($url);
    }
}