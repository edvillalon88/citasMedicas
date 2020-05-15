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
    /**
     * @Route("/_ajax", name="paciente_index_ajax", methods={"GET"})
     */
    public function _index(PacienteRepository $pacienteRepository): Response
    {
        $pacientes = $pacienteRepository->findAll();
        $list = array();
        foreach ($pacientes as $paciente) {

            $list[] = ['id'=>$paciente->getId(), 'text'=>$paciente->getNombre().' '.$paciente->getApellidos()." - ".$paciente->getTelefono()];
        }
        $response = new Response();
        $response->setContent(json_encode($list));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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
            $form->get('correo')->addError(new FormError("Ya existe un paciente con este correo"));
        
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
     * @Route("/_new", name="paciente_new_ajax", methods={"POST"})
     */
    public function _new(Request $request,PacienteRepository $pacienteRepository): Response
    {
        $paciente = new Paciente();
        $form = $this->createForm(PacienteType::class, $paciente);
        $form->handleRequest($request);
        
        $data_encode;
        if ($form->isSubmitted()) {
            $form = $this->validateCorreo($form, $paciente, $pacienteRepository);
            $form = $this->validateTelefono($form, $paciente, $pacienteRepository);
            if($form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($paciente);
                $entityManager->flush();
                $data_encode = ['correct'=>true];
            }else{
                $errors = array();
                foreach ($form->getErrors(true, false) as $error) {
                    $errors[] = $error->current()->getMessage();
                }
                $data_encode = [
                    'correct'=>false,
                    'errors'=>$errors,
                    
                ];
            }
            
        }

        /*return $this->render('paciente/new.html.twig', [
            'paciente' => $paciente,
            'form' => $form->createView(),
        ]);*/
        $response = new Response();
        $response->setContent(json_encode($data_encode));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * @Route("/buscar", name="paciente_search", methods={"POST"})
     */
    public function buscarPacientes(Request $request,PacienteRepository $pacienteRepository): Response
    {
        $criterio = $request->request->get('criterio');
        $data = $pacienteRepository->searchPaciente($criterio);

        return $this->render('paciente/index.html.twig', [
            'pacientes' => $data,
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
