@extends('barang.layout')

@section('content')

<h4 class="mt-5">Stok Gudang</h4>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<form action="">
<div class="input-group mb-3">
  <input name="search" type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
</div>
</form>

<table class="table table-hover mt-4 text-center align-middle">
    <thead>
      <tr>
       <th>Id Barang</th>
        <th>Nama Barang</th>
        <th>Merk Barang</th>
        <th>Jenis Barang</th>
        <th>Nama Supplier</th>
        <th>Tanggal Masuk </th>
        <th>Jumlah Barang</th>
        
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_barang }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>{{ $data->merk_barang }}</td>
                <td>{{ $data->jenis_barang }}</td>
                <td>{{ $data->nama_supplier }}</td>
                <td>{{ $data->tanggal_masuk }}</td>
                <td>{{ $data->jumlah_barang }}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>
@stop