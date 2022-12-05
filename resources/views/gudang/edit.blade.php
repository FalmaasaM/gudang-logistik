@extends('barang.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Gudang</h5>

		<form method="post" action="{{ route('gudang.update', $data->id_gudang) }}">
			@csrf
            <div class="mb-3">
                <label for="id_gudang" class="form-label">ID Gudang</label>
                <input type="text" class="form-control" id="id_gudang" name="id_gudang" value="{{ $data->id_gudang}}">
            </div>
			<div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal_Masuk</label>
                <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $data->tanggal_masuk }}">
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" value="{{ $data->jumlah_barang }}">
            </div>
            <div class="mb-3">
                <label for="no_order" class="form-label">No Order</label>
                <input type="text" class="form-control" id="no_order" name="no_order" value="{{ $data->no_order }}">
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" value="{{ $data->id_barang }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop