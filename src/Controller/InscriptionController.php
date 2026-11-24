<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InscriptionType;

final class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setDateInscription(new \DateTime());    
            $em->persist($utilisateur);
            $em->flush();

            $this->addFlash('success', 'Vous êtes inscrit !');
            
            return $this->redirectToRoute('app_inscription');
        }
        elseif ($form->isSubmitted()) 
        {
            $this->addFlash('error', 'NOK !');
        }

    public function index(Request $request): Response
    {
        $form = $this->createForm(InscriptionType::class);
        $form->handleRequest($request);

        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
            'form' => $form,
        ]);
    }
}
