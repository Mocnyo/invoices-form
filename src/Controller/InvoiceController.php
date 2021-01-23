<?php

namespace App\Controller;

use App\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @Route(path="/", name="invoice")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('invoice/index.html.twig');
    }

    /**
     * @Route(path="/admin/list", name="invoice_list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $invoices = $this->getDoctrine()->getRepository(Invoice::class)->findAll();

        return $this->render('invoice/list.html.twig', [
            'invoices' => $invoices
        ]);
    }

//    /**
//     * @Route(path="/admin/show/{id}", name="invoice_show")
//     * @param Invoice $invoice
//     * @param Request $request
//     */
//    public function showAction(Invoice $invoice, Request $request)
//    {
//
//    }
}