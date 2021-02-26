<?php

namespace App\Controller;

use App\Entity\User;
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

    public function addUser(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder,SerializerInterface $serializer, ProfilRepository $profilRepository): Response
    {
         //Recupérer les données envoyées dans la requête avec $request
         $data = $request->request->all();

       if($getavatar = $request->files->get("avatar")){
        $avatar = fopen($getavatar->getRealPath(), 'rb');
        $data["avatar"] = $avatar;
      }
   
       // $data est un array je le dénormalize avec la fonction denormalize() pour avoir un objet de type       User::class
       $user = $serializer->denormalize($data, User::class);

       if($profil= $profilRepository->findOneBy(['libelle'=>$data['profils']])){
        $user->setProfil($profil);
        }
       //Recupérer le password pour encodage
       $password = $request->get('password');
       $user->setPassword($encoder->encodePassword($user,$password));
      
        $em->persist($user);
        $em->flush();

        return  $this->json(['message'=> 'Utilisateur créé avec succès!'], Response::HTTP_CREATED); 
     
    }
}
