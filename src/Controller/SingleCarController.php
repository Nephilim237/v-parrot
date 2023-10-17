<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Vehicle;
use App\Form\OrderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleCarController extends AbstractController
{
    #[Route('/vehicle/{slug}', name: 'vehicle_details')]
    public function index(Vehicle $vehicle, Request $request, EntityManagerInterface $manager): Response
    {
        $message = new Message();
        $form = $this->createForm(OrderFormType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($message);
            $manager->flush();
            $this->addFlash('success', 'Message envoyé avec succès.');
            return $this->redirectToRoute('vehicle_details', ['slug' => $vehicle->getSlug(), '_fragment' => 'orderForm']);
        }

        return $this->render('single_car/index.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView()
        ]);
    }
}
