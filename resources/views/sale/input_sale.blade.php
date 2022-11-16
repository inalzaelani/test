@extends('template.master')
@section('content')
@php
    $no=1;
    $sum=0;
    $sum2=0;
@endphp
<div class="container">
  <form action="/storesale" method="POST" enctype="multipart/form-data">
    @csrf
    <h5>Transaksi</h5>
    <div class="form-group col-md-3">
        <div class="input-group-prepend">
            <span>No</span>
        </div>
            <input type="text" class="form-control form-control-sm" value={{ date('dmY').'-'. $kd }} name="kode" readonly>
    </div>

      <div class="form-group col-md-3">
        <div class="input-group-prepend">
            <span>Tanggal</span>
        </div>
            <input type="date" class="form-control form-control-sm" name="tanggal" value={{ date('Y-m-d') }} required>
      </div>
      
      <h5>Customer</h5>

      <div class="form-group">
        <div class="input-group-prepend">
          </div>
          <select class="form-select" aria-label="Default select example" name="cust_id" required>
            <option value="">Pilih Customer</option>
            @foreach ($data2 as $item)
                @if(isset($item))
                        <option value="{{ $item->kode }}">{{ $item->kode }}|| {{ $item->nama_customer }} || No Telp (+62){{ $item->no_telp }}</option>
                @endif
                @endforeach
          </select>
        </div>
{{-- 
    <div class="form-group col-md-3">
      
        <div class="input-group-prepend">
          <span>Nama</span>
        </div>
            <input type="text" class="form-control form-control-sm" name="nama" id="nama" required>
    </div>

    <div class="form-group col-md-3">
        <div class="input-group-prepend">
          <span>No Telp</span>
        </div>
            <input type="text" class="form-control form-control-sm" name="no_telp" id="no_telp" required>
    </div> --}}

    <div class="container mt-3">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Barang
      </button>
    </div>
  
<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr lass="d-flex">
          <th scope="col" rowspan="2">Aksi</th>
          <th scope="col" rowspan="2">No</th>
          <th scope="col" rowspan="2">Kode barang</th>
          <th scope="col" rowspan="2">Nama Barang</th>
          <th scope="col" rowspan="2">Qty</th>
          <th scope="col" rowspan="1">Harga Bandrol</th>
          <th scope="col">Diskon</th>
          <th></th>
          <th scope="col" >Harga Diskon</th>
          <th scope="col">Total</th>
        </tr>
        <tr>
          <th></th>
          <th>(%)</th>
          <th>Rp</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
        @foreach ($data4 as $item)
        <tr>
          <td>
            <a href="/editsale/{{ $item->id }}"><button type="button" class="btn btn-secondary">Edit</button></a>
            <a href="/deletecart/{{ $item->id }}"><button type="button" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Data?')">Hapus</button>
          </td>
          <td>{{ $no++ }}</td>
          <td>{{ $item->barang_id }}</td>
          <td>{{ $item->nama_barang }}</td>
          <td>{{ $item->qty }}</td>
          <td>Rp.{{ number_format($item->harga_bandrol,0,',','.') }}</td>
          <td>{{  number_format($item->diskon_pct)  }}%</td>
          <td>Rp.{{ number_format($item->diskon_nilai,0,',','.') }}</td>
          <td>Rp.{{ number_format($item->harga_diskon,0,',','.') }}</td>
          <td>Rp.{{ number_format($item->total,0,',','.') }}</td>
        </tr>
              @php
              $sum+=$item->total;
              $sum2+=$item->qty;
              @endphp
        @endforeach
      </tbody>
         
    </table>
  </div>
</div>
  

<div class="container m-auto">
  <p class="text-md">Jumlah Barang <input type="number" value="{{$sum2}}" name="qty" readonly> </p>


<p class="text-md-end">Subtotal <input type="number" value="{{ $sum }}" id="subtotal" name="sub_total"onkeyup="jumlah()" readonly> </p>
  <p class="text-md-end">Diskon <input type="number" min=0 id="diskon" name="diskon" onkeyup="jumlah()" required> </p>
  <p class="text-md-end">Ongkir <input type="number" min=0 id="ongkir" name="ongkir" onkeyup="jumlah()" required> </p>
  <p class="text-md-end">Total Bayar <input type="number" readonly id="total_bayar" name="total_bayar" > </p>

  <script>
    function jumlah(){
      var subtotal= parseInt(document.getElementById('subtotal').value);
      var diskon= parseInt(document.getElementById('diskon').value);
      var ongkir= parseInt(document.getElementById('ongkir').value);
      var total = (parseInt(subtotal)-parseInt(diskon))+parseInt(ongkir);

      if (!isNaN(total)) {
         document.getElementById('total_bayar').value = total;
      }
    }
  </script>

    <p class="text-center"><button type="submit" class="btn btn-success">Simpan</button>
</div>
  
</div>
</div>
</form> 

<form action="/tambahbarangcart" method="POST" enctype="multipart/form-data">
  @csrf
<div class="container mt-5">  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          @csrf
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <select class="form-select" aria-label="Default select example" name="kode_barang">
            <option selected>Pilih Barang</option>
            @foreach ($data3 as $item)
              @if(isset($item))
                <option value={{ $item->kode }}>{{ $item->kode }}||
                  <p>{{ $item->nama_barang }}||</p>
                <p>Stok:{{ $item->jumlah_barang  }}pcs</p></option>
              @endif
            @endforeach
          </select>
          @error('jumlah_barang')
          <div class="error">Stok tidak mencukupi</div>
          @enderror
          Jumlah Barang
          <div class="input-group flex-nowrap mt-2">
            <input type="number" class="form-control" placeholder="Jumlah Barang" aria-describedby="addon-wrapping" name="jumlah_barang">
          </div>

          Diskon
          <div class="input-group flex-nowrap mt-2">
            <input type="number" class="form-control" placeholder="Diskon" aria-describedby="addon-wrapping" name="diskon_pct" value=0 min=0>
            <span class="input-group-text">%</span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah Barang</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

