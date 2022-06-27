<?php 
include('connection.php');
// if(isset($_POST['submit'])){
    $datanama = $_FILES['data']['name'];
    $datatmp = $_FILES['data']['tmp_name'];
    $exe = pathinfo($datanama, PATHINFO_EXTENSION);

    // $folder = 'file';
    $ff = 'import/'.$datanama;
    if ($exe == 'csv'){
        // $upload = move_uploaded_file($datatmp , $ff);
        if($exe == 'csv'){
            date_default_timezone_set('Asia/Jakarta');
            move_uploaded_file($datatmp, "../file/". date("d-m-Y-H-i-s-")."$datanama");
            $open = fopen("../file/". date("d-m-Y-H-i-s-")."$datanama", 'r');
            while(($row = fgetcsv($open, 500, ';'))!==false){
                // ganti format tanggal
                $pecah_tanngal = explode("/",$row[0]);
                $balik = array_reverse($pecah_tanngal);
                $gabung = join("-",$balik);
                $transaction_date = $gabung;

                $sql = "INSERT INTO transaksi (transaction_date,produk) VALUES ('$transaction_date','$row[1]')";
                $query = mysqli_query($con,$sql);
            }
            // var_dump($row);
            // echo $datatmp ;

            // echo " b b b b b "; 

            // echo $open ;
            // echo " b b b b b "; 
            // print_r($row);
            header('location:../index.php?menu=data_transaksi');
            // return ''
        }else{
            echo 'gagal upload';
        }
    }else{
        echo "bukan csv";
    }
// }


?>