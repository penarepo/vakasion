<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VakasiNilai;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengisianNilaiController extends Controller
{
    public function index()
    {
        return view('dashboard.pengisiannilai.index',[
            'vakasinilais' => VakasiNilai::paginate(15),
        ]);
    }

    public function getPengisianNilai(Request $request)
    {
        $data = VakasiNilai::select('id','periode', 'kode_mk', 'nama_mk','nama_kelas','nip','dosen_pengajar','tgl_pengisian_nilai_uts','tgl_pengisian_nilai_uas')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $rows = 
                        '<a href="/dashboard/pengisiannilai/edit/'.$row['id'].'" class="badge bg-info">Edit</a>';
                        return $rows;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(Request $request)
    {
        $vakasiNilai = VakasiNilai::find($request->id);
        // return $vakasiNilai;
        return view('dashboard.pengisiannilai.edit',[
            'data' => $vakasiNilai,
        ]);
    }

    public function update(Request $request)
    {
        // return 'data berhasil diupdate';

        $data = [
            'tgl_pengisian_nilai_uts' => $request->tgl_pengisian_nilai_uts,
            'tgl_pengisian_nilai_uas' => $request->tgl_pengisian_nilai_uas,
        ];
        
        VakasiNilai::where('id', $request->id)
        ->update($data);

        return redirect('/dashboard/pengisiannilai')->with('success', 'Tgl Pengisian Nilai telah diubah!');
    }
}
