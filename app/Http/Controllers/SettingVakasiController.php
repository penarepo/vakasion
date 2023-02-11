<?php

namespace App\Http\Controllers;

use App\Models\SettingVakasi;
use App\Models\Tahunakademik;
use Illuminate\Http\Request;

class SettingVakasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.settingvakasi.index',[
            'settingvakasis' => SettingVakasi::all(),
        ]);
        // return view('dashboard.tahunakademiks.index',[
        //     'tahunakademiks' => Tahunakademik::all(),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.settingvakasi.create');
    }

    public function store(Request $request)
    {
        // return 'halaman sesudah add';
        $validatedData = $request->validate([
            'kode_setting' => 'required|unique:setting_vakasis',
            'honor_soal' => 'required',
            'honor_pembuat_soal' => 'required',
            'honor_pengawas' => 'required',
            'honor_soal_lewat' => 'required',
            'is_active' => 'required',
        ]);

        SettingVakasi::create($validatedData);

        $request->session()->flash('success','Setting Vakasi successfull created!');

        return redirect('dashboard/settingvakasis');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingVakasi  $settingVakasi
     * @return \Illuminate\Http\Response
     */
    public function show(SettingVakasi $settingVakasi)
    {
        return $settingVakasi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingVakasi  $settingVakasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $settingvakasi = SettingVakasi::find($request->id);
        // return $vakasiNilai;
        return view('dashboard.settingvakasi.edit',[
            'data' => $settingvakasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingVakasiRequest  $request
     * @param  \App\Models\SettingVakasi  $settingVakasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingVakasi $settingVakasi)
    {
        $validatedData = $request->validate([
            'kode_setting' => '',
            'honor_soal' => 'required',
            'honor_pembuat_soal' => 'required',
            'honor_pengawas' => 'required',
            'honor_soal_lewat' => 'required',
            'is_active' => 'required',
        ]);

        settingVakasi::where('id', $request->id)
        ->update($validatedData);

        return redirect('dashboard/settingvakasis')->with('success', 'Setting Vakasi has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingVakasi  $settingVakasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        SettingVakasi::destroy($request->id);

        // $request->session()->flash('success','Registration successfull!');

        return redirect('dashboard/settingvakasis')->with('success','Setting successfull deleted!');
    }
}
