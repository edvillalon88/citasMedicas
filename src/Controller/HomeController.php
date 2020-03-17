<?php

namespace App\Controller;

use App\Form\CitaType;
use App\Repository\CitaRepository;
use App\Repository\TipoCitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CitaRepository $cita, TipoCitaRepository $tipos)
    {
        $consulta = $tipos->findOneBy(['nombre'=>'Consulta']);
        $rev = $tipos->findOneBy(['nombre'=>'Revision']);
        $citas_consultas = $cita->getCitasTodayByType($consulta);
        $citas_rev = $cita->getCitasTodayByType($rev);
        $countConsulta = count($citas_consultas);
        $countRev = count($citas_rev);
        $total = ($countConsulta * $consulta->getPrecio())+($countRev * $rev->getPrecio());
        $citas = $cita->findAll();
        
        return $this->render('home/index.html.twig', [
            'data'=>$citas,
            'consultas'=>$countConsulta,
            'reviciones'=>$countRev,
            'totalMoney'=>$total,
            'controller_name' => 'HomeController',
        ]);
    }
}
