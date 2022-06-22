<<?php 
include('connection.php');

$transaction_date = $_POST['tanggal'];
$produk = $_POST['transaksi'];

$data = array(
    'status'=> false,
    'result' => 0
  
);

$sql = "INSERT INTO transaksi (transaction_date,produk) VALUES ('$transaction_date','$produk')";

$query = mysqli_query($con,$sql);

$lastId = mysqli_insert_id($con);
if($query == true)
{
   
    $data = array(
        'status' => 'true',
        'result' => 1,
       
    );
}

    echo json_encode($data);

?>