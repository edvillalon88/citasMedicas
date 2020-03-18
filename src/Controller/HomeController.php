<?php

namespace App\Controller;

use App\Entity\EnumEstado;
use App\Form\CitaType;
use App\Repository\CitaRepository;
use App\Repository\EstadoCitaRepository;
use App\Repository\TipoCitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CitaRepository $cita, TipoCitaRepository $tipos, EstadoCitaRepository $estadoRespository)
    {
        $pendiente = $estadoRespository->findOneBy(['nombre'=>EnumEstado::PENDIENTE]);
        $realizada = $estadoRespository->findOneBy(['nombre'=>EnumEstado::REALIZADA]);
        $cancelada = $estadoRespository->findOneBy(['nombre'=>EnumEstado::CANCELADA]);
        $consulta = $tipos->findOneBy(['nombre'=>'Consulta']);
        $rev = $tipos->findOneBy(['nombre'=>'Revision']);
        //resume economico por citas realizadas
        $citas_consultas = $cita->getCitasTodayByType($consulta,$realizada);
        $citas_rev = $cita->getCitasTodayByType($rev, $realizada);        
        $countConsulta = count($citas_consultas);
        $countRev = count($citas_rev);
        $total = ($countConsulta * $consulta->getPrecio())+($countRev * $rev->getPrecio());
        //resumen
        $citas = $cita->findBy(['estado'=>$pendiente]);
        $citasCanceladas = count($cita->findBy(['estado'=>$cancelada]));
        $citasRealizadas = count($cita->findBy(['estado'=>$realizada]));
        $pendientes = count($citas);
        
        return $this->render('home/index.html.twig', [
            'data'=>$citas,
            'consultas'=>$countConsulta,
            'reviciones'=>$countRev,
            'totalMoney'=>$total,
            'cancelas'=>$citasCanceladas,
            'realizadas'=>$citasRealizadas,
            'pendientes'=>$pendientes,
            'controller_name' => 'HomeController',
        ]);
    }
}
