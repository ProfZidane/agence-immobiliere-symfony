<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateurs')]
class UtilisateursController extends AbstractController
{    

    #[Route('/', name: 'app_utilisateurs_index', methods: ['GET'])]
    public function index(UtilisateursRepository $utilisateursRepository): Response
    {
        return $this->render('utilisateurs/index.html.twig', [
            'utilisateurs' => $utilisateursRepository->findAll(),
        ]);
    }



    #[Route('/new', name: 'app_utilisateurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UtilisateursRepository $utilisateursRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$utilisateur->setPassword();
            $hashedPassword = $userPasswordHasherInterface->hashPassword(
                $utilisateur,
                $utilisateur->getPassword()
            );
            $utilisateur->setPassword($hashedPassword);
            $utilisateursRepository->add($utilisateur);
            return $this->redirectToRoute('app_utilisateurs_auth', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateurs/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateurs_show', methods: ['GET'])]
    public function show(Utilisateurs $utilisateur): Response
    {
        return $this->render('utilisateurs/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_utilisateurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateurs $utilisateur, UtilisateursRepository $utilisateursRepository): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateursRepository->add($utilisateur);
            return $this->redirectToRoute('app_utilisateurs_auth', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateurs/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateurs_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateurs $utilisateur, UtilisateursRepository $utilisateursRepository): Response
    {
        $utilisateursRepository->remove($utilisateur);
        
        return $this->redirectToRoute('app_utilisateurs_auth', [], Response::HTTP_SEE_OTHER);
    }
}
