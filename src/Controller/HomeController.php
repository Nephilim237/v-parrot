<?php

namespace App\Controller;

use App\Entity\Testimonial;
use App\Form\SearchVehicleFormType;
use App\Form\TestimonialFormType;
use App\Repository\TestimonialRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VehicleRepository $vehicleRepository, TestimonialRepository $testimonialRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $vehicles = $vehicleRepository->getLatestOffers(16);
        $form = $this->createForm(SearchVehicleFormType::class);
        $search = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $param = $search->get('brand')->getData();
            $type = $search->get('type')->getData();
            $price = $search->get('price')->getData();
            $year = $search->get('year')->getData();
            $milliage = $search->get('milliage')->getData();

            $vehicles = $vehicleRepository->getOffersIncludingSearchParameters( $param, $type, $price, $year, $milliage,16);
        }

        $testimonial = new Testimonial();
        $testimonialForm = $this->createForm(TestimonialFormType::class, $testimonial);
        $testy = $testimonialForm->handleRequest($request);

        if ($testimonialForm->isSubmitted() && $testimonialForm->isValid()) {
            $manager->persist($testimonial);
            $manager->flush();
            $this->addFlash('success', 'Merci pour votre avis.');
            return $this->redirectToRoute('app_home', ['_fragment' => 'testimonials']);
        }

        return $this->render('home/index.html.twig', [
            'vehicles' => $vehicles,
            'form' => $form->createView(),
            'testyForm' => $testimonialForm->createView(),
            'testimonials' => $testimonialRepository->getActiveTestimonials()
        ]);
    }
}
