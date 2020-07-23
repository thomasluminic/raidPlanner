<?php

namespace App\Controller;

use App\Entity\Raid;
use App\Form\RaidType;
use App\Repository\RaidRepository;
use App\Service\DateRaidService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaidController extends AbstractController
{
    /**
     * @Route("/raid", name="raid")
     * @param Request $request
     * @param RaidRepository $raidRepository
     * @param DateRaidService $dateRaidService
     * @return Response
     */
    public function index(Request $request, RaidRepository $raidRepository, DateRaidService $dateRaidService): Response
    {
        $dateNextRaid = $dateRaidService->calculateDate();
        $monday = $dateNextRaid[0];
        $tuesday = $dateNextRaid[1];
        $friday = $dateNextRaid[2];

        $form = $this->createForm(RaidType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData() as $datum) {
                if ($datum) {
                    $raid = new Raid();
                    $raid->setUser($this->getUser());
                    $raid->setDate(new \DateTime($datum));
                }
            }
        }

        return $this->render('raid/index.html.twig', [
            'raids' => $raidRepository->findAll(),
            'monday' => $monday,
            'tuesday' => $tuesday,
            'friday' => $friday,
            'form' => $form->createView(),
        ]);
    }
}
