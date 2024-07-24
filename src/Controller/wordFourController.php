<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Entity\WordFour;
use App\Form\WishFormType;
use App\Form\WordFourFormType;
use App\Helper\Censurator;
use App\Helper\VerificatorWordFour;
use App\Repository\WishRepository;
use App\Repository\WordFourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mot-quatre", name="word_")
 */
class wordFourController extends AbstractController{
    private $wordFourRepository;

    public function __construct(WordFourRepository $wordFourRepository)
    {
        $this->wordFourRepository = $wordFourRepository;
    }

    /**
     * @Route("/devinette", name="word4")
     */
    public function riddle(Request $request, VerificatorWordFour $verificatorWordFour): Response
    {
        $wordFour = new WordFour();
        $wordFourForm = $this->createForm(WordFourFormType::class,$wordFour);

        $wordFourForm->handleRequest($request);
        if ($wordFourForm->isSubmitted() && $wordFourForm->isValid()) {
            $wordDb = $this->wordFourRepository->find(1)->getName();

            if($verificatorWordFour->verifWordFour($wordFourForm->get('name')->getData(), $wordDb)){
                $this->addFlash('success', 'Bravo ! T trop fort, tu as trouvé le mot : ' . $wordDb);
            }else{
                $this->addFlash('error', 'Nul ...');
            }

            return $this->redirectToRoute('word_word4');
        }

        return $this->render('word/word4.html.twig', [
            'wordForm' => $wordFourForm->createView()
        ]);
    }
}