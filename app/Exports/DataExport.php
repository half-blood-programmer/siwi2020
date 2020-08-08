<?php
namespace App\Exports;
use App\Post;
use App\User;
use App\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class DataExport implements  WithHeadings, ShouldAutoSize, FromQuery, WithEvents
{
    use Exportable;

    public function __construct(int $prodi)
    {
        switch( $prodi )
        {
            case 1:
                    $this->prodi = "D-III Akuntansi";
                    break;
            case 2:
                    $this->prodi = "D-III Pajak";
                    break;
            case 3:
                    $this->prodi = "D-I Pajak";
                    break;
            case 4:
                    $this->prodi = "D-III PBB/Penilai";
                    break;
            case 5:
                    $this->prodi = "D-III Kepabeanan dan Cukai";
                    break;
            case 6:
                    $this->prodi = "D-I Kepabeanan dan Cukai";
                    break;
            case 7:
                    $this->prodi = "D-III Kebendaharaan Negara";
                    break;
            case 8:
                    $this->prodi = "D-I Kebendaharaan Negara";
                    break;
            case 9:
                    $this->prodi = "D-III Manajemen Aset";
                    break;
            case 10:
                    $this->prodi = "D-III Akuntansi Alih Program";
                    break;
            case 11:
                    $this->prodi = "D-III Kebendaharaan Negara Alih Program";
                    break;
            case 12:
                    $this->prodi = "D-III Kepabeanan dan Cukai Alih Program";
                    break;
            case 13:
                    $this->prodi = "D-III Pajak Alih Program";
                    break;
            case 14:
                    $this->prodi = "D-IV Akuntansi Alih Program (Non AKT)";
                    break;
            case 15:
                    $this->prodi = "D-IV Akuntansi Alih Program (AKT)";
                    break;
            default:
                    $this->prodi = " ";
                    break;
        }
        
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:T1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function query()
    {
        return Mahasiswa::query()->where('prodi', $this->prodi)
        ->leftJoin('users', 'users.npm', '=', 'mahasiswas.npm')
        ->leftJoin('togas', 'togas.UserId', '=', 'mahasiswas.id')
        ->leftJoin('alamats', 'togas.UserId', '=', 'mahasiswas.id')
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
                    'togas.photo');
    }

  public function headings(): array
    {
        return [
            'id',
            'Nama',
            'Email',
            'JK',
            'NPM',
            'Kelas',
            'Absen',
            'Size Toga ',
            'Alamat',
            'Provinsi',
            'Kota',
            'Kecamatan',
            'Kelurahan',
            'Kode Pos',
            'No Whatsapp',
            'Nama Ayah',
            'Nama Ibu',
            'Photo'
        ];
    }
}
