<?php

namespace App\Controller;

use App\Form\DivisaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DivisasController extends AbstractController
{
    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
    }
    /**
     * @Route("/divisas", name="app_divisas")
     */
    public function getDivisa(Request $request): Response
    {

        $form = $this->createForm(DivisaType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // procesar los datos del formulario
            $formData = $form->getData();
            // ...
        }

        
        return $this->render('divisas/divisas.html.twig', [
            'form_divisa' => $form->createView(),
        ]);
        
    }
}
