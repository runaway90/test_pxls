<?php

namespace App\Controller;

use App\Entity\WeatherCheckpoint;
use App\Form\WeatherCheckpointType;
use App\Repository\WeatherCheckpointRepository;
use App\Services\WeatherAPIService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class WeatherCheckpointController extends AbstractController
{
    /**
     * @Route("/", name="weather_checkpoint_index", methods={"GET"})
     */
    public function index(WeatherCheckpointRepository $weatherCheckpointRepository): Response
    {
        return $this->render('weather_checkpoint/index.html.twig', [
            'weather_checkpoints' => $weatherCheckpointRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="weather_checkpoint_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $weatherCheckpoint = new WeatherCheckpoint();
        $form = $this->createForm(WeatherCheckpointType::class, $weatherCheckpoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weatherCheckpoint);
            $entityManager->flush();

            return $this->redirectToRoute('weather_checkpoint_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weather_checkpoint/new.html.twig', [
            'weather_checkpoint' => $weatherCheckpoint,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/new_from_api", name="weather_checkpoint_new_from_api", methods={"GET"})
     */
    public function newFromAPI(Request $request, WeatherAPIService $weatherAPIService): Response
    {

        $currentWeather = $weatherAPIService->getCurrentWeatherForWro();

        $weatherCheckpoint = new WeatherCheckpoint();
        $weatherCheckpoint->setCheckDate(new \DateTime(date('Y-m-d H:i:s')));
        $weatherCheckpoint->setSpeedWind($currentWeather->current->wind_kph);
        $weatherCheckpoint->setTemperature($currentWeather->current->temp_c);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($weatherCheckpoint);
        $entityManager->flush();

        return $this->redirectToRoute('weather_checkpoint_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/edit", name="weather_checkpoint_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WeatherCheckpoint $weatherCheckpoint): Response
    {
        $form = $this->createForm(WeatherCheckpointType::class, $weatherCheckpoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('weather_checkpoint_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weather_checkpoint/edit.html.twig', [
            'weather_checkpoint' => $weatherCheckpoint,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="weather_checkpoint_delete", methods={"POST"})
     */
    public function delete(Request $request, WeatherCheckpoint $weatherCheckpoint): Response
    {
        if ($this->isCsrfTokenValid('delete' . $weatherCheckpoint->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($weatherCheckpoint);
            $entityManager->flush();
        }

        return $this->redirectToRoute('weather_checkpoint_index', [], Response::HTTP_SEE_OTHER);
    }
}
