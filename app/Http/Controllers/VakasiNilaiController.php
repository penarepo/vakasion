<?php

namespace App\Http\Controllers;

use App\Imports\VakasiNilaiImport;
use App\Models\VakasiNilai;
use App\Http\Requests\StoreVakasiNilaiRequest;
use App\Http\Requests\UpdateVakasiNilaiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use DB;

class VakasiNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.vakasinilai.index',[
            // 'vakasinilais' => VakasiNilai::paginate(15),
        ]);
    }

    public function importExcel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ], [
            'file.required' => 'File wajib diisi.',
            'file.mimes' => 'Format file harus csv,xls atau xlsx.'
        ]);

        VakasiNilai::whereNotNull('id')->delete();

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        // $file->move('vakasi_nilai', $nama_file);
        // $path = "https://vakasi.ft.unpas.ac.id/vakasi_nilai/";
        // dd($path);
        Excel::import(new VakasiNilaiImport, $file);

        Session::flash('sukses', 'Data Nilai Berhasil Diimport!');

        return redirect('/dashboard/vakasinilais');
    }

    public function getVakasiNilai(Request $request)
    {
        $data = VakasiNilai::select('id','periode', 'kode_mk', 'nama_mk','nama_kelas','nip','dosen_pengajar')
            // ->groupBy('dosen_pengajar', 'nip', 'nidn','prodi')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $rows = 
                        '<a href="/dashboard/vakasinilais/edit/'.$row['id'].'" class="badge bg-info">Edit</a>
                        <form action="/dashboard/deletevakasinilai/'.$row['id'].'" method="post" class="d-inline" id="form'.$row['id'].'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                            <a href="javascript:;" class="badge bg-danger border-0" id="btnDelete" data="' . $row['id'] . '">Delete</a>
                        </form>
                        ';
                    
                        return $rows;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        VakasiNilai::destroy($request->id);
        return redirect('dashboard/vakasinilais')->with('success','Data successfull deleted!');
    }

    public function show(Request $request)
    {
        return $request;
    }

    public function edit(Request $request)
    {
        $vakasiNilai = VakasiNilai::find($request->id);
        // return $vakasiNilai;
        return view('dashboard.vakasinilai.edit',[
            'data' => $vakasiNilai,
        ]);
    }
}
