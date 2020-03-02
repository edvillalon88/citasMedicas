<?php

namespace App\Controller;

use App\Repository\CitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CitaRepository $cita)
    {
        $citas = $cita->findAll();
        
        return $this->render('home/index.html.twig', [
            'data'=>$citas,
            'controller_name' => 'HomeController',
        ]);
    }
}
