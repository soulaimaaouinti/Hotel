<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\GroupeHotelierType;
use App\Repository\HotelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ApiHotelController extends AbstractController
{
    /**
     * @Route("/hotel", name="hotel_index", methods={"GET"})
     */
    public function index(HotelRepository  $hotelRepository): Response
    {
        $groupes = $hotelRepository->findAll();

        $data = [];

        foreach ($groupes as $groupe) {
            $data[] = [
                'id' => $groupe->getId(),
                'nom' => $groupe->getNom(),
                'Adresse' => $groupe->getAdresse(),
                'Nb_etoile'=>$groupe->getNbEtoile(),
                'groupe'=>$groupe->getGroupe(),

            ];
        }


        return $this->json($data);
    }


    /**
     * @Route("/hotelNew", name="hotel_new", methods={"POST"})
     */
    public function new(Request $request, HotelRepository $hotelRepository): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(GroupeHotelierType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelRepository->add($hotel);
            return $this->json('Created new hotel successfully with id ' . $hotel->getId());
        }
        else{

            return $this->json('Invalid Data ' );
        }

    }
//

    /**
     * @Route("/hotelShow/{id}", name="groupe_show", methods={"GET"})
     */
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $project = $doctrine->getRepository(Hotel::class)->find($id);

        if (!$project) {

            return $this->json('No project found for id' . $id, 404);
        }

        $data = [
            'id' => $project->getId(),
            'nom' => $project->getNom(),
            'Adresse' => $project->getAdresse(),
            'Nb_etoile'=>$project->getNbEtoile(),
            'groupe'=>$project->getGroupe(),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/hotelEdit/{id}", name="groupe_edit", methods={"PUT"})
     */
    public function edit(ManagerRegistry $doctrine, Request  $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Hotel::class)->find($id);

        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }

        $project->setNom($request->request->get('nom'));
        $project->setAdreese($request->request->get('adresse'));
        $project->setNbEtoile($request->request->get('Nb_etoile'));
        $entityManager->flush();

        $data = [
            'id' => $project->getId(),
            'nom' => $project->getNom(),
            'Adresse' => $project->getAdresse(),
            'Nb_etoile'=>$project->getNbEtoile(),

        ];

        return $this->json($data);
    }

    /**
     * @Route("/hotelDel/{id}", name="hotel_delete", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Hotel::class)->find($id);

        if (!$project) {
            return $this->json('No hotel found for id' . $id, 404);
        }

        $entityManager->remove($project);
        $entityManager->flush();

        return $this->json('Deleted a hotel successfully with id ' . $id);
    }
}
