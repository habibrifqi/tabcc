// get datatable menu
$(document).ready(function () {
    let t = $('#tablemenus').DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        // order: [[1, 'asc']],
        'responsive': true,
        'ajax': {
            'url': 'menus/fetch_data.php',
            'type': 'post',
        },
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: 0,
        }, ],
        // order: [[1, 'asc']],
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [4]
            },

        ],
        "aoColumns": [{
                "sWidth": "30px"

            },
            null,
            null,
            {
                "sWidth": "90px",
                "sClass": "dt-center"
            }
        ],
        // columnDefs: [{
        //   // 'target': [0, 5],
        //   // 'ordertable': true,
        // }]
    });

    t.on('order.dt search.dt', function () {
        let i = 1;

        t.cells(0, {
            search: 'applied',
            order: 'applied'
        }).every(function (cell) {
            this.data(i++);
        });
    }).draw();


    $('.swalDefaultSuccess').click(function () {
        console.log('asdasd');
        // Toast.fire({
        //     icon: 'success',
        //     title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        // });
        swal.fire({
            title: "Berhasil!",
            text: "Menu Berhasil ditambahkan",
            icon: "success",
            timer: 2000,
            // showCancelButton: true,
            // confirmButtonColor: "#DD6B55",
            showCancelButton: false, // There won't be any cancel button
            showConfirmButton: false
        });
        // Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success',

        // )
    });

});

// get datatable menu end



// show single menu
function editForm(url) {
    $('#edit-menu').modal('show');
    var id = url;
    $(document).ready(function () {
        var trid = $('#trid').closet('tr').attr('id');
    })

    $.ajax({
        url: "menus/get_single_menu.php",
        data: {
            'id': id
        },
        type: "post",
        success: function (data) {
            console.log(data);
            var json = JSON.parse(data);
            $('#_nama_menu').val(json.nama_menu);
            $('#_harga').val(json.harga);
            $('#id').val(json.id);
            $('#trid').val(trid);
        }
    });

}
// show single menu end

// tambah menu
$(document).ready(function () {
    $(document).on('submit', '#tambahMenusForm', function (event) {
        event.preventDefault();
        var nama_menu = $('#tambah_nama_menu').val();
        var harga = $('#tambah_harga').val();
        if (nama_menu != '' && harga != '') {
            $.ajax({
                url: "menus/tambah_menus.php",
                type: "post",
                data: {
                    'nama_menu': nama_menu,
                    'harga': harga
                },
                success: function (data) {
                    dataambil = data;
                    let dataAmbilAs = dataambil.substr(1);
                    const obj = JSON.parse(dataAmbilAs);


                    if (obj.status == 'true') {
                        mytable = $('#tablemenus').DataTable();
                        mytable.draw();
                        $('#tambah-menu').modal('hide');
                        $("#tambah_harga").val("");
                        $("#tambah_nama_menu").val("");
                        swal.fire({
                            title: "Berhasil!",
                            text: "Menu Berhasil ditambahkan",
                            icon: "success",
                            timer: 2000,
                            // showCancelButton: true,
                            // confirmButtonColor: "#DD6B55",
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false
                        });
                    } else {
                        swal.fire({
                            title: "Gagal!",
                            text: "Menu Sudah Terdaftar",
                            icon: "error",
                            timer: 2000,
                            // showCancelButton: true,
                            // confirmButtonColor: "#DD6B55",
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false
                        });
                    }
                }
            });
        } else {
            alert('Fill all the required fields');
        }
    })
});
// tambah menu

// edit/update menu
$(document).on('submit', '#editMenuForm', function (event) {
    var id = $('#id').val();
    var trid = $('#trid').val();
    var nama_menu = $('#_nama_menu').val();
    var harga = $('#_harga').val();
    $.ajax({
        url: "menus/update_menu.php",
        data: {
            'id': id,
            'nama_menu': nama_menu,
            'harga': harga
        },
        type: 'post',
        success: function (data) {
            var json = JSON.parse(data);
            status = json.status;
            console.log(status);
            if (status == 'true') {
                var t = $('#tablemenus').DataTable();
                t.draw();
                $('#edit-menu').modal('hide');
                // var button = '<button  onclick=editForm(`'+id+'`); data-id="'+id+'" class="btn btn-info btn-sm editbtn" id=`"editbtn"`>Edit</button> <button  onclick=deletemenus(`'+id+'`); data-id="'+id+'" class="btn btn-danger btn-sm deletebtnMenu" id=`"deletebtnMenu"`>delete</button> '
                // var row = table.row("[id='" + trid + "']");
                // row.row("[id='" + trid + "']").data([id, nama_menu, harga, button]);
                swal.fire({
                    title: "Update Berhasil!",
                    text: "Menu Berhasil Diupdate",
                    icon: "success",
                    timer: 2000,
                    // showCancelButton: true,
                    // confirmButtonColor: "#DD6B55",
                    showCancelButton: false, // There won't be any cancel button
                    showConfirmButton: false
                });
            } else {
                // $('#edit-menu').modal('hide');
                swal.fire({
                    title: "Update Menu Gagal",
                    text: "Menu Sudah Terdaftar",
                    icon: "error",
                    timer: 2000,
                    // showCancelButton: true,
                    // confirmButtonColor: "#DD6B55",
                    showCancelButton: false, // There won't be any cancel button
                    showConfirmButton: false
                });
            }
        }
    })
})
// edit/update end

// delete menu
function deletemenu(id) {
    var id = id;
    // if (confirm("hapus?") == true) {
    //     $.ajax({
    //         url: 'menus/delete_menu.php',
    //         data: {
    //             'id': id
    //         },
    //         type: 'POST',
    //         success: function (data) {

    //             var json = JSON.parse(data);
    //             var status = json.status;
    //             if (status == 'success') {
    //                 // menambah 0000 di id utnukbisa dihapus
    //                 var noid = id.toString();
    //                 var dd = noid.padStart(5, '0');
    //                 var ddd = "M";
    //                 ddd += dd;
    //                 $('#' + ddd).closest('tr').remove();
    //             } else {
    //                 alert('gagal menghapus');
    //             }
    //         }
    //     })
    // }
    Swal.fire({
        title: 'Hapus Menu ?',
        text: "Menu Akan Dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'menus/delete_menu.php',
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
                        var ddd = "M";
                        ddd += dd;
                        $('#' + ddd).closest('tr').remove();
                    } else {
                        alert('gagal menghapus');
                    }
                }
            })


            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}
// delete menu end