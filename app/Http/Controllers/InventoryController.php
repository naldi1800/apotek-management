<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventory.index');
    }

    public function generatePdf($from, $to)
    {
        $inventories = Inventory::with('medicine', 'stock')->whereBetween('date', [$from, $to])->get();
        $data = [
            'datas' => $inventories,
            'from' => $from,
            'to' => $to
        ];
        $pdf = Pdf::loadView('inventory.pdf', $data);

        $fromDate = \Carbon\Carbon::parse($from);
        $toDate = \Carbon\Carbon::parse($to);
        $fileName = $fromDate->format('d-m-Y') . ' - ' . $toDate->format('d-m-Y') . ' DataObat.pdf';

        if ($fromDate->format('F') === $toDate->format('F') && $fromDate->format('Y') === $toDate->format('Y')) {
            $fileName = $fromDate->format('F') . ' ' . $fromDate->format('Y') . '-DataObat.pdf';
        }

        return $pdf->download($fileName);
    }

    public function print($from, $to)
    {
        // dd($from, $to);
        // $to = Carbon::parse($to)->format('F Y');
        // $from = Carbon::parse($from)->format('F Y');
        // Format the from and to dates as 'Y-m-d'
        $fromFormatted = Carbon::parse($from)->format('Y-m-d');
        $toFormatted = Carbon::parse($to)->format('Y-m-d');
        $history = Inventory::with('medicine', 'stock')->whereBetween('date', [$from, $to])->get();
        // dd($history);
        // dd($fromFormatted, $toFormatted);
        $data = [
            'datas' => $history,
            'from' => $fromFormatted,
            'to' => $toFormatted
        ];
        return view('inventory.print', $data);
    }
}
