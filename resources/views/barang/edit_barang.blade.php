@extends('template.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
              <h1 class="justify-content-center">Edit Data Barang</h1>
                <div class="cardbody">
                    <form action="/editstorebarang/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @error('kode')
                          <div class="alert alert-danger">{{ "Kode telah digunakan, Silakan gunakan Kode lain!" }}</div>   
                          @enderror
                        <div class="mb-3">
                          <label class="form-label">Kode Barang</label>
                          <input type="number" class="form-control" name="kode" value="{{ $data->kode }}" required>
                        </div>
  
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" value="{{ $data->nama_barang }}" required>
                          </div>
  
                          <div class="mb-3">
                              <label class="form-label">Tambah Stok</label>
                              <input type="number" min="1" class="form-control" name="tambah_stok" value=0 required>
                            </div>
  
                          <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Harga</label>
                              <input type="number" min="1" class="form-control" name="harga" value="{{ $data->harga }}" required>
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>