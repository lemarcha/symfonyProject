<?php

namespace App\Controller;

use App\Entity\Photocopie;
use App\Form\Mot3Type;
use App\Mot3Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Mot3Controller extends AbstractController
{

    /**
     * @Route("/mot_3", name="mot3_jouer")
     */
    public function verifyForm(Request $request, Validator $validator): Response
    {
        $photocopie = new Photocopie();
        $photocopieForm = $this->createForm(Mot3Type::class, $photocopie);
        $photocopieForm->handleRequest($request);

        if ($photocopieForm->isSubmitted() && $photocopieForm->isValid()) {
            $test = $validator->checkWorld($photocopie->getName());
            if ($test === true) {
                $this->addFlash('success', 'Bravo, vous avez trouvé le bon mot');
                return $this->redirectToRoute('mot3_jouer');
            } else {
                $this->addFlash('error', 'Oups !');
                return $this->redirectToRoute('mot3_jouer');
            }
        }

        return $this->render("mot_3/mot3Jouer.html.twig", [
            "mot3Form" => $photocopieForm->createView()
        ]);
    }
}
