<?php 
include('connection.php');
$sql = "SELECT * FROM menus";
$query = mysqli_query($con,$sql);

// $row = mysqli_fetch_assoc($query);
// $data = array();
while($row =  mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['nama_menu'];
	$sub_array[] = $row['harga'];
	$data[] = $sub_array;
}


$_POST['_get_menu'] = $data;
?>