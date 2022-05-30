<?php 

include('connection.php');


$nama_menu = $_POST['nama_menu'];
$harga = $_POST['harga'];
$id = $_POST['id'];


$sql = "UPDATE `menus` SET  `nama_menu`='$nama_menu' , `harga`= '$harga' WHERE id='$id' ";

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