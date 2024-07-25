<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentairesController extends AbstractController
{
    /**
     * @Route("/commentaires", name="app_commentaires")
     */
    public function list(CommentRepository $cr): Response
    {   
        $comment = $cr->findAll();
        dump($comment);
        return $this->render('commentaires/list.html.twig', [
            'comment' => $comment,
        ]);
    }

       /**
     * @Route("/commentaires/add", name="add_commentaires")
     */
    public function add(EntityManagerInterface $em, Request $request): Response 
    {
        $user = $this->isGranted("ROLE_USER");
        if(!$user){
            $this->createAccessDeniedException("Page réservée aux utilisateurs connectés");
            return $this->redirectToRoute('home');
        }

        //Afficher le formulaire
        $commentaire = new Comment();
        $userEnCours = $this->getUser();
        $commentaireForm = $this->createForm(CommentType::class, $commentaire);
        
        $commentaireForm->handleRequest($request);
        if($commentaireForm->isSubmitted() && $commentaireForm->isValid()){
            $commentaire->setUser($userEnCours);
            $commentaire->setDate(new \DateTime());
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('app_commentaires');
        }
        
        return $this->render('commentaires/add.html.twig', [
            'commentaireForm' => $commentaireForm->createView(),
            'userEnCours' => $userEnCours,
        ]);
    }
}
