<?php

namespace App\Http\Controllers;

use App\Models\TrnVakasi;
use App\Models\VakasiNilai;
use Illuminate\Http\Request;
use App\Models\SettingVakasi;
use App\Models\Tahunakademik;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
// use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class CetakVakasiController extends Controller
{
    public function index()
    {
        return view('dashboard.cetakvakasi.index',[
            // 'vakasinilais' => VakasiNilai::paginate(15),
        ]);
    }

    public function getVakasiNilai(Request $request)
    {
        $data = VakasiNilai::select('periode','nip','dosen_pengajar','prodi')
        ->groupBy('periode','dosen_pengajar', 'nip','prodi')
        ->get();

    if ($request->ajax()) {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $rows = 
                    '<a href="/dashboard/detailcetakvakasi/'.$row['nip'].'/'.$row['periode'].'" class="badge bg-info">Detail</a>
                    ';
                
                    return $rows;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    }

    public function detailCetakVakasi(Request $request)
    {
        $dataUTS = DB::table('vakasi_nilais AS t1')
        ->select(
            't1.id',
            't1.periode',
            't1.id_kelas',
            't1.kode_mk',
            't1.nama_mk',
            't1.nama_kelas',
            't1.tgl_pengisian_nilai_uts',
            't1.tgl_pengisian_nilai_uas',
            't1.jumlah_peserta_kelas',
            't1.nip',
            't1.dosen_pengajar',
            't2.id as id_trn_vakasi', 
            't2.insentif_vakasi_uts',
            't2.insentif_soal_uts',
            't2.status_cetak_uts',
            't2.insentif_vakasi_uas',
            't2.insentif_soal_uas',
            't2.status_cetak_uas')
        ->leftJoin('trn_vakasis as t2', 't1.id', '=', 't2.id_jadwal')
        ->where('nip',$request->nip)
        ->where('periode',$request->periode)
        ->orderBy('t1.kode_mk', 'asc')
        ->orderBy('t1.nama_mk', 'asc')
        ->get();

        // return $vakasiUTS;
         return view('dashboard.cetakvakasi.detail',[
            'datauts' => $dataUTS,
            'nip' => $request->nip,
            'periode' => $request->periode
        ]);
    }

    public function getDataVakasi(Request $request)
    {
        $data = TrnVakasi::find($request->id);
        return response()->json($data);
    }

    public function storeDataVakasi(Request $request)
    {
        // dd($request->jenis_vakasi);
        if ($request->jenis_vakasi == "UTS") {
            VakasiNilai::where('id', $request->id_jadwal)
            ->update(['tgl_pengisian_nilai_uts' => $request->tgl_pengisian_nilai_uts]);

            $dataVakasi = [
                'id_jadwal' => $request->id_jadwal,
                'status_cetak_uts' => $request->status_cetak_uts,
                'insentif_vakasi_uts' =>  (int)$request->insentif_vakasi_uts,
                'insentif_soal_uts' =>  (int)$request->insentif_soal_uts,
            ];
        }else{
            VakasiNilai::where('id', $request->id_jadwal)
            ->update(['tgl_pengisian_nilai_uas' => $request->tgl_pengisian_nilai_uas]);

            $dataVakasi = [
                'id_jadwal' => $request->id_jadwal,
                'status_cetak_uas' => $request->status_cetak_uas,
                'insentif_vakasi_uas' =>  (int)$request->insentif_vakasi_uas,
                'insentif_soal_uas' =>  (int)$request->insentif_soal_uas,
            ];
        }
        
        TrnVakasi::create($dataVakasi);
        return back()->with('success', 'Data vakasi telah dibuat!');
    }

    public function updateDataVakasi(Request $request)
    {
        if ($request->jenis_vakasi == "UTS") {
            VakasiNilai::where('id', $request->id_jadwal)
            ->update(['tgl_pengisian_nilai_uts' => $request->tgl_pengisian_nilai_uts]);

            $dataVakasi = [
                'status_cetak_uts' => $request->status_cetak_uts,
                'insentif_vakasi_uts' =>  (int)$request->insentif_vakasi_uts,
                'insentif_soal_uts' =>  (int)$request->insentif_soal_uts,
            ];
        }else{
            VakasiNilai::where('id', $request->id_jadwal)
            ->update(['tgl_pengisian_nilai_uas' => $request->tgl_pengisian_nilai_uas]);

            $dataVakasi = [
                'status_cetak_uas' => $request->status_cetak_uas,
                'insentif_vakasi_uas' =>  (int)$request->insentif_vakasi_uas,
                'insentif_soal_uas' =>  (int)$request->insentif_soal_uas,
            ];
        }

        TrnVakasi::where('id_jadwal', $request->id_jadwal)
        ->update($dataVakasi);
        // alert()->success('Success Title', 'Success Message');

        return redirect()->back()->with('success', 'Data vakasi telah diubah!');
    }


    public function cetakpdf(Request $request)
    {
        // dd($request->jenis_vakasi);
        $jenis_vakasi = $request->jenis_vakasi;
        $status_cetak = '';
        if ($jenis_vakasi == "UTS") {
            $status_cetak = "status_cetak_uts";
        }else{ 
            $status_cetak = "status_cetak_uas";
        }

        $vakasi = DB::table('vakasi_nilais AS t1')
        ->select(
            't1.id',
            't1.periode',
            't1.id_kelas',
            't1.kode_mk',
            't1.nama_mk',
            't1.nama_kelas',
            't1.tgl_pengisian_nilai_uts',
            't1.tgl_pengisian_nilai_uas',
            't1.jumlah_peserta_kelas',
            't1.nip',
            't1.bonus_soal_uts',
            't1.bonus_soal_uas',
            't1.dosen_pengajar',
            't2.id as id_trn_vakasi', 
            't2.insentif_vakasi_uts',
            't2.insentif_soal_uts',
            't2.status_cetak_uts',
            't2.insentif_vakasi_uas',
            't2.insentif_soal_uas',
            't2.status_cetak_uas')
        ->leftJoin('trn_vakasis as t2', 't1.id', '=', 't2.id_jadwal')
        ->where('nip',$request->nip)
        ->where('periode',$request->periode)
        ->where($status_cetak,'T')
        ->orderBy('t1.kode_mk', 'asc')
        ->get();
        // return $vakasi;

        $setting_vakasi = SettingVakasi::where('is_active','Y')->first();
        // return $setting_vakasi;
    
        $data_dosen = VakasiNilai::select('dosen_pengajar','nip','prodi')
        ->groupBy('dosen_pengajar','nip','prodi')
        ->where('nip', $request->nip)
        ->first();
        // return $data_dosen;

        $tahun_akademik = Tahunakademik::where('kode_tahun', $request->periode)
        ->first();

        // return $tahun_akademik;

        $data = [
            'vakasi' => $vakasi,
            'setting' => $setting_vakasi,
            'data_dosen' => $data_dosen,
            'jenis_vakasi' => $jenis_vakasi,
            'tahun_akademik' => $tahun_akademik,
        ];

        $total_vakasi = [];
            foreach ($vakasi as $item) {
                $trnVakasi = TrnVakasi::find($item->id_trn_vakasi);
                if ($jenis_vakasi== "UTS") {
                    $trnVakasi->status_cetak_uts = "Y";
                    $trnVakasi->tgl_cetak_uts = date('Y-m-d');
                    if ($item->tgl_pengisian_nilai_uts <= $tahun_akademik->tgl_batas_uts) {
                        $total_vakasi[] = ($item->jumlah_peserta_kelas * $setting_vakasi->honor_soal) + $item->insentif_vakasi_uts;
                    }else{
                        $total_vakasi[] = ($item->jumlah_peserta_kelas * $setting_vakasi->honor_soal_lewat) + $item->insentif_vakasi_uts;
                    }                    
                }else{
                    $trnVakasi->status_cetak_uas = "Y";
                    $trnVakasi->tgl_cetak_uas = date('Y-m-d');
                    if ($item->tgl_pengisian_nilai_uas <= $tahun_akademik->tgl_batas_uas) {
                        $total_vakasi[] = ($item->jumlah_peserta_kelas * $setting_vakasi->honor_soal) + $item->insentif_vakasi_uas;
                    }else{
                        $total_vakasi[] = ($item->jumlah_peserta_kelas * $setting_vakasi->honor_soal_lewat) + $item->insentif_vakasi_uas;
                    }
                }
                $trnVakasi->save();
            }

        $data['total'] = array_sum($total_vakasi);
	
 	foreach ($vakasi as $item) {
            if ($jenis_vakasi== "UTS") {
                VakasiNilai::where('bonus_soal_uts',"T")
                ->where('nip',$request->nip)
                ->where('periode',$request->periode)
                ->where('kode_mk',$item->kode_mk)
                ->update(['bonus_soal_uts' => "Y"]);
            }else{
                VakasiNilai::where('bonus_soal_uas',"T")
                ->where('nip',$request->nip)
                ->where('periode',$request->periode)
                ->where('kode_mk',$item->kode_mk)
                ->update(['bonus_soal_uas' => "Y"]);
            }
        }

        
        // $pdf = PDF::loadView('laporan-vakasi-pdf', $data);
        $pdf = PDF::loadview('kwitansi', $data);


        // alternative simpan dulu file nya kemudian nanti download
        $content = $pdf->download()->getOriginalContent();
	Storage::disk('public')->put('test.pdf', $content);

        $path = "https://vakasi.ft.unpas.ac.id/storage/public/test.pdf";
        
        // alert()->html('<i>HTML</i> <u>example</u>',"You can use <b>bold text</b>, <a href='$path'>links</a> and other HTML tags",'success')->autoclose(false);
	toast()->html("Vakasi telah selesai diproses","<a href='$path' class='btn btn-primary'>Unduh Invoice</a>",'success')->autoclose(false);
        return redirect()->back();

    }

    public function cetakalert(Request $request)
    {
        alert()->html('<i>HTML</i> <u>example</u>',"You can use <b>bold text</b>, <a href='//github.com'>links</a> and other HTML tags",'success')->autoclose(false);
        return redirect()->back();
    }
}
