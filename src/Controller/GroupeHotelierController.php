<?php

namespace App\Controller;

use App\Entity\GroupeHotelier;
use App\Form\GroupeHotelierType;
use App\Repository\GroupeHotelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/groupe/hotelier")
 */
class GroupeHotelierController extends AbstractController
{
    /**
     * @Route("/", name="app_groupe_hotelier_index", methods={"GET"})
     */
    public function index(GroupeHotelierRepository $groupeHotelierRepository): Response
    {
        return $this->render('groupe_hotelier/index.html.twig', [
            'groupe_hoteliers' => $groupeHotelierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_groupe_hotelier_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GroupeHotelierRepository $groupeHotelierRepository): Response
    {
        $groupeHotelier = new GroupeHotelier();
        $form = $this->createForm(GroupeHotelierType::class, $groupeHotelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupeHotelierRepository->add($groupeHotelier);
            return $this->redirectToRoute('app_groupe_hotelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('groupe_hotelier/new.html.twig', [
            'groupe_hotelier' => $groupeHotelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_groupe_hotelier_show", methods={"GET"})
     */
    public function show(GroupeHotelier $groupeHotelier): Response
    {
        return $this->render('groupe_hotelier/show.html.twig', [
            'groupe_hotelier' => $groupeHotelier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_groupe_hotelier_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, GroupeHotelier $groupeHotelier, GroupeHotelierRepository $groupeHotelierRepository): Response
    {
        $form = $this->createForm(GroupeHotelierType::class, $groupeHotelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupeHotelierRepository->add($groupeHotelier);
            return $this->redirectToRoute('app_groupe_hotelier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('groupe_hotelier/edit.html.twig', [
            'groupe_hotelier' => $groupeHotelier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_groupe_hotelier_delete", methods={"POST"})
     */
    public function delete(Request $request, GroupeHotelier $groupeHotelier, GroupeHotelierRepository $groupeHotelierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupeHotelier->getId(), $request->request->get('_token'))) {
            $groupeHotelierRepository->remove($groupeHotelier);
        }

        return $this->redirectToRoute('app_groupe_hotelier_index', [], Response::HTTP_SEE_OTHER);
    }
}
