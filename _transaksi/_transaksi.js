$(document).ready(function () {
    // Select the option with a value of 'US'
    var s2 = $('.select2').select2({
        theme: 'bootstrap4'
    });
  
    var vals = ["ss","dd"];

    vals.forEach(function (e) {
        if (!s2.find('option:contains(' + e + ')').length)
            s2.append($('<option>').text(e));
    });

    s2.val(vals).trigger("change");

    $('#reservationdate').datetimepicker({
        // format: 'L',
        format: 'DD/MM/YYYY'
    });

});

// $('.btt').on('click', function () {

//     console.log(newdate);
//     console.log(textt);
// });

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
                    // console.log(data);

                    if (obj.status == 'true') {
                        // mytable = $('#tablemenus').DataTable();
                        // mytable.draw();
                        $('#tambah-transaksi').modal('hide');
                        $("#reservationdate").find("input").val("");
                        // $("#select2").val("");

                    } else {
                        alert('failed');
                    }
                }
            });
        } else {
            alert('Fill all the required fields');
        }
        console.log(ss);
    })
});

$(function () {
    $("#clear").click(function () {
        $(".select2").select2('val', 'All');
    });
    console.log(ss);
    $(".select2").select2().select2('val', '1');
});