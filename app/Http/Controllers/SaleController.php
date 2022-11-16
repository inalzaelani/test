<?php

namespace App\Http\Controllers;


use LDAP\Result;
use Carbon\carbon;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\sale_det;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function Transaksi(Request $request)
    {
        if ($request->has('search')) {
            $data =  DB::table('customers')
                ->join('sales',  'sales.cust_id', '=', 'customers.kode')->where('sales.kode', 'like', "%" . $request->search . "%")->paginate(5);
        } else {
            $data =  DB::table('customers')
                ->join('sales',  'sales.cust_id', '=', 'customers.kode')->paginate(5);
        }
        return view("sale.transaksi")->with('data', $data);
    }

    public function TambahSale()
    {
        $q = DB::table('sales')->select(DB::raw('MAX(RIGHT(kode,4))as code'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->code) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {

            $kd = "0001";
        }

        $data2 = Customer::all();

        $data3 = Barang::all();

        $data4 =  DB::table('barangs')
            ->join('sale_dets', 'sale_dets.barang_id', '=', 'barangs.kode')
            ->get();


        return view("sale.input_sale", compact('data2', 'data3', 'data4', 'kd'));
    }

    public function TambahBarang(Request $request)
    {
        $kode_barang = $request->kode_barang;
        $harga_barang = (Barang::select('harga')->where('kode', $kode_barang)->first())->harga;
        $diskon_nilai = ($request->diskon_pct / 100) * $harga_barang;
        $harga_diskon = $harga_barang - $diskon_nilai;
        $total = $harga_diskon * $request->jumlah_barang;

        $data = sale_det::create([
            "sales_id" => $request->sales_id = 0,
            "barang_id" => $request->kode_barang,
            "harga_bandrol" => $harga_barang,
            "qty" => $request->jumlah_barang,
            "diskon_pct" => $request->diskon_pct,
            "diskon_nilai" => $diskon_nilai,
            "harga_diskon" => $harga_diskon,
            "ongkir" => $request->ongkir = 0,
            "total" => $total,
        ]);


        $barang = Barang::where('kode', $request->kode_barang)->first();
        if ($barang->jumlah_barang < $request->jumlah_barang) {
            return redirect()->route('TambahSale')->with('error');
        } else {
            $barang->jumlah_barang -= $request->jumlah_barang;
            $barang->save();
            return redirect()->route('TambahSale');
        }
    }

    public function Store(Request $request)
    {
        $data = Sale::create([
            "kode" => $request->kode,
            "tanggal" => $request->tanggal,
            "cust_id" => $request->cust_id,
            "qty" => $request->qty,
            "subtotal" => $request->sub_total,
            "diskon" => $request->diskon,
            "ongkir" => $request->ongkir,
            "total_bayar" => $request->total_bayar,
        ]);

        sale_det::truncate();
        return redirect()->route('Transaksi');
    }

    public function EditSale($id)
    {
        $data = sale_det::find($id);
        $barang = Barang::where('kode', $data->barang_id)->first();
        $barang->jumlah_barang += $data->qty;
        $barang->save();
        return view('sale.edit_sale', compact('data'));
    }

    public function EditStore(Request $request, $id)
    {
        $data = sale_det::find($id);
        $data->update([
            'diskon_pct' => $request->diskon_pct
        ]);
        $barang = Barang::where('kode', $data->barang_id)->first();
        if ($barang->jumlah_barang < $request->qty) {
            return redirect()->route('TambahSale')->with('error');
        } else {
            $barang->jumlah_barang -= $request->qty;
            $barang->save();
        }
        return redirect()->route('TambahSale');
    }

    public function Delete($id)
    {
        $data = sale_det::find($id);
        $data->delete();
        $barang = Barang::where('kode', $data->barang_id)->first();
        $barang->jumlah_barang += $data->qty;
        $barang->save();

        return redirect()->route('TambahSale');
    }
}
