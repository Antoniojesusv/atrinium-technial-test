<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\CompanyService;
use App\Factories\FactoryInterface;
use App\Factories\EntityFactory;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    public function __construct(CompanyService $CompanyService, FactoryInterface $entityFactory)
    {
        $this->companyService = $CompanyService;
        $this->entityFactory = $entityFactory;
    }
    /**
     * @Route("/", name="company_index", methods={"GET"})
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        $companies = $this->companyService->get();
        $sectorArray = $this->buildSectorArray($companies);
        return $this->render('company/index.html.twig', [
            'companies' => $companies,
            'sector' => $sectorArray
        ]);
    }

    /**
     * @Route("/new", name="company_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $company = $this->entityFactory->getInstance('company');
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $this->getRequestEntityName($request);
            $this->companyService->save($name);
            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods={"GET"})
     */
    public function show(Company $company): Response
    {
        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="company_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->companyService->update($company);
            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->request->get('_token'))) {
            $this->companyService->remove($company);
        }

        return $this->redirectToRoute('company_index');
    }

    /**
     * @Route("/{id}/delete", name="company_form_render", methods={"GET","POST"})
     */
    public function renderFormDelete(Company $company)
    {
        return $this->render('company/_delete_form.html.twig', ['company' => $company,]);
    }

    private function buildSectorArray(array $companies)
    {
        return array_map(function ($company) {
            return $company->getSector()->getName();
        }, $companies);
    }

    private function getRequestEntityName(Request $request): string
    {
        return $request->request->get('company')['name'];
    }
}
