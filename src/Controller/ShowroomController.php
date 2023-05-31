<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarType;
use Symfony\Component\HttpFoundation\Request;
class ShowroomController extends AbstractController
{
    #[Route('/showroom', name: 'app_showroom')]
    public function index(): Response
    {
        return $this->render('showroom/index.html.twig', [
            'controller_name' => 'ShowroomController',
        ]);
    }

    #[Route('/list', name: 'app_list')]
    public function list(CarRepository $carsrepo): Response
    {
        $cars=$carsrepo->findAll();
        return $this->render('showroom/list.html.twig', [
           'show' => $cars,
        ]);
    }

    #[Route('/list/{nce}', name: 'app_list_id')]
    public function getById(CarRepository $carsrepo , $nce): Response
    {
        $car[]=$carsrepo->find($nce);
        return $this->render('showroom/details.html.twig', [
           'showById' => $car,
        ]);
    }

    #[Route('/add', name: 'app_showroom')]
    public function add(Request $req, CarRepository $carrepo): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $carrepo->save($car, true);
            return $this->redirectToRoute('app_list');
        }
        return $this->renderForm('showroom/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/update/{nce}', name: 'app_update')]
    public function update(Request $req, CarRepository $carsrepo,$nce): Response
    {
        $carfind=$carsrepo->find($nce);
        $form = $this->createForm(CarType::class,$carfind);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $carsrepo->save($carfind, true);
            return $this->redirectToRoute('app_list');
        }
        return $this->renderForm('showroom/update.html.twig', [
            'form' => $form,

        ]);
    }
    #[Route('/delete/{nce}', name: 'app_delete')]
    public function delete(CarRepository $carsrepo,$nce): Response
    {
        $cardelete=$carsrepo->find($nce);
        $carsrepo->remove($cardelete, true);
        return $this->redirectToRoute('app_list');
        }
    
}
