<?php

namespace App\Http\Controllers;

use App\Exports\ProdukExport;
use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data['produk'] = Produk::orderBy('created_at', 'ASC')->get();

            return view('produk.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        // Error Handling
        try{
        DB::beginTransaction(); #Mulai Transaksi
        Produk::create($request->all()); #Query Input Ke Table

        DB::commit(); #Menyimpan Data Ke Database

        // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
        return redirect('produk')->with('success', 'Data produk berhasil ditambahkan!');

        }catch(QueryException | Exception | PDOException $error){
            DB::rollback(); #Undo Perubahan Query/Table
            $this->failResponse($error->getMessage(), $error->getCode());
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $produk->update($request->all());

        return redirect('produk')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        try{
            $produk->delete();
            return redirect('produk')->with('success', 'Delete Data Berhasil');
        }catch(QueryException | Exception | PDOException $error){
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function generatepdf()
    {
        $data['produk'] = Produk::get();
        $pdf = PDF::loadView('produk.data', $data);
        return $pdf->download('produk.pdf');
    }


    public function generateexcel()
    {
        $date = date('Y-m-d');
        return Excel::download(new ProdukExport(), $date . 'produk.xlsx');

        // $data['pengajuan'] = Pengajuan::get();
        // $excel = Excel::loadView('pengajuan.data', $data);
        // return $excel->download('pengajuan.xlxs');
    }
}
