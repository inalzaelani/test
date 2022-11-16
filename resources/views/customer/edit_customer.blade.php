@extends('template.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-8">
              <div class="card">
                <h1 class="justify-content-center">Edit Data Customer</h1>
                  <div class="cardbody">
                      <form action="/editstorecustomer/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                            <label class="form-label">Kode Customer</label>
                            <input type="number" class="form-control" name="kode" value="{{ $data->kode }}">
                          </div>
    
                          <div class="mb-3">
                              <label class="form-label">Nama Customer</label>
                              <input type="text" class="form-control" name="nama_customer" value="{{ $data->nama_customer }}">
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="number" class="form-control" name="no_telp"  value="{{ $data->no_telp }}">
                              </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>
              </div>