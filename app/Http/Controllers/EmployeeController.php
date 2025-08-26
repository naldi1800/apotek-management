<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
        public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $mode = 'Tambah';
        return view('employee.input', compact(['mode']));
    }

    public function update($id)
    {
        $mode = 'Edit';
        $data = Employee::find($id);
        return view('employee.input', compact(['mode', 'data']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $save = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|max:255|unique:employees,email',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password'
            ]);
            unset($save['confirm_password']);
            $save['password'] = Hash::make($save['password']);
            // dd($save);
            Employee::create($save);
            return redirect()->route('employee')->with('success', 'Employee berhasil ditambah');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function set(Request $request, $id)
    {
        $data = Employee::find($id);
        try {
            $save = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|max:255|unique:employees,email,' . $id,
                // 'status'   => 'required|integer|in:-1,0,1',
            ]);
            // if ($request->filled('password')) {
            //     $save['password'] = bcrypt($request->input('password'));
            // }
            $data->update($save);
            return redirect()->route('employee')->with('success', 'Employee berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function setStatus($id)
    {
        $data = Employee::find($id);
        try {
            if (!$data) {
                return redirect()->route('employee')->with('error', 'Data tidak ditemukan');
            }

            $data->status = $data->status == -1 ? 0 : -1;
            $data->save();

            return redirect()->route('employee')->with('success', 'Status employee berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('employee')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $data = Employee::find($id);

        try {
            if (!$data) {
                return redirect()->route('employee')->with('error', 'Data tidak ditemukan');
            }

            $data->delete();

            return redirect()->route('employee')->with('success', 'Employee berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('employee')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
