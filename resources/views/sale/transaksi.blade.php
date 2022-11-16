@extends('template.master')
@section('content')
@php
use Carbon\carbon;
    $no=1;
    $sum=0;
@endphp
<div class="container-fluid mt-3">

    <div class="container" >
        <form action="/transaksi" method="GET">
            <p class="text-lg-end"><input type="search" name="search" placeholder="Cari...."></p>
        </form>
    </div>
    <h4>Daftar Transaksi</h4>
    <table class="table table-sm table-striped">
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Transaksi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama Customer</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Sub Total</th>
            <th scope="col">Diskon</th>
            <th scope="col">Ongkir</th>
            <th scope="col">Total</th>
        </tr>
        @foreach ($data as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->kode }}</td>
            <td>{{ (new Carbon($item->tanggal ))->isoFormat("D MMMM Y")}}</td>
            <td>{{ $item->nama_customer }}</td>
            <td>{{ $item->qty }}</td>
            <td>Rp.{{ number_format($item->subtotal,0,',','.') }}</td>
            <td>Rp.{{ number_format($item->diskon,0,',','.')}}</td>
            <td>Rp.{{ number_format($item->ongkir,0,',','.') }}</td>
            <td>Rp.{{ number_format($item->total_bayar,0,',','.') }}</td>
            @php
                $sum+=$item->total_bayar;
            @endphp
             @endforeach
        </tr>
        <tr>
            <td colspan="7"></td>
            <td><b>Grand Total</b></td>
            <td>Rp.{{ number_format($sum,0,',','.') }}</td>
        </tr>
       
      </table>
</div>
@endsection