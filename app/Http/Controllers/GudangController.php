<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GudangController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('select * from gudang WHERE tanggal_masuk like :search AND recycle=0',[
            'search'=>'%'.$request->search.'%',
        ]);
        
        $datasrecycle = DB::select('select * from gudang WHERE tanggal_masuk like :search AND recycle=1',[
            'search'=>'%'.$request->search.'%',
        ]);

        return view('gudang.index')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);
        }
       else{
        $datas = DB::select('select * from gudang WHERE recycle=0');
        $datasrecycle = DB::select('select * from gudang WHERE recycle=1');

        return view('gudang.index')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);   
       }
    }
    public function create() {
        return view('gudang.add');
    }

    public function riwayat(){
        $datas = DB::select('select * from gudang WHERE recycle=0');
        $datasrecycle = DB::select('select * from gudang WHERE recycle=1');

        return view('gudang.riwayat')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);   
       
}

    public function store(Request $request) {
        $request->validate([
            'id_gudang' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_barang' => 'required',
            'no_order' => 'required',
            'id_barang' => 'required',
            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO gudang(id_gudang, tanggal_masuk, jumlah_barang, no_order, id_barang) VALUES (:id_gudang, :tanggal_masuk, :jumlah_barang, :no_order, :id_barang)',
        [
            'id_gudang' => $request->id_gudang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_barang' => $request->jumlah_barang,
            'no_order' => $request->no_order,
            'id_barang' => $request->id_barang,
            
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

        return redirect()->route('gudang.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('gudang')->where('id_gudang', $id)->first();

        return view('gudang.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_gudang' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_barang' => 'required',
            'no_order' => 'required',
            'id_barang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE gudang SET id_gudang = :id_gudang, tanggal_masuk = :tanggal_masuk, jumlah_barang = :jumlah_barang, no_order = :no_order, id_barang = :id_barang WHERE id_gudang = :id',
        [
            'id' => $id,
            'id_gudang' => $request->id_gudang,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_barang' => $request->jumlah_barang,
            'no_order' => $request->no_order,
            'id_barang' => $request->id_barang,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'jenis_biji' => $request->jenis_biji,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('gudang.index')->with('success', 'Data gudang berhasil diubah');
    }

    public function delete($id) {
        DB::delete('DELETE FROM gudang WHERE id_gudang = :id_gudang', ['id_gudang' => $id]);
        return redirect()->route('gudang.index')->with('success', 'Data gudang berhasil dihapus');
    }
    public function recycle($id) {
        DB::update('UPDATE gudang set recycle = 1 WHERE id_gudang = :id_gudang', ['id_gudang' => $id]);
        return redirect()->route('gudang.index')->with('success', 'Data gudang berhasil dihapus');
    }
    public function restore($id) {
        DB::update('UPDATE gudang set recycle = 0 WHERE id_gudang = :id_gudang', ['id_gudang' => $id]);
        return redirect()->route('gudang.index')->with('success', 'Data gudang berhasil direstore');
    }
}
