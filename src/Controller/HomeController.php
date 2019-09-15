<?php
namespace  App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/",name="home.index")
     * @return Response
     */
    public function index():Response{
        $clients = $this->repository->findAll();
        return $this->render('page/home.html.twig',[
            'clients'=> $clients
        ]);
    }
}