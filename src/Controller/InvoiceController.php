<?php

namespace App\Controller;

use App\Document\InvoicePdf;
use App\Entity\Invoice;
use App\Form\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @Route(path="/", name="invoice_new")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function newAction(Request $request, EntityManagerInterface $manager): Response
    {
        $invoice = new Invoice();
        $invoice->init();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($invoice);
            $manager->flush();

            $this->addFlash('success', 'Pomyślnie wygenerowano fakture.');

            $invoiceToPdf = new InvoicePdf();
            $invoiceToPdf->render($invoice, $this->renderView('document/invoicepdf.html.twig', [
                'invoice' => $invoice
            ]));

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('invoice/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/list", name="invoice_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(): Response
    {
        $invoices = $this->getDoctrine()->getRepository(Invoice::class)->findAll();

        return $this->render('invoice/list.html.twig', [
            'invoices' => $invoices
        ]);
    }

    /**
     * @Route(path="/admin/show/{id}", name="invoice_show")
     * @param Invoice $invoice
     * @return Response
     */
    public function showAction(Invoice $invoice): Response
    {

        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice
        ]);
    }

    /**
     * @Route(path="/admin/delete/{id}", name="invoice_delete")
     * @param Invoice $invoice
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse
     * @return RedirectResponse
     */
    public function deleteAction(Invoice $invoice, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($invoice);
        $entityManager->flush();

        $this->addFlash('success', 'Pomyślnie usunięto fakture.');

        return $this->redirectToRoute('invoice_list');
    }

    /**
     * @Route(path="/admin/download/{id}", name="invoice_download")
     * @param Invoice $invoice
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function downloadPdf(Invoice $invoice, Request $request): RedirectResponse
    {
        $invoiceToPdf = new InvoicePdf();
        $invoiceToPdf->render($invoice, $this->renderView('document/invoicepdf.html.twig', [
            'invoice' => $invoice
        ]));

        return $this->redirect($request->headers->get('referer'));
    }
}