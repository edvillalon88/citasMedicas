<?php

namespace App\Controller;

use App\Entity\EnumEstado;
use App\Repository\CitaRepository;
use App\Repository\EstadoCitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReporteEconomicoController extends AbstractController
{
    /**
     * @Route("/reporte", name="reporte_economico")
     */
    public function index(CitaRepository $citaRepository, EstadoCitaRepository $estadoRepository)
    {
        $years = $this->poblateYears(); 
        $months = $this->poblateMonth();
        $days = $this->poblateDay();
        $estado = $estadoRepository->findOneBy(['nombre'=>EnumEstado::REALIZADA]);
        $data = $citaRepository->reporteEconomico($years, $months, $days, $estado);
        //poblate years
        return $this->render('reporte_economico/index.html.twig', [
            'data' => $data
        ]);
    }
    private function poblateYears(){
        $data = [];
        $min = 2018;
        $max = 2050;
        for($i = $min; $i <= $max; $i++){
            array_push($data, $i);
        }
        return $data;
    }
    private function poblateMonth(){
        $data = [];
        $min = 1;
        $max = 12;
        for($i = $min; $i <= $max; $i++){
            array_push($data, $i);
        }
        return $data;
    }
    private function poblateDay(){
        $data = [];
        $min = 1;
        $max = 31;
        for($i = $min; $i <= $max; $i++){
            array_push($data, $i);
        }
        return $data;
    }
}
