<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Plant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class PlantController extends AbstractController {


    /**
     * @Route("/api/plant/{linkName}", name="plantData")
     */
    public function getPlantData($linkName) : JsonResponse {

        $plantData = $this->getDoctrine()
            ->getRepository(Plant::class)
            ->findOneBy(['linkName' => $linkName]);

        if (!$plantData) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($plantData->toAssoc(), Response::HTTP_OK);
    }

    /**
     * @Route("/plant", name="plant")
     */
    /*
    public function plant()
    {
        return $this->render('searchPlant.html.twig', [
            'controller_name' => 'PlantController'
        ]);
    }
    */
    /**
     * @Route("/plant/{name}", name="plantName")
     */
    /*
    public function index($name)
    {
        $plant = $this->getDoctrine()->getRepository('App:Plant')->findOneBy(array('linkName' => $name));

        return $this->render('plant.html.twig', [
            'controller_name' => 'PlantController', 'plant' => $plant
        ]);
    }
    */

    /**
     * @Route("/api/userPlants/names", name="getPlantNames", methods={"GET"})
     */
    public function getPlantNames()
    {
        $plants = $this->getDoctrine()->getRepository('App:Plant')->findAll();

        if (!$plants) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }
        //Get plantnames and push them in array
        $plantNames = [];
        foreach ($plants as $plant){
            array_push($plantNames, $plant->getName());
        }
        return new JsonResponse($plantNames, Response::HTTP_OK);
    }

}