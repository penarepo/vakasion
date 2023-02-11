$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(function () {
        var tblVakasi = $("#tblVakasi").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/dashboard/getcetakvakasi",
                type: "GET",
                error: function (err) {
                    console.log(err);
                },
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "periode",
                    name: "periode",
                },
                {
                    data: "nip",
                    name: "nip",
                },
                {
                    data: "dosen_pengajar",
                    name: "dosen_pengajar",
                },
                {
                    data: "prodi",
                    name: "prodi",
                },
                {
                    data: "action",
                    name: "action",
                    orderable: true,
                    searchable: true,
                },
            ],
            columnDefs: [
                {
                    targets: [0], // your case first column
                    className: "text-center",
                },
            ],
        });
    });

    $(function () {
        var tblVakasiUTS = $("#tblVakasiKelas").DataTable();
    });

    $(function () {
        var tblVakasiUTS = $("#tblVakasiUTS").DataTable();
    });

    $(function () {
        var tblVakasiUAS = $("#tblVakasiUAS").DataTable();
    });

    $("#tblVakasi").on("click", "#btnDetail", function () {
        data_id = $(this).attr("data");

        $.ajax({
            method: "GET",
            url: "/mk-vakasi-nilai/" + data_id,
            success: function (data) {
                var list_mk = data.length;

                if (list_mk != 0) {
                    $("#list_mk").html("");
                    let no = 1;

                    data.forEach(function (data, i) {
                        list = `
                            <tr>
                                <td class="text-center">${no++}</td>
                                <td class="text-center">${data["nama_mk"]} - ${
                            data["nama_kelas"]
                        }</td>
                                <td class="text-center">${
                                    data["jumlah_peserta_kelas"]
                                }</td>
                                <td class="text-center">${
                                    data["tgl_pengisian_nilai"]
                                }</td>
                                <td class="text-center">${data["status"]}</td>
                                <td class="text-center">${
                                    data["bonus_tepat_mengajar"]
                                }</td>
                                <td class="text-center">${
                                    data["tgl_pencairan"]
                                }</td>
                                <td class="text-center">${
                                    data["status_pencairan"]
                                }</td>
                            </tr>
                        `;
                        $("#list_mk").append(list);
                    });
                    btnNew =
                        "<a href='/cetak-vakasi-nilai/" +
                        data_id +
                        "'id='btnCetak' class='btn btn-primary btn-style rounded'>Cetak</a>";
                    document.getElementById("btnNew").innerHTML = btnNew;
                    // $("#btnNew").innerHTML(btnNew);
                } else {
                    $("#list_mk").html("");
                    list_kosong = `
                            <tr>
                                <td class="text-center" colspan="8">Tidak Ada Mata Kuliah</td>
                            </tr>
                        `;
                    $("#list_mk").append(list_kosong);
                }

                $("#detalMk").modal("show");
            },
        });
    });

    $("#tblVakasi").on("click", "#btnDelete", function () {
        data_id = $(this).attr("data");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                document.getElementById("form" + data_id).submit();
            }
        });
    });

    $("#tblVakasiKelas").on("click", "#btnDetailUTS", function () {
        var $this = $(this);
        var idJadwal = $(this).data("id-jadwal");
        var idtrnvakasi = $(this).data("id-trn-vakasi");
        var tgl_uts = $(this).data("tgl-uts");
        // console.log(tgl_uts);
        if (idtrnvakasi == "") {
            contain_vakasi =
                ` 
            <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="tgl_pengisian_nilai_uts">Tgl Pengisian Nilai UTS</label>
                    <input type="datetime-local" class="form-control" name="tgl_pengisian_nilai_uts" id="tgl_pengisian_nilai_uts" value="` +
                tgl_uts +
                `" required>
                    <input type="text" class="form-control" name="jenis_vakasi" hidden id="jenis_vakasi" value="UTS">
                    <input type="number" class="form-control" hidden name="id_jadwal" value=` +
                idJadwal +
                `>
                </div>
                <div class="mb-3">
                    <label for="insentif_vakasi">Insentif Tepat Mengajar</label>
                    <input type="number" class="form-control" name="insentif_vakasi_uts" id="insentif_vakasi_uts" value="0" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="status_cetak_uts">Status Cetak Vakasi</label>
                    <select class="form-select" name="status_cetak_uts">
                            <option value="T" selected>Belum Cetak</option>
                            <option value="Y">Sudah Cetak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="insentif_soal_uts">Insentif Bonus Soal</label>
                    <input type="number" class="form-control" name="insentif_soal_uts" id="insentif_soal_uts" value="0" required>
                </div>
            </div>
            `;
            document.getElementById("form_vakasi").innerHTML = contain_vakasi;
            $("#detalMk").modal("show");
        } else {
            $.ajax({
                method: "GET",
                url: "/dashboard/datavakasinilai/" + idtrnvakasi,
                success: function (data) {
                    inner_status_cetak = "";
                    if (data.status_cetak_uts == "Y") {
                        inner_status_cetak_uts = `
                                    <option value="Y" selected>Sudah Cetak</option>
                                    <option value="T">Belum Cetak</option>
                                    `;
                    } else {
                        inner_status_cetak_uts = `
                        <option value="T" selected>Belum Cetak</option>
                        <option value="Y">Sudah Cetak</option>
                        `;
                    }
                    contain_vakasi =
                        ` 
                    <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="insentif_vakasi">Insentif Tepat Mengajar</label>
                            <input type="datetime-local" class="form-control" name="tgl_pengisian_nilai_uts" id="tgl_pengisian_nilai_uts" value="` +
                        tgl_uts +
                        `" required>
                            <input type="text" class="form-control" name="jenis_vakasi" hidden id="jenis_vakasi" value="UTS">
                            <input type="number" class="form-control" hidden name="id_jadwal" value=` +
                        data.id_jadwal +
                        `>
                        </div>
                        <div class="mb-3">
                            <label for="insentif_vakasi">Insentif Tepat Mengajar</label>
                            <input type="number" class="form-control" name="insentif_vakasi_uts" id="insentif_vakasi_uts" value="` +
                        data.insentif_vakasi_uts +
                        `" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status_cetak">Status Cetak Vakasi</label>
                            <select class="form-select" name="status_cetak_uts">
                            ` +
                        inner_status_cetak_uts +
                        `
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name">Insentif Bonus Soal</label>
                            <input type="number" class="form-control" name="insentif_soal_uts" id="insentif_soal" value="` +
                        data.insentif_soal_uts +
                        `" required>
                        </div>
                    </div>
                    `;
                    document.getElementById("form_vakasi_update").innerHTML =
                        contain_vakasi;
                    $("#updateMk").modal("show");
                },
            });
        }
    });

    $("#tblVakasiKelas").on("click", "#btnDetailUAS", function () {
        var $this = $(this);
        var idJadwal = $(this).data("id-jadwal");
        var idtrnvakasi = $(this).data("id-trn-vakasi");
        var tgl_uas = $(this).data("tgl-uas");
        // console.log(tgl_uts);
        if (idtrnvakasi == "") {
            contain_vakasi =
                ` 
            <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="tgl_pengisian_nilai_uas">Tgl Pengisian Nilai UAS</label>
                    <input type="datetime-local" class="form-control" name="tgl_pengisian_nilai_uas" id="tgl_pengisian_nilai_uas" value="` +
                tgl_uas +
                `" required>
                    <input type="text" class="form-control" name="jenis_vakasi" hidden id="jenis_vakasi" value="UAS">
                    <input type="number" class="form-control" hidden name="id_jadwal" value=` +
                idJadwal +
                `>
                </div>
                <div class="mb-3">
                    <label for="insentif_vakasi_uas">Insentif Tepat Mengajar</label>
                    <input type="number" class="form-control" name="insentif_vakasi_uas" id="insentif_vakasi_uas" value="0" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="status_cetak_uas">Status Cetak Vakasi</label>
                    <select class="form-select" name="status_cetak_uas">
                            <option value="T" selected>Belum Cetak</option>
                            <option value="Y">Sudah Cetak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="insentif_soal_uas">Insentif Bonus Soal</label>
                    <input type="number" class="form-control" name="insentif_soal_uas" id="insentif_soal_uas" value="0" required>
                </div>
            </div>
            `;
            document.getElementById("form_vakasi").innerHTML = contain_vakasi;
            $("#detalMk").modal("show");
        } else {
            $.ajax({
                method: "GET",
                url: "/dashboard/datavakasinilai/" + idtrnvakasi,
                success: function (data) {
                    inner_status_cetak_uas = "";
                    if (data.status_cetak_uas == "Y") {
                        inner_status_cetak_uas = `
                                    <option value="Y" selected>Sudah Cetak</option>
                                    <option value="T">Belum Cetak</option>
                                    `;
                    } else {
                        inner_status_cetak_uas = `
                        <option value="T" selected>Belum Cetak</option>
                        <option value="Y">Sudah Cetak</option>
                        `;
                    }
                    contain_vakasi =
                        ` 
                    <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tgl_pengisian_nilai_uas">Insentif Tepat Mengajar</label>
                            <input type="datetime-local" class="form-control" name="tgl_pengisian_nilai_uas" id="tgl_pengisian_nilai_uas" value="` +
                        tgl_uas +
                        `" required>
                            <input type="text" class="form-control" name="jenis_vakasi" hidden id="jenis_vakasi" value="UAS">
                            <input type="number" class="form-control" hidden name="id_jadwal" value=` +
                        data.id_jadwal +
                        `>
                        </div>
                        <div class="mb-3">
                            <label for="insentif_vakasi_uas">Insentif Tepat Mengajar</label>
                            <input type="number" class="form-control" name="insentif_vakasi_uas" id="insentif_vakasi_uas" value="` +
                        data.insentif_vakasi_uas +
                        `" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status_cetak_uas">Status Cetak Vakasi</label>
                            <select class="form-select" name="status_cetak_uas">
                            ` +
                        inner_status_cetak_uas +
                        `
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="insentif_soal_uas">Insentif Bonus Soal</label>
                            <input type="number" class="form-control" name="insentif_soal_uas" id="insentif_soal_uas" value="` +
                        data.insentif_soal_uas +
                        `" required>
                        </div>
                    </div>
                    `;
                    document.getElementById("form_vakasi_update").innerHTML =
                        contain_vakasi;
                    $("#updateMk").modal("show");
                },
            });
        }
    });
});
