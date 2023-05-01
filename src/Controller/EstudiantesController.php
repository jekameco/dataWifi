<?php

namespace App\Controller;
use App\Entity\Estudiantes;
use App\Form\EstudiantesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EstudiantesController extends AbstractController
{
    /**
     * @Route("/estudiantes", name="app_estudiantes")
     */
    /*public function index()
    {
        return $this->render('estudiantes/estudiantes.html.twig');

 
        $listStudents = $em->getRepository('App:Estudiantes')->findAll();
        return $this->render('estudiantes/estudiantes.html.twig',[
            'listStudents' => $listStudents
        ]);


    }*/

    public function getStudents(EntityManagerInterface $entityManager)
    { 
        $listStudents = $entityManager->getRepository(Estudiantes::class)->findAll();

        $estudiante = new Estudiantes();
        $form_students = $this->createForm(EstudiantesType::class,$estudiante);


        return $this->render(
            'estudiantes/estudiantes.html.twig',
            array('listStudents' => $listStudents,'form_students' => $form_students->createView())
        );
    }
    

    /**
     * @Route("/estudiante/create", name="app_crear_estudiante")
     */
    public function createStudent(Request $request, EntityManagerInterface $entityManager)
    { 

        $serach = $request->get('values');
        $estudiante = new Estudiantes();
        $form_students = $this->createForm(EstudiantesType::class,$estudiante);
        $form_students->handleRequest($request);

        $responseJson = ['response'=>'error','info' => 'Hubo un error'];

        if($form_students->isSubmitted() && $form_students->isValid()){
            
            $entityManager->persist($estudiante);
            $entityManager->flush();
            $responseJson['response']  = 'success';
            $responseJson['info']  = 'insertado correctamente';
            $responseJson['prueba']  = $estudiante;
        }

        return new JsonResponse($responseJson);
    }

    /**
     * @Route("/estudiante/update", name="app_actualizar_estudiante")
     */
    public function getDataStudent(Request $request, EntityManagerInterface $entityManager)
    { 
        
        $id_update = $request->get('id_update');
        $listStudents = $entityManager->getRepository(Estudiantes::class)->find($id_update);
        $studentArray = get_object_vars($listStudents);

        $responseJson['response']  = 'success';
        $responseJson['info']  = 'datos correctamente';
        $responseJson['dataRow']  = array(
            'nombre' => $listStudents->getNombre(),
            'edad' => $listStudents->getEdad(),
            'grado' => $listStudents->getGrado(),
        );

        return new JsonResponse($responseJson);
    }

    /**
     * @Route("/estudiante/update", name="app_actualizar_estudiante")
     */
    public function updateStudent(Request $request, EntityManagerInterface $entityManager)
    { 
        
        $id_update = $request->request->get('estudiantes')['id_update'];
        $listStudents = $entityManager->getRepository(Estudiantes::class)->find($id_update);
        
        $form_students = $this->createForm(EstudiantesType::class,$listStudents);
        $form_students->handleRequest($request);
        
        $responseJson = ['response'=>'error','info' => 'Hubo un error','a' => $id_update];
        
        if($form_students->isSubmitted() && $form_students->isValid()){
            
            $entityManager->persist($listStudents);
            $entityManager->flush();
            $responseJson['response']  = 'success';
            $responseJson['info']  = 'Actualizado correctamente';
        }
        return new JsonResponse($responseJson);

    }

    /**
     * @Route("/estudiante/delete", name="app_eliminar_estudiante")
     */
    public function deleteStudent(Request $request, EntityManagerInterface $entityManager)
    { 
        $id_remove = $request->get('id_delete');
        $listStudents = $entityManager->getRepository(Estudiantes::class)->find($id_remove);

        $qb = $entityManager->createQueryBuilder();
        $qb->delete('App\Entity\Calificaciones', 'c')
        ->where('c.nombreestudiante = :nombreestudiante')
        ->setParameter('nombreestudiante', $listStudents->getNombre())
        ->getQuery()
        ->execute();

        //elimina estudiante
        $entityManager->remove($listStudents);
        $entityManager->flush();
        $responseJson['response']  = 'success';
        $responseJson['info']  = 'Eliminado correctamente';
        
        return new JsonResponse($responseJson);
    }
}
