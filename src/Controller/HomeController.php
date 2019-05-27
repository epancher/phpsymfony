<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementsRepository;
use App\Entity\Emplacement;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class HomeController extends AbstractController{

/**
 * @Route("/", name="index")
 * @param EvenementsRepository $repository
 * @return Response
 */
 
    public function index(EvenementsRepository $repository) : Response
    {
        $evenements = $repository->findLatest();
        $emplacement = new Emplacement();
        dump($evenements);
        return $this->render('pages/home.html.twig', [
            'evenements' => $evenements,
            'emplacement' => $emplacement
        ]);



        $builder->add('isAttending', ChoiceType::class, [
            'choices'  => [
                'Maybe' => null,
                'Yes' => true,
                'No' => false,
            ],
        ]);

    }
}