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

        <h5 class="card-title fw-bolder mb-3">Tambah Barang</h5>

		<form method="post" action="{{ route('barang.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang">
            </div>
			<div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang">
            </div>
            <div class="mb-3">
                <label for="merk_barang" class="form-label">Merk Barang</label>
                <input type="text" class="form-control" id="merk_barang" name="merk_barang">
            </div>
            <div class="mb-3">
                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                <input type="text" class="form-control" id="jenis_barang" name="jenis_barang">
            </div>
            <div class="mb-3">
                <label for="no_order" class="form-label">No Order</label>
                <input type="text" class="form-control" id="no_order" name="no_order">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop