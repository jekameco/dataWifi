<?php

namespace App\Controller;

use App\Entity\Calificaciones;
use App\Form\CalificacionesType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalificacionesController extends AbstractController
{
    /**
     * @Route("/calificaciones", name="app_calificaciones")
     */
    public function getCalificaciones(EntityManagerInterface $entityManager)
    {
        $listCalificaciones = $entityManager->getRepository(Calificaciones::class)->findAll();

        $estudiante = new Calificaciones();
        $form_calificacion = $this->createForm(CalificacionesType::class,$estudiante);


        return $this->render(
            'calificaciones/calificaciones.html.twig',
            array('listCalificaciones' => $listCalificaciones,'form_calificacion' => $form_calificacion->createView())
        );
    }

    /**
     * @Route("/calificacion/create", name="app_crear_calificacion")
     */

     public function createCalificacion(Request $request, EntityManagerInterface $entityManager)
     {
        $calificacion = new Calificaciones();
        //$nombre = $data['NombreEstudiante'];
        $date = new \DateTime('2018-05-09');
        $data = $request->request->all();

        $calificacion->setNombreEstudiante($data['calificaciones']['NombreEstudiante']);
        $calificacion->setNombreMateria($data['calificaciones']['NombreMateria']);
        $calificacion->setCalificacionFinal($data['calificaciones']['CalificacionFinal']);
        
        // Construir la fecha con los valores recibidos
        $fechaRegistro = new \DateTime();
        /*$fechaRegistro->setDate(
            $data['calificaciones']['FechaRegistro']['year'],
            $data['calificaciones']['FechaRegistro']['month'],
            $data['calificaciones']['FechaRegistro']['day']
        );*/
        $calificacion->setFecharegistro($fechaRegistro);
        
        $responseJson = ['response'=>'error','info' => 'Hubo un error','prueba' => $data ];
        
        
        $entityManager->persist($calificacion);
        $entityManager->flush();
        $responseJson['response']  = 'success';
        $responseJson['info']  = 'insertado correctamente';
        $responseJson['info']  = $data['calificaciones']['NombreEstudiante'];
        
        return new JsonResponse($responseJson); 
     }
}
