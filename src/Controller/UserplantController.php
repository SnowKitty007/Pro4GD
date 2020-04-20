<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Userplant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class UserplantController extends AbstractController
{
    /**
     * @Route("/userplant", name="userplant")
     */
    /*public function index()
    {
        return $this->render('userplant.html.twig', [
            'controller_name' => 'UserplantController'
        ]);
    }*/

    /**
     * @Route("/userplant", name="userplant")
     */
    public function index()
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $userplants = $user->getUserplants();

        return $this->render('userplant.html.twig', [
            'controller_name' => 'UserplantController', 'userplants' => $userplants
        ]);
    }

    /**
     * @Route("/createUserplant", name="app_createUserplant")
     */
    public function createUserplant()
    {
        $entityManager = $this->getDoctrine()->getManager();

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $userplant = new Userplant();
        $userplant->setName("Testplant");
        $userplant->setLocation("Irgendwo");
        $userplant->setNotes("This plant is dope");
        $userplant->setDateAdded(new \DateTime("now"));
        $userplant->setDateWatered(new \DateTime("now"));

        $user->addUserplant($userplant);

        $entityManager->persist($userplant);
        $entityManager->flush();

        return new Response('Saved new userplant with id '.$userplant->getId());
    }
}