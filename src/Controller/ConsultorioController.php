<?php

namespace App\Controller;

use App\Entity\Consultorio;
use App\Form\ConsultorioType;
use App\Repository\ConsultorioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/consultorio")
 */
class ConsultorioController extends AbstractController
{
    /**
     * @Route("/", name="consultorio_index", methods={"GET"})
     */
    public function index(ConsultorioRepository $consultorioRepository): Response
    {
        return $this->render('consultorio/index.html.twig', [
            'consultorios' => $consultorioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="consultorio_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $consultorio = new Consultorio();
        $form = $this->createForm(ConsultorioType::class, $consultorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultorio);
            $entityManager->flush();

            return $this->redirectToRoute('consultorio_index');
        }

        return $this->render('consultorio/new.html.twig', [
            'consultorio' => $consultorio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consultorio_show", methods={"GET"})
     */
    public function show(Consultorio $consultorio): Response
    {
        return $this->render('consultorio/show.html.twig', [
            'consultorio' => $consultorio,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="consultorio_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Consultorio $consultorio): Response
    {
        $form = $this->createForm(ConsultorioType::class, $consultorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consultorio_index');
        }

        return $this->render('consultorio/edit.html.twig', [
            'consultorio' => $consultorio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consultorio_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Consultorio $consultorio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultorio->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consultorio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('consultorio_index');
    }
}
