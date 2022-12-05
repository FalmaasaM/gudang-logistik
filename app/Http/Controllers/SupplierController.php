<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index() {
        $datas = DB::select('select * from supplier');

        return view('supplier.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('supplier.add');
    }

    public function store(Request $request) {
        $request->validate([
            'no_order' => 'required',
            'nama_supplier' => 'required',
            'alamat' => 'required',
        
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO supplier(no_order, nama_supplier, alamat) VALUES (:no_order, :nama_supplier, :alamat)',
        [
            'no_order' => $request->no_order,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('supplier')->where('no_order', $id)->first();

        return view('supplier.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'no_order' => 'required',
            'nama_supplier' => 'required',
            'alamat' => 'required',
            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE supplier SET no_order = :no_order, nama_supplier = :nama_supplier, alamat = :alamat WHERE no_order = :id',
        [
            'id' => $id,
            'no_order' => $request->no_order,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'total' => $request->total,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM supplier WHERE no_order = :no_order', ['no_order' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_pembeli', $id)->delete();

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil dihapus');
    }


}
