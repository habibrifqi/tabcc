<?php
session_start();
if (!isset($_SESSION['apriori_tncs_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "_transaksi/_get_menu.php";
// include_once "_transaksi/import_transaksi.php";
// include_once "import/excel_reader2.php";s
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <!-- <div class="page-header">
                <h1>
                    Data Transaksi
                </h1>
            </div> -->
            <!-- /.page-header -->
            <?php
//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}
$pp = '';
if($_SESSION["dd"]){
    $pp = $_SESSION["dd"];
    // echo $pp;
    $_SESSION["dd"] = '';
    // echo '<pre>';print_r($pp);
}


if(isset($_POST['submit'])){
    // if(!$input_error){
    $data = new Spreadsheet_Excel_Reader($_FILES['file_data_transaksi']['tmp_name']);

        $baris = $data->rowcount($sheet_index=0);
        $column = $data->colcount($sheet_index=0);
        //import data excel dari baris kedua, karena baris pertama adalah nama kolom
        // $temp_date = $temp_produk = "";
        for ($i=2; $i<=$baris; $i++) {
            for($c=1; $c<=$column; $c++){
                $value[$c] = $data->val($i, $c);
            }

            // if($i==2){
            //     $temp_produk .= $value[3];
            // }
            // else{
            //     if($temp_date == $value[1]){
            //         $temp_produk .= ",".$value[3];
            //     }
            //     else{
                    $table = "transaksi";
                    // $produkIn = get_produk_to_in($temp_produk);
                    $temp_date = format_date($value[1]);
                    $produkIn = $value[2];
                    
                    //mencegah ada jarak spasi
                    $produkIn = str_replace(" ,", ",", $produkIn);
                    $produkIn = str_replace("  ,", ",", $produkIn);
                    $produkIn = str_replace("   ,", ",", $produkIn);
                    $produkIn = str_replace("    ,", ",", $produkIn);
                    $produkIn = str_replace(", ", ",", $produkIn);
                    $produkIn = str_replace(",  ", ",", $produkIn);
                    $produkIn = str_replace(",   ", ",", $produkIn);
                    $produkIn = str_replace(",    ", ",", $produkIn);
                    //$item1 = explode(",", $produkIn);
                    
                    
//                    $field_value = array("transaction_date"=>($temp_date),
//                        "produk"=>$produkIn);
//                    $query = $db_object->insert_record($table, $field_value);
//                    INSERT INTO transaksi (transaction_date, produk)
//                    VALUES
//                    ('2016-06-01', 'nipple pigeon L'),
//                    ('2016-06-01', 'nipple ninio'),
//                    ('2016-06-01', 'mamamia L36'),
//                    ('2016-06-01', 'sweety FP XL34')
                    $sql = "INSERT INTO transaksi (transaction_date, produk) VALUES ";
                    $value_in = array();
                    //foreach ($item1 as $key => $isi) {
                      //  $value_in[] = "('$temp_date' , '$isi' )";
                    //}
                    //$value_to_sql_in = implode(",", $value_in);
                    //$sql .= $value_to_sql_in;
                    $sql .= " ('$temp_date', '$produkIn')";
                    $db_object->db_query($sql);

            //         $temp_produk = $value[3];
            //     }
            // }
            
            // $temp_date = $value[1];
        }
        ?>
            <script>
                location.replace("?menu=data_transaksi&pesan_success=Data berhasil disimpan");
            </script>
            <?php
}

if(isset($_POST['delete'])){
    $sql = "TRUNCATE transaksi";
    $db_object->db_query($sql);
    ?>
            <script>
                location.replace("?menu=data_transaksi&pesan_success=Data transaksi berhasil dihapus");
            </script>
            <?php
}

$sql = "SELECT
        *
        FROM
         transaksi 
         ORDER BY id DESC";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);

// get post dari _transaksi
$getmenu = $_POST['_get_menu'];
// $keys = array_keys($getmenu);
// rsort($keys);
// $mm = [
//     [
//         "nama" => 123,
//         "tai" => 23
//     ],
//     [
//         "nama" => 1,
//         "tai" => 2
//     ]
// ]
?>
<input type="hidden" name="pesan" id="pesan" value="<?= $pp ?>">
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <h3 class="card-title">data menus</h3> -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#tambah-transaksi">
                                            Tambah Transaksi
                                        </button>

                                        <button type="button" class="btn btn-info ml-2" data-toggle="modal"
                                            data-target="#import-transaksi">
                                            Import Data
                                        </button>
                                    </div>
                                    <div class="card-body">
                                    <?php
                                    if (!empty($pesan_error)) {
                                        display_error($pesan_error);
                                    }
                                    if (!empty($pesan_success)) {
                                        display_success($pesan_success);
                                    }

                                    echo "Jumlah data: ".$jumlah."<br>";
                                    if($jumlah==0){
                                        echo "Data kosong...";
                                    }
                                    ?>
                                     <table id="tabletransaksi" class="table">
                                        <thead>
                                            <th>id</th>
                                            <th>tanggal</th>
                                            <th>pesanan</th>
                                            <th style="min-width: 90px ;">Options</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-sm-12">
                    <div class="widget-box">
                        <div class="widget-body">
                            <div class="widget-main">
                                <?php
            // if (!empty($pesan_error)) {
            // display_error($pesan_error);
            // }
            // if (!empty($pesan_success)) {
            // display_success($pesan_success);
            // }

            // echo "Jumlah data: ".$jumlah."<br>";
            // if($jumlah==0){
            // echo "Data kosong...";
            // }
            // else{
            ?>
                                <!-- <table class='table table-bordered table-striped  table-hover'> -->
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Produk</th>
                                    </tr>
                                    <?php
                    // $no=1;
                    // while($row=$db_object->db_fetch_array($query)){
                    //     echo "<tr>";
                    //         echo "<td>".$no."</td>";
                    //         echo "<td>".format_date2($row['transaction_date'])."</td>";
                    //         echo "<td>".$row['produk']."</td>";
                    //     echo "</tr>";
                    //     $no++;
                    // }
                    ?>
                                <!-- </table> -->
                                <?php
            
            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
function get_produk_to_in($produk){
    $ex = explode(",", $produk);
    //$temp = "";
    for ($i=0; $i < count($ex); $i++) { 

        $jml_key = array_keys($ex, $ex[$i]);
        if(count($jml_key)>1){
            unset($ex[$i]);
        }

        //$temp = $ex[$i];
    }
    return implode(",", $ex);
}

?>

<!-- Tambah transaksi Modal -->
<div class="modal fade" id="tambah-transaksi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">tambah Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahtransaksiForm" action="javascript:void();" method="POST">
                    <!-- <h1>asdasd</h1> -->
                    <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" 
                                    data-target="#reservationdate" required/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <label>Multiple</label>
                        <select class="select2" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;" required>
                            <!-- <option selected disabled>all</option> -->
                            <!-- <option>dd</option> -->
                            <!-- <option>ed</option> -->
                            <!-- <option>ss</option> -->
                            <!-- <option><?//= $getmenu[0][1] ?></option> -->
                            <!-- <option>Nasgor Ori</option> -->
                            <?php 
                             foreach ($getmenu as $key) { ?>
                            <option><?= $key[1] ?></option>
                            <?php   
                            }
                            ?>
                        </select>
                    </div>
                    <!-- <button type="submit" class="btn btt">tt</button> -->
                    <div class="modal-footer justify-content-end">
                        <button type="reset"  class="btn btn-primary" id="clear">clear</button>
                        <button type="submit" class="btn btn-primary btn_transaksi">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Import Data transaksi Modal -->
<div class="modal fade" id="import-transaksi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!-- javascript:void(); -->
                <form id="import" action="_transaksi/import_transaksi.php" method="POST" enctype='multipart/form-data' >
                    <!-- <h1>asdasd</h1> -->
                    <div class="form-group">
                        <label>Import</label>
                           <input type="file" name="data" id="data">
                        </div>
                   
                    <div class="modal-footer justify-content-end">
                        <!-- <button type="reset"  class="btn btn-primary" id="clear">clear</button> -->
                        <button type="submit" name="submit" class="btn btn-primary btn_transaksi">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="edit-transaksi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">edit Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMenuForm" action="javascript:void();" method="POST">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="trid" name="trid" value="">
                    <div class="form-group">
                    <label>Date:</label>
                            <div class="input-group date" id="single_tanggal" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" 
                                    data-target="#single_tanggal" required/>
                                <div class="input-group-append" data-target="#single_tanggal" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                    <label>Multiple</label>
                        <select class="single_select2" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;" required>
                            <!-- <option selected disabled>all</option> -->
                            <!-- <option>dd</option> -->
                            <!-- <option>ed</option> -->
                            <!-- <option>ss</option> -->
                            <!-- <option><?//= $getmenu[0][1] ?></option> -->
                            <!-- <option>Nasgor Ori</option> -->
                            <?php 
                             foreach ($getmenu as $key) { ?>
                            <option><?= $key[1] ?></option>
                            <?php   
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
