<?php
error_reporting(0);
session_start();

$menu = '';
$titlepage = "Home";
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
}

if ($_GET['menu'] == 'proses_apriori') {
  $titlepage = "Proses Apriori";
}else if($_GET['menu'] == 'hasil'){
  $titlepage = "Hasil Proses Apriori";
}else if($_GET['menu'] == 'data_transaksi'){
  $titlepage = "Data Transaksi";
}else if($_GET['menu'] == 'menus'){
  $titlepage = "Menu";
}else if($_GET['menu'] == 'hasil' ||$_GET['id_process']){
  $titlepage = "Detail Hasil";
}else {
  $titlepage = "Home";
}


//if (!file_exists($menu . ".php")) {
//    $menu = 'not_found';
//}

if (!isset($_SESSION['apriori_tncs_id']) &&
        ( $menu != 'tentang' & $menu != 'not_found' & $menu != 'forbidden')) {
    header("location:login.php");
}
include_once 'fungsi.php';
//include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $titlepage ?></title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="template/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/summernote/summernote-bs4.min.css">
  <!-- T daterange -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="template/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> -->

  <!-- sweet alert -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="template/AdminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="template/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Animasi Loading Page -->
    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center"> -->
    <!-- <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
    <!-- </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include "menu.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $titlepage ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active"><?= $titlepage ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- mulai dari row -->
          <?php
            $menu = ''; //variable untuk menampung menu
            if (isset($_GET['menu'])) {
                $menu = $_GET['menu'];
            }

            if ($menu != '') {
                if (can_access_menu($menu)) {
                    if (file_exists($menu . ".php")) {
                        include $menu . '.php';
                    } else {
                        include "not_found.php";
                    }
                } else {
                    include "forbidden.php";
                }
            } 
            else {
                include "home.php";
            }
            ?>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="">Habib Rifqi</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="template/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->




  <!-- jQuery UI 1.11.4 -->
  <!-- <script src="template/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="template/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="template/AdminLTE/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="template/AdminLTE/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="template/AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="template/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="template/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="template/AdminLTE/plugins/moment/moment.min.js"></script>
  <script src="template/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="template/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="template/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="template/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="template/AdminLTE/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="template/AdminLTE/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="template/AdminLTE/dist/js/pages/dashboard.js"></script>

  <!-- DataTables JS -->
  <script src="template/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="template/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script> -->
  <!-- T daterange JS -->
  <script src="template/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>

  <!-- Select2 -->
  <script src="template/AdminLTE/plugins/select2/js/select2.full.min.js"></script>
  <!-- sweet alaert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="template/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>



  <script type="text/javascript">
    jQuery(function ($) {
      $('input[name=range_tanggal]').daterangepicker({
        'applyClass': 'btn-sm btn-success',
        'cancelClass': 'btn-sm btn-default',
        locale: {
          applyLabel: 'Apply',
          cancelLabel: 'Cancel',
          format: 'DD/MM/YYYY',
        }
      });
      //datepicker plugin
      //link
      $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function () {
          $(this).prev().focus();
        });

      //or change it into a date range picker
      $('.input-daterange').datepicker({
        autoclose: true
      });


      //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
      $('input[name=range_tanggal]').daterangepicker(

          {
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
              applyLabel: 'Apply',
              cancelLabel: 'Cancel',
              format: 'DD/MM/YYYY',
            }
          })
        .prev().on(ace.click_event, function () {
          $(this).next().focus();
        });

      $('#id-input-file-1 , #id-input-file-2').ace_file_input({
        no_file: 'No File ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false //| true | large
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
      });

      //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
      //but sometimes it brings up errors with normal resize event handlers
      $.resize.throttleWindow = false;

      /////////////////////////////////////
      $(document).one('ajaxloadstart.page', function (e) {
        $tooltip.remove();
      });
    });
  </script>
  <?php
    if ( $_GET['menu'] == 'menus') : ?>
  <script src="menus/menus.js"></script>
  <?php endif ?>

  <?php
    if ( $_GET['menu'] == 'data_transaksi') : ?>
  <script src="_transaksi/_transaksi.js"></script>
  <?php endif ?>

  <script>
    // $("#custom-tabs-one-home").hide();
    $(document).ready(function () {
      $("#custom-tabs-one-itemset1").show();
      $("#custom-tabs-one-itemset2").hide();
      $("#custom-tabs-one-itemset3").hide();
      $("#custom-tabs-one-confident").hide();
    });
    $("#custom-tabs-one-itemset1-tab").click(function () {
      $("#custom-tabs-one-itemset1").show();
      $("#custom-tabs-one-itemset2").hide();
      $("#custom-tabs-one-itemset3").hide();
      $("#custom-tabs-one-confident").hide();
      console.log('sds');
    });

    $("#custom-tabs-one-itemset2-tab").click(function () {
      $("#custom-tabs-one-itemset2").show();
      $("#custom-tabs-one-itemset1").hide();
      $("#custom-tabs-one-itemset3").hide();
      $("#custom-tabs-one-confident").hide();
      console.log('sds');
    });

    $("#custom-tabs-one-itemset3-tab").click(function () {
      $("#custom-tabs-one-itemset3").show();
      $("#custom-tabs-one-itemset1").hide();
      $("#custom-tabs-one-itemset2").hide();
      $("#custom-tabs-one-confident").hide();
      console.log('sds');
    });

    $("#custom-tabs-one-confident-tab").click(function () {
      $("#custom-tabs-one-confident").show();
      $("#custom-tabs-one-itemset1").hide();
      $("#custom-tabs-one-itemset2").hide();
      $("#custom-tabs-one-itemset3").hide();
      console.log('sds');
    });

    function deletehasil(id) {
      var id = id;
      console.log(id);
      if (confirm("hapus?") == true) {
        $.ajax({
          url: '_hasil/delete_hasil.php',
          type: 'POST',
          data: {
            'id': id
          },
          success: function (data) {
            // location.reload();
            // let dataAmbilAs = dataambil.substr(1);
            var json = JSON.parse(data);
            status = json.status;
            console.log(status);
            if (status == 'true') {
            //menambah 0000 di id utnukbisa dihapus
            // $('#table-hasil').reload();
            swal.fire({
                            title: "Import Berhasil",
                            text: "Data Berhasil Ditambah",
                            icon: "success",
                            timer: 2000,
                            // showCancelButton: true,
                            // confirmButtonColor: "#DD6B55",
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            
                        });
                        
                        setTimeout(function(){
                    window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
                },2100);
                // 
            } else {
                alert('gagal menghapus');
            }
          }
        })
      }
    }
  </script>




</body>

</html>