<?php

namespace App\Controller;

use App\Entity\Cita;
use App\Entity\Paciente;
use App\Form\CitaType;
use App\Repository\CitaRepository;
use App\Repository\ConsultorioRepository;
use App\Repository\PacienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitasController extends AbstractController
{
    /**
     * @Route("/citas", name="citas_index")
     */
    public function index(CitaRepository $citaRepository): Response
    {
        return $this->render('citas/index.html.twig', [
            'citas' => $citaRepository->findAll(),
        ]);
    }
    /**
     * @Route("/citas/detalle/{id}", name="citas_detail")
     */
    public function detalle(Request $requiest, $id, CitaRepository $citaRepository)
    {
        $cita = $citaRepository->find($id);
        return $this->render('citas/detail.html.twig', [
            'cita' => $cita,
        ]);
    }
    
    private function validateDate($form,Cita $cita, $citaRepository){
        $fechaHora = $cita->getFechaHora();
        $cita = $citaRepository->findOneBy(['fechaHora'=>$fechaHora]);
        $now = new \DateTime();
        $_form = $form;
        if(!empty($cita))
            $_form->get('fechaHora')->addError(new FormError(" Ya existe una cita para esta fecha y hora "));
        if($now > $fechaHora)
            $_form->get('fechaHora')->addError(new FormError(" No pude crear una cita para un tiempo ya pasado "));
        return $_form;
    }
    /**
     * @Route("/citas/new", name="cita_new", methods={"GET","POST"})
     */
    public function new(Request $request, CitaRepository $citaRepository , PacienteRepository $pacienteRepository): Response
    {
        $cita= new Cita();
        $form = $this->createForm(CitaType::class, $cita);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $form = $this->validateDate($form, $cita, $citaRepository);
            if ($form->isValid()) { 
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cita);
                $entityManager->flush();
                return $this->redirectToRoute('home');
            }
        }
        

        return $this->render('citas/new.html.twig', [
            'cita' => $cita,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{id}/edit", name="cita_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cita $cita,CitaRepository $citaRepository ): Response
    {
        $form = $this->createForm(CitaType::class, $cita);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {            
            $form = $this->validateDate($form, $cita, $citaRepository);
            if($form->isValid()){
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('citas_index');
            }
            
        }

        return $this->render('citas/edit.html.twig', [
            'cita' => $cita,
            'form' => $form->createView(),
        ]);
    }
}
