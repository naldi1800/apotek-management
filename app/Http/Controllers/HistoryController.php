<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history.index');
    }

    public function create()
    {
        return view('history.create');
    }

    public function generatePdf($from, $to)
    {
        $history = History::with('sparepart')->whereBetween('created_at', [$from, $to])->get();
        $data = [
            'datas' => $history,
            'from' => $from,
            'to' => $to
        ];
        $pdf = Pdf::loadView('history.pdf', $data);

        $fromDate = \Carbon\Carbon::parse($from);
        $toDate = \Carbon\Carbon::parse($to);
        $fileName = $fromDate->format('d-m-Y') . ' - ' . $toDate->format('d-m-Y') . ' DataBarangMasuk.pdf';

        if ($fromDate->format('F') === $toDate->format('F') && $fromDate->format('Y') === $toDate->format('Y')) {
            $fileName = $fromDate->format('F') . ' '. $fromDate->format('Y') . '-DataBarangMasuk.pdf';
        }

        return $pdf->download($fileName);
    }

    public function print($from, $to){
        $history = History::with('sparepart')->whereBetween('created_at', [$from, $to])->get();
        $data = [
            'datas' => $history,
            'from' => $from,
            'to' => $to
        ];
        return view('history.print', $data);
    }
}
