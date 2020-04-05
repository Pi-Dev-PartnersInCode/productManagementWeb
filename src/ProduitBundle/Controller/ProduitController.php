<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Produit;
use ProduitBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ProduitController extends Controller
{
    public function ajoutProduitAction (Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class , $produit);
        $form->handleRequest($request);
        #database register
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
        }
        return $this->render('@Produit/ajoutProduit.html.twig', array(
            'form' => $form->CreateView(),
        ));
    }
    public function afficheProduitAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository("ProduitBundle:Produit")->findAll();
        return $this->render('@Produit/afficheProduit.html.twig', array('produits' => $produit));
    }

}