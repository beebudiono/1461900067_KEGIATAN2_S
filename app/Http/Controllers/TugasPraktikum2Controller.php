<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use Illuminate\Http\Request;

class TugasPraktikum2Controller extends Controller
{
    public function tugas_praktikum_2(Request $request)
    {   
        $query = Guru::select('nama_guru', 'nip', 'kelamin', 'alamat_guru', 'telpon_guru', 'username');
        $select = $query->get();
        
        $query = Jadwal::join('data_guru', 'data_guru.id_guru', '=', 'tbl_jadwal.id_guru')
                                ->join('setup_pelajaran', 'setup_pelajaran.id_pelajaran', '=', 'tbl_jadwal.id_pelajaran')
                                ->join('setup_kelas', 'setup_kelas.id_kelas', '=', 'tbl_jadwal.id_kelas');

        if($request->has("search")){
            $query->where('data_guru.nama_guru', 'like', '%' . $request->search . '%');
        }

        $select_join = $query->get();

        return view('tugaspraktikum-0067', compact('select', 'select_join'));
    }
}
