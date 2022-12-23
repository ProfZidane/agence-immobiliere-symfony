<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Repository\ObjectsRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\Session;

#[Route('/auth')]
class AuthController extends AbstractController
{
    #[Route('/', name: 'app_auth')]
    public function index(ObjectsRepository $objectsRepository): Response
    {
        return $this->render('auth/login.html.twig', [
            'controller_name' => 'AuthController'            
        ]);
    }
    
    #[Route('/utilisateurs', name: 'app_utilisateurs_auth', methods: ['GET'])]
    public function utilisateurs(UtilisateursRepository $utilisateursRepository): Response
    {
        $session = new Session();
        $user = new Utilisateurs($session->get('firstName'), $session->get('lastName'));
        return $this->render('dashboard/utilisateurs.html.twig', [
            'utilisateurs' => $utilisateursRepository->findAll()
        ]);
    }

    #[Route('/biens', name: 'app_biens_auth', methods: ['GET'])]
    public function biens(ObjectsRepository $objectsRepository, UtilisateursRepository $utilisateursRepository): Response
    {   
        $data = [];
        $obj = $objectsRepository->findAll();
        
        foreach ($obj as $value) {
            $user = $utilisateursRepository->findOneById($value->getOwner());
            array_push($data,
                [
                    "object" => $value,
                    "user" => $user 
                ]);
        }
        return $this->render('dashboard/bien.html.twig', [
            'objects' => $objectsRepository->findAll(),
            'data' => $data
        ]);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, UtilisateursRepository $utilisateursRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = $utilisateursRepository->findBy(["email"=>$request->get("email")]);
        if ($user) {            
            if (!$userPasswordHasherInterface->isPasswordValid($user[0], $request->get('password'))) {
                
                $session = new Session();
                // $session->start();
                $session->set('firstName', $user[0]->getFirstName());
                $session->set('lastName', $user[0]->getLastName());
                $session->set('email', $user[0]->getEmail());

                return $this->render('dashboard/index.html.twig', [
                    'user' => $user[0]         
                ]);                
            }
        }

        return $this->redirectToRoute('/auth', [
            'error' => "Votre email ou mot de passe n'est pas correcte !"          
        ]);

       
        
    }
}
