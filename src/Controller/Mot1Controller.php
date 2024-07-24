<?php

namespace App\Controller;

use App\Form\Mot1Type;
use App\Entity\Mot1;
use App\Services\Check;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Mot1Controller extends AbstractController
{
    /**
     * @Route("/mot1", name="app_mot1")
     */
    public function index(EntityManagerInterface $em, Request $request, Check $ck): Response
    {
        $mot1 = new Mot1();
        $mot1Form = $this->createForm(Mot1Type::class, $mot1);

        $mot1Form->handleRequest(($request));
        if($mot1Form->isSubmitted() && $mot1Form->isValid()){
            $em->persist($mot1);
            $test = $ck->checker($mot1->getName());
            if ($test === false){
                return $this->render("mot1/perdu.html.twig");
            } else {
                return $this->render("mot1/gagne.html.twig");
            }
            $em->flush();
        }
        return $this->render('mot1/index.html.twig', [
            'mot1Form' => $mot1Form->createView(),
        ]);
    }
}
