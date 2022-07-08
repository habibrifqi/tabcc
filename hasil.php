<?php
//session_start();
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <!-- <div class="page-header"> -->
                <!-- <h1>
                    Hasil
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

$sql = "SELECT
        *
        FROM
         process_log  ORDER BY id DESC ";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
<!--            <form method="post" action="">
                <div class="form-group">
                    <input name="submit" type="submit" value="Proses" class="btn btn-success">
                </div>
            </form>-->

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }


            //echo "Jumlah data: ".$jumlah."<br>";
            if($jumlah==0){
                    echo "Data kosong...";
            }
            else{
            ?>
            <table style="width:100% ;" class='table table-bordered table-responsive-sm table table-bordered table-hover dataTable dtr-inline' id="table-hasil">
                <tr>
                <th>No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Min Support</th>
                <th>Min Confidence</th>
                <th></th>
                <th style="width: 100px ;text-align:center;">Options</th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
//                        if($no==1){
//                            echo "Min support: ".$row['min_support'];
//                            echo "<br>";
//                            echo "Min confidence: ".$row['min_confidence'];
//                        }
//                        $kom1 = explode(" , ",$row['kombinasi1']);
//                        $jika = implode(" Dan ", $kom1);
//                        $kom2 = explode(" , ",$row['kombinasi2']);
//                        $maka = implode(" Dan ", $kom2);
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".format_date2($row['start_date'])."</td>";
                            echo "<td>".format_date2($row['end_date'])."</td>";
                            echo "<td>".$row['min_support']."</td>";
                            echo "<td>".$row['min_confidence']."</td>";
                            $view = "<a href='index.php?menu=view_rule&id_process=".$row['id']."'>View rule</a>";
                            echo "<td>".$view."</td>";
                            echo "<td style='text-align:center'>";
                            // echo "<a href='export/CLP.php?id_process=".$row['id']."' "
                            //         . "class='btn btn-app btn-light btn-xs' target='blank'>
                            //         <i class='ace-icon fa fa-print bigger-160'></i>
                            //         Print
                            //     </a>";
                            echo "<a href='index.php?menu=view_rule_print&id_process=".$row['id']."' "
                            . "class='btn btn-primary btn-sm mb-1' target='blank'>
                            Print
                        </a> <button onclick=deletehasil('".$row["id"]."'); "
                        . "class='btn btn-danger btn-sm'>
                        delete
                    </button>";
                            echo "</td>";
//                            echo "<td>Jika ".$jika.", Maka ".$maka."</td>";
//                            echo "<td>".price_format($row['confidence'])."</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
            </table>
            <?php
            }
            ?>
                </div>
            </div>



        </div>
    </div>
</div>
