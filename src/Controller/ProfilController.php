<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class ProfilController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/{id}", name="profil")
     */
    public function profil(int $id): Response
    {
        $user = $this->userRepository->find($id);

        return $this->render('user/profil.html.twig', array(
            'user' => $user
        ));
    }
}