<?php 
include('connection.php');
session_start();
if(isset($_POST['submit'])){
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
                $pecah_tanngal = explode("/",$row[1]);
                $balik = array_reverse($pecah_tanngal);
                $gabung = join("-",$balik);
                $transaction_date = $gabung;
                $pecah_transaksi = explode(",",$row[2]);

                $i = 0;

                while($i < count($pecah_transaksi))
                {
                    $menu = ucwords($pecah_transaksi[$i]);
                    
                    $sql1 = "INSERT INTO menus (nama_menu,harga) VALUES ('$menu','0')";
                    $query1 = mysqli_query($con,$sql1);
                    $i++;
                   
                }
                $pesanan_final = ucwords(ucwords($row[2]), '\',');
                // echo "<pre>"; print_r($pecah_transaksi[$i]);die;
                $sql = "INSERT INTO transaksi (transaction_date,produk) VALUES ('$transaction_date','$pesanan_final')";
                $query = mysqli_query($con,$sql);
            }
            // var_dump($row);
            // echo $datatmp ;

            // echo " b b b b b "; 

            // echo $open ;
            // echo " b b b b b "; 
            // print_r($row);
            $_SESSION['dd'] = "csv";
            header('location:../index.php?menu=data_transaksi');
            // return ''
        }else{
            echo 'gagal upload';
        }
    }else{
        $_SESSION['dd'] = "bukan csv";
        header('location:../index.php?menu=data_transaksi');
    }
}
// $_SESSION['dd'] = "";



?>