<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

use App\Exports\DataExport;
use App\Mahasiswa;

class UserController extends Controller
{

    public function index($id)
    {
        $users = DB::table('mahasiswas')
        ->join('users', 'users.id', '=', 'mahasiswas.id')
        ->join('alamats', 'alamats.id' , '=', 'mahasiswas.id')
        ->join('togas', 'togas.id', '=', 'mahasiswas.id')
        ->where('mahasiswas.prodi_id', $id)
        ->orderBy(request()->sortby, request()->sortbydesc)
            ->when(request()->q, function($users) {
                $users = $users->where('mahasiswas.id', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('mahasiswas.name', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('users.email', 'LIKE', '%' . request()->q . '%');
        })->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $users]);
    }
    public function download_data($prodi_id, $name_data)
    {
        $data_name = 'Data-'.$name_data.'.xlsx';
        return (new DataExport($prodi_id))->download($data_name);
    }
    public function destroy($id)
    {
        $users = Mahasiswa::find($id);
        $users->delete();
        return response()->json(['status' => 'success']);
    }

}
