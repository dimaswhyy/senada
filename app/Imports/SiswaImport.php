<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;;


class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'id'    => Str::uuid(),
            'id_unit' => $row['id_unit'],
            'id_unit_account' => $row['id_unit_account'],
            'name' => $row['name'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'nik' => $row['nik'],
            'nis' => $row['nis'],
            'nisn' => $row['nisn'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'agama' => $row['agama'],
            'kewarganegaraan' => $row['kewarganegaraan'],
            'alamat' => $row['alamat'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'kelurahan' => $row['kelurahan'],
            'kecamatan' => $row['kecamatan'],
            'kotkab' => $row['kotkab'],
            'kode_pos' => $row['kode_pos'],
            'jenis_tinggal' => $row['jenis_tinggal'],
            'transportasi' => $row['transportasi'],
            'telepon' => $row['telepon'],
            'hp' => $row['hp'],
            'asal_sekolah' => $row['asal_sekolah'],
            'berkebutuhan_khusus' => $row['berkebutuhan_khusus'],
            'nama_ayah' => $row['nama_ayah'],
            'tanggal_lahir_ayah' => $row['tanggal_lahir_ayah'],
            'jenjang_pendidikan_ayah' => $row['jenjang_pendidikan_ayah'],
            'pekerjaan_ayah' => $row['pekerjaan_ayah'],
            'penghasilan_ayah' => $row['penghasilan_ayah'],
            'nik_ayah' => $row['nik_ayah'],
            'berkebutuhan_khusus_ayah' => $row['berkebutuhan_khusus'],
            'nama_ibu' => $row['nama_ibu'],
            'tanggal_lahir_ibu' => $row['tanggal_lahir_ibu'],
            'jenjang_pendidikan_ibu' => $row['jenjang_pendidikan_ibu'],
            'pekerjaan_ibu' => $row['pekerjaan_ibu'],
            'penghasilan_ibu' => $row['penghasilan_ibu'],
            'nik_ibu' => $row['nik_ibu'],
            'berkebutuhan_khusus_ibu' => $row['berkebutuhan_khusus_ibu'],
            'penerima_kip' => $row['penerima_kip'],
            'nomor_kip' => $row['nomor_kip'],
            'nama_kip' => $row['nama_kip'],
            'nomor_kks' => $row['nomor_kks'],
            'no_akta_lahir' => $row['no_akta_lahir'],
            'layak_pip' => $row['layak_pip'],
            'alasan_pip' => $row['alasan_pip'],
            'kebutuhan_khusus' => $row['kebutuhan_khusus'],
            'anak_ke' => $row['anak_ke'],
            'lintang' => $row['lintang'],
            'bujur' => $row['bujur'],
            'berat_badan' => $row['berat_badan'],
            'tinggi_badan' => $row['tinggi_badan'],
            'jumlah_saudara' => $row['jumlah_saudara'],
            'jarak_rumah' => $row['jarak_rumah'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'profil_siswa' => $row['profil_siswa'],
            'keterangan' => $row['keterangan'],
            'role_id' => $row['role_id'],
        ]);
    }
}
