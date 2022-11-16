@extends('template.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-8">
              <div class="card">
                <h1 class="justify-content-center">Edit Data Customer</h1>
                  <div class="cardbody">
                      <form action="/editstoresale/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                          @csrf
    
                          <div class="mb-3">
                              <label class="form-label">Jumlah Barang</label>
                              <input type="text" class="form-control" name="qty" value="{{ $data->qty }}">
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Diskon (%)</label>
                                <input type="number" class="form-control" name="diskon_pct"  value="{{ $data->diskon_pct }}" min=0 required>
                              </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>
              </div>