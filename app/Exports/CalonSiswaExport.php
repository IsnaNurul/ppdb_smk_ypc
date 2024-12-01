<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CalonSiswaExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * Get the data collection for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peserta::whereHas('siswa_register.gelombang.tahun_ajaran', function ($query) {
            $query->where('status', true); // Keep the status condition for the 'tahun_ajaran' table
        })
            ->with('siswa_register')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'NISN' => $item->siswa_register->nisn ?? 'Tidak ada data',
                    'No Peserta' => $item->no_peserta ?? 'Tidak ada data',
                    'NIK' => $item->siswa_register->nik ?? 'Tidak ada data',
                    'Nama Peserta' => $item->siswa_register->nama ?? 'Tidak ada data',
                    'Tempat / Tgl Lahir' => $item->siswa_register->tempat_lahir . ' , ' . $item->siswa_register->tanggal_lahir ?? 'Tidak ada data',
                    'Jenis Kelamin' => $item->siswa_register->jenis_kelamin ?? 'Tidak ada data',
                    'Agama' => $item->siswa_register->agama ?? 'Tidak ada data',
                    'No Handphone' => $item->siswa_register->nohp_siswa ?? 'Tidak ada data',
                    'Alamat Siswa' => $item->siswa_register->alamat_siswa ?? 'Tidak ada data',
                    'Asal Sekolah' => $item->siswa_register->asal_sekolah ?? 'Tidak ada data',
                    'Tahun Lulus' => $item->siswa_register->tahun_lulus ?? 'Tidak ada data',
                    'Pilihan Jurusan 1' => $item->siswa_register->jurusan1 ?? 'Tidak ada data',
                    'Pilihan Jurusan 2' => $item->siswa_register->jurusan2 ?? 'Tidak ada data',
                    'Gelombang' => $item->siswa_register->gelombang ?? 'Tidak ada data',
                    'Tinggi Badan' => $item->siswa_register->tinggi_badan ?? 'Tidak ada data',
                    'Berat Badan' => $item->siswa_register->berat_badan ?? 'Tidak ada data',
                    'Jarak' => $item->siswa_register->ket_jarak ?? 'Tidak ada data',
                    'Waktu' => $item->siswa_register->waktu ?? 'Tidak ada data',
                    'Transportasi' => $item->siswa_register->transportasi ?? 'Tidak ada data',
                    'Anak ke' => $item->siswa_register->anak_ke ?? 'Tidak ada data',
                    'Jumlah Saudara' => $item->siswa_register->jumlah_saudara ?? 'Tidak ada data',
                    'Hobi' => $item->siswa_register->hobi ?? 'Tidak ada data',
                    'Minat Ekskul' => $item->siswa_register->minat_ekskul ?? 'Tidak ada data',

                    // Data orang tua tetap ada
                    'Nama Ayah' => $item->siswa_register->ortuRegister->nama_ayah ?? 'Tidak ada data',
                    'Kontak Ayah' => $item->siswa_register->ortuRegister->nohp_ayah ?? 'Tidak ada data',
                    'Pekerjaan Ayah' => $item->siswa_register->ortuRegister->pekerjaan_ayah ?? 'Tidak ada data',
                    'Alamat Ayah' => $item->siswa_register->ortuRegister->alamat_ayah ?? 'Tidak ada data',
                    'Nama Ibu' => $item->siswa_register->ortuRegister->nama_ibu ?? 'Tidak ada data',
                    'Kontak Ibu' => $item->siswa_register->ortuRegister->nohp_ibu ?? 'Tidak ada data',
                    'Pekerjaan Ibu' => $item->siswa_register->ortuRegister->pekerjaan_ibu ?? 'Tidak ada data',
                    'Alamat Ibu' => $item->siswa_register->ortuRegister->alamat_ibu ?? 'Tidak ada data',
                    'Nama Wali' => $item->siswa_register->ortuRegister->nama_wali ?? 'Tidak ada data',
                    'Kontak Wali' => $item->siswa_register->ortuRegister->nohp_wali ?? 'Tidak ada data',
                    'Pekerjaan Wali' => $item->siswa_register->ortuRegister->pekerjaan_wali ?? 'Tidak ada data',
                    'Alamat Wali' => $item->siswa_register->ortuRegister->alamat_wali ?? 'Tidak ada data',
                ];
            });
    }



    /**
     * Set the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
{
    return [
        'No',
        'NISN',
        'No Peserta',
        'NIK',
        'Nama Peserta',
        'Tempat / Tgl Lahir',
        'Jenis Kelamin',
        'Agama',
        'No Handphone',
        'Alamat Siswa',
        'Asal Sekolah',
        'Tahun Lulus',
        'Pilihan Jurusan 1',
        'Pilihan Jurusan 2',
        'Gelombang',
        'Tinggi Badan(CM)',
        'Berat Badan(KG)',
        'Jarak(KM)',
        'Waktu',
        'Transportasi',
        'Anak Ke',
        'Jumlah Saudara',
        'Hobi',
        'Minat Ekskul',
        'Nama Ayah',
        'Kontak Ayah',
        'Pekerjaan Ayah',
        'Alamat Ayah',
        'Nama Ibu',
        'Kontak Ibu',
        'Pekerjaan Ibu',
        'Alamat Ibu',
        'Nama Wali',
        'Kontak Wali',
        'Pekerjaan Wali',
        'Alamat Wali',
    ];
}
    /**
     * Set styles for the exported file.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Style for column headings (with border)
        $sheet->getStyle('A1:AJ1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Apply border and style to all data rows
        $rowCount = $sheet->getHighestRow(); // Get the last row
        $sheet->getStyle('A2:AJ' . $rowCount)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => 'center',
                'horizontal' => 'center',
            ],
        ]);

        return [];
    }

    /**
     * Set auto size for the columns.
     *
     * @return bool
     */
    public function shouldAutoSize(): bool
    {
        return true;
    }
}