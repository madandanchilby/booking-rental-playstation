<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class InvoiceController extends Controller
{
    public function print_invoice()
    {
        $currentDate = now()->format('d/m/Y h:m:s');
        $printerId = 'POS-58';
        $connector = new WindowsPrintConnector($printerId);
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setEmphasis(true);
        $printer->text("Kopi Raya \n");
        $printer->text("Jl. Ring Road Utara No.11, Yogyakarta \n");
        $printer->feed(2);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Tanggal: $currentDate \n");
        $printer->text("Kasir: Nico \n");
        $printer->setEmphasis(false);
        $printer->text("\n===============================\n");
        $printer->text(sprintf("%.0f x %s \n", 2, "Kopi Sanger"));
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text('Rp. ' . number_format(50000, 2) . "\n");
        $printer->text("\n===============================\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->setEmphasis(true);
        $printer->text("Total: Rp. " . number_format(50000, 2) . "\n");
        $printer->text("Bayar: Rp. " . number_format(70000, 2) . "\n");
        $printer->text("Kembali: Rp. " . number_format(20000, 2) . "\n");
        $printer->feed(2);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Terima Kasih Telah Berkunjung");
        $printer->feed(5);
        $printer->close();

        return response()->json(['status' => 200, 'message' => 'printed invoice successfully']);
    }
}
