<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function TambahBarang()
    {
        $data =  DB::table('barangs')->paginate(5);
        return view("barang.tambah_barang")->with('data', $data);
    }

    public function Store(Request $request)
    {
        $request->validate([
            "kode" => 'required|unique:barangs,kode,' . $request->id,
        ]);

        $data = Barang::create([
            "kode" => $request->kode,
            "nama_barang" => $request->nama_barang,
            "jumlah_barang" => $request->jumlah_barang,
            "harga" => $request->harga
        ]);
        return redirect()->route('TambahBarang');
    }
    public function EditBarang($id)
    {
        $data = Barang::find($id);
        return view('barang.edit_barang', compact('data'));
    }

    public function EditStore(Request $request, $id)
    {
        $data = Barang::find($id);
        $data->update([
            "kode" => $request->kode,
            "nama_barang" => $request->nama_barang,
            "harga" => $request->harga
        ]);
        $barang = Barang::where('kode', $request->kode)->first();
        $barang->jumlah_barang += $request->tambah_stok;
        $barang->save();

        return redirect()->route('TambahBarang');
    }

    public function Delete($id)
    {
        $data = Barang::find($id);
        $data->delete();

        return redirect()->route('TambahBarang');
    }
}
