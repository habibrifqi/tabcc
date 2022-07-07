<?php 

include('connection.php');


$transaction_date = $_POST['transaction_date'];
$produk = $_POST['produk'];
$id = $_POST['id'];


$sql = "UPDATE `transaksi` SET  `transaction_date`='$transaction_date' , `produk`= '$produk' WHERE id='$id' ";

$query = mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 



?>