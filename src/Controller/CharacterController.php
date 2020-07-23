<?php

namespace App\Controller;

use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @Route("/character", name="character")
     * @param Request $request
     * @param CharacterRepository $characterRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(Request $request,CharacterRepository $characterRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CharacterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $user->addCharacter($form->getData()['character']);
            $entityManager->persist($user);
            $entityManager->flush();
        }

        $myCharacters = $this->getUser()->getCharacters();
        return $this->render('character/index.html.twig', [
            'characters' => $characterRepository->findAll(),
            'myCharacters' => $myCharacters,
            'form' => $form->createView(),
        ]);
    }
}
