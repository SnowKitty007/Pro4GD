<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Userplant;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/api/profile/{username}", name="profile")
     */
    public function getProfileUser($username) : JsonResponse {

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        if (!$user) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($user->toAssoc(), Response::HTTP_OK);
    }

    /**
     * @Route("/api/profile/{username}/setDescription", name="setName", methods={"PUT"})
     */
    public function setProfileUserDescription($username, Request $request){
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        if (!$user) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $data = $request->getContent();
        $user->setDescriptioin($data); //Set description to new text
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse($user->toAssoc(), Response::HTTP_OK);
    }

    /**
     * @Route("/api/profile/{username}/userplants", name="profile_userplant", methods={"GET"})
     */
    public function getProfileUserplant($username){
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        $userid = $user->getId();

        $plants = $this->getDoctrine()
            ->getRepository(Userplant::class)
            ->findAll();

        $userplantsProfile = [];

        foreach($plants as $plant) {
            $userplantsProfile[] = $plant->toAssoc();
        }

        return new JsonResponse($userplantsProfile, Response::HTTP_OK);
    }

    /**
     * @Route("/api/profile/{username}/friends", name="profile_friends", methods={"GET"})
     */
    public function getProfileFriends($username) {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        $friends = [];

        foreach($user->getOutgoingFriendRequests() as $request){
            if($request->getConfirmed()){
                $id = $request->getReceiver()->getId();
                $username = $request->getReceiver()->getUsername();
                $firstName = $request->getReceiver()->getFirstName();
                $lastName = $request->getReceiver()->getLastName();
                $level = $request->getReciever()->getLevel();
                $userPic = $request->getReciever()->getUserPic();

                $friendData = [
                    'id' => $id,
                    'username' => $username,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'level' => $level,
                    'userPic' => $userPic
                ];
                array_push($friends, $friendData);
            }
        }
        foreach($user->getIncomingFriendRequests() as $request){
            if($request->getConfirmed()){
                $id = $request->getSender()->getId();
                $username = $request->getSender()->getUsername();
                $firstName = $request->getSender()->getFirstName();
                $lastName = $request->getSender()->getLastName();
                $level = $request->getSender()->getLevel();
                $userPic = $request->getSender()->getUserPic();

                $friendData = [
                    'id' => $id,
                    'username' => $username,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'level' => $level,
                    'userPic' => $userPic
                ];
                array_push($friends, $friendData);
            }
        }
        return new JsonResponse($friends, Response::HTTP_OK);
    }

    /**
     * @Route("/api/profile/{username}/setDescription", name="profile_userdescription", methods={"PUT"})
     */
    public function setProfileDescription($username, Request $request) {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        if (!$user) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $data= $request->getContent();
        $user->setDescription($data);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse($user->toAssoc(), Response::HTTP_OK);
    }

/*
    public function getUserData($username) : JsonResponse {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);


        $rep = $this->getDoctrine()->getRepository(Entry::class);
        $entries = $rep->findAll($user->id);
        $userplant = [];
        foreach ($entries as $entry) {
            $userplants[] = $entry->toAssoc();
        }

        if (!$user) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(array('user'=>$user,'userplant'=>$userplant)->toAssoc(), Response::HTTP_OK);
    }*/


/**
 * @Route("/profile", name="profile")
 */
    /*public function profile()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /* @var \App\Entity\User $user */
        /*$user = $this->getUser();

        return $this->render('profile.html.twig', [
            'controller_name' => 'UserController', 'user' => $user
        ]);
    }
    /**
     * @Route("/profile/friends", name="profile_friends")
     */
   /* public function friends()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /* @var \App\Entity\User $user */
  /*      $user = $this->getUser();

        $friends = array();
        foreach($user->getOutgoingFriendRequests() as $request){
            if($request->getConfirmed()){
                array_push($friends, $request->getReceiver());
            }
        }
        foreach($user->getIncomingFriendRequests() as $request){
            if($request->getConfirmed()){
                array_push($friends, $request->getSender());
            }
        }

        return $this->render('friends.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'friends' => $friends
        ]);
    }*/
}