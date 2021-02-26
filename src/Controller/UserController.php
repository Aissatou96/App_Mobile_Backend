<?php

namespace App\Controller;

use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * @Route(
     *        path="api/user", 
     *        methods={"POST"}
     *       )
     */

    // public function addUser(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder,SerializerInterface $serializer, ProfilRepository $profilRepository): Response
    // {
    //    $profil = $request->get('profil');
    //    $user = $request->request->all();
    //    dd($user);
    // }
}
