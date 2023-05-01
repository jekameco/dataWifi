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


     /**
     * @Route("/calificacion/getData", name="app_actualizar_calificacion")
     */
    public function getDataCalificaciones(Request $request, EntityManagerInterface $entityManager)
    { 
        
        $id_update = $request->get('id_update');
        $listCalificacioness = $entityManager->getRepository(Calificaciones::class)->find($id_update);
        $CalificacionesArray = get_object_vars($listCalificacioness);

        $responseJson['response']  = 'success';
        $responseJson['info']  = 'datos correctamente';
        $responseJson['dataRow']  = array(
            'FechaRegistro' => $listCalificacioness->getFecharegistro(),
            'NombreEstudiante' => $listCalificacioness->getNombreestudiante(),
            'NombreMateria' => $listCalificacioness->getNombremateria(),
            'CalificacionFinal' => $listCalificacioness->getCalificacionfinal(),
        );

        return new JsonResponse($responseJson);
    }

    /**
     * @Route("/calificacion/update", name="app_actualizar_calificacion")
     */
    public function updateCalificaciones(Request $request, EntityManagerInterface $entityManager)
    { 
        
        $id_update = $request->request->get('calificaciones')['id_update'];
        $listCalificacioness = $entityManager->getRepository(Calificaciones::class)->find($id_update);
        $data = $request->request->all();
        $listCalificacioness->setNombreEstudiante($data['calificaciones']['NombreEstudiante']);
        $listCalificacioness->setNombreMateria($data['calificaciones']['NombreMateria']);
        $listCalificacioness->setCalificacionFinal($data['calificaciones']['CalificacionFinal']);
        
        // Construir la fecha con los valores recibidos
        $fechaRegistro = new \DateTime();
        /*$fechaRegistro->setDate(
            $data['calificaciones']['FechaRegistro']['year'],
            $data['calificaciones']['FechaRegistro']['month'],
            $data['calificaciones']['FechaRegistro']['day']
        );*/

        $responseJson = ['response'=>'error','info' => 'Hubo un error','a' => $id_update];
        
        //$form_Calificacioness = $this->createForm(CalificacionesType::class,$listCalificacioness);
        //$form_Calificacioness->handleRequest($request);
        
        
        //if($form_Calificacioness->isSubmitted() && $form_Calificacioness->isValid()){
            
            $entityManager->persist($listCalificacioness);
            $entityManager->flush();
            $responseJson['response']  = 'success';
            $responseJson['info']  = 'Actualizado correctamente';
            //}
            
            return new JsonResponse($responseJson);
    }

    /**
     * @Route("/calificacion/delete", name="app_eliminar_calificacion")
     */
    public function deleteCalificaciones(Request $request, EntityManagerInterface $entityManager)
    { 
        $id_remove = $request->get('id_delete');
        $listCalificacioness = $entityManager->getRepository(Calificaciones::class)->find($id_remove);
        $entityManager->remove($listCalificacioness);
        $entityManager->flush();
        $responseJson['response']  = 'success';
        $responseJson['info']  = 'Eliminado correctamente';
        $responseJson['a']  = $id_remove;
        return new JsonResponse($responseJson);
    }
}
