<?php

namespace App\Controller;

use App\Entity\Sector;
use App\Form\SectorType;
use App\Repository\SectorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\SectorService;
use App\Factories\FactoryInterface;
use App\Factories\EntityFactory;

/**
 * @Route("/sector")
 */
class SectorController extends AbstractController
{
    public function __construct(SectorService $sectorService, FactoryInterface $entityFactory)
    {
        $this->sectorService = $sectorService;
        $this->entityFactory = $entityFactory;
    }
    /**
     * @Route("/", name="sector_index", methods={"GET"})
     */
    public function index(SectorRepository $sectorRepository): Response
    {
        $sectors = $this->sectorService->get();
        return $this->render('sector/index.html.twig', [
            'sectors' => $sectors,
        ]);
    }

    /**
     * @Route("/new", name="sector_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sector = $this->entityFactory->getInstance('sector');
        $form = $this->createForm(SectorType::class, $sector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $this->getRequestEntityName($request);
            $this->sectorService->save($name);
            return $this->redirectToRoute('sector_index');
        }

        return $this->render('sector/new.html.twig', [
            'sector' => $sector,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sector_show", methods={"GET"})
     */
    public function show(Sector $sector): Response
    {
        return $this->render('sector/show.html.twig', [
            'sector' => $sector,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sector_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sector $sector): Response
    {
        $form = $this->createForm(SectorType::class, $sector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->sectorService->update($sector);
            return $this->redirectToRoute('sector_index');
        }

        return $this->render('sector/edit.html.twig', [
            'sector' => $sector,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sector_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sector $sector): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sector->getId(), $request->request->get('_token'))) {
            $this->sectorService->remove($sector);
        }

        return $this->redirectToRoute('sector_index');
    }

    /**
    * @Route("/{id}/delete", name="sector_form_render", methods={"GET","POST"})
    */
    public function renderFormDelete(Sector $sector)
    {
        return $this->render('sector/_delete_form.html.twig', ['sector' => $sector]);
    }

    private function getRequestEntityName(Request $request): string
    {
        return $request->request->get('sector')['name'];
    }
}
