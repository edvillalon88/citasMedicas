<?php

namespace App\Controller;

use App\Entity\Secretaria;
use App\Form\SecretariaType;
use App\Repository\DoctorRepository;
use App\Repository\SecretariaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/secretaria")
 */
class SecretariaController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="secretaria_index", methods={"GET"})
     */
    public function index(SecretariaRepository $secretariaRepository): Response
    {
        return $this->render('secretaria/index.html.twig', [
            'secretarias' => $secretariaRepository->findAll(),
            'error'=>''
        ]);
    }
    private function validUsuario($form, $entity, $userRepository){
        $result = $userRepository->findOneBy(['username'=>$entity->getUserName()]);

        if(!empty($result))
            $form->get('usuario')->get('username')->addError(new FormError("El usuario ".$entity->getUserName()." ya existe"));
        
        return $form;
    }
    /**
     * @Route("/new", name="secretaria_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $secretarium = new Secretaria();
        $form = $this->createForm(SecretariaType::class, $secretarium);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $form = $this->validUsuario($form, $secretarium->getUsuario(), $userRepository);
            if($form->isValid()){
                $secretarium->getUsuario()->setRoles(['ROLE_SECRETARIA']);
                $secretarium->getUsuario()->setPassword($this->passwordEncoder->encodePassword(
                    $secretarium->getUsuario(),
                    $secretarium->getUsuario()->getPassword()
                ));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($secretarium);
                $entityManager->flush();
    
                return $this->redirectToRoute('secretaria_index');
            }
            
        }

        return $this->render('secretaria/new.html.twig', [
            'secretarium' => $secretarium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secretaria_show", methods={"GET"})
     */
    public function show(Secretaria $secretarium): Response
    {
        return $this->render('secretaria/show.html.twig', [
            'secretarium' => $secretarium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="secretaria_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Secretaria $secretarium): Response
    {
        $form = $this->createForm(SecretariaType::class, $secretarium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secretaria_index');
        }

        return $this->render('secretaria/edit.html.twig', [
            'secretarium' => $secretarium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secretaria_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Secretaria $secretarium, DoctorRepository $doctorRepository, SecretariaRepository $secretariaRepository): Response
    {
        $doctor = $doctorRepository->findOneBy(['secretaria'=>$secretarium]);
        $error = '';
        if(empty($doctor)){
            $secretaria = $secretariaRepository->find($secretarium->getId());
            if (!empty($secretaria) && $this->isCsrfTokenValid('delete'.$secretarium->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($secretarium);
                $entityManager->flush();
            }else{
                $error = 'Esta secretaria ya no exist en el sistema';    
            }            
        }else{
            $error = 'Esta secretaria tiene un doctor asignado';
        }
         
        
        if(empty($error)){
            return $this->redirectToRoute('secretaria_index');
        }else{
            return $this->render('secretaria/index.html.twig', [
                'secretarias' => $secretariaRepository->findAll(),
                'error'=>$error
            ]);
        }
        
    }
}
