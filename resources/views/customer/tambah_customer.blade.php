@extends('template.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-8">
              <div class="card">
                <h1 class="justify-content-center">Tambah Customer</h1>
                  <div class="cardbody">
                      <form action="/storecustomer" method="POST" enctype="multipart/form-data">
                          @csrf
                          @error('Kode')
                            <div class="alert alert-danger">{{ "Kode telah digunakan, Silakan gunakan Kode lain!" }}</div>   
                            @enderror
                          <div class="mb-3">
                            <label class="form-label">Kode Customer</label>
                            <input type="number" class="form-control" name="kode" required>
                          </div>
    
                          <div class="mb-3">
                              <label class="form-label">Nama Customer</label>
                              <input type="text" class="form-control" name="nama_customer" required>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="number" class="form-control" name="no_telp" required>
                              </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>
              </div>
              
              <table class="table table-sm">
                <tr>
                  <th scope="col">Kode Customer</th>
                  <th scope="col">Nama Customer</th>
                  <th scope="col">No Telp</th>
                  <th scope="col">Aksi</th>
                </tr>
                
                  @foreach ($data as $item)
                  <tr>
                      <td>{{ $item->kode }}</td>
                      <td>{{ $item->nama_customer }}</td>
                      <td>(+62){{ $item->no_telp }}</td>
                      <td>
                        <a href="/editcustomer/{{ $item->id }}"><button type="button" class="btn btn-secondary">Edit</button></a>
                        <a href="/deletecustomer/{{ $item->id }}"><button type="button" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Data?')">Hapus</button>
                      </td>
                  </tr>
                  @endforeach
                
              </table>
          </div>
      </div>
</div>
@endsection