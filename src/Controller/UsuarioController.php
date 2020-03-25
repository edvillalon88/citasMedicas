<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditPassType;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsuarioController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/usuario", name="usuario")
     */
    public function index(UserRepository $userRepository)
    {

        return $this->render('usuario/index.html.twig', [
            'msg'=>'',
            'data'=>$userRepository->findAll(),
            'controller_name' => 'UsuarioController',
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('usuario/login.html.twig', [
            'controller_name' => 'UsuarioController',
        ]);
    }

    /**
     * @Route("/perfil/{id}", name="perfil_edit",methods={"GET","POST"})
     */
    public function editPerfil(Request $request, User $usuario)
    {
        $form = $this->createForm(UserEditType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {            
            if($form->isValid()){
                $this->getDoctrine()->getManager()->flush();
            }
            
        }

        return $this->render('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
       
    }

    /**
     * @Route("/usuario/reset/{id}", name="reset_pass",methods={"GET"})
     */
    public function resetPass(Request $request, User $usuario, UserRepository $userRepository)
    {
        $usuario->setPassword($this->passwordEncoder->encodePassword(
            $usuario,
            'CitasMedicas8801*'
        ));
        $this->getDoctrine()->getManager()->flush();

        return $this->render('usuario/index.html.twig', [
            'msg'=>'El password se ha reiniciado con exito',
            'data'=>$userRepository->findAll(),
            'controller_name' => 'UsuarioController',
        ]);
       
    }
    /**
     * @Route("/perfil/cambiarpass/{id}", name="pass_edit",methods={"GET","POST"})
     */
    public function editPass(Request $request, User $usuario)
    {
        $form = $this->createForm(UserEditPassType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {            
            if($form->isValid()){
                $usuario->setPassword($this->passwordEncoder->encodePassword(
                    $usuario,
                    $usuario->getPassword()
                ));
                $this->getDoctrine()->getManager()->flush();
            }
            
        }

        return $this->render('usuario/edit.pass.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
       
    }
}
