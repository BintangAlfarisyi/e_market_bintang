<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use App\Models\Produk;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class BarangController extends Controller
{
    public function index()
    {
        try {
            $produk = Produk::pluck('nama_produk', 'id');
            $user = User::pluck('name', 'id');
            $barang = Barang::orderBy('created_at', 'DESC')->get();

            // dd($data);

            return view('barang.index', compact('barang', 'produk', 'user'));
        } catch (QueryException | Exception | PDOException $error) {
            // $this->failResponse($error->getMessage(), $error->getCode());
            dd($error->getMessage());
        }
    }
    
    public function store(StoreBarangRequest $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            Barang::create($request->all());
            DB::commit();

            return redirect('barang')->with('success', 'Data barang berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollback();
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }
    
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());

        return redirect('barang')->with('success', 'Update Data Berhasil!');
    }

    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return redirect('barang')->with('success', 'Delete Data Berhasil!');
        } catch (QueryException | Exception | PDOException $error) {
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }
}
