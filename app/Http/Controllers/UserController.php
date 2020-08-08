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

    public function index($prodi)
    {

        switch( $prodi )
        {
            case 1:
                    $prodii = "D-III Akuntansi";
                    break;
            case 2:
                    $prodii = "D-III Pajak";
                    break;
            case 3:
                    $prodii = "D-I Pajak";
                    break;
            case 4:
                    $prodii = "D-III PBB/Penilai";
                    break;
            case 5:
                    $prodii = "D-III Kepabeanan dan Cukai";
                    break;
            case 6:
                    $prodii = "D-I Kepabeanan dan Cukai";
                    break;
            case 7:
                    $prodii = "D-III Kebendaharaan Negara";
                    break;
            case 8:
                    $prodii = "D-I Kebendaharaan Negara";
                    break;
            case 9:
                    $prodii = "D-III Manajemen Aset";
                    break;
            case 10:
                    $prodii = "D-III Akuntansi Alih Program";
                    break;
            case 11:
                    $prodii = "D-III Kebendaharaan Negara Alih Program";
                    break;
            case 12:
                    $prodii = "D-III Kepabeanan dan Cukai Alih Program";
                    break;
            case 13:
                    $prodii = "D-III Pajak Alih Program";
                    break;
            case 14:
                    $prodii = "D-IV Akuntansi Alih Program (Non AKT)";
                    break;
            case 15:
                    $prodii = "D-IV Akuntansi Alih Program (AKT)";
                    break;
            default:
                    $prodii = " ";
                    break;
        }
        $users = DB::table('mahasiswas')
        ->leftJoin('users', 'users.npm', '=', 'mahasiswas.npm')
        ->leftJoin('togas', 'togas.UserId', '=', 'mahasiswas.id')
        ->leftJoin('alamats', 'togas.UserId', '=', 'mahasiswas.id')
        ->where('mahasiswas.prodi', $prodii)
        ->select('mahasiswas.id',
                    'mahasiswas.nama',
                'users.email',
                    'mahasiswas.jenisKelamin',
                    'mahasiswas.npm',
                    'mahasiswas.kelas',
                    'mahasiswas.absen',
                'alamats.sizeToga',
                'alamats.alamat',
                'alamats.provinsi',
                'alamats.kota',
                'alamats.kecamatan',
                'alamats.kelurahan',
                'alamats.kodepos',
                'alamats.nomorWhatsapp',
                    'togas.namaAyah',
                    'togas.namaIbu',
                    'togas.photo')
        ->orderBy(request()->sortby, request()->sortbydesc)
            ->when(request()->q, function($users) {
                $users = $users->where('mahasiswas.id', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('mahasiswas.nama', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('mahasiswas.npm', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('mahasiswas.kelas', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.sizeToga', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.alamat', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.provinsi', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.kota', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.kecamatan', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.kelurahan', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.kodepos', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('alamats.nomorWhatsapp', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('togas.namaAyah', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('togas.namaIbu', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('togas.photo', 'LIKE', '%' . request()->q . '%')
                    ->orWhere('users.email', 'LIKE', '%' . request()->q . '%');
        })->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $users]);
    }
    public function download_data($prodi, $name_data)
    {
        $data_name = 'Data-'.$name_data.'.xlsx';
        return (new DataExport($prodi))->download($data_name);
    }
    public function destroy($id)
    {
        $users = Mahasiswa::find($id);
        $users->delete();
        return response()->json(['status' => 'success']);
    }

}
