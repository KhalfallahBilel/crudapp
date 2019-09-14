<?php
namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController {

    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/Clients",name="client.index")
     * @return Response
     */
    public function index():Response{
        /*$client = new Client();
        $client->setSiret('123456789zzz')
               ->setCompanyName('sii')
               ->setAddress('219 rue albert caquot valbonne')
               ->setTel('123245')
            ->setFax('125487')
            ->setManager('thierry')
            ->setApeCode('1254klhg')
            ->setActivity('Société de service informatique')
            ->setDescription('lorum ipsum');
        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();*/
        $this->repository->findAll();
        return $this->render('clients/index.html.twig',[
            'current_menu' => 'clients'
        ]);
    }
}