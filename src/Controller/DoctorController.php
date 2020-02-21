<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Form\EditDoctorType;
use App\Repository\DoctorRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/doctor")
 */
class DoctorController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="doctor_index", methods={"GET"})
     */
    public function index(DoctorRepository $doctorRepository): Response
    {
        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }

    private function validEmail($form, $entity, $doctorRepository){
        $result = $doctorRepository->findOneBy(['email'=>$entity->getEmail()]);

        if(!empty($result))
            $form->get('email')->addError(new FormError("La direccion de correo ".$entity->getEmail()." ya existe"));
        
        return $form;
    }
    private function validUsuario($form, $entity, $userRepository){
        $result = $userRepository->findOneBy(['username'=>$entity->getUserName()]);

        if(!empty($result))
            $form->get('usuario')->get('username')->addError(new FormError("El usuario ".$entity->getUserName()." ya existe"));
        
        return $form;
    }
    /**
     * @Route("/new", name="doctor_new", methods={"GET","POST"})
     */
    public function new(Request $request, DoctorRepository $doctorRepository, UserRepository $userRepository): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $form = $this->validEmail($form,$doctor, $doctorRepository);
            $form = $this->validUsuario($form,$doctor->getUsuario(), $userRepository);
            if ($form->isValid()) {
                $doctor->getUsuario()->setRoles(['DOCTOR']);
                $doctor->getUsuario()->setPassword($this->passwordEncoder->encodePassword(
                    $doctor->getUsuario(),
                    $doctor->getUsuario()->getPassword()
                ));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($doctor);
                $entityManager->flush();
    
                return $this->redirectToRoute('doctor_index');
            }
        }

        return $this->render('doctor/new.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctor_show", methods={"GET"})
     */
    public function show(Doctor $doctor): Response
    {
        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="doctor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Doctor $doctor, DoctorRepository $doctorRepository): Response
    {
        $form = $this->createForm(EditDoctorType::class, $doctor);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $form = $this->validEmail($form, $doctor, $doctorRepository);
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('doctor_index');
            }
        }
        

        return $this->render('doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Doctor $doctor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doctor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('doctor_index');
    }
}
