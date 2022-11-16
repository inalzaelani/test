@extends('template.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
              <h1 class="justify-content-center">Tambah Data Barang</h1>
                <div class="cardbody">
                    <form action="/storebarang" method="POST" enctype="multipart/form-data">
                        @csrf
                        @error('kode')
                          <div class="alert alert-danger">{{ "Kode telah digunakan, Silakan gunakan Kode lain!" }}</div>   
                          @enderror
                        <div class="mb-3">
                          <label class="form-label">Kode Barang</label>
                          <input type="number" class="form-control" name="kode" required>
                        </div>
  
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" required>
                          </div>
  
                          <div class="mb-3">
                              <label class="form-label">Jumlah</label>
                              <input type="number" min="1" class="form-control" name="jumlah_barang" required>
                            </div>
  
                          <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Harga</label>
                              <input type="number" min="1" class="form-control" name="harga" required>
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                      <table class="table table-sm">
                          <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga Barang</th>
                            <th scope="col">Aksi</th>
                          </tr>
                          @foreach ($data as $item)
                          <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->jumlah_barang }}</td>
                                <td>Rp. {{ number_format($item->harga,0,',','.') }}</td>
                                <td>
                                  <a href="/editbarang/{{ $item->id }}"><button type="button" class="btn btn-secondary">Edit</button></a>
                                  <a href="/deletebarang/{{ $item->id }}"><button type="button" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Data?')">Hapus</button>
                                </td>
                          </tr>
                          @endforeach
                        </table>
                </div>
            </div>
            
           
        </div>
    </div>
</div>
@endsection

