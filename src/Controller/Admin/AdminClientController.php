<?php
namespace App\Controller\Admin;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminClientController extends AbstractController{

    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $clients = $this->repository->findAll();
        $this->render('admin/client/index.html.twig', compact('clients'));
    }
}