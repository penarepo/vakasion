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
                url: "/dashboard/getpengisiannilai",
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
                    data: "kode_mk",
                    name: "kode_mk",
                },
                {
                    data: "nama_mk",
                    name: "nama_mk",
                },
                {
                    data: "nama_kelas",
                    name: "nama_kelas",
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
                    data: "tgl_pengisian_nilai_uts",
                    name: "tgl_pengisian_nilai_uts",
                },
                {
                    data: "tgl_pengisian_nilai_uas",
                    name: "tgl_pengisian_nilai_uas",
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
                {
                    targets: [7], // your case first column
                    render: function (data, type, row) {
                        if (data == "1970-01-01 00:00:00" || !data) {
                            return "Belum Input Nilai";
                        } else {
                            return data;
                        }
                    },
                },
                {
                    targets: [8], // your case first column
                    render: function (data, type, row) {
                        if (data == "1970-01-01 00:00:00" || !data) {
                            return "Belum Input Nilai";
                        } else {
                            return data;
                        }
                    },
                },
            ],
        });
    });

    $("#tblVakasi").on("click", "#btnDetail", function () {
        data_id = $(this).attr("data");

        $.ajax({
            method: "GET",
            url: "/dashboard/pengisiannilai/show/" + data_id,
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

    function filter() {
        table.ajax.reload(null, false);
    }
});
