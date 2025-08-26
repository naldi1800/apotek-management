<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Validation\ValidationException;

class MedicineController extends Controller
{

    public function basket()
    {
        // $basket = Basket::all();
        // if($basket->isEmpty()){
        //     $nota = "Belum terbit";
        // }else{
        //     $nota = $basket->last()->nomor_nota;
        // }
        return view('basket.index');
    }

    public function index()
    {
        // $datas = Medicine::with('category')->get();
        $datas = Medicine::all();
        // dd($datas);
        return view('medicine.index', compact('datas'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $medicines = Medicine::where('generic_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('brand_name', 'like', '%' . $searchTerm . '%')
            ->get();

        return response()->json($medicines);
    }

    public function create()
    {
        $mode = 'Tambah';
        return view('medicine.input', compact(['mode']));
    }

    public function update($id)
    {
        $mode = 'Edit';
        $data = Medicine::find($id);
        return view('medicine.input', compact(['mode', 'data']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $save = $request->validate([
                'generic_name'   => 'required|string|max:255',
                'brand_name'     => 'required|string|max:255',
                'unit'           => 'required|string|max:50',
                'purchase_price' => 'required|numeric|min:0',
                'selling_price'  => 'required|numeric|min:0',
                'bpom_number'    => 'required|string|max:100',
            ]);
            Medicine::create($save);
            return redirect()->route('medicine')->with('success', 'Medicine berhasil ditambah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function set(Request $request, $id)
    {
        $data = Medicine::find($id);
        try {
            $save = $request->validate([
                'generic_name'   => 'required|string|max:255',
                'brand_name'     => 'required|string|max:255',
                'unit'           => 'required|string|max:50',
                'purchase_price' => 'required|numeric|min:0',
                'selling_price'  => 'required|numeric|min:0',
                'bpom_number'    => 'required|string|max:100',
            ]);
            $data->update($save);
            return redirect()->route('medicine')->with('success', 'Medicine berhasil diupdate');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function delete($id)
    {
        $data = Medicine::find($id);

        try {
            if (!$data) {
                return redirect()->route('medicine')->with('error', 'Data tidak ditemukan');
            }

            $data->delete();

            return redirect()->route('medicine')->with('success', 'Medicine berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('medicine')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStock(Request $request, $id)
    {
        $data = Medicine::find($id);
        try {
            $save = $request->validate([
                'stok' => 'required|integer|min:0',
            ]);
            $data->update($save);
            return redirect()->route('medicine')->with('success', 'Stok berhasil diupdate');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function stockUpdate(Request $request)
    {
        $data = Medicine::find($request->nama_medicine);
        try {
            $save = $request->validate([
                'stok_masuk'  => 'required|integer|min:0',
                'total_harga' => 'required|numeric|min:0',
            ]);

            $data->update([
                'stok' => $data->stok + $save['stok_masuk'],
            ]);

            $data->history()->create([
                'jumlah' => $save['stok_masuk'],
                'total_harga' => $save['total_harga'],
                'tanggal_restock' => now(),
            ]);

            return redirect()->route('medicine.manastock')->with('success', 'Stok berhasil diupdate');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }
    public function stock()
    {
        $datas = Medicine::all();
        // dd($datas);
        return view('medicine.stock', compact('datas'));
    }
}
