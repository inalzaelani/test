<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function TambahCustomer()
    {
        $data =  DB::table('customers')->paginate(5);
        return view("customer.tambah_customer")->with('data', $data);
    }

    public function Store(Request $request)
    {
        $data = Customer::create([
            "kode" => $request->kode,
            "nama_customer" => $request->nama_customer,
            "no_telp" => $request->no_telp,
        ]);
        return redirect()->route('TambahCustomer');
    }
    public function EditCustomer($id)
    {
        $data = Customer::find($id);
        return view('customer.edit_customer', compact('data'));
    }

    public function EditStore(Request $request, $id)
    {
        $request->validate([
            "kode" => 'required|unique:customers,kode,' . $request->id,
        ]);

        $data = Customer::find($id);
        $data->update([
            "kode" => $request->kode,
            "nama_customer" => $request->nama_customer,
            "no_telp" => $request->no_telp,
        ]);
        return redirect()->route('TambahCustomer');
    }

    public function Delete($id)
    {
        $data = Customer::find($id);
        $data->delete();

        return redirect()->route('TambahCustomer');
    }
}
