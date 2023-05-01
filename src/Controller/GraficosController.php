<?php

namespace App\Controller;

use App\Form\GraficosType;
use App\Entity\Calificaciones;
use App\Entity\Materias;
use App\Entity\Estudiantes;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GraficosController extends AbstractController
{
    /**
     * @Route("/graficos", name="app_graficos")
     */

    public function getGraficos(Request $request,EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(GraficosType::class);
        $listCalificaciones = $entityManager->getRepository(Calificaciones::class)->findAll();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // procesar los datos del formulario
            $formData = $form->getData();
            // ...
        }


        return $this->render('graficos/graficos.html.twig', [
            'form_grafico' => $form->createView(),
            'listCalificaciones' => $listCalificaciones,
        ]);
    }
    /**
     * @Route("/graficos/info", name="app_info_graficos")
     */
    public function getInfoGraficos(Request $request, EntityManagerInterface $entityManager)
    {

        $data = $request->request->all()['graficos'];
        $date_start = $data['date_start'];
        $date_end = $data['date_end'];


        $qb = $entityManager->createQueryBuilder();
        $qb->select('AVG(c.calificacionfinal) as promedio_calificacion, c.nombremateria,c.fecharegistro')
            ->from('App\Entity\Calificaciones', 'c')
            ->where('c.fecharegistro BETWEEN :date_start AND :date_end')
            ->setParameter('date_start', $date_start)
            ->setParameter('date_end', $date_end)
            ->groupBy('c.nombremateria');
        /*->leftJoin('App\Entity\Estudiante', 'e', Join::WITH, 'm.id = e.materia_id')
            ->groupBy('m.id');*/
        $query = $qb->getQuery();
        $results = $query->getResult();

        $qbEstudiantes = $entityManager->createQueryBuilder();
        $qbEstudiantes->select('c.nombreestudiante, AVG(c.calificacionfinal) as promedio_calificacion')
            ->from('App\Entity\Calificaciones', 'c')
            ->where('c.fecharegistro BETWEEN :date_start AND :date_end')
            ->setParameter('date_start', $date_start)
            ->setParameter('date_end', $date_end)
            ->groupBy('c.nombreestudiante')
            ->orderBy('promedio_calificacion','DESC');
        /*->leftJoin('App\Entity\Estudiante', 'e', Join::WITH, 'm.id = e.materia_id')
        ->groupBy('m.id');*/
        $queryEstudiantes = $qbEstudiantes->getQuery();
        $resultsEstudiantes = $queryEstudiantes->getResult();

        // Construir array con los resultados obtenidos
        $responseData = [];
        foreach ($results as $result) {

            $rowData = [
                'NombreMateria' => $result['nombremateria'],
                'promedioMateria' => $result['promedio_calificacion']
            ];
            $responseData[] = $rowData;
        }

        $responseDataEstudiantes = [];
        foreach ($resultsEstudiantes as $resultsEstudiante) {

            $rowDataEstudiante = [
                'nombreestudiante' => $resultsEstudiante['nombreestudiante'],
                'promedio_calificacion' => $resultsEstudiante['promedio_calificacion']
            ];
            $responseDataEstudiantes[] = $rowDataEstudiante;
        }

        if(empty($responseData)){
            $responseData = [['NombreMateria'=> 'Ninguno','promedioMateria'=>'0']];
        }
        if(empty($responseDataEstudiantes)){
            $responseDataEstudiantes = [['nombreestudiante'=> 'Ninguno','promedio_calificacion'=>'0']];
        }
        
        
        if (!empty($results)) {
            $responseJson = ['response' => 'success', 'data' => $responseData, 'dataEstudiante' => $responseDataEstudiantes,'a'=>$date_start];
        } else {
            $responseJson = ['response' => 'error', 'info' => 'La consulta no retornó resultados.', 'data' => $responseData, 'dataEstudiante' => $responseDataEstudiantes,'a'=>$date_start];
        }
        
        
        //$calificacion->setNombreEstudiante($data['calificaciones']['NombreEstudiante']);
        /*
        $qb = $this->$entityManager->createQueryBuilder();
        $qb->select('m.nombre as materia, count(e.id) as cantidad')
        ->from('App\Entity\Materia', 'm')
        ->leftJoin('App\Entity\Estudiante', 'e', Join::WITH, 'm.id = e.materia_id')
        ->groupBy('m.id');
        
        */
        //$responseJson = ['response' => 'success', 'data' => $responseData,'dataEstudiante' => $responseDataEstudiantes];
        return new JsonResponse($responseJson);
    }
}
