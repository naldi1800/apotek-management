<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        return view('transaction.index');
    }

    public function basket()
    {
        return view('basket.index');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $medicine = Medicine::where('obat', 'like', '%' . $searchTerm . '%')->get();

        return response()->json($medicine);
    }
}
