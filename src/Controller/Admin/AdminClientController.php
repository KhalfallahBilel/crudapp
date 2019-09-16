<?php
namespace App\Controller\Admin;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminClientController extends AbstractController{

    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ClientRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.client.index")
     * @return Response
     */
    public function index():Response{
        $clients = $this->repository->findAll();
        return $this->render('admin/client/index.html.twig',compact('clients'));
    }

    /**
     * @Route("/admin/client/create", name="admin.client.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request){
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($client);
            $this->em->flush();
            $this->addFlash('success','Client ajouter avec succés');
            return $this->redirectToRoute('admin.client.index');
        }
        return $this->render('admin/client/new.html.twig',[
            'client' => $client,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.client.edit",methods="GET|POST")
     * @param Client $client
     * @param Request $request
     * @return Response
     */
    public function edit(Client $client, Request $request){
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','Client éditer avec succés');
            return $this->redirectToRoute('admin.client.index');
        }
        return $this->render('admin/client/edit.html.twig',[
            'client' => $client,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.client.delete",methods="DELETE")
     * @param Client $client
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Client $client, Request $request){
        if($this->isCsrfTokenValid('delete' . $client->getId(), $request->get('_token'))){
            $this->em->remove($client);
            $this->em->flush();
            $this->addFlash('success','Client supprimer avec succés');
       }
        return $this->redirectToRoute('admin.client.index');
    }


}