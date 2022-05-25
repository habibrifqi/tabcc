<<?php 
include('connection.php');

$nama_menu = $_POST['nama_menu'];
$harga = $_POST['harga'];

$data = array(
    'status'=> false,
    'result' => 0
  
);

$sql = "INSERT INTO menus (nama_menu,harga) VALUES ('$nama_menu','$harga')";

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