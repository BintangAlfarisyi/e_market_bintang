<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Http\Requests\StorePemasokRequest;
use App\Http\Requests\UpdatePemasokRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pemasok'] = Pemasok::orderBy('created_at', 'ASC')->get();

        return view('pemasok.index')->with($data);
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
     * @param  \App\Http\Requests\StorePemasokRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemasokRequest $request)
    {
        try{
            DB::beginTransaction(); #Mulai Transaksi
            Pemasok::create($request->all()); #Query Input Ke Table
    
            DB::commit(); #Menyimpan Data Ke Database
    
            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('pemasok')->with('success', 'Data pemasok berhasil ditambahkan!');
    
            }catch(QueryException | Exception | PDOException $error){
                DB::rollback(); #Undo Perubahan Query/Table
                // $this->failResponse($error->getMessage(), $error->getCode());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasok $pemasok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasok $pemasok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePemasokRequest  $request
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePemasokRequest $request, Pemasok $pemasok)
    {
        $pemasok->update($request->all());

        return redirect('pemasok')->with('success', 'Update Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasok $pemasok)
    {
        try{
            $pemasok->delete();
            return redirect('pemasok')->with('success', 'Delete Data Berhasil');
        }catch(QueryException | Exception | PDOException $error){
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }
}
