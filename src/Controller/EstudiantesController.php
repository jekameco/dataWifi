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
}
