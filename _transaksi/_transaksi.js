$(document).ready(function () {
    // Select the option with a value of 'US'
    var s2 = $('.select2').select2({
        theme: 'bootstrap4'
    });


    // var vals = ["Onion Ring", "Sosis Bakar"];

    // console.log(vals);
    // vals.forEach(function (e) {
    //     if (!s2.find('option:contains(' + e + ')').length)
    //         s2.append($('<option>').text(e));
    // });

    // s2.val(vals).trigger("change");

    $('#reservationdate').datetimepicker({
        // format: 'L',
        format: 'DD/MM/YYYY'
    });
    $('#single_tanggal').datetimepicker({
        // format: 'L',
        format: 'DD/MM/YYYY'
    });

});

$(document).ready(function () {
    let tt = $('#tabletransaksi').DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'responsive': true,
        // order: [[1, 'asc']],
        'ajax': {
            'url': '_transaksi/fetch_data.php',
            'type': 'post',
        },
        columnDefs: [{
            searchable: true,
            orderable: false,
            targets: 0,
        }, ],
        // order: [[1, 'asc']],
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [4]
            },

        ]
        // columnDefs: [{
        //   // 'target': [0, 5],
        //   // 'ordertable': true,
        // }]
    });
});

function editForm(url) {
    $('#edit-transaksi').modal('show');
    var id = url;
    // $(document).ready(function () {
    //     var trid = $('#trid').closet('tr').attr('id');
    // })

    $.ajax({
        url: "_transaksi/get_single_transaksi.php",
        data: {
            'id': id
        },
        type: "post",
        success: function (data) {
            console.log(data);
            var json = JSON.parse(data);
            var data_singel_tanggal = json.transaction_date;
            var data_transaction_date = (data_singel_tanggal.split("-").reverse().join("/"));

            var single_select2 = $('.single_select2').select2({
                theme: 'bootstrap4'
            });

            var data_singgle_produk = json.produk;
            var array = data_singgle_produk.split(",");
            // console.log(array);

            array.forEach(function (e) {
                if (!single_select2.find('option:contains(' + e + ')').length)
                    single_select2.append($('<option>').text(e));
            });

            single_select2.val(array).trigger("change");
            $("#single_tanggal").find("input").val(data_transaction_date);
            $('#id').val(json.id);
        }
    });

}

$(document).on('submit', '#edit-transaksi', function (event) {
    var time = $("#single_tanggal").find("input").val();
    var ss = $(".single_select2").val();
    var _transaksi = ss.toString();
    var date = time;
    var d = new Date(date.split("/").reverse().join("-"));
    var dd = d.getDate();
    var mm = d.getMonth() + 1;
    var yy = d.getFullYear();
    var _tanggal = yy + "-" + mm + "-" + dd;

    var id = $('#id').val();

    var tanggal = _tanggal;
    var transaksi = _transaksi;
    console.log(id);
    $.ajax({
        url: "_transaksi/update_transaksi.php",
        data: {
            'id': id,
            'transaction_date': tanggal,
            'produk': transaksi
        },
        type: 'post',
        success: function (data) {
            var json = JSON.parse(data);
            status = json.status;
            console.log(status);
            if (status == 'true') {
                var t = $('#tabletransaksi').DataTable();
                t.draw();
                $('#edit-transaksi').modal('hide');
                swal.fire({
                    title: "Update Berhasil!",
                    text: "Transaksi Berhasil Diupdate",
                    icon: "success",
                    timer: 2000,
                    // showCancelButton: true,
                    // confirmButtonColor: "#DD6B55",
                    showCancelButton: false, // There won't be any cancel button
                    showConfirmButton: false
                });
            } else {
                $('#edit-transaksi').modal('hide');
                alert('data sudah terpakai');
            }
        }
    })
})

// tambah transaksi
$(document).ready(function () {
    $(document).on('submit', '#tambahtransaksiForm', function (event) {
        event.preventDefault();
        // add value tanggal dan input
        var time = $("#reservationdate").find("input").val();
        var ss = $(".select2").val();
        var _transaksi = ss.toString();
        var date = time;
        var d = new Date(date.split("/").reverse().join("-"));
        var dd = d.getDate();
        var mm = d.getMonth() + 1;
        var yy = d.getFullYear();
        var _tanggal = yy + "-" + mm + "-" + dd;


        var tanggal = _tanggal;
        var transaksi = _transaksi;
        if (tanggal != '' && transaksi != '') {
            $.ajax({
                url: "_transaksi/tambah_transaksi.php",
                type: "post",
                data: {
                    'tanggal': tanggal,
                    'transaksi': transaksi
                },
                success: function (data) {
                    dataambil = data;
                    let dataAmbilAs = dataambil.substr(1);
                    const obj = JSON.parse(dataAmbilAs);
                    // const obj = JSON.parse(data);
                    console.log(obj.status);

                    if (obj.status == 'true') {
                        var t = $('#tabletransaksi').DataTable();
                        t.draw();
                        $('#tambah-transaksi').modal('hide');
                        $("#reservationdate").find("input").val([""]);
                        // $("#select2").val("");
                        swal.fire({
                            title: "Berhasil",
                            text: "Transaksi Berhasil Ditambah",
                            icon: "success",
                            timer: 2000,
                            // showCancelButton: true,
                            // confirmButtonColor: "#DD6B55",
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false
                        });

                    } else {
                        alert('failed');
                    }
                }
            });
        } else {
            alert('Fill all the required fields');
        }
        // console.log(ss);
    })
});



// delete transaksi
function deletemenu(id) {
    var id = id;
    // if (confirm("hapus?") == true) {

    // }

    Swal.fire({
        title: 'Hapus Transaksi ?',
        text: "Transaksi Akan Dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        // timer: 2000,
        // showCancelButton: true,
        // confirmButtonColor: "#DD6B55",
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '_transaksi/delete_transaksi.php',
                data: {
                    'id': id
                },
                type: 'POST',
                success: function (data) {

                    var json = JSON.parse(data);
                    var status = json.status;
                    if (status == 'success') {
                        // menambah 0000 di id utnukbisa dihapus
                        var noid = id.toString();
                        var dd = noid.padStart(5, '0');
                        var ddd = "T";
                        ddd += dd;
                        $('#' + ddd).closest('tr').remove();
                    } else {
                        alert('gagal menghapus');
                    }
                }
            })
            swal.fire({
                title: "Berhasil",
                text: "Transaksi Berhasil Dihapus",
                icon: "success",
                timer: 2000,
                // showCancelButton: true,
                // confirmButtonColor: "#DD6B55",
                showCancelButton: false, // There won't be any cancel button
                showConfirmButton: false
            });
        }
    })
}

$(function () {
    $("#clear").click(function () {
        $(".select2").select2('val', 'All');
    });
    console.log(ss);
    $(".select2").select2().select2('val', '1');
});

// $(document).on('submit', '#import', function (event) {


//     var data = $("#data").val();

//     $.ajax({
//         url: "_transaksi/import_transaksi.php",
//         type: "post",
//         data: {
//             'data': data,
//         },
//         success: function (data) {
//             dataambil = data;
//             // let dataAmbilAs = dataambil.substr(1);
//             // const obj = JSON.parse(dataAmbilAs);
//             // // const obj = JSON.parse(data);
//             console.log(dataambil);

//             // if (obj.status == 'true') {
//             //     var t = $('#tabletransaksi').DataTable();
//             //     t.draw();
//             //     $('#tambah-transaksi').modal('hide');
//             //     $("#reservationdate").find("input").val([""]);
//             //     // $("#select2").val("");

//             // } else {
//             //     alert('failed');
//             // }
//         }
//     });
//     // return false;
// })
$(document).ready(function () {
    var tt = $("#pesan").val();
    // console.log(tt);
    if (tt == 'bukan csv') {
        $("#pesan").val("");
        swal.fire({
            title: "Gagal Import! Periksa Kembali Format",
            text: "Format File Harus Csv",
            icon: "error",
            timer: 2000,
            // showCancelButton: true,
            // confirmButtonColor: "#DD6B55",
            showCancelButton: false, // There won't be any cancel button
            showConfirmButton: false
        });
    }

    if (tt == 'csv') {
        $("#pesan").val("");
        swal.fire({
            title: "Import Berhasil",
            text: "Data Berhasil Ditambah",
            icon: "success",
            timer: 2000,
            // showCancelButton: true,
            // confirmButtonColor: "#DD6B55",
            showCancelButton: false, // There won't be any cancel button
            showConfirmButton: false
        });
    }
});