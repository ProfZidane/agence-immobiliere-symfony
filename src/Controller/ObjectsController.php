<?php

namespace App\Controller;

use App\Entity\Objects;
use App\Form\ObjectsType;
use App\Repository\ObjectsRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/objects')]
class ObjectsController extends AbstractController
{
    #[Route('/', name: 'app_objects_index', methods: ['GET'])]
    public function index(ObjectsRepository $objectsRepository): Response
    {
        return $this->render('objects/index.html.twig', [
            'objects' => $objectsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_objects_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ObjectsRepository $objectsRepository): Response
    {
        $object = new Objects();
        $form = $this->createForm(ObjectsType::class, $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectsRepository->add($object);
            return $this->redirectToRoute('app_biens_auth', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('objects/new.html.twig', [
            'object' => $object,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_objects_show', methods: ['GET'])]
    public function show(Objects $object, UtilisateursRepository $utilisateursRepository): Response
    {
        $user = $utilisateursRepository->find($object->getOwner());

        return $this->render('objects/show.html.twig', [
            'object' => $object,
            'owner' => $user
        ]);
    }

    #[Route('/{id}/edit', name: 'app_objects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Objects $object, ObjectsRepository $objectsRepository): Response
    {
        $form = $this->createForm(ObjectsType::class, $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectsRepository->add($object);
            return $this->redirectToRoute('app_biens_auth', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('objects/edit.html.twig', [
            'object' => $object,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_objects_delete', methods: ['POST'])]
    public function delete(Request $request, Objects $object, ObjectsRepository $objectsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$object->getId(), $request->request->get('_token'))) {
            $objectsRepository->remove($object);
        }

        return $this->redirectToRoute('app_biens_auth', [], Response::HTTP_SEE_OTHER);
    }
}
