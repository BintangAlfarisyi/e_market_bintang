<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use PDOException;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::orderBy('created_at', 'ASC')->get();

        return view('user.index')->with($data);
    }

    public function store(StoreUserRequest $request)
    {
        try{
            DB::beginTransaction(); #Mulai Transaksi
            User::create($request->all()); #Query Input Ke Table
    
            DB::commit(); #Menyimpan Data Ke Database
    
            // Untuk Merefresh ke halaman itu kembali untuk melihat hasil
            return redirect('user')->with('success', 'Data user berhasil ditambahkan!');
    
            }catch(QueryException | Exception | PDOException $error){
                DB::rollback(); #Undo Perubahan Query/Table
                // $this->failResponse($error->getMessage(), $error->getCode());
            }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect('user')->with('success', 'Update Data Berhasil!');
    }

    public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect('user')->with('success', 'Delete Data Berhasil');
        }catch(QueryException | Exception | PDOException $error){
            // $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlxs');
    }
}
