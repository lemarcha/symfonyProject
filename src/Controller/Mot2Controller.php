<?php

namespace App\Controller;

use App\Entity\Mot2;
use App\Form\Mot2Type;
use App\Service\Verificator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Mot2Controller extends AbstractController
{
    /**
     * @Route("/mot2", name="app_mot2")
     */
    public function mot2(Request $request, EntityManagerInterface $em, Verificator $verificator): Response
    {
        $mot2 = new Mot2();

        $mot2Form = $this->createForm(Mot2Type::class, $mot2);
        $mot2Form->handleRequest($request);

        if($mot2Form->isSubmitted() && $mot2Form->isValid()){
            $em->persist($mot2);

            $result = $verificator->verifImput($mot2->getName());

            if($result === true){
                $this->addFlash('success', 'tentative réussit !');
                return $this->render('result/good.html.twig');
            } else {
                $this->addFlash('fuck', 'tentative raté');
                return $this->render('result/bad.html.twig');
            }
            $em>flush();
        }

        return $this->render('mot2/mot2.html.twig', [
            'controller_name' => 'Mot2Controller',
            "mot2Form" => $mot2Form->createView()
        ]);
    }
}
