<?php

namespace App\Controller;

use App\Entity\GroupeHotelier;
use App\Form\GroupeHotelierType;
use App\Repository\GroupeHotelierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api", name="api_")
 */
class ApiGroupeController extends AbstractController
{
    /**
     * @Route("/groupe", name="groupe_index", methods={"GET"})
     */
    public function index(GroupeHotelierRepository $groupeHotelierRepository): Response
    {
        $groupes = $groupeHotelierRepository->findAll();

        $data = [];

        foreach ($groupes as $groupe) {
            $data[] = [
                'id' => $groupe->getId(),
                'name' => $groupe->getNom(),
                'description' => $groupe->getDescription(),
            ];
        }


        return $this->json($data);
    }


    /**
     * @Route("/groupe", name="groupe_new", methods={"POST"})
     */
    public function new(Request $request, GroupeHotelierRepository $groupeHotelierRepository): Response
    {
        $groupeHotelier = new GroupeHotelier();
        $form = $this->createForm(GroupeHotelierType::class, $groupeHotelier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupeHotelierRepository->add($groupeHotelier);
            return $this->json('Created new project successfully with id ' . $groupeHotelier->getId());
        }
        else{

            return $this->json('Invalid Data ' );
        }

    }
//

    /**
     * @Route("/groupe/{id}", name="groupe_show", methods={"GET"})
     */
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $project = $doctrine->getRepository(GroupeHotelier::class)->find($id);

        if (!$project) {

            return $this->json('No project found for id' . $id, 404);
        }

        $data = [
            'id' => $project->getId(),
            'name' => $project->getNom(),
            'description' => $project->getDescription(),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/groupe/{id}", name="groupe_edit", methods={"PUT"})
     */
    public function edit(ManagerRegistry $doctrine, Request  $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(GroupeHotelier::class)->find($id);

        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }

        $project->setNom($request->request->get('nom'));
        $project->setDescription($request->request->get('description'));
        $entityManager->flush();

        $data = [
            'id' => $project->getId(),
            'name' => $project->getNom(),
            'description' => $project->getDescription(),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/groupe/{id}", name="groupe_delete", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(GroupeHotelier::class)->find($id);

        if (!$project) {
            return $this->json('No groupe found for id' . $id, 404);
        }

        $entityManager->remove($project);
        $entityManager->flush();

        return $this->json('Deleted a groupe successfully with id ' . $id);
    }
}
