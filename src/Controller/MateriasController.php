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

    
    /**
     * @Route("/materia/update", name="app_actualizar_materia")
     */
    public function getDataMateria(Request $request, EntityManagerInterface $entityManager)
    { 
        
        $id_update = $request->get('id_update');
        $listMaterias = $entityManager->getRepository(Materias::class)->find($id_update);
        $MateriaArray = get_object_vars($listMaterias);

        $responseJson['response']  = 'success';
        $responseJson['info']  = 'datos correctamente';
        $responseJson['dataRow']  = array(
            'nombreMateria' => $listMaterias->getNombremateria(),
        );

        return new JsonResponse($responseJson);
    }

    /**
     * @Route("/materia/update", name="app_actualizar_materia")
     */
    public function updateMateria(Request $request, EntityManagerInterface $entityManager)
    { 
        
        $id_update = $request->request->get('materias')['id_update'];
        $listMaterias = $entityManager->getRepository(materias::class)->find($id_update);
        
        $form_Materias = $this->createForm(materiasType::class,$listMaterias);
        $form_Materias->handleRequest($request);
        
        $responseJson = ['response'=>'error','info' => 'Hubo un error','a' => $id_update];
        
        if($form_Materias->isSubmitted() && $form_Materias->isValid()){
            
            $entityManager->persist($listMaterias);
            $entityManager->flush();
            $responseJson['response']  = 'success';
            $responseJson['info']  = 'Actualizado correctamente';
        }
        return new JsonResponse($responseJson);

    }

    /**
     * @Route("/materia/delete", name="app_eliminar_materia")
     */
    public function deleteMateria(Request $request, EntityManagerInterface $entityManager)
    { 
        $id_remove = $request->get('id_delete');
        $listMaterias = $entityManager->getRepository(materias::class)->find($id_remove);
        $entityManager->remove($listMaterias);
        $entityManager->flush();
        $responseJson['response']  = 'success';
        $responseJson['info']  = 'Eliminado correctamente';
        $responseJson['a']  = $id_remove;
        return new JsonResponse($responseJson);
    }
}
