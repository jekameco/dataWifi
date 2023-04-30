<?php

namespace App\Controller;

use App\Entity\Materias;
use App\Form\MateriasType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class MateriasController extends AbstractController
{
    /**
     * @Route("/materias", name="app_materias")
     */
    public function getMaterias(EntityManagerInterface $entityManager)
    { 
        $listMaterias = $entityManager->getRepository(Materias::class)->findAll();

        $materia = new Materias();
        $form_materias = $this->createForm(MateriasType::class,$materia);


        return $this->render(
            'materias/materias.html.twig',
            array('listMaterias' => $listMaterias,'form_materias' => $form_materias->createView())
        );
    }

    /**
     * @Route("/materia/create", name="app_crear_materia")
     */
    public function createMaterias(Request $request, EntityManagerInterface $entityManager)
    { 

        $serach = $request->get('values');
        $materia = new Materias();
        $form_materias = $this->createForm(MateriasType::class,$materia);
        $form_materias->handleRequest($request);

        $responseJson = ['response'=>'error','info' => 'Hubo un error'];

        if($form_materias->isSubmitted() && $form_materias->isValid()){
            
            $entityManager->persist($materia);
            $entityManager->flush();
            $responseJson['response']  = 'success';
            $responseJson['info']  = 'insertado correctamente';
        }

        return new JsonResponse($responseJson);
    }
}
