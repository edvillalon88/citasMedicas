<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/tmpls/{page}", name="calendar")
     */
    public function index($page)
    {
        return $this->render('tmpls/'.$page, [
            'controller_name' => 'CalendarController',
        ]);
    }
}
