<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{

    public function addNewBatch(Request $request)
    {

        // dd($request->all());
        // try {    
        $save = $request->validate([
            'medicine_id'       => 'required|exists:medicines,id',
            'batch_number'      => 'required|string|max:100',
            'expiry_date'       => 'required|date',
            'stock_date'        => 'required|date',
            'initial_quantity'  => 'required|integer|min:0',
            'current_quantity'  => 'required|integer|min:0',
            'status'            => 'required|in:ditarik,tersedia,expire',
        ]);
        $stock = Stock::create($save);

        $inventory = $request->validate([
            'medicine_id'       => 'required|exists:medicines,id',
            // 'stock_id'          => 'required|exists:stocks,id', // from $stock
            // 'type'              => 'required|in:masuk,keluar', // default masuk
            'quantity'          => 'required|integer|min:0',
            'description'       => 'nullable|string|max:255',
            // 'date'              => 'required|date', // default now() or $request->stock_date
        ]);

        $inventory['stock_id'] = $stock->id;
        $inventory['type'] = 'masuk';
        $inventory['date'] = $request->stock_date;

        Inventory::create($inventory);


        return redirect()->route('stock.manastock')->with('success', 'Batch baru berhasil ditambah');
        // } catch (ValidationException $e) {
        //     return redirect()->back()->withErrors($e->validator)->withInput();
        // }
    }

    public function updateBatch(Request $request, $id)
    {
        $data = Stock::find($id);
        $save = $request->validate([
            'expiry_date'       => 'required|date',
            'stock_date'        => 'required|date',
            'status'            => 'required|in:ditarik,tersedia,expire',
        ]);
        $data->update($save);
        return redirect()->route('stock.manastock')->with('success', 'Batch berhasil diupdate');
    }

    public function transactionUpdateStock($id_batch, $quantity, $type)
    {
        $stock = Stock::find($id_batch);
        if (!$stock) {
            return redirect()->back()->with('error', 'Batch tidak ditemukan');
        }

        if ($type === 'masuk') {
            $stock->current_quantity += $quantity;
        } elseif ($type === 'keluar') {
            if ($stock->current_quantity < $quantity) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk pengurangan');
            }
            $stock->current_quantity -= $quantity;
        } else {
            return redirect()->back()->with('error', 'Tipe transaksi tidak valid');
        }

        $inventory = new Inventory();
        $inventory->medicine_id = $stock->medicine_id;
        $inventory->stock_id = $stock->id;
        $inventory->type = $type;
        $inventory->quantity = $quantity;
        $inventory->description = ($type === 'masuk') ? 'Penambahan stok' : 'Pengurangan stok';
        $inventory->date = now();


        $stock->save();
        $inventory->save();

        return redirect()->back()->with('success', 'Penjualan berhasil');
    }




    public function index()
    {
        $stocks = Stock::with('medicine')->get();
        return view('stock.index', compact('stocks'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $stocks = Stock::where(function ($query) use ($searchTerm) {
            $query->whereHas('medicine', function ($q) use ($searchTerm) {
                $q->where('generic_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brand_name', 'like', '%' . $searchTerm . '%');
            })
                ->orWhere('batch_number', 'like', '%' . $searchTerm . '%');
        })->with('medicine')->get();

        return response()->json($stocks);
    }

    public function delete($id)
    {
        $data = Stock::find($id);

        try {
            if (!$data) {
                return redirect()->route('stock')->with('error', 'Data tidak ditemukan');
            }

            $data->delete();

            return redirect()->route('stock')->with('success', 'Stock berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('stock')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
