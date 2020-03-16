<?php

namespace App\Controller;

use App\Entity\Paciente;
use App\Form\PacienteType;
use App\Repository\PacienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/paciente")
 */
class PacienteController extends AbstractController
{
    /**
     * @Route("/", name="paciente_index", methods={"GET"})
     */
    public function index(PacienteRepository $pacienteRepository): Response
    {
        return $this->render('paciente/index.html.twig', [
            'pacientes' => $pacienteRepository->findAll(),
        ]);
    }
    private function validateTelefono($form, Paciente $paciente, $pacienteRepository){
       
        $result = $pacienteRepository->findBy(['telefono'=>$paciente->getTelefono()]);
        $error = false;
        for($i = 0; $i < count($result); $i++){
            if($result[$i]->getId() != $paciente->getId()){
                $error = true;
            }

        }
        if($error)
            $form->get('telefono')->addError(new FormError("Ya existe un paciente con este telefono"));
        
        return $form;
    }
    private function validateCorreo($form, Paciente $paciente, $pacienteRepository){
        if(empty($paciente->getCorreo()))
            return $form;
        $result = $pacienteRepository->findBy(['correo'=>$paciente->getCorreo()]);
        $error = false;
        for($i = 0; $i < count($result); $i++){
            if($result[$i]->getId() != $paciente->getId()){
                $error = true;
            }
        }
        if($error)
            $form->get('email')->addError(new FormError("Ya existe un paciente con este correo"));
        
        return $form;
    }
    /**
     * @Route("/new", name="paciente_new", methods={"GET","POST"})
     */
    public function new(Request $request,PacienteRepository $pacienteRepository): Response
    {
        $paciente = new Paciente();
        $form = $this->createForm(PacienteType::class, $paciente);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $form = $this->validateCorreo($form, $paciente, $pacienteRepository);
            $form = $this->validateTelefono($form, $paciente, $pacienteRepository);
            if($form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($paciente);
                $entityManager->flush();
    
                return $this->redirectToRoute('paciente_index');
            }
            
        }

        return $this->render('paciente/new.html.twig', [
            'paciente' => $paciente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paciente_show", methods={"GET"})
     */
    public function show(Paciente $paciente): Response
    {
        return $this->render('paciente/show.html.twig', [
            'paciente' => $paciente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="paciente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Paciente $paciente,PacienteRepository $pacienteRepository): Response
    {
        $form = $this->createForm(PacienteType::class, $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {            
            $form = $this->validateCorreo($form, $paciente, $pacienteRepository);
            $form = $this->validateTelefono($form, $paciente, $pacienteRepository);
            if($form->isValid()){
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('paciente_index');
            }
            
        }

        return $this->render('paciente/edit.html.twig', [
            'paciente' => $paciente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paciente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Paciente $paciente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paciente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paciente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('paciente_index');
    }
}
