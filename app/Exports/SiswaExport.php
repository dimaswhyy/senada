<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::all();
    }
    public function headings(): array{
        return [
            "id","id_unit","id_unit_account","name","jenis_kelamin","nik","nis","nisn","tempat_lahir","tanggal_lahir","agama","kewarganegaraan","alamat","rt","rw","kelurahan","kecamatan","kotkab","kode_pos","jenis_tinggal","transportasi","telepon","hp","asal_sekolah","berkebutuhan_khusus","nama_ayah","tanggal_lahir_ayah","jenjang_pendidikan_ayah","pekerjaan_ayah","penghasilan_ayah","nik_ayah","berkebutuhan_khusus_ayah","nama_ibu","tanggal_lahir_ibu","jenjang_pendidikan_ibu","pekerjaan_ibu","penghasilan_ibu","nik_ibu","berkebutuhan_khusus_ibu","penerima_kip","nomor_kip","nama_kip","nomor_kks","no_akta_lahir","layak_pip","alasan_pip","kebutuhan_khusus","anak_ke","lintang","bujur","berat_badan","tinggi_badan","jumlah_saudara","jarak_rumah","email","password","profil_siswa","keterangan","role_id","create_at","update_at"];
    }
}
