<?php

namespace App\Controller;

use App\Entity\Raid;
use App\Form\RaidType;
use App\Repository\CharacterRepository;
use App\Repository\RaidRepository;
use App\Service\DateRaidService;
use App\Service\RaidService;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param RaidService $raidService
     * @param CharacterRepository $characterRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(
        Request $request,
        RaidRepository $raidRepository,
        DateRaidService $dateRaidService,
        RaidService $raidService,
        CharacterRepository $characterRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $dateNextRaid = $dateRaidService->calculateDate();
        $monday = $dateNextRaid[0];
        $tuesday = $dateNextRaid[1];
        $friday = $dateNextRaid[2];

        $form = $this->createForm(RaidType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $character = $characterRepository->find($form->getData()['userCharacter']);
            if(!$raidRepository->findBy(['user' => $this->getUser()])) {
                $raid = new Raid();
                $raid->setUser($this->getUser())
                    ->setUserCharacter($character)
                    ->setDayOne($form->getData()['dayOne'])
                    ->setDayTwo($form->getData()['dayTwo'])
                    ->setDayThree($form->getData()['dayThree']);
            } else {
                $raid = $raidRepository->findOneBy(['user' => $this->getUser()]);
                $raid->setUserCharacter($character)
                    ->setDayOne($form->getData()['dayOne'])
                    ->setDayTwo($form->getData()['dayTwo'])
                    ->setDayThree($form->getData()['dayThree']);
            }

            $entityManager->persist($raid);
            $entityManager->flush();
        }

        $raids = $raidRepository->findAll();
        $resumeRaid = $raidService->resumeRaidParticipant($raids);
        $resumeCharactersRaid = $raidRepository->resumeUserCharacter();

        return $this->render('raid/index.html.twig', [
            'raids' => $raids,
            'characters' => $this->getUser()->getCharacters(),
            'monday' => $monday,
            'tuesday' => $tuesday,
            'friday' => $friday,
            'resumeRaid' => $resumeRaid,
            'resumeCharacterRaid' => $resumeCharactersRaid,
            'form' => $form->createView(),
        ]);
    }
}
