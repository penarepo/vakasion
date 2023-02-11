<?php

namespace App\Http\Controllers;

use App\Models\Tahunakademik;
use Illuminate\Http\Request;

class DashboardTahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tahunakademiks.index',[
            'tahunakademiks' => Tahunakademik::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tahunakademiks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_tahun' => 'required|unique:tahunakademiks',
            'nama_tahun' => 'required|min:3|max:255',
            'tgl_batas_uts' => '',
            'tgl_batas_uas' => '',
            'is_active' => 'required',
        ]);

        Tahunakademik::create($validatedData);

        $request->session()->flash('success','Tahun Akademik successfull created!');

        return redirect('dashboard/tahunakademiks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function show(Tahunakademik $tahunakademik)
    {
        return $tahunakademik;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahunakademik $tahunakademik)
    {
        return view('dashboard.tahunakademiks.edit',[
            'tahunakademik' => $tahunakademik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahunakademik $tahunakademik)
    {
        $validatedData = $request->validate([
            'kode_tahun' => 'required',
            'nama_tahun' => 'required|min:3|max:255',
            'tgl_batas_uts' => '',
            'tgl_batas_uas' => '',
            'is_active' => 'required',
        ]);

        Tahunakademik::where('id', $tahunakademik->id)
        ->update($validatedData);

        return redirect('dashboard/tahunakademiks')->with('success', 'Tahun Akademik has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahunakademik $tahunakademik)
    {
        Tahunakademik::destroy($tahunakademik->id);

        // $request->session()->flash('success','Registration successfull!');

        return redirect('dashboard/tahunakademiks')->with('success','Tahun Akademik successfull deleted!');
    }
}
