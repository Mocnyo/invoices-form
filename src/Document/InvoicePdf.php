<?php

namespace App\Document;

use App\Entity\Invoice;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoicePdf
{
    public function render(Invoice $invoice, $html)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Faktura $invoice", [
            "Attachment" => true
        ]);

        exit();
    }
}