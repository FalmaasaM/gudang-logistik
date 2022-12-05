@extends('barang.layout')

@section('content')

<form action="">
<div class="input-group mt-3 mb-2">
  <input name="search" type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
</div>
</form>

<h4 class="">Data Gudang</h4>

<a href="{{ route('gudang.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-4 text-center align-middle">
    <thead>
      <tr>
        <th>ID Gudang</th>
        <th>Tanggal Masuk</th>
        <th>Jumlah Barang</th>
        <th>No Order</th>
        <th>ID Barang</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_gudang }}</td>
                <td>{{ $data->tanggal_masuk }}</td>
                <td>{{ $data->jumlah_barang }}</td>
                <td>{{ $data->no_order }}</td>
                <td>{{ $data->id_barang }}</td>
                
                <td>
                    <a href="{{ route('gudang.edit', $data->id_gudang) }}" type="button" class="btn btn-primary rounded-3">Ubah</a>

                 
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_gudang}}">
                        Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $data->id_gudang }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('gudang.delete', $data->id_gudang) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#recycle{{ $data->id_gudang}}">
                        Recycle
                    </button> -->

                    <!-- Modal -->
                    <!-- <div class="modal fade" id="recycle{{ $data->id_gudang }}" tabindex="-1" aria-labelledby="recycleLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="recycleLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('gudang.recycle', $data->id_gudang) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- <h4 class="">Recycle</h4>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID Gudang</th>
        <th>Tanggal Masuk</th>
        <th>Jumlah Barang</th>
        <th>No Order</th>
        <th>ID Barang</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datasrecycle as $data)
            <tr>
                <td>{{ $data->id_gudang }}</td>
                <td>{{ $data->tanggal_masuk }}</td>
                <td>{{ $data->jumlah_barang }}</td>
                <td>{{ $data->no_order }}</td>
                <td>{{ $data->id_barang }}</td>
                <td>
                    <a href="{{ route('gudang.restore', $data->id_gudang) }}" type="button" class="btn btn-secondary rounded-3">Restore</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table> -->
@stop