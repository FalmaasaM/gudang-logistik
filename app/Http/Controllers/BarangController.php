<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('select * from barang WHERE nama_barang like :search AND recycle=0 ',[
            'search'=>'%'.$request->search.'%',
        ]);
        
        $datasrecycle = DB::select('select * from barang WHERE nama_barang like :search AND recycle=1',[
            'search'=>'%'.$request->search.'%',
        ]);

        return view('barang.index')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);
        }
       else{
        $datas = DB::select('select * from barang WHERE recycle=0');
        $datasrecycle = DB::select('select * from barang WHERE recycle=1');

        return view('barang.index')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);   
       }
    }
    public function join(Request $request) {
        if($request->has('search')){
            $datas = DB::select('SELECT barang.id_barang,barang.nama_barang,barang.merk_barang,barang.jenis_barang,supplier.nama_supplier,gudang.tanggal_masuk,gudang.jumlah_barang FROM `barang` RIGHT JOIN supplier ON supplier.no_order = barang.no_order LEFT JOIN gudang ON gudang.id_barang = barang.id_barang WHERE barang.nama_barang like :search',[
                'search'=>'%'.$request->search.'%',
            ]);

        return view('join')
            ->with('datas', $datas);
        }
        else {
            $datas = DB::select('SELECT barang.id_barang,barang.nama_barang,barang.merk_barang,barang.jenis_barang,supplier.nama_supplier,gudang.tanggal_masuk,gudang.jumlah_barang FROM `barang` RIGHT JOIN supplier ON supplier.no_order = barang.no_order LEFT JOIN gudang ON gudang.id_barang = barang.id_barang');

        return view('join')
            ->with('datas', $datas);
        }
    }
    public function create() {
        return view('barang.add');
    }

    public function riwayat(){
            $datas = DB::select('select * from barang WHERE recycle=0');
            $datasrecycle = DB::select('select * from barang WHERE recycle=1');
    
            return view('barang.riwayat')
                ->with('datas', $datas)
                ->with('datasrecycle', $datasrecycle);   
           
    }

    public function store(Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'jenis_barang' => 'required',
            'no_order' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO barang(id_barang, nama_barang, merk_barang, jenis_barang, no_order) VALUES (:id_barang, :nama_barang, :merk_barang, :jenis_barang, :no_order)',
        [
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'merk_barang' => $request->merk_barang,
            'jenis_barang' => $request->jenis_barang,
            'no_order' => $request->no_order,
        ]
        );

 

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('barang')->where('id_barang', $id)->first();

        return view('barang.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'jenis_barang' => 'required',
            'no_order' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE barang SET id_barang = :id_barang, nama_barang = :nama_barang, merk_barang = :merk_barang, jenis_barang = :jenis_barang, no_order = :no_order WHERE id_barang = :id',
        [
            'id' => $id,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'merk_barang' => $request->merk_barang,
            'jenis_barang' => $request->jenis_barang,
            'no_order' => $request->no_order,
        ]
        );

 

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah');
    }

    public function delete($id) {
        DB::delete('DELETE FROM barang WHERE id_barang = :id_barang', ['id_barang' => $id]);
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }
    public function recycle($id) {
        DB::update('UPDATE barang set recycle = 1 WHERE id_barang = :id_barang', ['id_barang' => $id]);
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }
    public function restore($id) {
        DB::update('UPDATE barang set recycle = 0 WHERE id_barang = :id_barang', ['id_barang' => $id]);
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil direstore');
    }
}
