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

    public function __construct(int $prodi_id)
    {
        $this->prodi_id = $prodi_id;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function query()
    {
        return Mahasiswa::query()->where('prodi_id', $this->prodi_id)
        ->join('users', 'users.id', '=', 'mahasiswas.id')
        ->join('alamats', 'alamats.id' , '=', 'mahasiswas.id')
        ->join('togas', 'togas.id', '=', 'mahasiswas.id')
        ->select('mahasiswas.id',
                    'mahasiswas.name',
                    'mahasiswas.jenis_kelamin',
                    'mahasiswas.npm',
                    'mahasiswas.kelas',
                'togas.size_toga',
                'alamats.alamat',
                'alamats.kode_pos',
                    'togas.nama_ayah',
                    'togas.nama_ibu');
    }

  public function headings(): array
    {
        return [
            'id',
            'Nama',
            'JK',
            'NPM',
            'Kelas',
            'Size Toga ',
            'Alamat',
            'Kode Pos',
            'Nama Ayah',
            'Nama Ibu'
        ];
    }
}
