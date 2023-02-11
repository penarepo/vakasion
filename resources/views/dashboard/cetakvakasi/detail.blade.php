@extends('dashboard.layouts.main')



@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <h1 class="h2">Detail Vakasi Nilai</h1>

</div>

<div class="mb-3">

    <a href="/dashboard/cetakpdfvakasi/{{$nip}}/{{$periode}}/UTS" class="btn btn-primary">Proses Vakasi UTS</a>

    <a href="/dashboard/cetakpdfvakasi/{{$nip}}/{{$periode}}/UAS" class="btn btn-primary">Proses Vakasi UAS</a>

    {{-- <a href="/dashboaprd/cetakpdfalert/{{$nip}}/{{$periode}}/UAS" class="btn btn-primary">Cetak Alert</a> --}}

    {{-- <button id="alert-button">Show Alert</button> --}}



</div>



<div class="" style="margin-top: 30px">

    <blockquote class="blockquote">

        <footer class="blockquote-footer">Pastikan TM (Insentif Tepat Mengajar) sudah terisi sebelum melakukan proses vakasi</footer>

      </blockquote>

</div>





<div class="table-responsive">



    @if($sukses = Session::get('sukses'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $sukses }}</strong>

        </div>

    @endif

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                {{-- <h1>Data Kelas</h1> --}}

                <table class="table table-striped table-sm" id="tblVakasiKelas">

                    <thead class="text-center">

                        <tr>

                            <th scope="col">#</th>

                            <th scope="col">Kode</th>

                            <th scope="col">Matakuliah</th>

                            <th scope="col">Kelas</th>

                            <th scope="col">Mhs</th>

                            <th scope="col">Tgl Pengisian UTS</th>

                            <th scope="col">TM UTS</th>

                            <th scope="col">Vakasi UTS</th>

                            <th scope="col">Tgl Pengisian UAS</th>

                            <th scope="col">TM UAS</th>

                            <th scope="col">Vakasi UAS</th>

                            <th scope="col">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-center">

                        @foreach($datauts as $data)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                {{-- <td>{{ $data->id }}</td> --}}

                                <td>{{ $data->kode_mk }}</td>

                                <td>{{ $data->nama_mk }}</td>

                                <td>{{ $data->nama_kelas }}</td>

                                <td>{{ $data->jumlah_peserta_kelas }}</td>

                                <td>{{ $data->tgl_pengisian_nilai_uts }}</td>

                                <td>{{ $data->insentif_vakasi_uts }} </td>

                                <td>

                                    <i

                                        data-feather="{{ $data->status_cetak_uts == 'Y' ? 'check-circle' : 'circle' }}"></i>

                                </td>

                                <td>{{ $data->tgl_pengisian_nilai_uas }}</td>

                                <td>{{ $data->insentif_vakasi_uas }}</td>

                                <td>

                                    <i

                                        data-feather="{{ $data->status_cetak_uas == 'Y' ? 'check-circle' : 'circle' }}"></i>

                                </td>

                                <td>

                                    <button class="badge bg-info border-0" id="btnDetailUTS"

                                        data-id-jadwal="{{ $data->id }}"

                                        data-tgl-uts="{{ $data->tgl_pengisian_nilai_uts }}"

                                        data-id-trn-vakasi="{{ $data->id_trn_vakasi != null ? $data->id_trn_vakasi : '' }}">Detail

                                        UTS</button>

                                    <button class="badge bg-info border-0" id="btnDetailUAS"

                                        data-id-jadwal="{{ $data->id }}"

                                        data-tgl-uas="{{ $data->tgl_pengisian_nilai_uas }}"

                                        data-id-trn-vakasi="{{ $data->id_trn_vakasi != null ? $data->id_trn_vakasi : '' }}">Detail

                                        UAS</button>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="detalMk" tabindex="-1" role="dialog" aria-labelledby="detalMkTitle" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle">Detail Vakasi ADD</h5>

                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="row">

                <form action="/dashboard/createvakasinilai" method="POST">

                    @csrf

                    <div class="modal-body">

                        <div id="form_vakasi"></div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="updateMk" tabindex="-1" role="dialog" aria-labelledby="detalMkTitle" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle">Detail Vakasi UPDATE</h5>

                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="row">

                <form action="/dashboard/updatevakasinilai" method="POST">

                    @csrf

                    <div class="modal-body">

                        <div id="form_vakasi_update"></div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>





<script src="/js/cetakvakasi.js"></script>




@endsection

